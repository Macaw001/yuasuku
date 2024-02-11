<?php require('../dbconnect.php');
require('../login_function.php');
?>
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
				
				<?php $subjects = ['student_number'=>'学籍番号', 'japanese'=>'国語', 'english'=>'英語', 'science'=>'理科', 'society'=>'社会', 'mathematics'=>'数学', 'sum'=>'合計']; ?>			
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
		<?php require('../header.php'); ?>
		<!-- tableで成績を一覧表示　-->
		<div class="container mt-2">
		<?php
		$tests = $db->query('SELECT * FROM tests');
		?>
		<ul class="list-inline">
		<?php while ($test = $tests->fetch()): ?>
		<li class="list-inline-item"><a href="index2.php?id=<?php echo $test['id']; ?>&grade=<?php echo $_REQUEST['grade']; ?>"><?php echo $test['test_name']; ?></a>/</li>
		<?php endwhile; ?>

		</ul>
		<ul class="list-inline"><li class="list-inline-item" id="sort"><?php echo $subjects[$_REQUEST['subject_name']]; ?></li><li class="list-inline-item">で並び替え</li></ul>
		<table class="table table-bordered border-praimary">
			<thead>
				<tr>
					<th id="student_number">学籍番号<a href="result.php?subject_name=student_number&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th>名前</th>
					<th id="japanese" >国語<a href="result.php?subject_name=japanese&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th id="english">英語<a href="result.php?subject_name=english&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th id="science">理科<a href="result.php?subject_name=science&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th id="society">社会<a href="result.php?subject_name=society&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th id="mathematics">数学<a href="result.php?subject_name=mathematics&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
					<th id="sum">合計<a href="result.php?subject_name=sum&id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-caret-down"></a></i></th>
				</tr>
			</thead>
			<tbody>

				<?php while ($exam = $exams->fetch()): ?>
				<tr>
					<?php foreach ($thead as $index): ?>
					<td><?php echo $exam[$index]; ?></td>
					<?php endforeach; ?>
				<?php endwhile; ?>
			</tbody>
		</table>
		</div>
		<script>
			let sortby = document.getElementById('sort').textContent;
			let ths = document.querySelectorAll("th");
			let selectedHeading = Array.from(ths);
			console.log(selectedHeading);
			for (const data of selectedHeading) {
				console.log(data.textContent);
			}
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
