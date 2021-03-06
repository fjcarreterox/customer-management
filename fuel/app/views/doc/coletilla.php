<?php
$pdf = new \Fuel\Core\FPDF();
$name=html_entity_decode($name);

$pos = strpos($name,"o-d");
if($pos !== false){
    $name = str_replace("o-d","O'd",strtolower($name));
}

$pdf->AddFont('Arial','','arial.php');
$title = 'DOCUMENTOS LEGALES LOPD: COLETILLA PARA E-MAIL';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);
$pdf->SetFont('Arial','BU',15);
$pdf->MultiCell(0,10,strtoupper('coletilla para e-mails'),0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,10,'***************************************************************************************************************',0,'J');
$pdf->SetFont('Arial','I',11);
$pdf->MultiCell(0,6,utf8_decode('La información contenida en este mensaje y/o archivos adjuntos es confidencial y/o legalmente protegida y está destinada a ser leída exclusivamente por los destinatarios especificados. Si por error usted ha recibido esta comunicación y no es el destinatario señalado, le informamos que está totalmente prohibida, y es ilegal conforme al Código Penal, cualquier uso, revelación, distribución, impresión o copia de toda o alguna parte de la información contenida en esta comunicación, y le rogamos nos la reenvíe y la elimine de sus archivos. Gracias.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si por error usted ha recibido esta comunicación, en cumplimiento de la Ley Orgánica de Protección de Datos debe abstenerse de realizar cualquier tratamiento no autorizado con la información contenida en la misma. De conformidad con la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal, se le informa que sus datos de carácter personal forman parte y son tratados en los ficheros de titularidad de nuestra empresa con la finalidad de gestión y control de las relaciones contractuales. Sus datos han sido obtenidos de una relación contractual anterior o de fuentes accesibles al público: repertorios telefónicos, listas de colegios profesionales, Diarios y Boletines oficiales y los medios de comunicación. Le informamos de la posibilidad de ejercer sus derechos de acceso, rectificación, cancelación y oposición sobre sus datos personales, solicitándolo por escrito o por correo electrónico a nuestra empresa.'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','BI',11);
$pdf->MultiCell(0,6,utf8_decode('Comunicaciones Comerciales:'),0,'J');
$pdf->SetFont('Arial','I',11);
$pdf->MultiCell(0,6,utf8_decode('Conforme a la Ley 34/2002 de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSICE) le comunicamos que su dirección de correo electrónico forma parte de los ficheros de titularidad de nuestra empresa, por haber habido una relación contractual anterior de productos o servicios similares o por disponer de su consentimiento previo expresamente autorizado. En todo caso, le informamos de la posibilidad de oponerse al envío de estas comunicaciones comerciales, solicitándolo por correo electrónico dirigido a nuestra empresa.'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','BI',11);
$pdf->MultiCell(0,6,utf8_decode('Seguridad:'),0,'J');
$pdf->SetFont('Arial','I',11);
$pdf->MultiCell(0,6,utf8_decode('Aunque hemos tomado las medidas para asegurarnos que este correo electrónico y sus ficheros adjuntos estén libres de virus, le recomendamos que a efectos de mantener buenas prácticas de seguridad, el receptor debe asegurarse que este correo y sus ficheros adjuntos estén libres de virus. El emisor no garantiza la integridad y seguridad del presente correo, ni se responsabiliza de posibles perjuicios derivados de la captura, incorporaciones de virus o cualesquiera otras manipulaciones efectuadas por terceros.'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','BI',11);
$pdf->MultiCell(0,6,utf8_decode('Medio Ambiente:'),0,'J');
$pdf->SetFont('Arial','I',11);
$pdf->MultiCell(0,6,utf8_decode('Por favor, antes de imprimir este correo electrónico asegúrese de que necesita hacerlo.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,10,'***************************************************************************************************************',0,'J');
$pdf->Ln(20);
$pdf->Output("Coletilla-emails-$name.pdf",'I');