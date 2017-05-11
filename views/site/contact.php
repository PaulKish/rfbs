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
	
	<div class="row">
		<div class="col-md-5">
		    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
		        <div class="alert alert-success">
		            Thank you for contacting us. We will respond to you as soon as possible.
		        </div>
		    <?php else: ?>
		        <div class="row">
		            <div class="col-md-12">
		            	<p>For any issues please write to us using the form below</p>

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
		<div class="col-md-7">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#kenya" aria-controls="kenya" role="tab" data-toggle="tab">Kenya</a></li>
			    <li role="presentation"><a href="#uganda" aria-controls="uganda" role="tab" data-toggle="tab">Uganda</a></li>
			    <li role="presentation"><a href="#tanzania" aria-controls="tanzania" role="tab" data-toggle="tab">Tanzania</a></li>
			    <li role="presentation"><a href="#rwanda" aria-controls="rwanda" role="tab" data-toggle="tab">Rwanda</a></li>
			    <li role="presentation"><a href="#burundi" aria-controls="burundi" role="tab" data-toggle="tab">Burundi</a></li>
			    <li role="presentation"><a href="#malawi" aria-controls="malawi" role="tab" data-toggle="tab">Malawi</a></li>
			    <li role="presentation"><a href="#ssudan" aria-controls="ssudan" role="tab" data-toggle="tab">South Sudan</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="kenya">
			    	<address>
			        	<strong>
			        	<h3>Eastern African Grain Council</h3>
						Mbaazi Avenue, Off Kingara Road <br>
						P.O Box 218-00606 Nairobi, Kenya <br>
						Tel: +254 20 3745840/ 37560636/7 <br>
						Mobile: +254 710 607 313/ +254 733 444 035 <br>
						Fax: +254 20 3745841, Secretariat <br>
						Email: <?= Html::mailto('rfbs@eagc.org') ?> 
						</strong>
			    	</address>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="uganda">
			    	<address>
			        	<strong>
			        	<h3>Eastern African Grain Council</h3>
			        	Plot 958, Galukande Close <br>
						Munyenga (Opp. Kironde Close) <br>
						P.O Box 28435 Kampala, Uganda <br>
						Tel: +256 393 112 854/ +256 414 501 903
			        	</strong>
			        </address>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="tanzania">
			    	<address>
			        	<strong>
			        	<h3>Eastern African Grain Council</h3>
			        	Dar es Salaam Office: <br>
						Sinza Mori, Plot No. 16, <br>
						P.O Box 33619, Dar es Salaam Tanzania <br>
						Tel: +255 754 354 582/ +255 784 366 669 <br>
						<br>
						Arusha Office: <br>
						Selian Agricultural Research Institute (SARI) <br>
						P.O Box 6024, Arusha, Tanzania <br>
						Tel:+255 754 354 852/ +255 784 366 669
			        	</strong>
			        </address>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="rwanda">
			    	<address>
			        	<strong>
			        	<h3>Eastern African Grain Council</h3>
			        	EAGC Office, No. 2 KG38 Street, Kimironko, KG38 street, <br>
						Number 2 <br>
						P.O Box 4497 Kigali, Rwanda <br>
						Tel: +250 788 315 138
			        	</strong>
			        </address>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="burundi">
			    	<address>
			        	<strong>
			        	<h3>Eastern African Grain Council</h3>
			        	IFDC Office Bujumbura, Burundi <br>
						Tel: +257 714 809 83
			        	</strong>
			        </address>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="malawi">
			    	<address>
			        	<strong>
			        	<h3>Eastern African Grain Council</h3>
			        	Off Mphonongo Street, Area 43/Plot 491 <br>
						C/O Box 30209 <br>
						Lilongwe 3 <br>
						Malawi
			        	</strong>
			        </address>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="ssudan">
			    	<address>
			        	<strong>
			        	<h3>Eastern African Grain Council</h3>
			        	Hai Amarat Dehavana Lounge, next to Lugali house <br>
						P.O Box 505, Juba-South Sudan <br>
						Office Mob: +211-920-623-935,
			        	</strong>
			        </address>
			    </div>
			</div>
			<hr>
		</div>
    <?php endif; ?>
</div>
</div>