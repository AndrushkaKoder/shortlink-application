<?php
/**
 * @var \Kernel\Session\Session $session
 * @var \Kernel\View\View $view
 */
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
	      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/auth.css">
	<title>Авторизация в коротких ссылках</title>
</head>
<body>

<div class="container">
	<div class="row my-5">
		<div class="col-12 text-center my-3">
			<h1 class="fs-2">Авторизуйтесь</h1>
			<p>Чтобы создавать короткие ссылки</p>
		</div>
		<div class="col-xl-4 col-md-8 col-sm-12 m-auto">
			<form action="/login" method="POST"
			      class="d-flex justify-content-center align-items-center flex-column gap-3">
				<label for="email">E-mail</label>
				<input type="text" id="email" name="email" class="form-control">
				<label for="password">Пароль</label>
				<input type="password" id="password" name="password" class="form-control">
				<button class="btn btn-success">Войти</button>
				<a href="/register">Регистрация</a>
			</form>
			<?php $view->component('auth.message'); ?>
		</div>
		<div class="col-12 d-flex justify-content-center mt-5">
			<div class="image">
				<a href="<?= config('app', 'git'); ?>" target="_blank">
					<img src="img/git.png" alt="github link">
				</a>

			</div>
		</div>
	</div>
</div>
<script type="module" src="assets/js/app.js"></script>
</body>
</html>