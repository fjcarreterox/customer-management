<?php
if($pending!=null) {
    ?>
    <p>Para tener su documentación LOPD actualizada, deben completar las siguientes tareas:</p>
    <ol>
        <?php
        $items = explode("\n", $pending);
        foreach ($items as $item) {
            echo '<li>' . $item . '</li>';
        }
        ?>
    </ol>
    <br/>
    <p>Para comunicarnos la información que le solicitamos, por favor, emplee esta <a href="mailto:clienteslopd@agdata.es">dirección de e-mail</a>.</p>
    <?php
}
else {
    echo "<p>¡Enhorabuena! Tiene toda su documentación al día.</p><br/>";
    echo "<p>Revise periódicamente esta sección para comprobar si toda su documentación se encuentra debidamente actualizada.</p><br/>";
}?>
<?php echo \Fuel\Core\Html::anchor("/","<span class='glyphicon glyphicon-backward'></span> Volver al menú principal",array("class"=>"btn btn-danger"))?>