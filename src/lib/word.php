<?php
require_once __DIR__.'/../../vendor/phpoffice/phpword/bootstrap.php';

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

$imagePathTitle = __DIR__.'/../../public/img/titulo_utec.png';
$imagePathLogo = __DIR__.'/../../public/img/logo_res_utec.png';
// $imageTitle->setAlignmentH(\PhpOffice\PhpWord\SimpleType\Jc::CENTER); // Establecer alineación horizontal central

/* Note: any element you append to a document must reside inside of a Section. */

// Adding an empty Section to the document...
$section = $phpWord->addSection();



// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("./public/doc/".$req->getTitle().".docx");

header("Content-Disposition: attachment;filename=".$req->getTitle().".docx");
echo file_get_contents("./public/doc/".$req->getTitle().".docx");
// Saving the document as ODF file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
// $objWriter->save('helloWorld.odt');

// Saving the document as HTML file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
// $objWriter->save('helloWorld.html');

/* Note: we skip RTF, because it's not XML-based and requires a different example. */
/* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */