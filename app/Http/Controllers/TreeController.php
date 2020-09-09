<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tree;
class TreeController extends Controller
{
    //Display home page
    //GET: /trees 
    public function index()
    {
        return view('trees.index',['trees'=>Tree::all()]);
    }

    //Display form for creating root element
    //GET /trees/create
    public function create()
    {
        return view('trees.create');
    }

    //Display form for creating element children
    //GET: /trees/createChildren/{id}
    public function createChildren($id)
    {
        $tree = Tree::findOrFail($id);
        return view('trees.createChildren',['tree'=>$tree]);
    }

    //Store a newly created element in database.
    //POST: /trees
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|min:3|max:50',
        ]);

        $text = $request->input('text','Tree text');
        $id = $request->input('id',null);

        $tree = new Tree();
        $tree->text = $text;
        $tree->parentID = $id;
        $tree->save();

        $request->session()->flash('status','Element successfully created!');

        return redirect()->route('trees.index', ['trees' => Tree::all()]);
    }

    //Display form for editing element
    //GET: /trees/{treeId}/edit
    public function edit($id)
    {
        $tree = Tree::findOrFail($id);
        return view("trees.edit",['tree'=> $tree,'selectTree'=> $this->getChildrenForSelect($id)]);
    }

    //Update element
    //PUT: /trees/{treeId}
    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|min:3|max:50',
        ]);

        $parentID = $request->input('select','Tree text');
        $text = $request->input('text');
        $treeToUpdate = Tree::find($id);

        if($parentID == 'root'){
            $treeToUpdate->parentID = null;
        } else {
            $treeToUpdate->parentID = (int)$parentID;
        }

        $treeToUpdate->text = $text;
        $treeToUpdate->save();

        $request->session()->flash('status','Element successfully edited!');

        return redirect()->route("trees.index",['trees'=>Tree::all()]);
    }

    //Show deleteForm
    //GET: trees/destory/{treeId}
    public function deleteForm(Request $request, $id)
    {
        $tree = Tree::findOrFail($id);
        return view("trees.delete",['tree'=> $tree]);
    }

    //Remove tree with children form database
    //DELETE: trees/{treeId}
    public function destroy(Request $request,$id)
    {
        $tree = Tree::findOrFail($id);
        $this->deleteChildren($tree);

        $request->session()->flash('status','Element successfully deleted!');

        return redirect()->route('trees.index', ['trees' => Tree::all()]);
    }

    //Recursive method for deleting children
    private function deleteChildren(Tree $tree){
        $treeChildren = $tree->children()->get();

        if(count($treeChildren)>0){
            foreach( $treeChildren as $t){
                $this->deleteChildren($t);
            }
        }
        $tree->delete();
    }

    //Method for displaying possible parents
    //Prevent from select element children
    private function getChildrenForSelect($id){
        $list = $this->deleteChildrenFromLIst(Tree::all(),Tree::find($id));

        return $list->filter(function($item) use (&$id){
            return $item->id !=$id;
        });
    }
    //Recursive deleting children from list
    private function deleteChildrenFromLIst($treeList,$tree){
        $treeChildren = $tree->children()->get();

        foreach($treeChildren as $child){

            if(count($treeChildren)> 0 && $child->id!=$tree->id){
                $treeList = $this->deleteChildrenFromLIst($treeList,$child);
            }
            
            $treeList = $treeList->filter(function($el) use (&$child){
                return $el->id!=$child->id;
            });

        }

        return $treeList;
    }

}
