<?php require('../dbconnect.php');
require('../login_function.php');
$column_items = ['id','name', 'grade', 'class', 'student_number', 'created_at', 'modified_at'];
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
		
		<div class="container mt-3">
		<h2>生徒一覧</h2>
		<?php
		$students = $db->query('SELECT * FROM students');
		?>
		<table class="table table-bordered">
			<thead>
				<th>id</th><th>名前</th><th>学年</th><th>クラス</th><th>学籍番号</th><th>制作日</th><th>更新日</th>
			</thead>
			
			<tbody>
				<?php while ($student = $students->fetch()): ?>
				<tr>
					<?php for ($i = 0; $i < 7; $i++): ?>
						<?php if ($i == 1): ?>
						<td><a
								href="student.php?student_id=<?php
								echo
								$student['id'];
								?>"><?php
								print($student[$column_items[$i]]);
								?></a></td>
						<?php else: ?>
						<td><?php print($student[$column_items[$i]]); ?></td>
						<?php endif; ?>	
					<?php endfor; ?>
					<td><a class="btn-link" onclick="createModal('edit', <?php echo htmlspecialchars($student['id']); ?>)">変更する</a></td>
					<td><a class="btn-link" onclick="createModal('delete', <?php echo $student['id']; ?>)">削除する</a></td>
				</tr>	
				<?php endwhile; ?>
			</tbody>
		</table>

		<a href="create.php">学生を登録する</a>
		<a href="../login/logout.php">ログアウト</a>
		</div>

		<!-- モーダルを表示する部分を作成　-->
		<div class="modal fade" id="edit" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5>生徒の情報を編集</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div id="modal-body-edit">
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="delete" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5>生徒の情報を削除</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div id="modal-body-delete">
					</div>
				</div>
			</div>
		</div>


		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script>
			function createModal(url, num) {
				let xhr = new XMLHttpRequest();
				xhr.open('GET', './' + url + '.php?id=' + num, true);
				xhr.onreadystatechange = function() {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							document.getElementById('modal-body-delete').innerHTML = xhr.responseText;
							let myModal = new bootstrap.Modal(document.getElementById('delete'));
							myModal.show();
						} else {
							console.log('Error: ' + xhr.status);
						}
					}
				};
				xhr.send();
			}
		</script>

	</body>
</html>	
