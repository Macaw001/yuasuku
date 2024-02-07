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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
		<title></title>
	</head>
	<body>
		<div class="container">
			<?php require('../header.php'); ?>

			<ul class="list-inline">
				<li class="list-inline-item"><a href="">トップに戻る</a></li>   <!-- 要 リンク先の指定 -->
				<li class="list-inline-item"><a href="index2.php">テスト一覧に戻る</a></li>
			</ul>
			<!-- tableで成績を一覧表示　-->
			<?php
			$tests = $db->query('SELECT * FROM tests');
			$test_names = [];
			?>
			<ul class="list-inline">
			<?php while ($test = $tests->fetch()): ?>
			<li class="list-inline-item"><a href="ranking.php?id=<?php echo $test['id']; ?>&grade=<?php echo $_REQUEST['grade']; ?>"><?php echo $test['test_name']; ?></a>/</li>
			<?php $test_names[$test['id']] = $test['test_name']; ?>  <!-- 連想配列として$test_namesにテスト名を追加し、27行目でそのテスト名を表示する 	-->
			<?php endwhile; ?>
			</ul>

			<h1>学年ランキング</h1>
			<ul class="list-inline">
				<li class="list-inline-item"><a href="ranking.php?id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES); ?>&grade=1">1年生 </a></li>
				<li class="list-inline-item"><a href="ranking.php?id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES); ?>&grade=2">2年生 </a></li>
				<li class="list-inline-item"><a href="ranking.php?id=<?php echo htmlspecialchars($_REQUEST['id'], ENT_QUOTES); ?>&grade=3">3年生 </a></li>
			</ul>
			<h6>テスト種類: <?php echo $test_names[$_REQUEST['id']]; ?></h6>
			<h6>選択学年: <?php echo $_REQUEST['grade'] . '年'; ?></h6>

				
					<!-- theadにインデックスを配列として指定/ examsテーブルからデータをfetchし、テーブル作成 -->	

					<?php
			$subjects = ['sum'=>'総合', 'japanese'=>'国語', 'english'=>'英語', 'science'=>'理科', 'society'=>'社会', 'mathematics'=>'数学'];
					$thead = ['test_name', 'name', 'japanese', 'english', 'science', 'society', 'mathematics', 'sum']; 
					?>
					<?php foreach ($subjects as $subject => $nihongo): ?>
					<h3><?php echo $nihongo; ?>トップ5</h3>

					<table class="table">
						<thead>
							<tr>
								<th>順位</th><th>テスト名</th><th>名前</th><th>国語</th><th>英語</th><th>理科</th><th>社会</th><th>数学</th><th>合計</th>
							</tr>
						</thead>
						<tbody>
					<?php

					$exams = $db->prepare('select *, exams.id as exam_id, tests.id as test_id from exams, students, tests where exams.student_id=students.id and exams.test_id=tests.id and test_id=? and grade=? ORDER BY ' . htmlspecialchars($subject) . ' DESC LIMIT 5');
					$exams->execute(array($_REQUEST['id'], $_REQUEST['grade']));
					//echo $subject;
					?>
					<?php $num = 1; ?>
					<?php while ($exam = $exams->fetch()): ?>
					<tr>
					<td class="text-end"><?php switch($num) {
						case 1:
							echo '<i class="fa-solid fa-chess-king" style="color: #FFD43B;"></i>';
							break;
						case 2:
							echo '<i class="fa-solid fa-chess-king" style="color: #c0bfbc;"></i>';
							break;
						case 3:
							echo '<i class="fa-solid fa-chess-king" style="color: #b5835a;"></i>';
							break;				}
						?>
					
						<?php echo $num; ?>
					</td>
						<?php foreach ($thead as $index): ?>
						<?php if ($num == 1 or $num == 2 or $num == 3): ?>
							<td style="font-weight: 700"><?php echo $exam[$index]; ?></td>
							<?php else: ?>
							<td><?php echo $exam[$index]; ?></td>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
					<?php $num++; ?>
					<?php endwhile; ?>
				</tbody>
			</table>
			<?php endforeach; ?>
		</div>		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/4488efa2d0.js" crossorigin="anonymous"></script>
	</body>
</html>	
