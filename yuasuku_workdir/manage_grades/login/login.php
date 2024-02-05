<?php require('../dbconnect.php');









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
		<h2>ログインする</h2>

		<p>教員IDとパスワードを入力してください</p>
		<form action="index.php" method="post"> 
			<label for="login_id">教員ID</label><br>
			<input type="text" id="login_id" name="login_id" size="25" maxlength="25" /><br>
			<label for="password">パスワード</label><br>
			<input type="text" id="password" name="password" size="25" maxlength="25" /><br>
			<label for="save">ログイン情報の記録</label><br>
			<input id="save" type="checkbox" name="save" value="on"><br>
			<label for="save">次回からは自動でログインする</label><br>
				<input type="submit" value="送信する">
		</form>
				
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
