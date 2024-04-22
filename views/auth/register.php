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
			<h1 class="fs-2">Регистрация</h1>
			<p>В сервисе коротких ссылок</p>
		</div>
		<div class="col-xl-4 col-md-8 col-sm-12 m-auto">
			<form action="/register" method="POST"
			      class="d-flex justify-content-center align-items-center flex-column gap-3">
				<label for="name">Имя</label>
				<input
						type="text"
						id="name"
						name="name"
						class="form-control"
						required
						value="<?php echo $session->old('name') ?>"
				>
				<label for="email">E-mail</label>
				<input
						type="text"
						id="email"
						name="email"
						class="form-control"
						required
						value="<?php echo $session->old('email') ?>"
				>
				<label for="password">Пароль</label>
				<input
						type="password"
						id="password"
						name="password"
						class="form-control"
						required
						value="<?php echo $session->old('password') ?>"
				>
				<label for="password_repeat">Повторите пароль</label>
				<input
						type="password"
						id="password_repeat"
						name="password_repeat"
						class="form-control"
						required
						value="<?php echo $session->old('password_repeat') ?>"
				>
				<button class="btn btn-success">Регистрация</button>
				<a href="/login">Назад</a>
			</form>
			<?php $view->component('auth.message'); ?>
		</div>
	</div>
</div>

<script type="module" src="assets/js/app.js"></script>
</body>
</html>