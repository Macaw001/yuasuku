<?php require('../dbconnect.php');
require('../login_function.php');
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
	<?php
	if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
		$id = $_REQUEST['id'];
		$students = $db->prepare('SELECT * FROM students WHERE id=?');
		$students->execute(array($_REQUEST['id']));
		$student = $students->fetch();
		}
	?>

	<p>学生情報の編集</p>
	<form action="edit_do.php" method="post">
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
		<label for="name">名前</label>
		<input type="test" id="name" name="name" cols="25" value="<?php echo $student['name']; ?>">
		<label for="grade">学年</label>
		<select name="grade" id="grade">
			<option value="1">1年</option>
			<option value="2">2年</option>
			<option value="3">3年</option>
			<option value="<?php echo $student['grade']; ?>" selected><?php echo $student['grade']; ?>年</option>
		</select>
		<label for="class">クラス</label>
		<select name="class" id="class">
			<option value="1">1組</option>
			<option value="2">2組</option>
			<option value="3">3組</option>
			<option value="4">4組</option>
			<option value="5">5組</option>
			<option value="<?php echo $student['class']; ?>" selected><?php echo $student['class']; ?>組</option>
		</select>
		<label for="student_number">学籍番号</label>
		<input type="text" name="student_number" id="student_number" maxlength="8" value="<?php echo $_POST['student_number']; ?>"></input>
		<button type="submit">登録する</button>
	</form>
	<a href="index.php">戻る</a>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
