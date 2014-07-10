<!DOCTYPE html>
<html lang="en-US" dir="rtl">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		@foreach($data as $key => $value)
                <b>{{$key}}: </b>
                <br>
                {{$value}}
                <br>
                @endforeach
	</body>
</html>

