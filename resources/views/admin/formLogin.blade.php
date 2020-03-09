<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="{{route('admin.login.do')}}" action="" method="post">
        @csrf
        <label for="email">email</label>
        <input type="text" name="email" id="email">
        <br>
        <label for="password">password</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" value="Autenticar">
    </form>
</body>
</html>