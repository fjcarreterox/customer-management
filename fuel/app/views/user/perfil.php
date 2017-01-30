<p>Estos son los datos que conforman su ficha de cliente en la base de datos de A.G.DATA S.L.:</p>
<br/>
<table class="table table-striped table-bordered table-hover">
    <thead></thead>
    <tbody>
    <tr class="text-center">
        <td>Razón social:</td>
        <td><strong><?php echo $cliente["nombre"]; ?></strong></td>
    </tr>
    <tr class="text-center">
        <td>CIF / NIF:</td>
        <td><?php if($cliente["cif_nif"]!=''){echo $cliente["cif_nif"];}else{echo '<span class="red">-- FALTA NIF/CIF --</span>';} ?></td>
    </tr>
    <tr class="text-center">
        <td>Dirección postal completa:</td>
        <td><?php echo $cliente["direccion"]; ?>, <?php echo $cliente["cpostal"]; ?>, <?php echo $cliente["loc"]; ?>. <?php echo $cliente["prov"]; ?></td>
    </tr>
    <tr class="text-center">
        <td>Teléfonos de contacto:</td>
        <td><?php echo $cliente["tel"]." / ".$cliente["tel2"]; ?></td>
    </tr>
    <tr class="text-center">
        <td>Página web:</td>
        <td><?php if($cliente["pweb"]!=''){echo $cliente["pweb"];}else{echo '<span class="red">-- FALTA PAG. WEB --</span>';} ?></td>
    </tr>
    <tr class="text-center">
        <td>E-mail principal:</td>
        <td><?php if($cliente["email"]!=''){echo $cliente["email"];}else{echo '<span class="red">-- FALTA E-MAIL --</span>';} ?></td>
    </tr>
    <tr class="text-center">
        <td>Actividad principal:</td>
        <td><?php echo $cliente["actividad"]; ?></td>
    </tr>
    <tr class="text-center">
        <td>IBAN:</td>
        <td><?php if($cliente["iban"]!=''){echo $cliente["iban"];}else{echo '<span class="red">-- FALTA IBAN --</span>';} ?></td>
    </tr>
    <tr class="text-center">
        <td>Núm. trabajadores:</td>
        <td><?php echo $cliente["num_trab"];?></td>
    </tr>
    </tbody>
</table>
<br/>
<h3>Listado de trabajadores</h3>
<table class="table table-striped table-bordered table-hover table-responsive">
    <thead>
    <tr class="text-center">
        <td><strong>Nombre</strong></td>
        <td><strong>DNI</strong></td>
        <td><strong>Cargo o función</strong></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($contactos as $c): ?>
        <tr>
            <td><?php echo $c["nombre"]; ?></td>
            <td><?php echo $c["dni"]; ?></td>
            <td><?php echo $c["cargofuncion"]; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br/>
<p>Si sus datos están incompletos o han cambiado, por favor <a href="mailto:clienteslopd@agdata.es?subject=Comunicación o modificación de datos identificativos">siga este enlace</a> para comunicárnoslo. Gracias</p>
<?php echo \Fuel\Core\Html::anchor("/","<span class='glyphicon glyphicon-backward'></span> Volver al menú principal",array("class"=>"btn btn-danger"))?>