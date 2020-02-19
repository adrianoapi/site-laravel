<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de Usuários</title>
</head>
<body>
    <a href="{{route('users.formAddUser')}}">Novo</a>
    <table border="1">
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>email</td>
                <td>actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                <a href="{{route('users.list', ['user' => $user->id])}}">Visualizar</a>
                <a href="{{route('users.formEditUser', ['user' => $user->id])}}">Editar</a>
                    <form action="{{route('user.destroy', ['user' => $user->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="user" value="{{$user->id}}">
                        <input type="submit" value="Excluir">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">{{ $users->fragment('foo')->links() }}</td>
            </tr>
        </tfoot>
    </table>

    <style>li {display: inline;}</style>

      
    
</body>
</html>