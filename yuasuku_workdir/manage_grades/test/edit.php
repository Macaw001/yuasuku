<?php require('../dbconnect.php');
require('../login_function.php');
?>
<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>編集</title>
		<!-- Bootstrap Css -->
	 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<title></title>
	</head>

	<body>
		<div class="container">
		<?php
		if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
			$id = $_REQUEST['id'];
				$tests = $db->prepare('SELECT * FROM tests WHERE id=?');
				$tests->execute(array($_REQUEST['id']));
				$test = $tests->fetch();
		}
		?>

		<form action="edit_do.php" method="post">
			<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
			<!-- <?php echo $_REQUEST['id']; ?> -->
			<label class="form-label" for="test_name">テストの種類</label>
			<input class="form-control" type="text" name="test_name" id="test_name" value="<?php print($test['test_name']); ?>">
			<div class="row">
				<div class="col-12 text-end">
			<button class=" btn btn-primary mt-3" type="submint">編集を反映する</button>
				</div>
			</div>
		</form>

		<a href="index.php">戻る</a>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
