<div class="element">
    @if ($haveChildren)
        <i class="far fa-circle"></i>
    @else
        <i class="fas fa-angle-down"></i>
    @endif
    <span>{{$text}}</span>
    <div class="element__divider"></div>
    <div class="element__icons">
        <a href="{{route("trees.createChildren",['id'=>$id])}}">
            <i class="fas fa-plus"></i>
        </a>
        <a href="{{route("trees.edit",['tree'=>$id])}}">
            <i class="fas fa-edit"></i>
        </a>
         <a href={{route("trees.deleteForm",['id'=>$id])}}>
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>