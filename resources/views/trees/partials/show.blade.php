@php
   $children = $tree->children()->get()->toArray();
   $treeChildren = $tree->children()->get();
   $filteredChildren = array_filter($children,function($element){
       return $element['parentID']!=null;
   }); 
@endphp

@if(count($filteredChildren) > 0)
<div class="element"> 
    <i class="fas fa-angle-down"></i>
    <span>{{$tree->text}}</span>
    <div class="element__divider"></div>
    <div class="element__icons">
        <a>
            <i class="fas fa-plus"></i>
        </a>
        <a>
            <i class="fas fa-edit"></i>
        </a>
         <a href={{route("trees.destroy",['tree'=>$tree->id])}}>
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>
    @foreach ($treeChildren as $tc)
    @if($tc->parentID !=null)
    <div class="nested">
        @include('trees.partials.show',['tree'=> $tc])
    </div>
        @endif
    @endforeach
@else 
<div class="element">
    <i class="far fa-circle"></i>
    <span>{{$tree->text}}</span>
    <div class="element__divider"></div>
    <div class="element__icons">
        <a>
            <i class="fas fa-plus"></i>
        </a>
        <a>
            <i class="fas fa-edit"></i>
        </a>
         <a>
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>
@endif
