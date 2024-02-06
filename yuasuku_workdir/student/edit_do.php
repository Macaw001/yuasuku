<?php require('../dbconnect.php'); ?>
<?php require('../login_funtion.php'); ?>
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
		<?php require('../header.php'); ?>
		<?php
		$students = $db->prepare('UPDATE students SET name=?, grade=?, class=?, student_number=? WHERE id=?');
		$students->execute(array($_POST['name'], $_POST['grade'], $_POST['class'], $_POST['student_number'], $_POST['id']));
		?>
		<p>生徒の情報を編集しました</p>
		<p><a href="index.php">戻る</a></p>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
