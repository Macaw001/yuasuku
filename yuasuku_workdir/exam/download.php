<?php require('../dbconnect.php');

//ダウンロード処理を開始
header('Content-type: text/csv');
header('Content-Length: ' . filesize($filepath));
header('Content-Disposition: attachment; filename=' . urlencode('file.csv'));


$exams = $db->query('select student_number, name, japanese, english, science, society, mathematics, sum from exams, students, tests where exams.student_id=students.id and exams.test_id=tests.id');

$data = [['学籍番号','名前','国語','英語','理科','社会','数学','合計']];
	while ($exam = $exams->fetch(PDO::FETCH_ASSOC)) { 
	$data[] = $exam; //fetchで取得した配列データを$dataに代入し、多元配列を作る
}
$filepath = '../data/data_exam.csv';

$fp = fopen($filepath, 'w');
foreach ($data as $line) {
	fputcsv($fp, $line);
 }
fclose($fp);


readfile($filepath);
exit;

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
	<p>ダウンロードが終了しました</p>
	<a href="index2.php">戻る</a>


<?php 
$file = fopen('../data/test.csv', 'r');
while ($line = fgetcsv($file)) {
	foreach($line as $data) {
		echo $data . ",";
		
	}
	echo '<br>';
}
fclose($file);
?>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
