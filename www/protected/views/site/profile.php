<?php
/* @var $this SiteController */
/* @var $model TblProfile */
/* @var $form CActiveForm */
?>

<?php

/*
Yii::app()->clientScript->registerScript(
    'myHideEffect',
    '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
    CClientScript::POS_READY
);

Yii::app()->clientScript->registerCss(
    'infomsgClass',
    '.info{background-color:yellow;}'
);
*/
if(Yii::app()->user->hasFlash('infomsg')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('infomsg'); ?>
    </div>
<?php endif; ?>

<div class="form">

<?php

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'tbl-profile-profile-form',
	'action' => CHtml::normalizeUrl(array('site/profile')),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php //echo $form->dropDownList($model, 'gender', TblProfile::model()->getGenderOptions());
            echo $form->checkBoxList($model, 'gender', TblProfile::model()->getGenderOptions());
        ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->urlField($model,'website'); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'photos'); ?>
        <?php
        $this->widget('CMultiFileUpload', array(
            //'model'=>$photosModel,
            //'attribute'=>'image',
            'name' => 'images',
            'accept'=>'jpg|gif|png|pdf',
            'options'=>array(

            ),
            'htmlOptions' => array( 'multiple' => 'multiple', ),
        ));
       // echo CHtml::activeFileField($model, 'photos');

        ?>
        <?php echo $form->error($photosModel,'image'); ?>

    </div>

    <?php

    if(CCaptcha::checkRequirements()): ?>
        <div class="row">
            <?php echo $form->labelEx($model,'verifyCode'); ?>
            <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model,'verifyCode'); ?>
            </div>
            <div class="hint">Please enter the letters as they are shown in the image above.
                <br/>Letters are not case-sensitive.</div>
            <?php echo $form->error($model,'verifyCode'); ?>
        </div>
    <?php endif; ?>


	<div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
<div id="output"></div>

</div><!-- form -->

<?php


?>

<?php
$this->beginClip('tstclp');
?>
clip
<?php
$this->endClip();
?>