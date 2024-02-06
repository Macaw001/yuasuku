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
		$tests = $db->query('select * from tests');
?>
		<?php while ($test = $tests->fetch()): ?>
		<?php
		print($test['id'] . ' ' . $test['test_name'] . ' ' . $test['created_at'] . ' ' . $test['modified_at']);
		?>
		<a href="edit.php?id=<?php echo $test['id']; ?>">編集する</a>
		<a href="delete.php?id=<?php echo $test['id']; ?>">削除する</a>
<?php echo '<br>'; ?>
		
<?php endwhile; ?>
		<a href="create.php">作成する</a>
		<br>
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
