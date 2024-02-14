<?php require('../dbconnect.php');
require('../login_function.php');

$classes = $db->prepare('SELECT * FROM students WHERE id=?');
$classes->execute(array($_POST['student_id']));
$class = $classes->fetch();
$class_id = $class['class_id'];
//echo $class_id;



?>
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
		<?php if ($class_id === $_SESSION['class_id']): ?>
		<?php require('../header.php'); ?>
		<?php
		$exams = $db->prepare('INSERT INTO exams SET test_id=?, student_id=?, japanese=?, english=?, science=?, society=?, mathematics=?, sum=?, created_at=NOW()');
		$exams->execute(array($_POST['test_id'], $_POST['student_id'], $_POST['japanese'], $_POST['english'], $_POST['science'], $_POST['society'], $_POST['mathematics'], $_POST['sum']));
		echo '登録が完了しました';
		?>
		<a href="index2.php">戻る</a>
		<?php else: ?>
<?php header('Location: ../login/error.php'); ?>
<?php endif; ?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
