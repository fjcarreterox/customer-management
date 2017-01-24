<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>AGDATA S.L.</title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php /*echo Asset::css('main.css');*/ ?>
	<style>
        #logo {
            text-align: center;
            /*margin-top: 22px;*/
        }

        #logo img {
			width:70%;
        }
	</style>
</head>
<body>
<header>
	<div class="container">
		<div id="logo"><?php echo \Fuel\Core\Asset::img('customers.jpg');?></div>
	</div>
</header>
<div class="container">
	<div class="jumbotron">
		<!--<h1 class="login">AGDATA S.L.</h1>
        <p>¡Bienvenido a su zona de cliente!</p>
        <p>Por favor, identifíquese para acceder a su Área interna.</p>-->
		<?php echo render('welcome/_form_login'); ?>
		<small>¿Aún no tiene usuario? Escríbanos a <a href="mailto:clienteslopd@agdata.es?subject=Solicitud de claves de acceso">esta dirección</a> para solicitarlo</small>
	</div>
	<hr/>
	<footer>
		<p class="pull-right">Sitio creado por A.G.Data S.L.</p>
	</footer>
</div>
</body>
</html>