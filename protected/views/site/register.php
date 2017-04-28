<div class="form-page">
    <?php $form=$this->beginWidget('CActiveForm'); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="form-box">
            <?php echo $form->label($model,'email'); ?>
            <?php echo $form->emailField($model,'email') ?>
        </div>

        <div class="form-box">
            <?php echo $form->label($model,'password'); ?>
            <?php echo $form->passwordField($model,'password') ?>
        </div>

        <div class="form-box">
            <?php echo $form->label($model,'confirmationPassword'); ?>
            <?php echo $form->passwordField($model,'confirmationPassword') ?>
        </div>

        <div class="form-box">
            <div class="space"></div>
            <?php echo CHtml::submitButton('Регистрация'); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>