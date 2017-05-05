<div class="title">Добавление книги: Шаг 2</div>
<div class="form-page">
    <?php echo CHtml::beginForm(); ?>
        <div class="form-box">
            <?php echo CHtml::activeLabel($addform, 'Библиотека'); ?>
            <?php
                $library = Library::model()->findAll(array('select' => 'id, name', 'order' => 'id'));
                $list = CHtml::listData($library, 'id', 'name');
            ?>
            <?php echo CHtml::activeDropDownList($addform, 'library', $list); ?>
        </div>

        <div class="form-box">
            <?php echo CHtml::activeLabel($addform, 'Количество книг'); ?>
            <?php echo CHtml::activeNumberField($addform, 'count'); ?>
        </div>

        <div class="form-box">
            <div class="space"></div>
            <?php echo CHtml::submitButton('Добавить'); ?>
        </div>
    <?php echo CHtml::endForm(); ?>
</div>