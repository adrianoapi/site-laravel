<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edição de link</title>
</head>
<body>

<form action="{{route('links.edit', ['link' => $link->id])}}" method="POST">
    @csrf
    @method('PUT')
        <label for="">title</label>
        <input type="text" name="title" value="{{$link->title}}">

        <label for="">link_id</label>
        <input type="text" name="link_id" value="{{$link->link_id}}">

        <input type="submit" value="Editar">

    </form>

    <a href="{{route('links.listAll')}}">Listagem</a>
    
</body>
</html>