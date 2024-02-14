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
	$id = $_REQUEST['id'];
	$exams = $db->prepare('SELECT * FROM exams, students WHERE exams.student_id=students.id AND exams.id=?');
	$exams->execute(array($_REQUEST['id']));
	$exam = $exams->fetch();
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
		<div class="container">
		<p>選択中の生徒: <?php echo $exam['name']; ?></p>
		<table class="table table-bordered">
			<thead>
				<tr>
					<?php foreach ($column_names as $eng=>$jp): ?>
					<th><?php echo $jp; ?></th>
					<?php endforeach; ?>	
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach ($column_names as $eng=>$jp): ?>
					<td><?php echo htmlspecialchars($exam[$eng], ENT_QUOTES, 'utf-8'); ?></td>
					<?php endforeach; ?>
				</tr>
			</tbody>
		</table>

		<div class="row">
			<div class="mg-3 col-12 text-end">
				<a href="delete_do.php?id=<?php echo $id; ?>" class="btn btn-primary">削除する</a>
		</div>
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
