<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de linksItems</title>
</head>
<body>
    
    <a href="{{route('linksItems.create')}}">Novo</a>
    <table border="1">
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($linksItems as $link)
            <tr>
                <td>{{$link->id}}</td>
                <td>{{$link->title}}</td>
                <td>
                    <a href="{{route('linksItems.list', ['linkItem' => $link->id])}}">Visualizar</a>
                    <a href="{{route('linksItems.formEditLink', ['linkItem' => $link->id])}}">Editar</a>
                    <form action="{{route('linksItems.destroy', ['linkItem' => $link->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="link" value="{{$link->id}}">
                        <input type="submit" value="Excluir">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">{{ $linksItems->fragment('foo')->links() }}</td>
            </tr>
        </tfoot>
    </table>

    <style>li {display: inline;}</style>

      
    
</body>
</html>