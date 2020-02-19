<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edição de usuário</title>
</head>
<body>

<form action="{{route('users.edit', ['user' => $user->id])}}" method="POST">
    @csrf
    @method('PUT')
        <label for="">nome</label>
        <input type="text" name="name" value="{{$user->name}}">

        <label for="">email</label>
        <input type="text" name="email" value="{{$user->email}}">

        <label for="senha"></label>
        <input type="password" name="password" value="">

        <input type="submit" value="Editar">

    </form>

    <a href="{{route('users.listAll')}}">Listagem</a>
    
</body>
</html>