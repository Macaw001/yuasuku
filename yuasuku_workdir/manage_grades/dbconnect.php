<?php
try {
	$db = new PDO('mysql:host=127.0.0.1;dbname=manage_grades;charset=utf8', 'ubu-server-php', 'rosagiganthia1');
}catch (PDOException $e) {
	echo 'DB接続エラー: ' . $e->getMessage();
}
?>
