<html>
<title>Hello/UserIndex</title>
<h1>Index</h1>
<p>お名前を入力してください</p>
<p>UserName: {{$user}}</p>
<p>Message: {{$msg}}</p>
<form method="post" action="/hello">
{{csrf_field()}}
<input type="text" name="id">
<input type="submit" value="送信">
</form>
</html>