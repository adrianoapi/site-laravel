<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de links</title>
</head>
<body>
    <a href="{{route('links.create')}}">Novo</a>
    <table border="1">
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $link)
            <tr>
                <td>{{$link->id}}</td>
                <td>{{$link->title}}</td>
                <td>
                    <form action="{{route('links.destroy', ['link' => $link->id])}}" method="POST">
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
                <td colspan="3">{{ $links->fragment('foo')->links() }}</td>
            </tr>
        </tfoot>
    </table>

    <style>li {display: inline;}</style>

      
    
</body>
</html>