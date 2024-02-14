<?php require('../dbconnect.php');
require('../login_function.php');

if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	$exams = $db->prepare('SELECT * FROM exams, students WHERE exams.student_id=students.id AND exams.id=?');
	$exams->execute(array($_REQUEST['id']));
	$exam = $exams->fetch();

	$column_names = [
		'japanese'=>'国語',
		'english'=>'英語',
		'science'=>'理科',
		'society'=>'社会',
		'mathematics'=>'数学',
		'sum'=>'合計'
	];

}

//書き直し
if ($_REQUEST['action'] == 'rewrite') {
	$_POST = $_SESSION['exam'];
	$error['rewrite'] = true;
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
	
	
	<p>生徒名: <?php echo $exam['name']; ?><p>
		<div class="mt-3 container">
			<form action="edit_do.php" method="post">
				<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
				<?php foreach ($column_names as $eng=>$jp): ?>
				<label class="form-label" for="<?php echo $eng; ?>"><?php echo $jp; ?></label>
				<input type="text"  class="form-control" name="<?php echo $eng; ?>"id="<?php echo $eng; ?>" onchange="do_calc();" value="<?php echo $exam[$eng]; ?>">
				<br>
				<?php endforeach; ?>
				<input onclick="submit()" value="編集を反映する">		
			</form>
		</div>



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
