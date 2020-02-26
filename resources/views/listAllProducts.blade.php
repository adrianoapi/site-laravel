<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de Produtos</title>
</head>
<body>
    <a href="{{route('products.create')}}">Novo</a>
    <table border="1">
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $produto)
            <tr>
                <td>{{$produto->id}}</td>
                <td>{{$produto->title}}</td>
                <td>
                    <a href="{{route('products.show', ['product' => $produto->id])}}">Visualizar</a>
                    <a href="{{route('products.edit', ['product' => $produto->id])}}">Editar</a>
                    <form action="{{route('products.destroy', ['product' => $produto->id])}}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" id="{{$produto->id}}">
                    <input type="submit" value="Excluir">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
            </tr>
        </tfoot>
    </table>

    <style>li {display: inline;}</style>

      
    
</body>
</html>