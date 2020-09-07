<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ebdc98e921.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/app.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <button class="wrapper__button">Add New Root</button>
    @foreach ($trees as $tree) 
    @if($tree->parentID ==null)
        @include('trees.partials.show',['tree'=> $tree])
    @endif
    @endforeach
    </div>
</body>
</html>