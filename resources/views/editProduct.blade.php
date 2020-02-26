<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Edit</title>
</head>
<body>
<form action="{{route('products.update', ['product' => $product->id])}}" method="POST">
    @csrf
    @method('PUT')
    <label for="">title</label>
    <input type="text" name="title" value="{{$product->title}}">
    <br>
    <label for="">amount</label>
    <input type="text" name="amount" value="{{$product->amount}}">
    <br>
    <label for="">description</label>
    <textarea name="description" id="description" cols="30" rows="10">{{$product->description}}</textarea>
    <br>
    <input type="submit" value="Salvar">
</form>

</body>
</html>