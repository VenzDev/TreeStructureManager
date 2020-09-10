@extends('trees.layout')

@php
    const ALL_ASC = 0;
    const ALL_DESC = 1;
    const ROOTS_ASC = 2;
    const ROOTS_DESC = 3;
    const CHILDREN_ASC = 4;
    const CHILDREN_DESC = 5;

    $sortOptions = [
        ALL_ASC=>'all items by name asc',
        ALL_DESC=>'all items by name desc',
        ROOTS_ASC=>'only roots by name asc',
        ROOTS_DESC=>'only roots by name desc',
        CHILDREN_ASC=>'only children by name asc',
        CHILDREN_DESC=>'only children by name desc'
    ];

    $sortOption = Request::get('sort');

    switch ($sortOption) {
        case ALL_ASC:
            $trees = $trees->sortBy('text');
            break;
        case ALL_DESC:
            $trees = $trees->sortByDesc('text');
            break;
        case ROOTS_ASC:
            $trees = $trees->whereNull('parentID')->sortBy('text');
            break;
        case ROOTS_DESC:
            $trees = $trees->whereNull('parentID')->sortByDesc('text');
            break;
    }

@endphp

@section('content')
    <div class="wrapper">
        <a href={{route('trees.create')}} class="wrapper__button">Add New Root</a>

        @if (session()->has('status'))
            <div class="wrapper__message">
                <p>{{session()->get('status')}}</p>
            </div>
        @endif

        <div>
        @foreach ($sortOptions as $key => $option)
            <button onclick="window.location='{{route('trees.index',['trees'=>$trees,'sort'=>$key])}}'">{{$option}}</button>   
        @endforeach
        </div>

        @foreach ($trees as $tree) 
            @if($tree->parentID ==null)
                @include('trees.partials.showTrees',['tree'=> $tree])
            @endif
        @endforeach

    </div>
@endsection