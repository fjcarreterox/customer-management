<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::js('jquery.js'); ?>
    <?php echo Asset::js('bootstrap.min.js'); ?>
    <?php echo Asset::css('main.css'); ?>
    <link href='https://fonts.googleapis.com/css?family=Armata' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
if(Session::get('user')==""){
    return \Fuel\Core\Response::redirect('/');
}
else{
    $vars=Session::get();
}
//echo "SESS:";print_r($vars);
?>
    <header></header>
	<div class="container">
        <div class="col-md-12 cabecera">
			<a alt="Ir al menú principal" href="http://localhost/public/" class="no-decoration">
				<?php echo Asset::img('logo.png',array("class"=>"logo","alt"=>"Ir al menú principal")); ?>
				<h1>AGDATA S.L.</h1>
			</a>
			<h2>Área de gestión interna</h2>
			<br/>
			<h3><strong><?php echo $title; ?></strong></h3>
			<hr/>
<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success">
				<strong>¡Correcto!</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
				</p>
			</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger">
				<strong>Error...</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>
		</div>
		<div class="col-md-12">
<?php echo $content; ?>
		</div>
		<footer>
			<p class="pull-right">Sesión iniciada: usuario <b><?php echo Session::get('user');?></b></p>
			<!--<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php /*echo e(Fuel::VERSION);*/ ?></small>
			</p>-->
		</footer>
	</div>
</body>
</html>
