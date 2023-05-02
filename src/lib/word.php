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
$phpWord->addTitleStyle(1,['name' => 'Arial', 'size' => 12,'bold' => true,'allCaps' => true],['lineHeight' => 1.5, 'spaceAfter' => 240]);
//activar la numeración de paginas en a tabla de contenidos
$phpWord->getSettings()->setUpdateFields(true);
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
$section = $phpWord->addSection(array('pageNumberingStart' => 1));

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
$section = $phpWord->addSection(array('pageNumberingStart' => 2));
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
//espacio del header
// $section->headerDistance(PhpOffice\PhpWord\Shared\Converter::inchToTwip(10));
$section->getStyle()->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(6));
$section->addText('índice',$styleFontIndice);
$toc = $section->addTOC($fontToc,$tocStyle);

//SECCICON INDICE END

//SECCION PRESENTACION

//config de seccion
$styleFontPresentacion = array('name' => 'Arial', 'size' => 12);
$stylePresBD = array('name' => 'Arial', 'size' => 12, 'bold' => true);
$fontPresentacion = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('pageNumberingStart' => 3));
$section->getStyle()->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(6));

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
$section = $phpWord->addSection(array('pageNumberingStart' => 4));
$section->getStyle()->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(6));

$section->addTitle('Fundamentación', 1, $styleFontTitleh4,$alignFont);
$textRun = $section->addTextRun($fontFun);

$textRun->addText('La Universidad Tecnológica de El Salvador presenta a la sociedad la carrera de ',$styleFontFun);

$textRun->addText($req->getNameCar(),$styleFunBD);

$textRun->addText(', para formar con estrategias de entrega ',$styleFontFun);

$textRun->addText($req->getModalityCar().', ',$styleFunBD);

$textRun->addText($req->getFundamentacion().'.',$styleFontFun);
$textRun->addTextBreak(2);

$textRun->addText('Con la estrategia de entrega '.$req->getModalityCar().', se podrán eliminar barreras fronterizas y se contribuirá al cumplimiento de la Misión Institucional, en la cual se establece que "La Universidad Tecnológica de El Salvador existe para brindar a amplios sectores poblacionales, innovadores servicios educativos".');

//SECCION FUNDAMENTACION END

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