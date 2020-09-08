@extends('trees.layout')

@section('content')
    <div class="wrapper">
        <h2 class="wrapper__title">create Root Element</h2>
        <form class="wrapper__form" method="POST" action="{{ route('trees.store') }}">
            @csrf
            <div class="wrapper__inputs">
                <label>ELement Name</label>
                <br>
                <input type="text" name="text"/>
            </div>
            <button class="wrapper__button" type="submit">Create!</button>
        </form>
        <a href={{route('trees.index')}} class="wrapper__button">Back to List</a>
    </div>
@endsection