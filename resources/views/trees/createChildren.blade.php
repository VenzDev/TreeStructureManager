@extends('trees.layout')

@section('content')
    <div class="wrapper">
        <h2 class="wrapper__title">create Tree</h2>
        <form class="wrapper__form" method="POST" action="{{ route('trees.store') }}">
            @csrf
            <p>Parent</p>
            <div class="wrapper__input">
                <label>ELement Name</label>
                <br>
                <input type="text" name="text"/>
                <input name="id" type="hidden" value={{$id}}>
            </div>
            <button class="wrapper__button" type="submit">Create!</button>
        </form>
        <a href={{route('trees.index')}} class="wrapper__button">Back to List</a>
    </div>
@endsection