<?php require('dbconnect.php'); ?>
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
		<!-- tableで成績を一覧表示　-->
		<?php
		$tests = $db->query('select * from tests');
		?>
		<table>
			<thead>
				<tr>
					<th>id</th><th>学生番号</th><th>テストの種類</th><th>国語</th><th>英語</th><th>理科</th><th>社会</th><th>数学</th><th>合計</th><th>制作日</th><th>更新日</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($test = $tests->fetch()): ?>
					<tr>
					<?php for ($i = 0; $i <= 10; $i++): ?>
						<td><?php print($test[$i]); ?></td>
					<?php endfor; ?>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
