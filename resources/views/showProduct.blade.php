
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exibe usuário</title>
</head>
<body>

    <p>{{$product->title}}</p>
    <p>{{$product->amount}}</p>
    <p>{{$product->description}}</p>

    @if($product->image != '')
        <img src="{{$product->image}}" width="300px" alt="">
    @endif

</body>
</html>