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
		<?php require('../header.php'); ?>
		<?php
		$tests = $db->query('SELECT * FROM tests');
		$students = $db->query('SELECT * FROM students');
		?>
		<p>成績を入力する</p>
		<form onsubmit="return false;" action="create_do.php" method="post">
			<label for="test_id">テストの種類</label>
			<select name="test_id" id="test_id">
				<option value="">テストを選択してください</option>
				<?php while ($test =  $tests->fetch()): ?>
				<option value="<?php echo $test['id']; ?>"><?php echo $test['id'] .  $test['test_name']; ?></option>
				<?php endwhile; ?>
			</select>
			<label for="student_id">生徒の名前</label>
			<select name="student_id" id="student_id">
				<option value="">生徒を指定してください</option>
				<?php while ($student = $students->fetch()): ?>
				<option value="<?php echo $student['id']; ?>"><?php echo $student['id'] .  $student['name']; ?></option>
				<?php endwhile; ?>
			</select>
			<br>
			<?php $subjects = ['japanese' => '国語', 'english' => '英語', 'science' => '理科', 'society' => '社会', 'mathematics' => '数学']; ?>
		
			<?php foreach ($subjects as $eng => $jap): ?>
			<label for="<?php echo $eng; ?>"><?php echo $jap; ?></label>
			<input type="text" name="<?php echo $eng; ?>" id="<?php echo $eng; ?>" onchange="do_calc();">
			<?php endforeach; ?>	
			<label for="sum">合計</label>
			<input type="text" name="sum" id="sum">
			<input type="submint" onclick="submit()" value="送信する">
		</form>

			
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script>	//合計の計算を行う
		let total;
		const do_calc = function() {
			total = 0;
			const subjects = ['japanese', 'english', 'science', 'society', 'mathematics'];
			for (let i = 0; i < subjects.length; i++) {
				let subject = document.getElementById(subjects[i]).value;

				if (!subject) {
					total += 0;
				} else {
					total += parseInt(subject);
					console.log(total);
				}
				document.getElementById('sum').value = total;
			}
		}
		</script>
	</body>
</html>	
