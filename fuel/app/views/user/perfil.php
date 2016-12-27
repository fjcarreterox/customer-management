<p>Estos son los datos que conforman su ficha de cliente en la base de datos de A.G.DATA S.L.:</p>
<br/>
<table class="table table-striped table-bordered table-hover">
    <thead></thead>
    <tbody>
    <tr class="text-center">
        <td>Categoría:</td>
        <td><?php echo $cliente["tipo"]; ?></td>
    </tr>
    <tr class="text-center">
        <td>Estado:</td>
        <td><?php echo $cliente["estado"]; ?></td>
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
        <td>Actividad prioncipal:</td>
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
<p>Por favor, emplee <a href="" target="_blank" title="Se abre en ventana nueva...">este formulario</a> para poder
    comunicar cualquier cambio o errata en estos datos a A.G.DATA S.L.</p>