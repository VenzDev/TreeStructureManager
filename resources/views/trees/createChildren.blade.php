@extends('trees.layout')

@section('content')
    <div class="wrapper">
        <h2 class="wrapper__title">create Children</h2>
        <form class="wrapper__form" method="POST" action="{{ route('trees.store') }}">
            @csrf
        <p>Parent: <span>{{$tree->text}}</span></p>
            <div class="wrapper__inputs">
                <label>ELement Name</label>
                <br>
                <input type="text" name="text"/>
                <input name="id" type="hidden" value={{$tree->id}}>
                @if ($errors->any())
                    <p class="wrapper__error">Input cannot be empty!</p>
                @endif
            </div>
            <button class="wrapper__button" type="submit">Create!</button>
        </form>
        <a href={{route('trees.index')}} class="wrapper__button">Back to List</a>
    </div>
@endsection