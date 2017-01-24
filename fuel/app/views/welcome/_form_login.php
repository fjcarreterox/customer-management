<?php echo Form::open(array("action"=>"welcome/login","class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('CIF / NIF', 'username', array('class'=>'control-label')); ?>
			<?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Username')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Contraseña', 'pass', array('class'=>'control-label')); ?>
			<?php echo Form::password('pass', Input::post('pass', isset($user) ? $user->pass : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Contraseña')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', 'Área interna de cliente <span class="glyphicon glyphicon-chevron-right"></span><span class="glyphicon glyphicon-chevron-right"></span>', array('class' => 'btn btn-primary','type'=>'submit')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>