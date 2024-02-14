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
//echo $_POST['id'];
//echo $_POST['english'];
//echo $_POST['mathematics'];

$data = [];
foreach ($column_names as $eng=>$jp) {
	$data[$eng] = htmlspecialchars($_POST[$eng]);
}
//フォームから受け取ったデータがすべて数字かどうかを調べる関数
function areAllNumeric($array) {
	foreach ($array as $value) {
		if (!is_numeric($value)) {
			return false;
		}
	}
	return true;
}

if (areAllNumeric($data)) {
	echo 'すべて数字です';
} else {
	echo '数字以外が含まれます';
}



if (isset($_POST['id']) && is_numeric($_POST['id'])) {
	if (areAllNumeric($data)) {
	$id = $_POST['id'];
	$exams = $db->prepare('UPDATE exams SET japanese=?, english=?, science=?, society=?, mathematics=?, sum=? WHERE id=?');
	$exams->execute(array($_POST['japanese'], $_POST['english'], $_POST['science'], $_POST['society'], $_POST['mathematics'], $_POST['sum'], $_POST['id']));
	echo 'test';	
	} else {
	header('Location: index2.php');
	}
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
	
	<a href="index2.php">テスト結果一覧へ戻る</a>	
	

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   
	</body>
</html>	
