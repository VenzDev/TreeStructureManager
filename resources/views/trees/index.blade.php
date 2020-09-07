@foreach ($trees as $tree) 
    @if($tree->parentID ==null)
        @include('trees.partials.show',['tree'=> $tree])
    @endif
@endforeach