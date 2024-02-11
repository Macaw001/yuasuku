<header>
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-collapse">
				<ul class="navbar-nav">
					<li class="nav-item"><a href="/learn/yuasuku_workdir/manage_grades/index.php" class="nav-link">Top</a></li>
					<li class="nav-item"><a href="/learn/yuasuku_workdir/manage_grades/exam/index2.php" class="nav-link">テスト結果</a></li>
					<li class="nav-item"><a href="/learn/yuasuku_workdir/manage_grades/student/index.php" class="nav-link">生徒</a></li>
					<li class="nav-item"><a href="/learn/yuasuku_workdir/manage_grades/test/index.php" class="nav-link">テスト</a></li>

				</ul>
				<div class="d-flex ms-auto">			
					<a style="color: gray" class="nav-link"><?php echo htmlspecialchars($_SESSION['teacher_name'], ENT_QUOTES) . ' ' .  $_SESSION['login_date'];  ?></a>
				</div>
			</div>
		</div>
	</nav>	
	
	
</header>	

