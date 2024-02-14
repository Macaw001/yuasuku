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
		<div class="container">
		<?php
		if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
			$id = $_REQUEST['id'];
			$students = $db->prepare('SELECT * FROM students WHERE id=?');
			$students->execute(array($id));
			$student = $students->fetch();
		}
		?>
		<table class="table table-bordered mt-3">
			<thead>
				<tr>
					<th>id</th><th>名前</th><th>学年</th><th>クラス</th><th>学籍番号</th><th>作成日</th><th>更新日</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php 
				$column_names = ['id','name','grade','class','student_number','created_at','modified_at']; ?>
				<?php foreach ($column_names as $column_name): ?>
					<td><?php echo $student[$column_name]; ?></td>
				<?php endforeach; ?>
				</tr>
			</tbody>
		</table>
		<div class="row">
			<div class="mb-3 col-12 text-end">
				<a  class="btn btn-primary" href="delete_do.php?id=<?php echo $id; ?>">削除する</a>
			</div>
		</div>
		</div>
	</body>
</html>	
