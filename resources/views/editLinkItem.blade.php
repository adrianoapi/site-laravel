<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edição de link</title>
</head>
<body>

<form action="{{route('linksItems.edit', ['linkItem' => $linkItem->id])}}" method="POST">
    @csrf
    @method('PUT')
        <label for="">title</label>
        <input type="text" name="title" value="{{$linkItem->title}}">
        <br>
        <label for="">title</label>
        <input type="text" name="url" value="{{$linkItem->url}}">
        <br>
        <label for="">link_id</label>
        <select name="link_id">
            @foreach ($parent as $parentLink)

                @if($parentLink->id == $linkItem->link_id)         
                    <option value="{{$parentLink->id}}" selected>{{$parentLink->title}}</option>
                @else
                    <option value="{{$parentLink->id}}">{{$parentLink->title}}</option>      
                @endif
                
            @endforeach
        </select>

        <input type="submit" value="Editar">

    </form>

    <a href="{{route('linksItems.listAll')}}">Listagem</a>
    
</body>
</html>