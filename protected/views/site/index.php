<?php
$this->pageTitle = Yii::app()->name;
?>

<div class="title">Новинки</div>
<div class="card-box">
    <?php foreach ($books as $book) { ?>
    <div class="card">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/book.png" alt="">
        <span class="name">
            <span class="label"><?php echo $book->label; ?></span>
            <span class="author"><?php echo $book->author; ?></span>
        </span>
        <div class="space"></div>
        <a href="">Подробниие</a>
    </div>
    <?php } ?>
</div>