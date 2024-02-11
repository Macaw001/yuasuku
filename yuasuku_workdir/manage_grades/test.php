<!--
	提供されたコードでは、$students->fetch() によって取得した行を $data 配列に array_push しています。しかし、$student は連想配列ではなく、単なる添字配列である可能性があります。この場合、fputcsv が2つの要素を持つ配列を想定しているため、2つの値が同じ行として重複して出力されることがあります。

	修正するには、$student を連想配列に変換するか、直接 $students->fetch(PDO::FETCH_ASSOC) のように連想配列としてデータを取得するようにします。以下は修正例です：
	from chatGPT
-->
<?php
require('./dbconnect.php');

$students = $db->query('select id from students');


$data = [];
	while ($student = $students->fetch(PDO::FETCH_ASSOC)) { 
	$data[] = $student; //fetchで取得した配列データを$dataに代入し、多元配列を作る
}
$filepath = './data/test.csv';

 	$fp = fopen($filepath, 'w');
 	foreach ($data as $line) {
	fputcsv($fp, $line);
 }
 fclose($fp);
	echo 'test';
?>

