<?php
$pdf = new PDF_MC_Table();
$pdf->AddFont('Arial','','arial.php');
$title = 'DOCUMENTOS LEGALES LOPD: CLÁUSULA DE RECOGIDA DE DATOS DE CLIENTES';
$pdf->SetTitle(utf8_decode($title));
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','BU',15);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('cláusula para la recogida de datos de clientes')),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',14);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de lo dispuesto en el artículo 5 de la Ley Orgánica 15/1999, de 13 de diciembre de Protección de Datos de Carácter Personal, '.html_entity_decode($name).', con CIF '.$cif.', le informa que los datos de carácter personal proporcionados formarán parte de un fichero automatizado del que es titular y único responsable.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de gestionar las actividades contratadas con nuestra empresa.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En todo caso, Ud. podrá ejercitar los derechos de acceso, rectificación, cancelación y oposición, en el ámbito reconocido por la normativa española en protección de datos, dirigiéndose por escrito a nuestra sede situada en '.html_entity_decode($dir).'.'),0,'J');$pdf->Ln(5);
$pdf->Ln(20);
$pdf->Output("Cláusula-clientes-".html_entity_decode($name).".pdf",'I');