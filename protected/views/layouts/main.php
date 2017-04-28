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
				<a href="">Корзина</a>
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
			<a href="">Регистрация</a>
			<a href="">Вход</a>
			</div>
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
