
@extends('admin.master.layout')

@section('content')
<h1>Login</h1>
<form action="{{route('admin.login.do')}}" action="" method="post">
    @csrf
    @if($errors->all())
        @foreach($errors->all() as $error)
            {{$error}}
            <br>
        @endforeach
    @endif
    <label for="email">email</label>
    <input type="text" name="email" id="email">
    <br>
    <label for="password">password</label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Autenticar">
</form>
@endsection
