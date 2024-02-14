<?php require('dbconnect.php');
session_start();
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
		<header>
			<?php require('header.php'); ?>
		</header>


		<?php 
echo 'class_idは: ' .  $_SESSION['class_id'];
echo 'class_id: ' . $_SESSION['teacher_rank'];
echo 'year: ' . $_SESSION['year'];
?>

		<div class="container">  <!-- colを適用したdiv要素に枠線を指定しても、ガターで離すことができない。colを適用したdiv内にdivを作り、それに枠線を適用すること。 -->
			<div class="row gx-2 mt-3">
				<div class="col-md-6">
					<div style="border:solid 1px black;"><a href="/learn/yuasuku_workdir/manage_grades/index.php">トップへ</a></div>
				</div>
				<div class="col-md-6">
					<div style="border:solid 1px black;"><a href="/learn/yuasuku_workdir/manage_grades/exam/index2.php">テスト結果</a></div>
				</div>
				<div class="col-md-6">
					<div style="border:solid 1px black;"><a href="/learn/yuasuku_workdir/manage_grades/student/index.php">生徒</a></div>
				</div>
				<div class="col-md-6">
					<div style="border:solid 1px black;"><a href="/learn/yuasuku_workdir/manage_grades/login/logout.php">ログアウト</a></div>
				</div>
			</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		</div>
	</body>
</html>	
