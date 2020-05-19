<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exibe linkItem</title>
</head>
<body>

    <h1>{{$linkItem->title}}</h1>

    <p>{{$linkItem->linkItem_id}}</p>
    <p>{{$linkItem->url}}</p>
    <p>{{date('d/m/Y H:i', strtotime($linkItem->created_at))}}</p>

 

    <a href="{{route('linksItems.listAll')}}">Listagem</a>

</body>
</html>