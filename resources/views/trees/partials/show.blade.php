@php
   $children = $tree->children()->get()->toArray();
   $treeChildren = $tree->children()->get();
   $filteredChildren = array_filter($children,function($element){
       return $element['parentID']!=null;
   }); 
@endphp

@if(count($filteredChildren) > 0)

<span>{{$tree->text}}</span>
    @foreach ($treeChildren as $tc)
    @if($tc->parentID !=null)
    <ul class="nested">
        @include('trees.partials.show',['tree'=> $tc])
    </ul>
        @endif
    @endforeach
@else 
<span>{{$tree->text}}</span>
@endif
