<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
	<h2><?= $this->title ?></h2>

	<hr>
	<p>For any issues please write to us using the form below</p>
	<div class="row">
		<div class="col-md-6">
		    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
		        <div class="alert alert-success">
		            Thank you for contacting us. We will respond to you as soon as possible.
		        </div>
		    <?php else: ?>
		        <div class="row">
		            <div class="col-md-12">

		                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

		                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

		                    <?= $form->field($model, 'email') ?>

		                    <?= $form->field($model, 'subject') ?>

		                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

		                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
		                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
		                    ]) ?>

		                    <div class="form-group">
		                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
		                    </div>

		                <?php ActiveForm::end(); ?>

		            </div>
		        </div>
		</div>
		<div class="col-md-6">
	        <address>
				Mbaazi Avenue, Off Kingara Road <br>
				P.O Box 218-00606 Nairobi, Kenya <br>
				Tel: +254 20 3745840/ 37560636/7 <br>
				Mobile: +254 710 607 313/ +254 733 444 035 <br>
				Fax: +254 20 3745841, Secretariat <br>
				Email: <?= Html::mailto('rfbs@eagc.org') ?> 
	    	</address>
		</div>
    <?php endif; ?>
</div>
</div>