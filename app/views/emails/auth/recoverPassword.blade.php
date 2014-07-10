<!DOCTYPE html>
<html lang="en-US" dir="rtl">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>أستعادة كلمة السر </h2>
		<br>
                <div>مرحبا  {{$username}}  </div>
				<br>
		<div>
		هذه كلمة السر الجديدة. يمكنك تغييرها بعد تفعيلها 
		<br>
		{{$password}}
		<br>
		</div>
		<br>
                <div> لتفعيلها يرجى الضغط على الرابط التالي: 
				<br>
				{{ $link}} </div>
	</body>
</html>