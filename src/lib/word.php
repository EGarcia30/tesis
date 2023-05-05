<?php
require_once __DIR__.'/../../vendor/phpoffice/phpword/bootstrap.php';

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

//configuraciones generales
//pagina tamaño carta
\PhpOffice\PhpWord\Settings::setDefaultPaper('Letter');
//fuente predeterminada
$phpWord->setDefaultFontName('Arial');
$phpWord->setDefaultFontSize(12);
//ocultar errores gramaticales
$phpWord->getSettings()->setHideGrammaticalErrors(true);
$phpWord->getSettings()->setHideSpellingErrors(true);
//idioma predeterminado del documento
$phpWord->getSettings()->setThemeFontLang(new PhpOffice\PhpWord\Style\Language(PhpOffice\PhpWord\Style\Language::ES_ES));
//estilo de titulos predeterminado
$phpWord->addTitleStyle(1,['name' => 'Arial', 'size' => 12,'bold' => true,'allCaps' => true],['lineHeight' => 1.5, 'spaceAfter' => 240, 'spaceBefore' => 240, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
//activar la numeración de paginas en a tabla de contenidos
$phpWord->getSettings()->setUpdateFields(true);
//funcion de margenes
function margenes($section){
    $section->getStyle()->setMarginTop(1420);
    $section->getStyle()->setMarginLeft(1700);
    $section->getStyle()->setMarginRight(1420);
    $section->getStyle()->setMarginBottom(1420);
}
//interlineado generale de los parrafos
// $phpWord->addParagraphStyle(array('spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(12)));
//PATH DE IMAGENES
$imagePathTitle = __DIR__.'/../../public/img/titulo_utec.png';
$imagePathLogo = __DIR__.'/../../public/img/logo_res_utec.png';
// $imageTitle->setAlignmentH(\PhpOffice\PhpWord\SimpleType\Jc::CENTER); // Establecer alineación horizontal central

// SECCION PORTADA

/* Note: any element you append to a document must reside inside of a Section. */
$styleFontPortadah1 = array('name' => 'Arial', 'size' => 18, 'bold' => true, 'allCaps' => true);
$styleFontPortadah2 = array('name' => 'Arial', 'size' => 16, 'bold' => true, 'allCaps' => true);
$styleFontPortadah3 = array('name' => 'Arial', 'size' => 14, 'bold' => true, 'allCaps' => true);
$styleFontPortadaVigencia = array('name' => 'Arial', 'size' => 14, 'bold' => true);
$styleFontPresentacion = array('name' => 'Arial', 'size' => 12, 'bold' => true);
$fontPortada = array('align' => 'center', 'spaceAfter' => 160, 'lineHeight' => 1.5);
// $spaceNone = array('spaceAfter' => 0);

$imgPortada = array('width' => 350, 'height' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
$imgLogo = array('width' => 125, 'height' => 125, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);

//Portada
//Imagen titulo Universidad
$section->addImage($imagePathTitle, $imgPortada);
$section->addTextBreak();
$section->addText($req->getNameFac(),$styleFontPortadah2,$fontPortada);
$section->addTextBreak();
//Imagen Logo
$section->addImage($imagePathLogo, $imgLogo);
$section->addTextBreak();
$section->addText('Plan de estudio de la carrera',$styleFontPortadah3,$fontPortada);
$section->addText($req->getNameCar(),$styleFontPortadah1,$fontPortada);
$section->addText('Modalidad de entrega '.$req->getModalityCar(),$styleFontPortadah3,$fontPortada);
$section->addText('Del '.$req->getStartValidity(). ' al '.$req->getEndValidity(),$styleFontPortadaVigencia,$fontPortada);
$section->addTextBreak(2);
$section->addText($req->getReviewDate(),$styleFontPortadah3,$fontPortada);
$section->addTextBreak();
$section->addText('SAN SALVADOR, EL SALVADOR, CENTROAMÉRICA.',$styleFontPortadah3,$fontPortada);
// Agregar el pie de página a las secciones desde portada hasta el final
$footer = $section->addFooter();
$footer->addPreserveText('{PAGE}', null, array('alignment' => 'right'));
// $footer->addPreserveText('Página {PAGE} de {NUMPAGES}', null, array('alignment' => 'right'));

//SECCION PORTADA END

//SECCICON INDICE

//estilos de mi segunda seccion
$imageStyle = array(
    'wrappingStyle' => 'tight',
    'wrapDistanceBottom' => 10,
    'marginTop' => -10,
    'marginLeft' => 0,
    'width' => 50, 
    'height' => 50, 
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
);
$styleHeader = array('name' => 'Arial', 'size' => 10, 'bold' => true, 'allCaps' => true);
$styleHeaderBD = array('name' => 'Arial', 'size' => 9, 'allCaps' => true);
$styleFontIndice = array('name' => 'Arial', 'size' => 12, 'allCaps' => true);
$fontToc = array('name' => 'Arial', 'size' => 11, 'allCaps' => true);
$tocStyle = array('tabLeader' => \PhpOffice\PhpWord\Style\TOC::TAB_LEADER_DOT);
$fontIndice = array('align' => 'center', 'spaceAfter' => 0);

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);
$header = $section->addHeader();
//Imagen Logo
$header->addImage($imagePathLogo, $imageStyle);
$header->addText('Universidad Tecnológica de El Salvador',
$styleHeader,
$fontIndice);

$header->addText($req->getNameFac(),
$styleHeaderBD,
$fontIndice);

$header->addText($req->getNameCar().'. Modalidad '.$req->getModalityCar(),
$styleHeaderBD,
$fontIndice);

$header->addText('Vigencia del plan de estudio del '.$req->getStartValidity().' al '.$req->getEndValidity(),
$styleHeaderBD,
$fontIndice);
$header->addTextBreak();
//espacio del header
// $section->headerDistance(PhpOffice\PhpWord\Shared\Converter::inchToTwip(10));
// $section->getStyle()->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(6));
$section->addText('índice',$styleFontIndice,);
$toc = $section->addTOC($fontToc,$tocStyle);

//SECCICON INDICE END

//SECCION PRESENTACION

//config de seccion
$styleFontPresentacion = array('name' => 'Arial', 'size' => 12);
$stylePresBD = array('name' => 'Arial', 'size' => 12, 'bold' => true);
$fontPresentacion = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);

$section->addTitle('Presentación', 1);
$textRun = $section->addTextRun($fontPresentacion);
$textRun->addText('La Universidad Tecnológica de El Salvador presenta a la sociedad salvadoreña y a su comunidad educativa universitaria, el plan de estudio de la carrera de ',$styleFontPresentacion);

$textRun->addText($req->getNameCar(),
$stylePresBD);

$textRun->addText(', a desarrollarse en ',
$styleFontPresentacion);

$textRun->addText('Modalidad '.$req->getModalityCar(),
$stylePresBD);

$textRun->addText(', el cual ha sido actualizado considerando diferentes aspectos de un proceso de desarrollo curricular que ha partido de la Misión  y Visión de la Universidad, lo que implica que el presente plan de estudio se orienta a desarrollar  una formación profesional de calidad, que los graduados sean capaces de aplicar y construir conocimientos en su área laboral y se constituyan en personas capaces de formular propuestas pertinentes a las necesidades de la sociedad.',
$styleFontPresentacion);

//SECCION PRESENTACION END

//SECCCION FUNDAMENTACION

//config Generales de fundamentacion
$styleFontFun = array('name' => 'Arial', 'size' => 12);
$styleFunBD = array('name' => 'Arial', 'size' => 12, 'bold' => true);
$fontFun = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);

$section->addTitle('Fundamentación', 1);
$textRun = $section->addTextRun($fontFun);

$textRun->addText('La Universidad Tecnológica de El Salvador presenta a la sociedad la carrera de ',$styleFontFun);

$textRun->addText($req->getNameCar(),$styleFunBD);

$textRun->addText(', para formar con estrategias de entrega ',$styleFontFun);

$textRun->addText($req->getModalityCar().', ',$styleFunBD);

$textRun->addText($req->getFundamentacion().'.',$styleFontFun);
$section->addParagraph();

$section->addText('Con la estrategia de entrega '.$req->getModalityCar().', se podrán eliminar barreras fronterizas y se contribuirá al cumplimiento de la Misión Institucional, en la cual se establece que "La Universidad Tecnológica de El Salvador existe para brindar a amplios sectores poblacionales, innovadores servicios educativos".',$styleFontFun,$fontFun);

//SECCION FUNDAMENTACION END

//SECCION CREADORES/ESPECIALISTAS

//config de la seccion especialistas
$fontEncabezado = array('name' => 'Arial', 'size' => 9, 'italic' => true);
$paragraphEncabezado = array('spaceAfter' => 200, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH);
//tittulos estilo
$fontTitleTab = array('name' => 'Arial', 'size' => 10, 'bold' => true, 'allCaps' => true);
$pgTitleTab = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0, 'spaceBefore' => 0, 'textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER,);
//tabla estilo
$styleTable = [
    'borderSize' => 10,
    'borderColor' => '000000',
    'cellMargin' => 50,
];
//celdas estilo
$cellStyle = array(
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
    'valign' => 'center'
);
//texto estilo
$fontCell = array('name' => 'Arial', 'size' => 10);
$listStyle = array(
    'listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED,
    'textIndent' => 0,
    'align' => 'center'
);
$pgCell = array(
    'align' => 'center'
);

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);

$section->addTitle('Cuadro Resumen de los Especialistas que Participaron en el Diseño Curricular',1);
$section->addText('Tabla 1 Cuadro resumen de los especialistas que participaron en el diseño curricular',
$fontEncabezado,
$paragraphEncabezado);

//tabla de los especialistas
$phpWord->addTableStyle('especialista', $styleTable);
$table = $section->addTable('especialista');
$table->addRow();
$table->addCell(3000, $cellStyle)->addText('Profesional',$fontTitleTab, $pgTitleTab);
$table->addCell(3000, $cellStyle)->addText('Grado Academico',$fontTitleTab, $pgTitleTab);
$table->addCell(3000, $cellStyle)->addText('Experiencia Profesional',$fontTitleTab, $pgTitleTab);
$table->addCell(3000, $cellStyle)->addText('Nivel de Participación',$fontTitleTab, $pgTitleTab);

$i = 0;
//Leyendo creadores
foreach($creadores as $key => $value){
    //añadimos fila
    $table->addRow();
    //columna profesional(nombre creador)
    $table->addCell(3000, $cellStyle)->addText($value['Creador'],$fontCell,$pgCell);
    $cellGrado = $table->addCell(3000, $cellStyle);
    $cellExp = $table->addCell(3000, $cellStyle);
    $cellPar = $table->addCell(3000, $cellStyle);
    //ciclo for que nos lee la cantidad de grados academicos vienen por cada creador
    $countGrado = count($grado[$i]);
    for($x = 0; $x < $countGrado; $x++){
        //llenamos la columna grado academico con todos nuestro grados academicos x un creador
        $cellGrado->addListItem($grado[$i][$x]['Grados_Academicos'],0,$fontCell,$listStyle);
    }
    $countExp = count($exp[$i]);
    for($y = 0; $y < $countExp; $y++){
        //llenamos la columna Experiencia con todas las experiencias profesionales x un creador
        $cellExp->addListItem($exp[$i][$y]['Experiencia'],0,$fontCell,$listStyle);
    }
    $countPar = count($participacion[$i]);
    for($e = 0; $e < $countPar; $e++){
        //llenamos la columna Participación con todas las participaciones x un creador
        $cellPar->addListItem($participacion[$i][$e]['Participacion'],0,$fontCell,$listStyle);
    }
    $i++;
}

//SECCION CREADORES/ESPECIALISTAS END

//SECCION GENERALIDADES CARRERA

//config general
//texto estilo
$fontGen = array('name' => 'Arial', 'size' => 12);
$pgGen = array(
    'align' => 'center'
);
$listGen = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED, 'align' => 'center');

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);
$section->addTitle('1.  Generalidades de la Carrera',1);
$section->addText('Tabla 2 Generalidades de la Carrera',
$fontEncabezado,
$paragraphEncabezado);

//tabla generalidades
$phpWord->addTableStyle('generalidades', $styleTable);
$table = $section->addTable('generalidades');

$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Nombre de la Carrera : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($req->getNameCar(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Requisito de Ingreso : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($gen->getRequisito(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Titulo a otorgar : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($req->getNameCar(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Duracion en años y ciclos : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($gen->getYears()." años y ".$gen->getCiclos()." ciclos",$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Número de Asignaturas : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($gen->getAsignatura(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Número de Unidades Valorativas : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($gen->getValorativas(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Modalidad de entrega : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($req->getModalityCar(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Sede donde se impartirá : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($gen->getSede(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Unidad responsable : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($gen->getResponsible(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Ciclo de inicio: ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($req->getStartValidity(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Año de inicio : ',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($gen->getInicio(),$fontGen,$pgGen);
$table->addRow();
$table->addCell(6000, $cellStyle)->addListItem('Vigencia del Plan',1,$fontGen,$listGen);
$table->addCell(6000, $cellStyle)->addText($req->getStartValidity()." - ".$req->getEndValidity(),$fontGen,$pgGen);

//SECCION GENERALIDADES CARRERA END

//SECCION JUSTIFICACION Y MODALIDAD DE ENTREGA

//config
//estilo
$fontJus = array('name' => 'Arial', 'size' => 12);
$pgJus = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);
// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);
$section->addTitle('2.  Justificación y modalidad de entrega de la carrera',1);
$section->addText('La Universidad Tecnológica de El Salvador, en su proceso de innovación educativa, ha diseñado este plan de estudio tomando en cuenta una adecuación curricular y modalidad de entrega de la carrera, sin menoscabo de la calidad académica y con la idea de responder a los desafíos y compromisos que la sociedad actualmente demanda.',$fontJus,$pgJus);
$section->addParagraph();

$section->addtext('Con esta modalidad de entrega, se trabajan los conocimientos, habilidades y valores, elementos fundamentales de la educación basada en competencias que constituyen parte medular de nuestro Modelo Educativo; el cual se fortalece con el uso de las TIC ya que contribuyen al proceso de aprendizaje de los estudiantes en modalidad '.$req->getModalityCar().', de manera que les permita lograr el dominio de las competencias que aparecen en el perfil profesional.',$fontJus,$pgJus);
$section->addParagraph();

$section->addText('Para ofertar esta carrera, un elemento primordial que se ha considerado es la diversidad de estrategias metodológicas para el aprendizaje que presentan los programas de las asignaturas; se hace énfasis en técnicas didácticas que ponen en práctica las habilidades y conocimientos de los educandos, propiciando que ellos mismos creen marcos referenciales que les ayuden en los diferentes procesos de la vida académica y posterior desempeño profesional.',$fontJus,$pgJus);

//SECCION JUSTIFICACION Y MODALIDAD DE ENTREGA END

//SECCION PROPOSITO DE LA CARRERA

//estilos
$fontPro = array('name' => 'Arial', 'size' => 12);
$pgPro = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);
$section->addTitle('3.  Propósito de la Carrera',1);
$section->addText($pro->getDescripcion(),$fontPro,$pgPro);

//SECCION PROPOSITO DE LA CARRERA END

//SECCION CRITERIOS DE SELECCION Y REQUISITOS DE INGRESO DEL ASPIRANTE

//estilos
$fontAsp = array('name' => 'Arial', 'size' => 12);
$pgAsp = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('headerHeight' => 200));
margenes($section);
$section->addTitle('4.  Criterios de seleccón y Requisitos de ingreso del aspirante',1);
$section->addText('Consecuente con la misión institucional, de brindar a amplios sectores poblacionales el acceso a la educación superior, la Universidad no realiza un proceso de selección que restrinja el ingreso de nuevos estudiantes; su proceso de admisión pretende conocer el dominio de las competencias que traen los aspirantes para realizar acciones de nivelación que permitan cerrar la brecha con el perfil de ingreso requerido.',$fontPro,$pgPro);
$section->addParagraph();
$section->addText('A los nuevos estudiantes se les aplica una prueba diagnóstica para conocer el nivel de entrada, examinando sus conocimientos, habilidades, actitudes, intereses, hábitos y técnicas de estudio, como base para determinar las acciones niveladoras a procurar en algunas asignaturas ejes.',$fontPro,$pgPro);
$section->addParagraph();
$section->addText('La Universidad atendiendo a lo establecido en el artículo 17 de la Ley de Educación Superior, da fiel cumplimiento a los requisitos de ingreso.',$fontPro,$pgPro);

//SECCION CRITERIOS DE SELECCION Y REQUISITOS DE INGRESO DEL ASPIRANTE END


// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("./public/doc/".$req->getNameCar().".docx");

header("Content-Disposition: attachment;filename=".$req->getNameCar().".docx");
echo file_get_contents("./public/doc/".$req->getNameCar().".docx");
// Saving the document as ODF file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
// $objWriter->save('helloWorld.odt');

// Saving the document as HTML file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
// $objWriter->save('helloWorld.html');

/* Note: we skip RTF, because it's not XML-based and requires a different example. */
/* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */