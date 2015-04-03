<!DOCTYPE html>
<html>
<head>
	<title>Pdf</title>
</head>
<body>


<h1>Esto es un pdf!!</h1>
{{ HTML::image('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F'.$qrcode.'%2F&choe=UTF-8') }}
<img src="'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F'.$qrcode.'%2F&choe=UTF-8">
</body>
</html>
