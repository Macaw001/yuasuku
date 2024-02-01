<?php require('../dbconnect.php'); ?>
<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap Css -->
	 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<title></title>
	</head>

	<body>
		<h1>学生を登録する</h1>

		<form action="save.php" method="post">
			<label for="name">名前</label>
			<input type="test" id="name" name="name" cols="25">
			<label for="grade">学年</label>
			<select name="grade" id="grade">
				<option value="1">1年</option>
				<option value="2">2年</option>
				<option value="3">3年</option>
			</select>
			<label for="class">クラス</label>
			<select name="class" id="class">
				<option value="1">1組</option>
				<option value="2">2組</option>
				<option value="3">3組</option>
				<option value="4">4組</option>
				<option value="5">5組</option>
			</select>
			<label for="student_number">学籍番号</label>
			<input type="text" name="student_number" id="student_number" maxlength="8">	
			<button type="submit">登録する</button>
		</form>

		<a href="index.php">戻る</a>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
