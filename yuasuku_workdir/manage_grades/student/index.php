<?php require('../dbconnect.php');
$column_items = ['id','name', 'grade', 'class', 'student_number', 'created_at', 'modified_at'];
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
		
		<?php
		$students = $db->query('SELECT * FROM students');
		?>
		<table>
			<thead>
				<th>id</th><th>名前</th><th>学年</th><th>クラス</th><th>学籍番号</th><th>制作日</th><th>更新日</th>
			</thead>
			
			<tbody>
				<?php while ($student = $students->fetch()): ?>
				<tr>
					<?php for ($i = 0; $i < 7; $i++): ?>
					<td><?php print($student[$column_items[$i]]); ?></td>
					<?php endfor; ?>
					<td><a href="edit.php?id=<?php echo $student['id']; ?>">変更する</a></td>
					<td><a href="delete.php?id=<?php echo $student['id']; ?>">削除する</a></td>
				</tr>	
				<?php endwhile; ?>
			</tbody>
		</table>

		<a href="create.php">学生を登録する</a>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
