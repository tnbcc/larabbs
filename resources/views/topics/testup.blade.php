<!DOCTYPE html>
<html>
  <head>
    <title>文件上传</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
  </head>
 <body> 
<form action="{{ route('loadfile') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="file" name="photo">
<input type="submit" value="上传"/>
</form>
</body>
</html>
