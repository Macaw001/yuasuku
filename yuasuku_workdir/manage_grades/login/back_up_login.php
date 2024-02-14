<?php require('../dbconnect.php');
//echo ($_COOKIE['login_id']);
//echo ($_COOKIE['password']);

//echo 'post' . $_POST['login_id'];
//echo 'pst{pass]' . $_POST['password'];
session_start();

if ($_COOKIE['login_id'] != '') {
	$_POST['login_id'] = $_COOKIE['login_id'];
	$_POST['password'] = $_COOKIE['password'];
	$_POST['save'] = 'on';
}

if (!empty($_POST)) {  //login処理
	if ($_POST['login_id'] != '' && $_POST['password'] != '') {
		$login = $db->prepare('SELECT * FROM teachers WHERE login_id=? AND password=?');
		$login->execute(array(
			$_POST['login_id'],
			$_POST['password'])  //teachersの作成時にsha1でパスワード暗号化する必要がある
		);
		$teacher = $login->fetch();

		if ($teacher) { //ログイン成功
			echo ('if teacher');
			$_SESSION['login_id'] = $teacher['login_id'];
			$_SESSION['time'] = time();
			$_SESSION['teacher_name'] = $teacher['teacher_name'];
		  	$_SESSION['login_date'] = date('Y年m月j日 G時 i分');

			if ($_POST['save'] == 'on') {
				setcookie('login_id', $_POST['login_id'], time()+60*60*24*14);
				setcookie('password', $_POST['password'], time()+60*60*24*14);
		}
			header('Location: ../index.php'); exit();
		} else {
			$error['login'] = 'failed';
		}
	} else {
		$error['login'] = 'blank';
	}
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
		<div class="container mt-5">
		<h2>ログインする</h2>
		<div class="card">
			<div class="card-body">
		<p>教員IDとパスワードを入力してください</p>
		<form action="" method="post"> 
			<label for="login_id">教員ID</label><br>
			<?php if ($_POST['login_id']): ?>
			<input type="text" id="login_id" name="login_id" size="25" maxlength="25" value="<?php echo htmlspecialchars($_POST['login_id'], ENT_QUOTES); ?>" /><br>	
			<?php else: ?>
			<input type="text" id="login_id" name="login_id" size="25" maxlength="25" /><br>	
			<?php endif; ?>
			<?php if ($error['login'] == 'blank'): ?>
			<p class="error">* 教員アドレスとパスワードをご記入ください</p>
			<?php endif; ?>
			<?php if ($error['login'] == 'failed'): ?>
			<p class="error">* ログインに失敗しました。正しくもう一度ご記入ください</p>
			<?php endif; ?>
			<label for="password">パスワード</label><br>
			<?php if ($_POST['password']): ?>
			<input type="password" id="password" name="[password" size="25" maxlength="25" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>" /><br>
			<?php else: ?>
			<input type="password" id="password" name="password" size="25" maxlength="25" /><br>
			<?php endif; ?>
			<div class="row">
				<div class="col-12">
			<label  for="save">ログイン情報の記録</label><br>
			<input id="save" type="checkbox" name="save" value="on"><br>
			<label for="save">次回からは自動でログインする</label><br>
				<input class="btn btn-primary mt-3" type="submit" value="送信する">
				</div>
			</div>
		</form>
			</div>
		</div>
		</div>				
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>	
