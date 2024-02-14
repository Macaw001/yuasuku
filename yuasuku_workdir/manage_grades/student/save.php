<?php require('../dbconnect.php');
require('../login_function.php');
$classes = $db->prepare('SELECT id FROM classes WHERE year=? and class_name=?');
$classes->execute(array($_POST['grade'], $_POST['class']));
$class = $classes->fetch();
$class_id = $class['id'];

if ($class_id === $_SESSION['class_id']) {

	$students = $db->prepare('INSERT INTO students SET name=?, grade=?, class=?, student_number=?, created_at=NOW(), class_id=?');
	$students->execute(array($_POST['name'], $_POST['grade'], $_POST['class'], $_POST['student_number'], $class_id));
echo '学生の登録が完了しました';
} else {
	header('Location: ../login/error.php');
}
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
		<?php require('../header.php'); ?>
		<a href="index.php">戻る</a>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
