<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de usuário</title>
</head>
<body>

<form action="{{route('address.store')}}" method="POST">
    @csrf
        <input type="hidden" name="user_id" value="1">
        <label for="">street</label>
        <input type="text" name="street">
        <br>
        <label for="">number</label>
        <input type="text" name="number">
        <br>
        <label for="senha">city</label>
        <input type="text" name="city">
        <br>
        <label for="state">state</label>
        <input type="text" name="state" id="state">
        <br>
        <input type="submit" value="Cadastrar">

    </form>

    
</body>
</html>