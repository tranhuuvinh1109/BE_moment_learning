<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div>
	<h1 style="font-style: italic;color: rgb(251 146 60);">Moment Learning</h1>
	<div style="display: flex;justify-content: center;align-items: center;">
		<div style="border-radius: 8px;width: 250px;background-color: rgb(251 113 133);box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);">
			<img
				style="width: 100%;"
				src="{{ $img }}"
				alt="course"
			/>
			<div style="text-align: center;color: rgb(255 255 255);">
				<h5>Course: {{ $course }}</h5>
				<h4>{{ $price }}$</h4>
			</div>
		</div>
	</div>
	<p>
		Thank you for signing up for our course. Have a nice day
	</p>
</div>
</body>
</html>