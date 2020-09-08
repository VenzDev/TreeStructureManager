<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tree;
class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trees.index',['trees'=>Tree::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trees.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createChildren($id)
    {
        return view('trees.createChildren',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|max:50',
        ]);

        $text = $request->input('text','Tree text');
        $id = $request->input('id',null);

        $tree = new Tree();
        $tree->text = $text;
        $tree->parentID = $id;
        $tree->save();

        return redirect()->route('trees.index', ['trees' => Tree::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tree = Tree::findOrFail($id);
        return view("trees.edit",['tree'=> $tree,'selectTree'=> $this->getChildrenForSelect($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $text = $request->input('select','Tree text');
        $parentID = null;
        $treeToUpdate = Tree::find($id);
        if($text == 'root'){
            $treeToUpdate->parentID = null;
        } else {
            $treeToUpdate->parentID = (int)$text;
        }
        $treeToUpdate->save();

        return redirect()->route("trees.index",['trees'=>Tree::all()]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteForm(Request $request, $id)
    {
        $tree = Tree::findOrFail($id);
        return view("trees.delete",['tree'=> $tree]);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $tree = Tree::findOrFail($id);
        $this->deleteChildren($tree);

        return redirect()->route('trees.index', ['trees' => Tree::all()]);
    }

    private function deleteChildren(Tree $tree){
        $treeChildren = $tree->children()->get();

        if(count($treeChildren)>0){
            foreach( $treeChildren as $t){
                $this->deleteChildren($t);
            }
        }
        $tree->delete();
    }

    private function getChildrenForSelect($id){
        $list = $this->deleteChildrenFromLIst(Tree::all(),Tree::find($id));

        return $list->filter(function($item) use (&$id){
            return $item->id !=$id;
        });
    }

    private function deleteChildrenFromLIst($treeList,$tree){
        $treeChildren = $tree->children()->get();
        foreach($treeChildren as $t){
            if(count($treeChildren)> 0 && $t->id!=$tree->id){
                $treeList = $this->deleteChildrenFromLIst($treeList,$t);
            }
            $treeList = $treeList->filter(function($item) use (&$t){
                return $item->id!=$t->id;
            });
        }
        return $treeList;
    }
}
