<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.min.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<header>
		<div class="container">
			<h1>Общая библиотека</h1>
			<nav>
				<a href="">Домой</a>
				<a href="">Архив</a>
				<a href="">Клиенты</a>
				<a href="">Информация</a>
				<a href="">Контакты</a>
				<div class="search">
					<form>
						<input type="text" name="name" placeholder="Название книги">
						<input type="submit" value="Найти">
					</form>
				</div>
			</nav>
		</div>
	</header>
	<section class="login-nav">
		<div class="container">
			<?php if (Yii::app()->user->isGuest): ?>
				<a href="">Регистрация</a>
			<?php else: ?>
				<a href="">Корзина</a>
				<div class="space"></div>
				<span><?php echo Yii::app()->user->name; ?></span>
				<a href="">Выход</a>
			<?php endif ?>
			<?php if (Yii::app()->user->isGuest): ?>
				<?php $form = $this->beginWidget('CActiveForm'); ?>
					<?php echo $form->emailField($this->loginModel, 'email') ?>
					<?php echo $form->passwordField($this->loginModel, 'password') ?>
					<?php echo CHtml::submitButton('Войти'); ?>
				<?php $this->endWidget(); ?>
			<?php endif ?>
		</div>
	</section>

	<section>
		<div class="container">
			<?php echo $content; ?>
		</div>
	</section>

	<footer>
		<div class="container">
			<div>
				<span>Адрес</span>
				<p>п. Монино ул. Хорошовская д. 7</p>
			</div>
			<div>
				<span>Контакты</span>
				<p>8-495-765-23-12</p>
				<p>8-495-785-77-53</p>
			</div>
			<div>
				<span>Соц. сети</span>
			</div>
		</div>
	</footer>
</body>
</html>
