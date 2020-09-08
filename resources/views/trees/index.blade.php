@extends('trees.layout')

@section('content')
    <div class="wrapper">
        <a href={{route('trees.create')}} class="wrapper__button">Add New Root</a>
        @foreach ($trees as $tree) 
            @if($tree->parentID ==null)
                @include('trees.partials.showTrees',['tree'=> $tree])
            @endif
        @endforeach
    </div>
@endsection