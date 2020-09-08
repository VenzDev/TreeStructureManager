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

        $tree = new Tree();
        $tree->text = $text;
        $tree->parentID = null;
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
        //
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
        //
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
        return view("trees.delete");
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
}
