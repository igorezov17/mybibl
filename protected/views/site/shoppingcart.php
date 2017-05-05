<?php $this->pageTitle = Yii::app()->name; ?>

<div class="admin-toolbar">
    <a href="<?php echo Yii::app()->createUrl('/shoppingcart/get'); ?>">Получить код</a>
</div>

<div class="title">Корзина</div>

<?php if ($this->getCountShoppingCart() == 0): ?>
    <div class="information"><span>Корзина пуста</span></div>
<?php else: ?>
<div class="card-box">
    <?php foreach ($books as $store): ?>
    <div class="card">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/book.png" alt="">
        <span class="name">
            <span class="label"><?php echo $store->book->label; ?></span>
            <span class="author"><?php echo $store->book->author; ?></span>
        </span>
        <div class="space"></div>
        <a href="<?php echo Yii::app()->createUrl('/shoppingcart/'.$store->book->id.'/del'); ?>">Удалить</a>
    </div>
    <?php endforeach ?>
</div>
<?php endif ?>