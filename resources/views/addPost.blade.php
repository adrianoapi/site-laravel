<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<form action="{{route('posts.store')}}" method="POST">
    @csrf
    <label for="">Título</label>
    <input type="text" name="title" value="">
    <br>
    <label for="">Sub-título</label>
    <input type="text" name="subtitle" value="">
    <br>
    <label for="">Conteúdo</label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
    <br>
    <input type="submit" value="Cadastrar">
</form>

</body>
</html>