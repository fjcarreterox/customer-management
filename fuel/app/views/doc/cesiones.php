<p>Estos son los contratos que deben tener firmados con terceros por la comunicación de datos de sus ficheros.</p>
<p>Cuando surgan nuevos cesionarios de datos o cambien los actuales, rogamos nos lo comuniquen <a href="mailto:clienteslopd@agdata.es">aquí</a> para elaborarles los contratos de cesión necesarios.</p>
<br/>
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr class="text-center">
        <td><strong>Cesionario</strong></td>
        <td><strong>&nbsp;</strong></td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($cesiones as $c): ?>
        <tr class="text-center">
            <td><?php
                $q = "SELECT nombre FROM clientes WHERE `id` =".$c["idcesionaria"];
                $res = DB::query($q)->as_assoc()->execute();
                echo $res[0]["nombre"];
                ?></td>
            <td><?php echo Html::anchor('doc/cesion/' . $c["idcesionaria"], '<span class="glyphicon glyphicon-file"></span> Ver contrato', array('class' => 'btn btn-info','target'=>'_blank')); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br/>