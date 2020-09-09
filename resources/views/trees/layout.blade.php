<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ebdc98e921.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/app.css">
    <title>Tree Structure</title>
</head>
<body>
    @yield('content')

    <script>
        function toggleChildren(e){
            if(e.target.tagName.toLowerCase() === 'span'){
                let id = e.target.parentElement.id;

                let arrowIcon = e.target.parentElement.childNodes[1];
                rotateArrow(arrowIcon);

                let children = [...document.getElementsByClassName("nested")];

                children = children.filter(child => child.id === id );

                children.forEach(child => {
                    if (child.style.display === "none") {
                        child.style.display = "block";
                    } else {
                        child.style.display = "none";
                    }
                })
            }
        }

        function rotateArrow(arrowIcon){
            if(arrowIcon.style.transform === ''){
                arrowIcon.style.transform = 'rotate(-90deg)';
            }else {
                arrowIcon.style.transform = '';
            }  
        }
    </script>
</body>
</html>