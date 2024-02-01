<?php require('../dbconnect.php'); ?>
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
		<?php
		if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
			$id = $_REQUEST['id'];
			$students = $db->prepare('SELECT * FROM students WHERE id=?');
			$students->execute(array($id));
			$student = $students->fetch();
		}
		?>
		<table>
			<thead>
				<tr>
					<th>id</th><th>名前</th><th>学年</th><th>クラス</th><th>学籍番号</th><th>作成日</th><th>更新日</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php for ($i = 0; $i <= 6; $i++): ?>
					<td><?php echo $student[$i]; ?></td>
				<?php endfor; ?>
				</tr>
			</tbody>
		</table>
		<a href="index.php">戻る</a>
		<a href="delete_do.php?id=<?php echo $id; ?>">削除する</a>
	</body>
</html>	
