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
		
		<div class="container mt-3">
		<div class="card px-3">
			<div class="card-text">
				<h3 class="card-title">テスト一覧</h3>
<?php
		$tests = $db->query('select * from tests');
?>		<div class="card">
	<table class="table table-bordered">
		<tbody>
		<?php while ($test = $tests->fetch()): ?>
		<tr>
			<td class="data"><?php echo $test['id']; ?></td><td><?php echo $test['test_name']; ?></td>
			<td><a class="openModal" data-id="<?php echo $test['id']; ?>" onclick="createModal(<?php echo $test['id']; ?>)"><?php echo $test['id']; ?>編集する</a></td>
			<td><a class="openModal" data-id="<?php echo $test['id']; ?>"  onclick="createDeleteModal(<?php echo $test['id']; ?>)">削除する</a></td>
		</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
	</div>

		<a href="create.php">作成する</a>
		<a href="../login/logout.php">ログアウト</a>
		<br>
		</div>
		</div>	



		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit">編集する</button>

		<div class="modal fade" id="edit" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5>テストの編集</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div id="modal-body">
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="delete" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5>テストの削除</h5>
					       	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div id="modal-body1">
					</div>
				</div>
			</div>
		</div>
		<!-- script内に、ajaxの処理を行うファンクションを作り、アンカーそれぞれにonclikを使いそのファンクションを埋め込む。phpの変数をjavascriptのファンクションの引数として利用。 -->
		<script>

		function createModal(num) {
			let xhr = new XMLHttpRequest();
			xhr.open('GET', './edit.php?id=' + num, true); //numにphpで取得した変数を代入する
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						document.getElementById('modal-body').innerHTML = xhr.responseText;
						let myModal = new bootstrap.Modal(document.getElementById('edit'));
						myModal.show();
					} else {
						console.error('Error: ' + xhr.status);
					}
				}
			};
			xhr.send();
		};

		function createDeleteModal(num) {
			console.log('test');
			let xhr = new XMLHttpRequest();
			xhr.open('GET', './delete.php?id=' + num, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4) {
					console.log(4);
					if (xhr.status === 200) {
						console.log(200);
						console.log(xhr.responseText);
						document.getElementById('modal-body1').innerHTML = xhr.responseText;
						let myModal = new bootstrap.Modal(document.getElementById('delete'));
						myModal.show();
					} else {
						console.error('Error: ' + xhr.status);
					}
				}
			};
			xhr.send();
		}

		</script>





		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

			

	</body>
</html>	
