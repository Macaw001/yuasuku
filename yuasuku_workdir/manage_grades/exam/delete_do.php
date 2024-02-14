<?php require('../dbconnect.php');
require('../login_function.php');

$column_names = [
	'japanese'=>'国語',
	'english'=>'英語',
	'science'=>'理科',
	'society'=>'社会',
	'mathematics'=>'数学',
	'sum'=>'合計'
];

if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
	$exams = $db->prepare('DELETE FROM exams WHERE id=?');
	$exams->execute(array($_REQUEST['id']));
} else {
	echo "<p>テストの削除がうまく行きませんでした</p><p>２秒後にテスト一覧に戻ります</p>";
	header("refresh:2;url=index2.php");
	$error['fail'] = true;
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
	<?php if ($error['fail'] !== true): ?>
	<div class="container">
			<p>テストを削除しました</p>	
		<a href="index2.php">テスト一覧へ戻る</a>	
		</div>
		<?php endif; ?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
