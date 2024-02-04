<?php require('../dbconnect.php'); ?>
<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap Css -->
	 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<title></title>
	</head>

	<body>
		<!-- tableで成績を一覧表示　-->
		<?php
		$tests = $db->query('SELECT * FROM tests');
		?>
		<ul class="list-inline">
		<?php while ($test = $tests->fetch()): ?>
		<li class="list-inline-item"><a href="index2.php?id=<?php echo $test['id']; ?>"><?php echo $test['test_name']; ?></a>/</li>
		<?php endwhile; ?>

		</ul>
		<table>
			<thead>
				<tr>
					<th>学籍番号<a href="result.php?subject_name=student_number&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th>名前</th>
					<th>国語<a href="result.php?subject_name=japanese&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th>英語<a href="result.php?subject_name=english&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th>理科<a href="result.php?subject_name=science&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th>社会<a href="result.php?subject_name=society&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th>数学<a href="result.php?subject_name=mathematics&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th>合計<a href="result.php?subject_name=sum&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
				</tr>
			</thead>
			<tbody>
				<!-- theadにインデックスを配列として指定/ examsテーブルからデータをfetchし、テーブル作成 -->	
				<?php
				$subject_name = $_REQUEST['subject_name'];
			       	$thead = ['student_number', 'name', 'japanese', 'english', 'science', 'society', 'mathematics', 'sum']; 
				if ($subject_name === 'student_number') {   // 学籍番号のみ並ぶ順を変える
					$exams = $db->prepare('select *, exams.id as exam_id, tests.id as test_id from exams, students, tests where exams.student_id=students.id and exams.test_id=tests.id and test_id=? ORDER BY ' . htmlspecialchars($subject_name));
				} else {

					$exams = $db->prepare('select *, exams.id as exam_id, tests.id as test_id from exams, students, tests where exams.student_id=students.id and exams.test_id=tests.id and test_id=? ORDER BY ' . htmlspecialchars($subject_name) . ' DESC');
				}				//上記のコードは改良が必要。サニタイズ必要？
				$exams->execute(array($_REQUEST['id']));
 				$exams->execute();
//				echo $subject_name;
				?>

				<?php while ($exam = $exams->fetch()): ?>
				<tr>
					<?php foreach ($thead as $index): ?>
					<td><?php echo $exam[$index]; ?></td>
					<?php endforeach; ?>
					<td><a href="edit.php?id=<?php echo $exam['exam_id']; ?>">編集する</a></td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
