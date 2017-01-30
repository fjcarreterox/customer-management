<p>Estos son los ficheros de datos declarados a la <strong>Agencia Española de Protección de Datos:</strong></p>
<br/>
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr class="text-center">
        <td><strong>Tipo</strong></td>
        <td><strong>Nivel</strong></td>
        <td><strong>Soporte</strong></td>
        <td><strong>Inscrito en la Agencia</strong></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($ficheros as $f): ?>
        <tr class="text-center">
            <td><?php
                $q = "SELECT tipo FROM tipo_ficheros WHERE `id` =".$f["idtipo"];
                $nombre = DB::query($q)->as_assoc()->execute();
                echo $nombre[0]["tipo"];
                ?></td>
            <td><?php
                switch ($f["nivel"]) {
                    case 1:
                        echo "Básico";
                        break;
                    case 2:
                        echo "Medio";
                        break;
                    case 3:
                        echo "Alto";
                        break;
                    default:
                        echo "-- NO ESPECIFICADO --";
                }
                ?></td>
            <td><?php echo $f["soporte"]; ?></td>
            <td><?php if($f["inscrito"]){echo "SÍ (".date_conv($f["fecha"]).")";}else{echo "NO";}; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br/>
<p>En caso de que traten datos distintos de los declarados, o si éstos han sido modificados o suprimidos, por favor, comuníquenoslo <a href="mailto:clienteslopd@agdata.es?subject=Modificación o alta de ficheros">aquí</a>.</p>
<p>Para actualizar la fecha de inscripción de sus ficheros, rogamos nos remita por mail a <a href="mailto:clienteslopd@agdata.es">clienteslopd@agdata.es</a> la carta que les envía la Agencia de Protección de Datos.</p>
<?php echo \Fuel\Core\Html::anchor("/","<span class='glyphicon glyphicon-backward'></span> Volver al menú principal",array("class"=>"btn btn-danger"))?>