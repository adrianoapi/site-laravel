
{{var_dump(extension_loaded ( 'fileinfo' ))}}
<form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
    @csrf

    <input type="file" name="arquivo" id="">
    <br>
    <input type="submit" value="Submit" />
</form>