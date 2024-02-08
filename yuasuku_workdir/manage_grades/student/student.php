<?php require('../dbconnect.php');
require('../login_function.php');

//生徒のidを利用してテストのデータを取得
$exams = $db->prepare('SELECT * FROM exams, students, tests WHERE students.id=exams.student_id and tests.id=exams.test_id and student_id=?');
$exams->execute(array($_REQUEST['student_id']));

//名前を取得する
$students = $db->prepare('SELECT * FROM students WHERE id=?');
$students->execute(array($_REQUEST['student_id']));
$student = $students->fetch();
$student_name = $student['name'];

$column_names = ['test_name'=>'テスト名', 'japanese'=>'国語', 'english'=>'英語', 'science'=>'社会', 'mathematics'=>'数学', 'sum'=>'合計'];
?>
<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
		<!-- Bootstrap Css -->
	 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<title></title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	</head>
	<body>
		<div class="container">
		<?php
		require('../header.php');
		?>
		<a href="index.php">生徒一覧に戻る</a>
		<h3><?php echo $student_name; ?>さんの成績</h3>

		<table class="table table-bordered">
			<tr>
				<?php foreach ($column_names as $eng => $jpn): ?>
					<th><?php echo $jpn; ?></th>
				<?php endforeach; ?>	
			</tr>	
				<?php while ($exam = $exams->fetch()): ?>
				<tr>	
					<?php foreach ($column_names as $key => $value): ?>
					<td class="<?php echo $key ?>"><?php echo $exam[$key]; ?></td>
					<?php endforeach; ?>
				</tr>
				<?php endwhile; ?>

		</table>
		</div>
		

		<div style="width: 800px;"><canvas id="bar_graph"></canvas></div>
		
		
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

		<!-- chartjsでグラフを実装　-->
		<script>
		const ctx = document.getElementById('bar_graph');
	
		//lebelsにclass="test_name"の要素を配列として取得する
		const tableData = document.querySelectorAll(".test_name");
		const labels = [];
		for (const testname of tableData) {
			labels.push(testname.textContent);
		}
		//alert(labels[0]);

		//sumの適用されたクラス内のデータを取得
		const gokei = document.querySelectorAll(".sum");
		const data = [];
		for (const sum of gokei) {
			data.push(sum.textContent);
		}

		//キャンバスにグラフを描写
		const myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: labels,	//labelsはtdのデータが入った配列
				datasets: [{
				label: '合計',
				data: data, //右のデータは合計のテーブル内のデータが入った配列
				backgroundColor: '#f88'
		}]
		}
		});

		</script>	
	</body>
</html>	
