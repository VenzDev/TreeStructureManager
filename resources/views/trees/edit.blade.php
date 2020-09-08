@extends('trees.layout')


@section('content')
<div class="wrapper">
    <h2 class="wrapper__title">Edit element</h2>
    <form class="wrapper__form" method="POST" action="{{ route('trees.update',['tree'=>$tree->id]) }}">
        @csrf
        @method("PUT")
        <div class="wrapper__input">
            <label>ELement Name</label>
            <br>
            <input value={{$tree->text}} type="text" name="text"/>
            <br>
            <label>Parent</label>
            <br>
            <select name="select" id="select">
                <option value="root">Root Element</option>
                @foreach ($selectTree as $t)
                    <option value={{$t->id}}>{{$t->text}}</option>
                @endforeach    
            </select>            
        </div>
        <button class="wrapper__button" type="submit">Create!</button>
    </form>
    <a href={{route('trees.index')}} class="wrapper__button">Back to List</a>
</div>
@endsection