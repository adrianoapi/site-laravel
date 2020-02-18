<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de usuário</title>
</head>
<body>

<form action="{{route('users.store')}}" method="POST">
    @csrf
        <label for="">nome</label>
        <input type="text" name="name">

        <label for="">email</label>
        <input type="text" name="email">

        <label for="senha"></label>
        <input type="password" name="password">

        <input type="submit" value="Cadastrar">

    </form>
    
</body>
</html>