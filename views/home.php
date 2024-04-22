<?php
/**
 * @var \Kernel\View\View $view
 * @var \Kernel\Session\Session $sesion
 * @var \Kernel\Auth\User $user
 */
?>

<?php $view->component('template.header'); ?>

	<div class="container">
		<div class="row gap-3 mt-5">
			<div class="col-12 text-center">
				<h2>Вставтьте длинную ссылку в поле и нажмите на кнопку</h2>
				<?php $view->component('auth.message'); ?>
			</div>
			<div class="col-12 d-flex justify-content-center mb-5">
				<form action="/store" method="post" class="links_form d-flex flex-column gap-3" style="min-width:400px;"
				      data-user="<?= $user->id(); ?>">
					<input id="link" type="text" name="link" placeholder="Вставлять сюда" class="form-control" required>
					<button type="submit" class="btn btn-primary">
						Создать короткую ссылку
					</button>
				</form>
			</div>
			<div class="col-12 d-flex justify-content-center gap-3 mb-5">
				<form action="/logout" method="post">
					<button type="submit" class="btn btn-danger">
						Выйти
					</button>
				</form>
			</div>
			<div class="col-12 d-flex justify-content-center flex-column align-items-center">
				<div><p>Ваши ссылки:</p></div>
				<div>
					<ul class="links_list">
						<?php if ($links = $user->links()): ?>
							<?php foreach ($links as $link): ?>
								<li>
									<a href="<?= $link['short_url'] ?>" target="_blank">
										<?= $link['short_url'] ?>
									</a>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

<?php $view->component('template.footer'); ?>