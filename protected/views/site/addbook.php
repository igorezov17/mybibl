<div class="title">Добавление книги: Шаг 1</div>
<div class="form-page">
    <?php echo CHtml::beginForm(); ?>
        <div class="form-box">
            <?php echo CHtml::activeLabel($addform, 'Название книги'); ?>
            <?php echo CHtml::activeTextField($addform, 'label'); ?>
        </div>

        <div class="form-box">
            <?php echo CHtml::activeLabel($addform, 'Автор книги'); ?>
            <?php echo CHtml::activeTextField($addform, 'author'); ?>
        </div>

        <div class="form-box">
            <div class="space"></div>
            <?php echo CHtml::submitButton('Добавить'); ?>
        </div>
    <?php echo CHtml::endForm(); ?>
</div>