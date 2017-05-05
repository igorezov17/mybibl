<?php $this->pageTitle = Yii::app()->name . ' ' . $book->author . ' - ' . $book->label; ?>

<?php if (!Yii::app()->user->isGuest && Yii::app()->user->permission): ?>
    <div class="admin-toolbar">
        <a href="<?php echo Yii::app()->createUrl('/addstore/'.$id); ?>">Пополнить архив</a>
    </div>
<?php endif ?>
<div class="book-page">
    <div class="label"><span class="author"><?php echo $book->author; ?>:</span>&nbsp;<?php echo $book->label; ?></div>
    <?php if ($count > 0): ?>
        <div class="disc">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/book.png" alt="">
            <?php foreach ($stores as $store): ?>
                <?php if ($store->count > 0): ?>
                    <div class="info">
                        <span class="done">Находится: <?php echo $store->library->name; ?></span>
                        <span class="done">Адрес: <?php echo $store->library->location; ?></span>
                        <span class="done">Телефон: <?php echo $store->library->phones; ?></span>
                        <span class="done">Количество: <?php echo $store->count; ?></span>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="pay">
            <div class="space"></div>
            <a href="<?php echo Yii::app()->createUrl('/book/'.$id.'/add'); ?>">Добавить в корзину</a>
        </div>
     <?php else: ?>  
        <div class="empty">
            Книги нету ни в одной библиотеке
        </div>
    <?php endif ?>
</div>