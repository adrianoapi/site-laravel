<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exibe link</title>
</head>
<body>

    <h1>{{$link->title}}</h1>

    <p>{{$link->link_id}}</p>
    <p>{{date('d/m/Y H:i', strtotime($link->created_at))}}</p>

 

    <a href="{{route('links.listAll')}}">Listagem</a>

</body>
</html>