<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Create</title>
</head>
<body>
    
    <form action="{{route('products.store')}}" method="POST">
        @csrf
    <label for="">title</label>
    <input type="text" name="title" value="">
    <br>
    <label for="">amount</label>
    <input type="text" name="amount" value="">
    <br>
    <label for="">description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    <br>
    <input type="submit" value="Cadastrar">
</form>

</body>
</html>