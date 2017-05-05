<?php $this->pageTitle = Yii::app()->name; ?>

<?php if (!Yii::app()->user->isGuest && Yii::app()->user->permission): ?>
    <div class="admin-toolbar">
        <a href="<?php echo Yii::app()->createUrl('/addbook'); ?>">Добавить новую книгу</a>
    </div>
<?php endif ?>
<div class="title">Новинки</div>
<div class="card-box">
    <?php foreach ($books as $book): ?>
    <div class="card">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/book.png" alt="">
        <span class="name">
            <span class="label"><?php echo $book->label; ?></span>
            <span class="author"><?php echo $book->author; ?></span>
        </span>
        <div class="space"></div>
        <a href="<?php echo Yii::app()->createUrl('/book/'.$book->id); ?>">Подробнее</a>
    </div>
    <?php endforeach ?>
</div>