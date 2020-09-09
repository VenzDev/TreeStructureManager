@php
   $treeChildren = $tree->children()->get();

   $children = $tree->children()->get()->toArray();
   $filteredChildren = array_filter($children,function($element){
       return $element['parentID']!=null;
   }); 
@endphp

@if(count($filteredChildren) > 0)
    @include('trees.partials.element',['id'=>$tree->id,'text'=>$tree->text,'haveChildren'=>true])
    @foreach ($treeChildren as $tc)
        @if($tc->parentID !=null)
            <div class="nested" id={{$tree->id}}>
                @include('trees.partials.showTrees',['tree'=> $tc])
            </div>
        @endif
    @endforeach
@else 
    @include('trees.partials.element',['id'=>$tree->id,'text'=>$tree->text,'haveChildren'=>false])
@endif
