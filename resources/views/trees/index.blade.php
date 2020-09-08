@extends('trees.layout')

@section('content')
    <div class="wrapper">
        <a href={{route('trees.create')}} class="wrapper__button">Add New Root</a>
        @if (session()->has('status'))
            <div class="wrapper__message">
                <p>{{session()->get('status')}}</p>
            </div>
        @endif
        @foreach ($trees as $tree) 
            @if($tree->parentID ==null)
                @include('trees.partials.showTrees',['tree'=> $tree])
            @endif
        @endforeach
    </div>
@endsection