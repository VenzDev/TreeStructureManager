@extends('trees.layout')

@php
    $treeChildren = $tree->children()->get();
@endphp

@section('content')
    <div class="wrapper">
        <form class="wrapper__form" method="POST" action="{{ route('trees.destroy',["tree"=>$tree]) }}">
            @csrf
            @method('DELETE')
            <div class="wrapper__input">
            <h4>Are you sure you want to delete this element?</h4>
            <p>{{$tree->text}}</p>
            @if (count($treeChildren)>0)
            <p class="wrapper__warning">Element includes children!</p>
            @endif
            </div>
            <button class="wrapper__button" type="submit">Delete!</button>
        </form>
        <a href={{route('trees.index')}} class="wrapper__button">Back to List</a>
    </div>
@endsection