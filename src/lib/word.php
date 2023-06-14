<?php
use Penad\Tesis\models\StudyPlan;

use Penad\Tesis\models\Materia;
use Penad\Tesis\models\PlanEstudioMateria;
use Penad\Tesis\models\Prerrequisito;
use Penad\Tesis\models\MateriaPrerrequisito;
use Penad\Tesis\models\Elemento;
use Penad\Tesis\models\MateriaValorInstitucional;
use Penad\Tesis\models\ContenidoAsignatura;
use Penad\Tesis\models\Habilidades;
use Penad\Tesis\models\Conocimientos;
use Penad\Tesis\models\Metodologia;
use Penad\Tesis\models\CriterioContenido;
use Penad\Tesis\models\Indicador;
use Penad\Tesis\models\CriterioEvaluacion;
use Penad\Tesis\models\EvaluacionPresencial;
use Penad\Tesis\models\IndicadorEvaluacionPresencial;
use Penad\Tesis\models\EvaluacionNoPresencial;
use Penad\Tesis\models\IndicadorEvaluacionNoPresencial;
use Penad\Tesis\models\MaterialApoyo;
use Penad\Tesis\models\Recursos;
use Penad\Tesis\models\ImagenMateria;

use Penad\Tesis\models\CicloExtraordinarioModel;
use Penad\Tesis\models\PlanCicloExtraordinario;
use Penad\Tesis\models\PrerrequisitoCiclo;

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
    //estilos de titulos 2 predeterminados
    $phpWord->addTitleStyle(2,['name' => 'Arial', 'size' => 12,'bold' => true],['lineHeight' => 1.5, 'spaceAfter' => 240, 'spaceBefore' => 240, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
    //activar la numeración de paginas en a tabla de contenidos
    $phpWord->getSettings()->setUpdateFields(true);
    //funcion de margenes
    function margenes($section){
        $section->getStyle()->setMarginTop(1420);
        $section->getStyle()->setMarginLeft(1700);
        $section->getStyle()->setMarginRight(1420);
        $section->getStyle()->setMarginBottom(1420);
    }
    //funcion de numeros romanos
    // Define a function to convert integers to Roman numerals
    function intToRoman($integer) {
        $table = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );
        $result = '';
        foreach ($table as $roman => $value) {
            $result .= str_repeat($roman, $integer / $value);
            $integer %= $value;
        }
        return $result;
    }
//configuraciones generales end

//PATH DE IMAGENES
    $imagePathTitle = __DIR__.'/../../public/img/titulo_utec.png';
    $imagePathLogo = __DIR__.'/../../public/img/logo_res_utec.png';
    $imagePathPerfil = __DIR__.'/../../public/img/perfil_profesional.png';
//PATH DE IMAGENES END

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
    $section->addText('Del '.($req == null ? '' : $req->getStartValidity()). ' al '.($req == null ? '' : $req->getEndValidity()),$styleFontPortadaVigencia,$fontPortada);
    $section->addTextBreak(2);
    $section->addText(($req == null ? '': $req->getReviewDate()),$styleFontPortadah3,$fontPortada);
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

    $header->addText('Vigencia del plan de estudio del '.($req == null ? '' : $req->getStartValidity()).' al '.($req == null ? '' : $req->getEndValidity()),
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

    $section->addTitle('Presentación.', 1);
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

    $section->addTitle('Fundamentación.', 1);
    $textRun = $section->addTextRun($fontFun);

    $textRun->addText('La Universidad Tecnológica de El Salvador presenta a la sociedad la carrera de ',$styleFontFun);

    $textRun->addText($req->getNameCar(),$styleFunBD);

    $textRun->addText(', para formar con estrategias de entrega ',$styleFontFun);

    $textRun->addText($req->getModalityCar().', ',$styleFunBD);

    $textRun->addText(($req == Null ? '' : $req->getFundamentacion()).'.',$styleFontFun);
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
        'align' => 'center',
        'spaceAfter' => 0
    );
    $pgCell = array(
        'align' => 'center'
    );

    // Adding an empty Section to the document...
    $section = $phpWord->addSection(array('headerHeight' => 200));
    margenes($section);

    $section->addTitle('Cuadro Resumen de los Especialistas que Participaron en el Diseño Curricular.',1);
    $section->addText('Tabla 1 Cuadro resumen de los especialistas que participaron en el diseño curricular.',
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
        'align' => 'center',
        'spaceAfter' => 0
    );
    $listGen = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED, 'align' => 'center', 'spaceAfter' => 0);

    // Adding an empty Section to the document...
    $section = $phpWord->addSection(array('headerHeight' => 200));
    margenes($section);
    $section->addTitle('1. Generalidades de la Carrera.',1);
    $section->addText('Tabla 2 Generalidades de la Carrera.',
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
    $table->addCell(6000, $cellStyle)->addText(($gen == null ? '' : $gen->getRequisito()),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Titulo a otorgar : ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText($req->getNameCar(),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Duracion en años y ciclos : ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText(($gen == null ? '' : $gen->getYears())." años y ".($gen == null ? '' : $gen->getCiclos())." ciclos",$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Número de Asignaturas : ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText(($gen == null ? '' : $gen->getAsignatura()),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Número de Unidades Valorativas : ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText(($gen == null ? '' : $gen->getValorativas()),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Modalidad de entrega : ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText($req->getModalityCar(),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Sede donde se impartirá : ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText(($gen == null ? '' : $gen->getSede()),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Unidad responsable : ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText(($gen == null ? '' : $gen->getResponsible()),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Ciclo de inicio: ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText(($req == null ? '' :$req->getStartValidity()),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Año de inicio : ',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText(($gen == null ? '' : $gen->getInicio()),$fontGen,$pgGen);
    $table->addRow();
    $table->addCell(6000, $cellStyle)->addListItem('Vigencia del Plan',1,$fontGen,$listGen);
    $table->addCell(6000, $cellStyle)->addText(($req == null ? '' :$req->getStartValidity())." - ".($req == null ? '' :$req->getEndValidity()),$fontGen,$pgGen);

//SECCION GENERALIDADES CARRERA END

//SECCION JUSTIFICACION Y MODALIDAD DE ENTREGA

    //config
    //estilo
    $fontJus = array('name' => 'Arial', 'size' => 12);
    $pgJus = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);
    // Adding an empty Section to the document...
    $section = $phpWord->addSection(array('headerHeight' => 200));
    margenes($section);
    $section->addTitle('2. Justificación y modalidad de entrega de la carrera.',1);
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
    $section->addTitle('3. Propósito de la Carrera.',1);
    $section->addText(($pro == null ? '' : $pro->getDescripcion()),$fontPro,$pgPro);

//SECCION PROPOSITO DE LA CARRERA END

//SECCION CRITERIOS DE SELECCION Y REQUISITOS DE INGRESO DEL ASPIRANTE

    //estilos
    $fontAsp = array('name' => 'Arial', 'size' => 12);
    $pgAsp = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

    // Adding an empty Section to the document...
    $section = $phpWord->addSection(array('headerHeight' => 200));
    margenes($section);
    $section->addTitle('4. Criterios de seleccón y Requisitos de ingreso del aspirante.',1);
    $section->addText('Consecuente con la misión institucional, de brindar a amplios sectores poblacionales el acceso a la educación superior, la Universidad no realiza un proceso de selección que restrinja el ingreso de nuevos estudiantes; su proceso de admisión pretende conocer el dominio de las competencias que traen los aspirantes para realizar acciones de nivelación que permitan cerrar la brecha con el perfil de ingreso requerido.',$fontPro,$pgPro);
    $section->addParagraph();
    $section->addText('A los nuevos estudiantes se les aplica una prueba diagnóstica para conocer el nivel de entrada, examinando sus conocimientos, habilidades, actitudes, intereses, hábitos y técnicas de estudio, como base para determinar las acciones niveladoras a procurar en algunas asignaturas ejes.',$fontPro,$pgPro);
    $section->addParagraph();
    $section->addText('La Universidad atendiendo a lo establecido en el artículo 17 de la Ley de Educación Superior, da fiel cumplimiento a los requisitos de ingreso.',$fontPro,$pgPro);

//SECCION CRITERIOS DE SELECCION Y REQUISITOS DE INGRESO DEL ASPIRANTE END

//SECCION PERFIL DEL PROFESIONAL A FORMAR

    //COMPETENCIAS GENERALES

        //estilos
        $fontPer = array('name' => 'Arial', 'size' => 12);
        $pgPer = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

        // $fontEncabezado = array('name' => 'Arial', 'size' => 9, 'italic' => true);
        // $paragraphEncabezado = array('spaceAfter' => 200, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH);

        // Adding an empty Section to the document...
        $section = $phpWord->addSection(array('headerHeight' => 200));
        margenes($section);
        $section->addTitle('5. Perfil del Profesional que se pretende formar.',1);
        $section->addText('El perfil profesional del graduado de la carrera de '.$req->getNameCar().', se estructura con tres tipos de perfiles: General, Básico y de Especialidad.',$fontAsp,$pgPer);
        $section->addTitle('5.1 Perfil General',2);
        $section->addText('Conformado por competencias generales, comunes para todas las carreras que ofrece la Universidad.',$fontPer,$pgPer);
        $section->addTitle('5.1.1 Competencias Generales',2);
        $section->addText('Tabla 3 Competencias generales',$fontEncabezado,$paragraphEncabezado);

        //estilos font pg tabla
        $fontTabP = array('name' => 'Arial', 'size' => 12);
        $pgPerTab = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 240);

        $fontTitleP = array('name' => 'Arial', 'size' => 10, 'bold' => true, 'allCaps' => true);
        $pgTabP = array(
            'textIndent' => 0,
            'align' => 'center',
            'spaceAfter' => 0
        );

        //tabla generalidades
        $phpWord->addTableStyle('competencias', $styleTable);
        $table = $section->addTable('competencias');

        $table->addRow();
        $table->addCell(6000,$cellStyle)->addText('Competencias Generales',$fontTitleP,$pgTabP);
        $table->addCell(2000,$cellStyle)->addtext('Ciclo en que se cumple',$fontTitleP,$pgTabP);
        foreach($comGeneral as $key => $value){
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText($value['descripcion'],$fontTabP,$pgPerTab);
            $table->addCell(2000,$cellStyle)->addtext(intToRoman(intval($value['ciclo'])),$fontTabP,$pgPerTab);
        }

    //COMPETENCIAS GENERALES END

    //COMPETENCIAS BASICAS
        // Adding an empty Section to the document...
        $section = $phpWord->addSection(array('headerHeight' => 200));
        margenes($section);
        $section->addTitle('5.2 Perfil Básico',2);
        $section->addText('Las competencias básicas del profesional de '.$req->getNameCar().', de la Universidad Tecnológica de El Salvador, son las siguientes:',$fontPer,$pgPer);
        $section->addTitle('5.2.1 Competencias Básicas',2);
        $section->addText('Tabla 4 Competencias básicas',$fontEncabezado,$paragraphEncabezado);

        //tabla generalidades
        $phpWord->addTableStyle('competencias', $styleTable);
        $table = $section->addTable('competencias');

        $table->addRow();
        $table->addCell(6000,$cellStyle)->addText('Competencias Básicas',$fontTitleP,$pgTabP);
        $table->addCell(2000,$cellStyle)->addtext('Ciclo en que se cumple',$fontTitleP,$pgTabP);
        foreach($comBasica as $key => $value){
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText($value['descripcion'],$fontTabP,$pgPerTab);
            $table->addCell(2000,$cellStyle)->addtext(intToRoman(intval($value['ciclo'])),$fontTabP,$pgPerTab);
        }

    //COMPETENCIAS BASICAS END

    //COMPETENCIAS ESPECIALIDAD
        // Adding an empty Section to the document...
        $section = $phpWord->addSection(array('headerHeight' => 200));
        margenes($section);
        $section->addTitle('5.2 Perfil de Especialidad',2);
        $section->addText('Las competencias de Especialidad del profesional de '.$req->getNameCar().', de la Universidad Tecnológica de El Salvador, son las siguientes:',$fontPer,$pgPer);
        $section->addTitle('5.2.1 Competencias de Especialidad',2);
        $section->addText('Tabla 5 Competencias de especialidad',$fontEncabezado,$paragraphEncabezado);

        //tabla generalidades
        $phpWord->addTableStyle('competencias', $styleTable);
        $table = $section->addTable('competencias');

        $table->addRow();
        $table->addCell(6000,$cellStyle)->addText('Competencias de Especialidad',$fontTitleP,$pgTabP);
        $table->addCell(2000,$cellStyle)->addtext('Ciclo en que se cumple',$fontTitleP,$pgTabP);
        foreach($comEspecialidad as $key => $value){
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText($value['descripcion'],$fontTabP,$pgPerTab);
            $table->addCell(2000,$cellStyle)->addtext(intToRoman(intval($value['ciclo'])),$fontTabP,$pgPerTab);
        }

        //valores Institucionales
            $fontCell = array('name' => 'Arial', 'size' => 12);
            $listStyle = array(
                'listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED,
                'textIndent' => 0,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
                'spaceAfter' => 240
            );

            $section->addTitle('5.4 Valores Institucionales',2);
            $section->addListItem('Compromiso agresivo.',0,$fontCell,$listStyle);
            $section->addListItem('Innovación permanente.',0,$fontCell,$listStyle);
            $section->addListItem('Respeto y pensamiento positivo.',0,$fontCell,$listStyle);
            $section->addListItem('Liderazgo institucional.',0,$fontCell,$listStyle);
            $section->addListItem('Solidaridad y trascendencia cultural.',0,$fontCell,$listStyle);
            $section->addListItem('Integridad.',0,$fontCell,$listStyle);
        //valores institucionales end
    //COMPETENCIAS ESPECIALIDAD END


//SECCION PERFIL DEL PROFESIONAL A FORMAR END 


//AREAS DE DESEMPEÑO
    // Adding an empty Section to the document...
    $section = $phpWord->addSection(array('headerHeight' => 200));
    margenes($section);
    $section->addTitle('5.5 Esferas de Actuación o Áreas de Desempeño',2);

    $section->addText('Con la Carrera '.$req->getNameCar().' se podrá desempeñar en las siguientes áreas:',$fontPer,$pgPer);
    $section->addText('Tabla 6 Esferas de actuación',$fontEncabezado,$paragraphEncabezado);

    $fontTabP = array('name' => 'Arial', 'size' => 10, 'bold' => true);
    $fontTabC = array('name' => 'Arial', 'size' => 10);
    $pgPerTab = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 0);


    //tabla generalidades
    $phpWord->addTableStyle('areas', $styleTable);
    $table = $section->addTable('areas');
    $table->addRow();
    $table->addCell(3000,$cellStyle)->addText('Área de desempeño',$fontTabP,$pgPerTab);
    $table->addCell(3000,$cellStyle)->addText('Puesto a desempeñar',$fontTabP,$pgPerTab);
    $table->addCell(3000,$cellStyle)->addText('Funciones del puesto',$fontTabP,$pgPerTab);
    $table->addCell(3000,$cellStyle)->addText('Tipo de organización laboral',$fontTabP,$pgPerTab);
    foreach($areas as $key => $value){
        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText($value['area'],$fontTabC,$pgPerTab);
        $table->addCell(3000,$cellStyle)->addText($value['puesto'],$fontTabC,$pgPerTab);
        $table->addCell(3000,$cellStyle)->addText($value['funciones_puesto'],$fontTabC,$pgPerTab);
        $table->addCell(3000,$cellStyle)->addText($value['tipo_organizacion'],$fontTabC,$pgPerTab);
    }

//AREAS DE DESEMPEÑO END

//ORGANIZACION DEL PENSUM

    // Agregar un párrafo al documento
    $section = $phpWord->addSection();
    margenes($section);
    $section->addTitle('6. Organización del Pensum.',1);
    $section->addText('Áreas de Formación profesional');

    $imgPerfil = array('width' => 400, 'height' => 250, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);

    $section->addImage($imagePathPerfil,$imgPerfil);

//ORGANIZACION DEL PENSUM END

//MATERIAS PENSUM
    // Agregar un párrafo al documento
    $section = $phpWord->addSection();
    margenes($section);

    $fontTabP = array('name' => 'Arial', 'size' => 12, 'bold' => true);
    $section->addText('Estructura del plan de estudio',$fontTabP);
    $section->addText('El plan de estudio de '.$req->getNameCar().' está estructurado por asignaturas clasificadas en áreas de formación, las cuales comprenden varias asignaturas para cada una.',$fontPer,$pgPer);

    $section->addTitle('6.1 Cuadro resumen del pensum de '.$req->getNameCar().'. '.$req->getModalityCar(),2);
    $section->addText('Tabla 7 Cuadro Resumen',$fontEncabezado,$paragraphEncabezado);


    $fontT = array('name' => 'Arial', 'size' => 9, 'bold' => true);
    $fontC = array('name' => 'Arial', 'size' => 9);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 0);

    //tabla pensum
    $phpWord->addTableStyle('pensum',$styleTable);
    $table= $section->addTable('pensum');
    $table->addRow();
    $table->addCell(1100,$cellStyle)->addText('Ciclo',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('No.',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('Código',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('AF',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('Asignatura',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('Prerrequisito',$fontT,$pgTC);
    $cell = $table->addCell(1100,$cellStyle);
        $subTable = $cell->addTable();
        $subTable->addRow();
        $subTable->addCell(1100,$cellStyle)->addText('HTS',$fontT,$pgTC);
        $subTable->addRow();
        $subTable->addCell(525,$cellStyle)->addText('P',$fontT,$pgTC);
        $subTable->addCell(525,$cellStyle)->addText('NP',$fontT,$pgTC);
    $cell = $table->addCell(1100,$cellStyle);
        $subTable = $cell->addTable();
        $subTable->addRow();
        $subTable->addCell(1100,$cellStyle)->addText('HPS',$fontT,$pgTC);
        $subTable->addRow();
        $subTable->addCell(525,$cellStyle)->addText('P',$fontT,$pgTC);
        $subTable->addCell(525,$cellStyle)->addText('NP',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('HTS',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('UV',$fontT,$pgTC);

    $materias = PlanEstudioMateria::getPlanMaterias($id);
    $numCiclo = 0;
    $ttHTP = 0;
    $ttHTNP = 0;
    $ttHPP = 0;
    $ttHPNP = 0;
    $ttHTS = 0;
    $ttUV = 0;
    foreach($materias as $key => $value){
        $materia_id = intval($value['materia_id']);

        $ttHTP += intval($value['horas_teoricas_presencial']);
        $ttHTNP += intval($value['horas_teoricas_nopresencial']);
        $ttHPP += intval($value['horas_practicas_presencial']);
        $ttHPNP += intval($value['horas_practicas_nopresencial']);
        $ttHTS += intval($value['horas_ciclo']);
        $ttUV += intval($value['unidades_valorativas']);

        $puntos = '*';
        if($value['modalidad'] !== 'semipresencial'){
            $puntos = '**';
        }
        
        $table->addRow();
        $table->addCell(1100,$cellStyle)->addText(intToRoman(intval($value['ciclo'])),$fontC,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($value['no_orden'],$fontC,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($value['codigo'],$fontC,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($value['area_formacion'],$fontC,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($value['nombre_asignatura'].$puntos,$fontC,$pgTC);

        $arrCell = $table->addCell(1100,$cellStyle);
        $prerrequisitos = MateriaPrerrequisito::getMateriaPrerrequisitos($materia_id);
        foreach($prerrequisitos as $llave => $valor){
            // var_dump($valor);
            // exit();
            $arrCell->addText($valor['prerrequisito'],$fontC,$pgTC);
        }

        $cell = $table->addCell(1100,$cellStyle);
            $subTable = $cell->addTable();
            $subTable->addRow();
            $subTable->addCell(525,$cellStyle)->addText($value['horas_teoricas_presencial'],$fontC,$pgTC);
            $subTable->addCell(525,$cellStyle)->addText($value['horas_teoricas_nopresencial'],$fontC,$pgTC);
        $cell = $table->addCell(1100,$cellStyle);
            $subTable = $cell->addTable();
            $subTable->addRow();
            $subTable->addCell(525,$cellStyle)->addText($value['horas_practicas_presencial'],$fontC,$pgTC);
            $subTable->addCell(525,$cellStyle)->addText($value['horas_practicas_nopresencial'],$fontC,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($value['horas_ciclo'],$fontC,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($value['unidades_valorativas'],$fontC,$pgTC);
    }

    $table->addRow();
    $cell = $table->addCell(6600,$cellStyle);
    $cell->addText('Total: ',$fontT,$pgTC);
    $cell->getStyle()->setGridSpan(6);
    $subCell = $table->addCell(1100,$cellStyle);
        $subTable = $subCell->addTable();
        $subTable->addRow();
        $subTable->addCell(525,$cellStyle)->addText($ttHTP,$fontT,$pgTC);
        $subTable->addCell(525,$cellStyle)->addText($ttHTNP,$fontT,$pgTC);
    $subCell = $table->addCell(1100,$cellStyle);
        $subTable = $subCell->addTable();
        $subTable->addRow();
        $subTable->addCell(525,$cellStyle)->addText($ttHPP,$fontT,$pgTC);
        $subTable->addCell(525,$cellStyle)->addText($ttHPNP,$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText($ttHTS,$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText($ttUV,$fontT,$pgTC);
    $table->addRow();
    $cell = $table->addCell(11000,$cellStyle);
    $cell->addText('Simbología AF: Áreas de Formación, AG: Área General, AB: Área Básica, AE: Área de Especialidad, HTS: Horas Teóricas Semanales, HPS: Horas Prácticas Semanales, HT: Horas Totales, UV: Unidades Valorativas',$fontT,$pgTC);
    $cell->getStyle()->setGridSpan(10);

    $section->addTextBreak();
    $section->addText('* Esta asignatura podrá ser impartida en modalidad presencial y no presencial.',$fontC,$pgTC);
    $section->addText('** Esta asignatura podrá ser impartida en modalidad presencial y semipresencial.',$fontC,$pgTC);
    $section->addText('Nota: será a petición escrita del estudiante.',$fontC,$pgTC);
//MATERIAS PENSUM END

//MATERIAS X AREA DE FORMACION
    $fontC = array('name' => 'Arial', 'size' => 11);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START, 'lineHeight' => 1.5, 'spaceAfter' => 120);

    //FORMACION GENERAL
        $section->addTitle('6.2 Asignaturas por áreas de formación',2);
        $section->addTitle('6.2.1 Área de formación general',2);

        $section->addText('Esta área contiene las asignaturas relacionadas con las competencias generales.',$fontC,$pgTC);
        $section->addText('Tabla 8 Áreas de formación',$fontEncabezado,$paragraphEncabezado);

        $fontT = array('name' => 'Arial', 'size' => 9, 'bold' => true);
        $fontC = array('name' => 'Arial', 'size' => 9);
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 120);

        $phpWord->addTableStyle('formacion_general',$styleTable);
        $table = $section->addTable('formacion_general');
        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText('Orden en Pensum',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('Asignatura',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('Unidades Valorativas',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('No. de horas por ciclo',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('CAH%',$fontT,$pgTC);

        $ttAG = 0;
        $ttUVG = 0;
        $ttHCG = 0;
        $ttCAHG = 0;
        $materiasGenerales = PlanEstudioMateria::getMateriaFormacion($id,'AG');
        foreach($materiasGenerales as $llave => $valor){
            $ttAG++;
            $ttUVG += intval($valor['unidades_valorativas']);
            $ttHCG += intval($valor['horas_ciclo']);

            $CAH = 0;
            $UV = 0;
            $UV = intval($valor['unidades_valorativas']);
            $CAH = ($UV*100)/$ttUV;
            $CAHRound = number_format($CAH,2);
            $ttCAHG += $CAHRound;

            $table->addRow();
            $table->addCell(3000,$cellStyle)->addText($valor['no_orden'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['nombre_asignatura'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['unidades_valorativas'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['horas_ciclo'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($CAHRound,$fontC,$pgTC);
        }

        $table->addRow();
        $cell = $table->addCell(6000,$cellStyle);
        $cell->addText('Totales',$fontT,$pgTC);
        $cell->getStyle()->setGridSpan(2);
        $table->addCell(3000,$cellStyle)->addText($ttUVG,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttHCG,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttCAHG,$fontT,$pgTC);

        $fontC = array('name' => 'Arial', 'size' => 10);
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START, 'lineHeight' => 1.5, 'spaceAfter' => 0);

        $section->addText('CAH%: Carga académica horaria expresada en porcentajes.',$fontC,$pgTC);
        $section->addText('Nota: El cálculo de CAH se ha hecho de la siguiente manera:
        UV x 100% / TUV 
        UV=Unidades Valorativas de la asignatura. TUV= Total de Unidades Valorativas.
        ',$fontC,$pgTC);
    //FORMACION GENERAL END

    //FORMACION BASICA
        $section->addTitle('6.2.2 Área de formación básica',2);

        $section->addText('Esta área contiene las asignaturas relacionadas con las competencias básicas.',$fontC,$pgTC);
        $section->addText('Tabla 9 Áreas de formación básica',$fontEncabezado,$paragraphEncabezado);

        $fontT = array('name' => 'Arial', 'size' => 9, 'bold' => true);
        $fontC = array('name' => 'Arial', 'size' => 9);
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 120);

        $phpWord->addTableStyle('formacion_basica',$styleTable);
        $table = $section->addTable('formacion_basica');
        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText('Orden en Pensum',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('Asignatura',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('Unidades Valorativas',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('No. de horas por ciclo',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('CAH%',$fontT,$pgTC);

        $ttAB = 0;
        $ttUVB = 0;
        $ttHCB = 0;
        $ttCAHB = 0;
        $materiasBasicas = PlanEstudioMateria::getMateriaFormacion($id,'AB');
        foreach($materiasBasicas as $llave => $valor){
            $ttAB++;
            $ttUVB += intval($valor['unidades_valorativas']);
            $ttHCB += intval($valor['horas_ciclo']);

            $CAH = 0;
            $UV = 0;
            $UV = intval($valor['unidades_valorativas']);
            $CAH = ($UV*100)/$ttUV;
            $CAHRound = number_format($CAH,2);
            $ttCAHB += $CAHRound;

            $table->addRow();
            $table->addCell(3000,$cellStyle)->addText($valor['no_orden'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['nombre_asignatura'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['unidades_valorativas'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['horas_ciclo'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($CAHRound,$fontC,$pgTC);
        }

        $table->addRow();
        $cell = $table->addCell(6000,$cellStyle);
        $cell->addText('Totales',$fontT,$pgTC);
        $cell->getStyle()->setGridSpan(2);
        $table->addCell(3000,$cellStyle)->addText($ttUVB,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttHCB,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttCAHB,$fontT,$pgTC);

        $fontC = array('name' => 'Arial', 'size' => 10);
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START, 'lineHeight' => 1.5, 'spaceAfter' => 0);

        $section->addText('CAH%: Carga académica horaria expresada en porcentajes.',$fontC,$pgTC);
        $section->addText('Nota: El cálculo de CAH se ha hecho de la siguiente manera:
        UV x 100% / TUV 
        UV=Unidades Valorativas de la asignatura. TUV= Total de Unidades Valorativas.
        ',$fontC,$pgTC);
    //FORMACION BASICA END

    //FORMACION ESPECIALIDAD
        $section->addTitle('6.2.3 Área de formación de especialidad',2);

        $section->addText('Esta área contiene las asignaturas relacionadas con las competencias de especialidad.',$fontC,$pgTC);
        $section->addText('Tabla 10 Áreas de formación especialidad',$fontEncabezado,$paragraphEncabezado);

        $fontT = array('name' => 'Arial', 'size' => 9, 'bold' => true);
        $fontC = array('name' => 'Arial', 'size' => 9);
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 120);

        $phpWord->addTableStyle('formacion_especialidad',$styleTable);
        $table = $section->addTable('formacion_especialidad');
        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText('Orden en Pensum',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('Asignatura',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('Unidades Valorativas',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('No. de horas por ciclo',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('CAH%',$fontT,$pgTC);

        $ttAE = 0;
        $ttUVE = 0;
        $ttHCE = 0;
        $ttCAHE = 0;
        $materiasEspecialidad = PlanEstudioMateria::getMateriaFormacion($id,'AE');
        foreach($materiasEspecialidad as $llave => $valor){
            $ttAE++;
            $ttUVE += intval($valor['unidades_valorativas']);
            $ttHCE += intval($valor['horas_ciclo']);

            $CAH = 0;
            $UV = 0;
            $UV = intval($valor['unidades_valorativas']);
            $CAH = ($UV*100)/$ttUV;
            $CAHRound = number_format($CAH,2);
            $ttCAHE += $CAHRound;

            $table->addRow();
            $table->addCell(3000,$cellStyle)->addText($valor['no_orden'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['nombre_asignatura'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['unidades_valorativas'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($valor['horas_ciclo'],$fontC,$pgTC);
            $table->addCell(3000,$cellStyle)->addText($CAHRound,$fontC,$pgTC);
        }

        $table->addRow();
        $cell = $table->addCell(6000,$cellStyle);
        $cell->addText('Totales',$fontT,$pgTC);
        $cell->getStyle()->setGridSpan(2);
        $table->addCell(3000,$cellStyle)->addText($ttUVE,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttHCE,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttCAHE,$fontT,$pgTC);

        $fontC = array('name' => 'Arial', 'size' => 10);
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START, 'lineHeight' => 1.5, 'spaceAfter' => 0);

        $section->addText('CAH%: Carga académica horaria expresada en porcentajes.',$fontC,$pgTC);
        $section->addText('Nota: El cálculo de CAH se ha hecho de la siguiente manera:
        UV x 100% / TUV 
        UV=Unidades Valorativas de la asignatura. TUV= Total de Unidades Valorativas.
        ',$fontC,$pgTC);
    //FORMACION ESPECIALIDAD END

    //RESUMEN

        $fontT = array('name' => 'Arial', 'size' => 9, 'bold' => true);
        $fontC = array('name' => 'Arial', 'size' => 9);
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 0);

        $section->addTitle('6.3 Cuadro resumen por área de formación. '.$req->getNameCar(),2);
        $section->addText('Tabla 11 cuadro resumen por área',$fontEncabezado,$paragraphEncabezado);

        $phpWord->addTableStyle('formacion_resumen',$styleTable);
        $table = $section->addTable('formacion_resumen');

        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText('Orden en Pensum',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('Asignatura',$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText('Unidades Valorativas',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText('No. de horas totales por área de formación',$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText('CAH%',$fontT,$pgTC);

        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText('Área General',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttAG,$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText($ttUVG,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttHCG,$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText($ttCAHG,$fontT,$pgTC);

        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText('Área Básica',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttAB,$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText($ttUVB,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttHCB,$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText($ttCAHB,$fontT,$pgTC);

        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText('Área de Especialidad',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttAE,$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText($ttUVE,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttHCE,$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText($ttCAHE,$fontT,$pgTC);

        $ttA = ($ttAG + $ttAB + $ttAE);
        $ttUV = ($ttUVG + $ttUVB + $ttUVE);
        $ttHC = ($ttHCG + $ttHCB + $ttHCE);
        $ttCAH = number_format(($ttCAHG + $ttCAHB + $ttCAHE),2);

        $table->addRow();
        $table->addCell(3000,$cellStyle)->addText('Totales',$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttA,$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText($ttUV,$fontT,$pgTC);
        $table->addCell(3000,$cellStyle)->addText($ttHC,$fontT,$pgTC);
        $table->addCell(2000,$cellStyle)->addText($ttCAH,$fontT,$pgTC);

        $fontC = array('name' => 'Arial', 'size' => 10);
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START, 'lineHeight' => 1.5, 'spaceAfter' => 0);

        $section->addText('CAH%: Carga académica horaria expresada en porcentajes.',$fontC,$pgTC);
        $section->addText('Nota: El cálculo de CAH se ha hecho de la siguiente manera:
        UV x 100% / TUV 
        UV=Unidades Valorativas de la asignatura. TUV= Total de Unidades Valorativas.
        ',$fontC,$pgTC);
    //RESUMEN END

//MATERIAS X AREA DE FORMACION END

//MALLA CURRICULAR
    $fontT = array('name' => 'Arial', 'size' => 9, 'bold' => true);
    $fontC = array('name' => 'Arial', 'size' => 12);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

    $sectionStyle = array(
        'orientation' => 'landscape',
    );

    $section->addTitle('6.4 Malla Curricular',2);
    $section->addText('En este espacio estará una tabla con el Pensum de la carrera:',$fontC,$pgTC);

    $section->addText('Universidad Tecnológica de El Salvador',
    $styleHeader,
    $fontIndice);

    $section->addText($req->getNameFac(),
    $styleHeaderBD,
    $fontIndice);

    $section->addText($req->getNameCar().'. Modalidad '.$req->getModalityCar(),
    $styleHeaderBD,
    $fontIndice);

    $section->addText('Año de inicio: '.($gen == null ? '' : $gen->getInicio()),
    $styleHeaderBD,
    $fontIndice);

    $section->addText('Vigencia del plan de estudio del '.($req == null ? '' : $req->getStartValidity()).' al '.($req == null ? '' : $req->getEndValidity()),
    $styleHeaderBD,
    $fontIndice);

    $section->addTextBreak();

    $fontC = array('name' => 'Arial', 'size' => 6, 'bold' => true);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 0);
    $styleTable = [
        'borderSize' => 10,
        'borderColor' => '000000',
    ];
    $styleTableP = [
        'cellSpacing' => 50,
    ];
    $cellStyle = array(
        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
        'valign' => 'center'
    );

    $materia = PlanEstudioMateria::getPlanMaterias($id);

    $ciclos = 0;
    foreach($materia as $llave => $valor){
        if($valor['ciclo'] > $ciclos){
            $ciclos++;
        }
    }

    $section = $phpWord->addSection($sectionStyle);
    margenes($section);
    $section->setPageOrientation('landscape');

    $uvTotal = 0;
    $table = $section->addTable();
    $table->addRow();
    for ($i = 0; $i < $ciclos; $i++) {
        $uvCiclo = 0;
        $materiaCiclo = PlanEstudioMateria::getMateriaCiclo($id,intval($i+1));
        $cell = $table->addCell(2500);
        $cell->addText('Ciclo '.($i+1),$fontC,$pgTC);
        $phpWord->addTableStyle('padre',$styleTableP);
            $subTable = $cell->addTable('padre');
        foreach($materiaCiclo as $llave => $valor) {
            $subTable->addRow();
            $subCell = $subTable->addCell(2500);
                $phpWord->addTableStyle('malla',$styleTable);
                $pensum = $subCell->addTable('malla');
                $pensum->addRow();
                $pensum->addCell(1800,$cellStyle)->addText($valor['no_orden'],$fontC,$pgTC);
                $pensum->addCell(1800,$cellStyle)->addText($valor['codigo'],$fontC,$pgTC);
                $pensum->addRow();
                $gridName = $pensum->addCell(1800,$cellStyle);
                $gridName->addText($valor['nombre_asignatura'],$fontC,$pgTC);
                $gridName->getStyle()->setGridSpan(2);
                $pensum->addRow();
                $psRes = $pensum->addCell(1800,$cellStyle);
                $prerrequisitos = MateriaPrerrequisito::getMateriaPrerrequisitos(intval($valor['materia_id']));
                foreach($prerrequisitos as $posicion => $orden){
                    $psRes->addText($orden['no_orden'],$fontC,$pgTC);
                }
                $pensum->addCell(1800,$cellStyle)->addText($valor['unidades_valorativas'],$fontC,$pgTC);
                $uvCiclo += intval($valor['unidades_valorativas']);
        }
        $uvTotal += intval($uvCiclo);
        $subTable->addRow();
        $uvCell = $subTable->addCell(1800);
            $phpWord->addTableStyle('uv',$styleTable);
            $uv = $uvCell->addTable('uv');
            $uv->addRow();
            $uv->addCell(1800,$cellStyle)->addText($uvCiclo.' U.V',$fontC,$pgTC);
            $uv->addRow();
            $uv->addCell(1800,$cellStyle)->addText($uvTotal.' U.V',$fontC,$pgTC);
    }

    $fontC = array('name' => 'Arial', 'size' => 12);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START, 'lineHeight' => 1.5, 'spaceAfter' => 240);

    $table->addRow();
    $cellGrid = $table->addCell(1800,$cellStyle);
    $cellGrid->addText('Asignaturas que se pueden programar en ciclo extraordinario: un estudiante podrá cursar solamente una asignatura en ciclo extraordinario:'
    ,$fontT,
    $pgTC);
    $cellGrid->getStyle()->setGridSpan(10);

    $cicloExtra = PlanCicloExtraordinario::getPlanCiclo($id);


    $cExtra = 0;
    $arrActual = [];
    $cActual = 0;
    foreach($cicloExtra as $llave => $valor){
        if($valor['ciclo'] > $cExtra){
            if($valor['ciclo'] !== $cActual){
                $cExtra++;
                array_push($arrActual, $valor['ciclo']);
            }
            $cActual = $valor['ciclo'];
        }
    }
    
    $fontC = array('name' => 'Arial', 'size' => 6, 'bold' => true);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 0);

    $table = $section->addTable();
    $table->addRow();
    for($x = 0; $x < $cExtra; $x++){

        $cicloMateria = PlanCicloExtraordinario::getPlanExtraordinario($id,$arrActual[$x]);

        $cellCiclo = $table->addCell(2500);
        $phpWord->addTableStyle('padreCiclo',$styleTableP);
            $subTableCiclo = $cellCiclo->addTable('padreCiclo');
        foreach($cicloMateria as $llave => $valor) {
            $subTableCiclo->addRow();
            $subCellCiclo = $subTableCiclo->addCell(2500);
                $phpWord->addTableStyle('cicloExtraordinario',$styleTable);
                $cicloExtra = $subCellCiclo->addTable('cicloExtraordinario');
                $cicloExtra->addRow();
                $cicloExtra->addCell(1800,$cellStyle)->addText($valor['no_orden'],$fontC,$pgTC);
                $cicloExtra->addCell(1800,$cellStyle)->addText($valor['codigo'],$fontC,$pgTC);
                $cicloExtra->addRow();
                $gridName = $cicloExtra->addCell(1800,$cellStyle);
                $gridName->addText($valor['nombre_asignatura'],$fontC,$pgTC);
                $gridName->getStyle()->setGridSpan(2);
                $cicloExtra->addRow();
                $psRes = $cicloExtra->addCell(1800,$cellStyle);
                $prerrequisitos = PrerrequisitoCiclo::getPrerrequisitosCiclos(intval($valor['extra_id']));
                foreach($prerrequisitos as $posicion => $orden){
                    $psRes->addText($orden['no_orden'],$fontC,$pgTC);
                }
                $cicloExtra->addCell(1800,$cellStyle)->addText($valor['unidades_valorativas'],$fontC,$pgTC);
                $uvCiclo += intval($valor['unidades_valorativas']);
        }
    }
//MALLA CURRICULAR END

//PLAN DE ABSORCIÓN
    $fontC = array('name' => 'Arial', 'size' => 12);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);

    $section = $phpWord->addSection();
    margenes($section);

    $section->addTitle('7. Plan de absorción',1);
    $section->addTitle('7.1 Políticas de absorción',2);

    $section->addText('El plan de estudio se regirá bajo las siguientes políticas de absorción:',$fontC,$pgTC);

    $listStyle = array(
        'listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED,
        'textIndent' => 0,
        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
        'spaceAfter' => 240
    );

    $anioString = substr(($req == null ? '' : $req->getStartValidity()),-4);

    // Crear un objeto DateTime con la fecha proporcionada
    $fecha = DateTime::createFromFormat('Y', $anioString);

    // Restar 5 años al objeto DateTime
    $fecha->sub(new DateInterval('P1Y'));

    // Obtener el año restado
    $anioRestado = $fecha->format('Y');

    $planAnterior = StudyPlan::getPlanAnterior($anioRestado);

    $section->addListItem('El plan de estudio propuesto será única y exclusivamente para estudiantes de nuevo ingreso, a partir del '.($req == null ? '' : $req->getStartValidity()).'.', 0, $fontC, $listStyle);

    $section->addListItem('Los estudiantes inscritos con el plan de estudio autorizado con vigencia del '.(empty($planAnterior) ? '' : $planAnterior[0]['vigencia_inicio']).' al '.(empty($planAnterior) ? '' : $planAnterior[0]['vigencia_final']).' finalizarán sus estudios con dicho plan. ', 0, $fontC, $listStyle);

    $section->addListItem('En el caso de estudiantes que reingresen, se hará un análisis para su absorción; se aplicará el Plan vigente al momento de reingreso.', 0, $fontC, $listStyle);

    $section->addListItem('La institución se compromete a desarrollar los dos planes de estudio, sin ningún costo adicional a los establecidos para los estudiantes, estos no tendrán dificultades en su proceso administrativo y registro académico, en cumplimiento a los artículos 21 y 27 del Reglamento de la Ley de Educación Superior.', 0, $fontC, $listStyle);

    $section->addListItem('Los estudiantes activos que de manera voluntaria y debidamente informados y asesorados deseen incorporarse al presente Plan conociendo las implicaciones académicas y administrativas que dicha migración conlleva, podrán hacerlo conforme a los procedimientos establecidos y en función de las tablas de absorción definidas en este plan.', 0, $fontC, $listStyle);


    $fontC = array('name' => 'Arial', 'size' => 12);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);
    $section->addTitle('7.2 Tabla que describe la absorción',2);
    $section->addText('En proceso...',$fontC,$pgTC);
    $section->addTitle('7.3 Matriz de cambios significativos entre planes de estudio',2);
    $section->addText('En proceso...',$fontC,$pgTC);

    $section->addTitle('7.4 Otorgamiento de equivalencias de créditos académicos por unidades valorativas',2);
    $section->addText('El otorgamiento de equivalencias se concederá, siempre y cuando:',$fontC,$pgTC);
    $section->addListItem('Los contenidos programáticos coinciden, por lo menos, en un 80%.', 0, $fontC, $listStyle);
    $section->addListItem('El número de horas de trabajo académico asistidas por un docente, por asignatura, es equivalente.', 0, $fontC, $listStyle);
    $section->addText('Según el Art 6 de la Ley de Educación Superior, 1 Unidad Valorativa (UV) equivale   a 20 horas de trabajo académico asistidas por un docente, en un ciclo de dieciséis semanas.',$fontC,$pgTC);
    $section->addText('El número de horas asistidas por créditos académicos (CA) se determinará con base en la normativa del lugar de procedencia de los estudios realizados por el solicitante.',$fontC,$pgTC);

//PLAN DE ABSORCIÓN END

//CICLOS EXTRAORDINARIOS

    $section = $phpWord->addSection();
    margenes($section);

    $fontC = array('name' => 'Arial', 'size' => 12);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);
    $section->addTitle('8 Ciclos Extraordinarios',1);
    $section->addText('Según Art. 13. Del Reglamento General de la Ley de Educación Superior, las instituciones de educación superior podrán impartir asignatura en un ciclo extraordinario, el cual deberá tener como equivalente el tiempo que se establece en el inciso 2° del Art. 6 de la Ley, con una carga académica máxima de 6 unidades valorativas por cada estudiante. Las asignaturas a impartirse en el ciclo extraordinario serán aquéllas que no requieran un período prolongado de actividad académica, las que deberán establecerse en el respectivo plan de estudios, cuya duración es de seis semanas (6 semanas).',$fontC,$pgTC);
    $section->addText('Tabla 14 Ciclos Extraordinarios',$fontEncabezado,$paragraphEncabezado);

    $fontT = array('name' => 'Arial', 'size' => 9, 'bold' => true);
    $fontC = array('name' => 'Arial', 'size' => 9);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'lineHeight' => 1.5, 'spaceAfter' => 0);


    //tabla cicloextraordinario
    $phpWord->addTableStyle('cicloExtra',$styleTable);
    $table= $section->addTable('cicloExtra');
    $table->addRow();
    $table->addCell(1100,$cellStyle)->addText('Ciclo',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('No.',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('Código',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('AF',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('Asignatura',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('Prerrequisito',$fontT,$pgTC);
    $cell = $table->addCell(1100,$cellStyle);
        $subTable = $cell->addTable();
        $subTable->addRow();
        $subTable->addCell(1100,$cellStyle)->addText('HTS',$fontT,$pgTC);
        $subTable->addRow();
        $subTable->addCell(525,$cellStyle)->addText('P',$fontT,$pgTC);
        $subTable->addCell(525,$cellStyle)->addText('NP',$fontT,$pgTC);
    $cell = $table->addCell(1100,$cellStyle);
        $subTable = $cell->addTable();
        $subTable->addRow();
        $subTable->addCell(1100,$cellStyle)->addText('HPS',$fontT,$pgTC);
        $subTable->addRow();
        $subTable->addCell(525,$cellStyle)->addText('P',$fontT,$pgTC);
        $subTable->addCell(525,$cellStyle)->addText('NP',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('HTS',$fontT,$pgTC);
    $table->addCell(1100,$cellStyle)->addText('UV',$fontT,$pgTC);

    $cicloExtra = PlanCicloExtraordinario::getPlanCiclo($id);

    foreach($cicloExtra as $llave => $valor){
        $table->addRow();
        $table->addCell(1100,$cellStyle)->addText(intToRoman($valor['ciclo']),$fontT,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($valor['no_orden'],$fontT,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($valor['codigo'],$fontT,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($valor['area_formacion'],$fontT,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($valor['nombre_asignatura'],$fontT,$pgTC);
        $preCell = $table->addCell(1100,$cellStyle);
        $prerrequisitos = PrerrequisitoCiclo::getPrerrequisitosCiclos(intval($valor['extra_id']));
        foreach($prerrequisitos as $posicion => $orden){
            $preCell->addText($orden['prerrequisito'],$fontC,$pgTC);
        }
        $cell = $table->addCell(1100,$cellStyle);
            $subTable = $cell->addTable();
            $subTable->addRow();
            $subTable->addCell(525,$cellStyle)->addText($valor['horas_teoricas_presencial'],$fontT,$pgTC);
            $subTable->addCell(525,$cellStyle)->addText($valor['horas_teoricas_nopresencial'],$fontT,$pgTC);
        $cell = $table->addCell(1100,$cellStyle);
            $subTable = $cell->addTable();
            $subTable->addRow();
            $subTable->addCell(525,$cellStyle)->addText($valor['horas_practicas_presencial'],$fontT,$pgTC);
            $subTable->addCell(525,$cellStyle)->addText($valor['horas_practicas_nopresencial'],$fontT,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($valor['horas_ciclo'],$fontT,$pgTC);
        $table->addCell(1100,$cellStyle)->addText($valor['unidades_valorativas'],$fontT,$pgTC);
    }

//CICLOS EXTRAORDINARIOS END

// PERFIL Y FUNCIONES DEL PERSONAL ACADÉMICO
//PERFIL Y FUNCIONES DEL PERSONAL ACADÉMICO END

//ACTUALIZACION PLAN DE ESTUDIO
    $section = $phpWord->addSection();
    margenes($section);

    $fontC = array('name' => 'Arial', 'size' => 12);
    $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);
    $section->addTitle('17. Plazo de actualización del plan de estudio',1);
    $section->addTitle('17.1 Plazo de actualización del plan de estudio',2);
    $section->addText('El plan de estudio actualizado tendrá una vigencia de cinco años como producto del perfil que se espera formar en el quinquenio 2023-2027. Según Ley de Educación Superior, Art. 37, literal b) Disponer de los planes de estudios adecuados, actualizados al menos una vez en el término de duración de la carrera y aprobados para los grados que se ofrezcan.',$fontC,$pgTC);

    $section->addTitle('17.2 Responsables de la revisión y actualización',2);
    $section->addText('El Directorio Ejecutivo ha determinado la creación de una estructura organizativa para los procesos de actualización a través de las siguientes instancias:
    Una Comisión de Currículo General y Comisiones de Currículo por facultad y carrera las cuales organizan equipos de apoyo para que les colaboren en todo el proceso curricular.
    ',$fontC,$pgTC);
//ACTUALIZACION PLAN DE ESTUDIO END

// PROGRAMA X ASIGNATURA

    $fontContent = array('name' => 'Arial', 'size' => 12);
    $pgContent = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 240);
    $section->addTitle('18. Programa de cada asignatura con enfoque de competencias ',1);
    $section->addText('A continuación, se presentan los diseños instruccionales y las aulas virtuales de las asignaturas de la carrera de'.$req->getNameCar().', modalidad '.$req->getModalityCar(),$fontContent ,$pgContent);

        /* Note: any element you append to a document must reside inside of a Section. */
        // $styleFontPortadah1 = array('name' => 'Arial', 'size' => 18, 'bold' => true, 'allCaps' => true);
        // $styleFontPortadah2 = array('name' => 'Arial', 'size' => 16, 'bold' => true, 'allCaps' => true);
        // $styleFontPortadah3 = array('name' => 'Arial', 'size' => 14, 'bold' => true, 'allCaps' => true);
        // $styleFontPortadaVigencia = array('name' => 'Arial', 'size' => 14, 'bold' => true);
        // $styleFontPresentacion = array('name' => 'Arial', 'size' => 12, 'bold' => true);
        // $fontPortada = array('align' => 'center', 'spaceAfter' => 160, 'lineHeight' => 1.5);
        // $spaceNone = array('spaceAfter' => 0);
    $fontTM = array('name' => 'Arial', 'size' => 12, 'bold' => true);
    $pgTM = array('align' => 'start', 'spaceAfter' => 160, 'lineHeight' => 1.5);


    $imgPortada = array('width' => 300, 'height' => 60, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
    $imgLogo = array('width' => 125, 'height' => 125, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);

    $materias = PlanEstudioMateria::getPlanMaterias($id);

    foreach($materias as $key => $value){
        $prerrequisitos = [];
        $elemento = [];
        $valores = [];
        $contenidoAsignatura = [];
        $habilidades = [];
        $conocimientos = [];
        $metodologias = [];
        $criterioContenido = [];
        $materia_id = intval($value['materia_id']);

        // Agregar un párrafo al documento
        $section = $phpWord->addSection();
        margenes($section);

        // SECCION PORTADA

            //Portada
            //Imagen titulo Universidad
            $section->addImage($imagePathTitle, $imgPortada);
            $section->addTextBreak();
            $section->addText($req->getNameFac(),$styleFontPortadah2,$fontPortada);
            $section->addTextBreak();
            //Imagen Logo
            $section->addImage($imagePathLogo, $imgLogo);
            $section->addTextBreak();
            $section->addText('Programa de la asignatura',$styleFontPortadah3,$fontPortada);
            $section->addTextBreak(2);
            $section->addText($value['nombre_asignatura'],$styleFontPortadah2,$fontPortada);
            $section->addTextBreak(2);
            $section->addText('Ciclo '.intToRoman($value['ciclo']),$styleFontPortadah3,$fontPortada);
            $section->addTextBreak();
            $section->addText('SAN SALVADOR, EL SALVADOR, CENTROAMÉRICA.',$styleFontPortadah3,$fontPortada);

        //SECCION PORTADA END
        //TABLA DE GENERALIDADES
            //Generalidades
            $section->addText('18.1 '.$value['nombre_asignatura'],$fontTM,$pgTM);
            $section->addText('Generalidades.',$fontTM,$pgTM);

            $fontGen = array('name' => 'Arial', 'size' => 12);
            $pgGen = array(
                'align' => 'start',
                'spaceAfter' => 0
            );
            $listGen = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED, 'align' => 'start', 'spaceAfter' => 0);
            //tabla generalidades
            $phpWord->addTableStyle('asignatura', $styleTable);
            $table = $section->addTable('asignatura');
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.1. Nombre de la asignatura:',$fontTM,$pgGen);
            $table->addCell(6000,$cellStyle)->addText($value['nombre_asignatura'],$fontTM,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.2. No. de orden:',$fontGen,$pgGen);
            $table->addCell(6000,$cellStyle)->addText($value['no_orden'],$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.3. Código:',$fontGen,$pgGen);
            $table->addCell(6000,$cellStyle)->addText($value['codigo'],$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.4. Prerrequisito:',$fontGen,$pgGen);
            $cellPrerrequisitos = $table->addCell(6000,$cellStyle);
            array_push($prerrequisitos, MateriaPrerrequisito::getMateriaPrerrequisitos($materia_id));
            foreach($prerrequisitos as $llave => $valor){
                foreach($valor as $posicion => $valor){
                    $cellPrerrequisitos->addText($valor['prerrequisito'],$fontGen,$pgGen);
                }
            }
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.5. No. de horas por ciclo:',$fontGen,$pgGen);
            $table->addCell(6000,$cellStyle)->addText($value['horas_ciclo'],$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.6. Horas teóricas semanales:',$fontGen,$pgGen);
            $cell = $table->addCell(6000,$cellStyle);
            $subTable = $cell->addTable();
            $subTable->addRow();
            $subTable->addCell(6000,$cellStyle)->addText('Presenciales: '.$value['horas_teoricas_presencial'],$fontGen,$pgGen);
            $subTable->addRow();
            $subTable->addCell(6000,$cellStyle)->addText('No Presenciales: '.$value['horas_teoricas_nopresencial'],$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.7. Horas prácticas semanales:',$fontGen,$pgGen);
            $cell = $table->addCell(6000,$cellStyle);
            $subTable = $cell->addTable();
            $subTable->addRow();
            $subTable->addCell(6000,$cellStyle)->addText('Presenciales: '.$value['horas_practicas_presencial'],$fontGen,$pgGen);
            $subTable->addRow();
            $subTable->addCell(6000,$cellStyle)->addText('No Presenciales: '.$value['horas_practicas_nopresencial'],$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.8. Duración del ciclo en semanas:',$fontGen,$pgGen);
            $table->addCell(6000,$cellStyle)->addText($value['ciclo_semanas'],$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.9. Duración de la hora clase:',$fontGen,$pgGen);
            $table->addCell(6000,$cellStyle)->addText($value['duracion_clase'].' minutos',$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.10. Unidades valorativas:',$fontGen,$pgGen);
            $table->addCell(6000,$cellStyle)->addText($value['unidades_valorativas'],$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.11. Identificación del ciclo académico:',$fontGen,$pgGen);
            $table->addCell(6000,$cellStyle)->addText(intToRoman($value['ciclo']),$fontGen,$pgGen);
            $table->addRow();
            $table->addCell(6000,$cellStyle)->addText('18.1.12. Modalidad de entrga:',$fontGen,$pgGen);
            $table->addCell(6000,$cellStyle)->addText($value['modalidad'],$fontGen,$pgGen);
        //TABLA DE GENERALIDADES END
            $section->addTextBreak(2);
        //DESCRIPCION HASTA VALORES
            $section->addText('19.1. Descripción de la asignatura:',$fontTM,$pgTM);
            $section->addText($value['descripcion'],$fontContent,$pgContent);

            $section->addText('19.1.1. Función clave:',$fontTM,$pgTM);
            $section->addText($value['funcion_clave'],$fontContent,$pgContent);

            $section->addText('19.1.2. Unidad de Competencia:',$fontTM,$pgTM);
            $section->addText($value['unidad_competencia'],$fontContent,$pgContent);

            $fontCell = array('name' => 'Arial', 'size' => 12);
            $listStyle = array(
                'listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED,
                'textIndent' => 0,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
                'spaceAfter' => 240
            );

            $section->addText('19.1.3. Elementos de competencias:',$fontTM,$pgTM);
            array_push($elemento,Elemento::getElementos($materia_id));
            foreach($elemento as $posicion => $valor){
                foreach($valor as $llave => $valor){
                    $section->addListItem($valor['elemento'],0,$fontCell,$listStyle);
                }
            }

            $section->addText('19.1.4. Valores institucionales a desarrollar',$fontTM,$pgTM);
            array_push($valores,MateriaValorInstitucional::getMateriaValores($materia_id));
            foreach($valores as $llave => $valor){
                foreach($valor as $posicion => $valor){
                    $section->addListItem($valor['valor'],0,$fontCell,$listStyle);
                }
            }
        //DESCRIPCION HASTA VALORES END

        $fontTC = array('name' => 'Arial', 'size' => 10, 'bold' => true, 'AllCaps' => true);
        $fontTCP = array('name' => 'Arial', 'size' => 10, 'bold' => true);
        $fontGen = array('name' => 'Arial', 'size' => 10);
        $pgGen = array(
            'align' => 'center',
            'spaceAfter' => 0
        );

        $section->addText('20.1 Contenido de la Asignatura.',$fontTM,$pgTM);

        array_push($contenidoAsignatura, ContenidoAsignatura::getContenidoAsignaturas($materia_id));
        foreach($contenidoAsignatura as $llave => $valor){
            $j=1;
            foreach($valor as $posicion => $asignatura){
                $contenido_id = intval($asignatura['contenido_id']);

                //tabla generalidades
                $phpWord->addTableStyle('contenido_asignatura', $styleTable);
                $table = $section->addTable('contenido_asignatura');

                $table->addRow();
                $tableText = $table->addCell(10000,$cellStyle);
                $txt = $tableText->addTextRun();
                $txt->addText('Unidad de Aprendizaje '.$j.': ',$fontTCP,$pgGen);
                $txt->addText($asignatura['unidad_aprendizaje'],$fontTC,$pgGen);
                $tableText->getStyle()->setGridSpan(5);

                $table->addRow();
                $tblTxt = $table->addCell(10000,$cellStyle);
                $txt = $tblTxt->addTextRun();
                $txt->addText('Competencia: ',$fontTCP,$pgGen);
                $txt->addText($asignatura['competencia'],$fontGen,$pgGen);
                $tblTxt->getStyle()->setGridSpan(5);

                $table->addRow();
                $cell = $table->addCell(2000,$cellStyle);
                $cell->addTextRun();
                $cell->addText('Habilidades',$fontTCP,$pgGen);
                $cell->addText('(Elemento de competencia)',$fontGen,$pgGen);
                $cell = $table->addCell(2000,$cellStyle)->addText('Conocimientos',$fontTCP,$pgGen);
                $cell = $table->addCell(2000,$cellStyle)->addText('Metodología',$fontTCP,$pgGen);
                $cell = $table->addCell(2000,$cellStyle)->addText('Criterios de evaluación',$fontTCP,$pgGen);
                $cell = $table->addCell(2000,$cellStyle);
                $subTable = $cell->addTable();
                $subTable->addRow();
                $subTable->addCell(2000,$cellStyle)->addText('Tiempo estimado',$fontTCP,$pgGen);
                $subTable->addRow();
                $subTable->addCell(1000,$cellStyle)->addText('Semanas',$fontGen,$pgGen);
                $subTable->addCell(1000,$cellStyle)->addText('No. de Horas',$fontGen,$pgGen);

                $table->addRow();
                $hblCell = $table->addCell(2000,$cellStyle);
                $habilidades = [];
                array_push($habilidades,Habilidades::getHabilidades($contenido_id));
                foreach($habilidades as $llave => $valor){
                    foreach($valor as $posicion => $valor){
                        $hblCell->addListItem($valor['habilidad'],0,$fontGen,$listStyle);
                    }
                }

                $cncmtCell = $table->addCell(2000,$cellStyle);
                $conocimientos = [];
                array_push($conocimientos,Conocimientos::getConocimientos($contenido_id));
                foreach($conocimientos as $llave => $valor){
                    foreach($valor as $posicion => $valor){
                        $cncmtCell->addListItem($valor['conocimiento'],0,$fontGen,$listStyle);
                    }
                }

                $mtdlgCell = $table->addCell(2000,$cellStyle);
                $mtdlgCell->addtext($asignatura['descripcion_metodologia'],$fontGen,$pgGen);
                $metodologias = [];
                array_push($metodologias,Metodologia::getMetodologias($contenido_id));
                foreach($metodologias as $llave => $valor){
                    foreach($valor as $posicion => $valor){
                        $mtdlgCell->addListItem($valor['metodologia'],0,$fontGen,$listStyle);
                    }
                }

                $ctrCell = $table->addCell(2000,$cellStyle);
                $ctrCell->addtext($asignatura['descripcion_evaluacion'],$fontGen,$pgGen);
                $criterioContenido = [];
                array_push($criterioContenido,CriterioContenido::getCriterios($contenido_id));
                foreach($criterioContenido as $llave => $valor){
                    foreach($valor as $posicion => $valor){
                        $ctrCell->addListItem($valor['descripcion'],0,$fontGen,$listStyle);
                    }
                }

                $cell = $table->addCell(2000,$cellStyle);
                $antrTable = $cell->addTable();
                $antrTable->addRow();
                $antrTable->addCell(1000,$cellStyle)->addText('Semana '.$asignatura['semana_inicio'].' a la semana '.$asignatura['semana_final'],$fontGen,$pgGen);
                $antrTable->addCell(1000,$cellStyle)->addText($asignatura['no_horas'],$fontGen,$pgGen);
                
                
                $table->addRow();
                $actCell = $table->addCell(10000,$cellStyle);
                $actCell->addText('actitudes: '.$asignatura['actitudes'],$fontGen,$pgGen);
                $actCell->getStyle()->setGridSpan(5);
                $section->addTextBreak(2);
                $j++;
            }
        }

        $fontGen = array('name' => 'Arial', 'size' => 12);
        $pgGen = array(
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 120
        );
        $pgTC = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'lineHeight' => 1.5, 'spaceAfter' => 120);

        $section->addText('21.1. Estrategia metodológica',$fontTM,$pgTM);
        $section->addText($value['estrategia'],$fontGen,$pgTC);
        $section->addTextBreak(2);

        $section->addText('22.1 Criterios de evaluación',$fontTM,$pgTM);

        $fontGen = array('name' => 'Arial', 'size' => 10);
        $listCri = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED, 'align' => 'start', 'spaceAfter' => 0);
        //tabla criterios de evauacion
        $phpWord->addTableStyle('indicador', $styleTable);
        $table = $section->addTable('indicador');
        $table->addRow();
        $table->addCell(3333,$cellStyle)->addText('Indicadores de logro',$fontTCP,$pgGen);
        $table->addCell(3333,$cellStyle)->addText('Criterios de evaluación',$fontTCP,$pgGen);
        $cell = $table->addCell(3333,$cellStyle);
        $subTable = $cell->addTable();
        $subTable->addRow();
        $subTable->addCell(3333,$cellStyle)->addText('Sistema de Evaluación',$fontTCP,$pgGen);
        $subTable->addRow();
        $subTable->addCell(1666,$cellStyle)->addText('Presencial',$fontTCP,$pgGen);
        $subTable->addCell(1666,$cellStyle)->addText('No Presencial',$fontTCP,$pgGen);
        $indicador = [];
        array_push($indicador, Indicador::getIndicadores($materia_id));
        foreach($indicador as $llave => $valor){
            foreach($valor as $posicion => $valor){
                $indicador_id = intval($valor['indicador_id']);

                $table->addRow();
                $idcdCell = $table->addCell(3333,$cellStyle);
                $idcdCell->addListItem($valor['indicador'],0,$fontGen,$listCri);

                $ceCell = $table->addCell(3333,$cellStyle);
                $criterioEvaluacion = [];
                array_push($criterioEvaluacion, CriterioEvaluacion::getCriteriosEvaluaciones($indicador_id));
                foreach($criterioEvaluacion as $llave => $valor){
                    foreach($valor as $posicion => $valor){
                        $ceCell->addListItem($valor['criterio'],0,$fontGen,$listCri);
                    }
                }

                $subCell = $table->addCell(3333,$cellStyle);
                $subTable = $subCell->addTable();
                $subTable->addRow();
                $subCell = $subTable->addCell(1666,$cellStyle);
                $presencial = [];
                array_push($presencial, IndicadorEvaluacionPresencial::getIndicadorSpresencial($indicador_id));
                foreach($presencial as $llave => $valor){
                    foreach($valor as $posicion => $valor){
                        $subCell->addListItem($valor['evaluacion'],0,$fontGen,$listCri);
                    }
                }
                $subCell = $subTable->addCell(1666,$cellStyle);
                $noPresencial = [];
                array_push($noPresencial, IndicadorEvaluacionNoPresencial::getIndicadorSNopresencial($indicador_id));
                foreach($noPresencial as $llave => $valor){
                    foreach($valor as $posicion => $valor){
                        $subCell->addListItem($valor['evaluacion'],0,$fontGen,$listCri);
                    }
                }
            }
        }

        $section->addTextBreak(2);

        $section->addText('23.1. Fuentes de información y materiales de apoyo',$fontTM,$pgTM);
        $section->addText('(Fuentes actualizadas y que exista al menos 3 ejemplares disponibles en biblioteca)',$fontGen,$pgGen);
        $section->addTextBreak();
        $material = [];
        array_push($material,MaterialApoyo::getMateriales($materia_id));
        foreach($material as $llave => $valor){
            foreach($valor as $posicion => $valor){
                $section->addText($valor['material'],$fontGen,$pgContent);
            }
        }

        $section->addTextBreak();

        $section->addText('24.1. Sitios web y recursos digitales',$fontTM,$pgTM);
        $recursos = [];
        array_push($recursos,Recursos::getRecursos($materia_id));
        foreach($recursos as $llave => $valor){
            foreach($valor as $posicion => $valor){
                $section->addText($valor['titulo'].': '.$valor['link'],$fontGen,$pgGen);
            }
        }

        $section->addTextBreak();

        $sizeImg = array('width' => 300, 'height' => 150, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
        $section->addText('25.1. Aula Virtual',$fontTM,$pgTM);

        $imgAula = ImagenMateria::getImagen($materia_id);
        $rutaImg = $imgAula['img_materia'];
        $section->addImage($rutaImg, $sizeImg);
    }
//PROGRAMA X ASIGNATURA END

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