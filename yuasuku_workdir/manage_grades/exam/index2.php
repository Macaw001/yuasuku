<?php require('../dbconnect.php');
session_start();

if (isset($_SESSION['login_id']) && $_SESSION['time'] + 3600 > time()) {
	//login状態
	$_SESSION['time'] = time();
} else {
	header('Location: ../login/login.php'); exit();
}
echo $_SESSION['id_student'];
echo $_SESSION['login_id']; 

if (($_POST['reset_student_id'])) {
	unset($_SESSION['id_student']);
	echo '検索結果をリセットしました';
}


?>
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
		<header>
			<h6><?php echo htmlspecialchars($_SESSION['teacher_name'], ENT_QUOTES) . ' ' .  $_SESSION['login_date'];  ?></h6>
			<form action='' method="post">
				<input type="search" name="search" placeholder="学籍番号か名前で検索">
				<button type="submit" class="btn btn-warning">検索</button>
			</form>
		</header>
		<?php
		if ($_POST['search']) {
			$students = $db->prepare('SELECT id FROM students WHERE name=? or student_number=?');
			$students->execute(array($_POST['search'], $_POST['search']));
			$data = $students->fetch();
			$id_student = $data['id']; 
			$_SESSION['id_student'] = $id_student; //$data['id']で取得した、studentsテーブルのidをsessionに保存する
		//	echo 'id_student available';
		}
		echo $id_student;
		?>	
		<!-- tableで成績を一覧表示　-->
		<?php
		$tests = $db->query('SELECT * FROM tests');
		$test_names = [];
		?>
		<ul class="list-inline">
		<?php while ($test = $tests->fetch()): ?>
		<li class="list-inline-item"><a href="index2.php?id=<?php echo $test['id']; ?>"><?php echo $test['test_name']; ?></a>/</li>
		<?php $test_names[$test['id']] = $test['test_name']; ?>  <!-- 連想配列として$test_namesにテスト名を追加し、27行目でそのテスト名を表示する 	-->
		<?php endwhile; ?>

		</ul>
		<h6><?php echo $test_names[$_REQUEST['id']]; ?></h6>
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
			       	$thead = ['student_number', 'name', 'japanese', 'english', 'science', 'society', 'mathematics', 'sum']; 

				if ($_SESSION['id_student']) {
				$exams = $db->prepare('select *, exams.id as exam_id, tests.id as test_id from exams, students, tests where exams.student_id=students.id and exams.test_id=tests.id and test_id=? and students.id=?');
				$exams->execute(array($_REQUEST['id'], $_SESSION['id_student']));
				} else {

				$exams = $db->prepare('select *, exams.id as exam_id, tests.id as test_id from exams, students, tests where exams.student_id=students.id and exams.test_id=tests.id and test_id=?');
				$exams->execute(array($_REQUEST['id']));
				}
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

		<form action="download.php" method="post">
			<input type="submit" name="download" value="csvファイルをダウンロード">
		</form>
		<a href="create.php">成績を追加する</a>
		<form action"" method="post">
			<input type="submit" name="reset_student_id" value="検索結果をリセット">
		</form>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
