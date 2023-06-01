<div class="position-relative" id="formMaterias">
    <h2 class="text-utec text-center header-font-custom">Materias</h2>
    <div class="d-flex flex-column w-75 mx-auto mt-3 mt-sm-5">
        <div class="d-flex justify-content-between flex-wrap">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-danger mb-2  p-0 px-3 rounded-5" data-bs-toggle="modal" data-bs-target="#informacion">
                <span class="icon profile-icon">
                    <i class="fas fa-question"></i>
                </span>
            </button>
            <!-- modal guardar avance -->
            <?php require __DIR__ . '/../../components/modalPlan/modalInformacion.php'; ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2 p-0 px-2" data-bs-toggle="modal" data-bs-target="#materiasPasadas">
                <span class="icon profile-icon">
                    <p class="font-custom m-0">¿Quieres usar materias de planes pasados?</p>
                </span>
            </button>
        </div>
        <form action="/tesis/plan/materia/<?= $this->d['plan']->getId()?>" method="post" class="position-relative" enctype="multipart/form-data">
            <div class="guardar">
                <button type="submit" class="btn btn-success">
                    <span class="icon profile-icon">
                        <i class="fas fa-save"></i>
                    </span>
                </button>
            </div>
            <div id="materias">
                <div class="mb-3 border border-utec p-3 rounded">
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Ciclo en que se impartira la materia:</label>
                        <input type="number"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 1</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Nombre Asignatura:</label>
                        <input type="text"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Algoritmo I</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">No. de orden:</label>
                        <input type="number"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 1</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Codigo de Asignatura:</label>
                        <input type="text"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: ALG1-E</small>
                    </div>
                    <div class="mb-3">
                        <p class="text-utec font-custom">Areas de formación:</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="AB">
                            <label class="form-check-label" for="">
                                Area Basica
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="AG" >
                            <label class="form-check-label" for="">
                                Area General
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="AE" id="flexCheck">
                            <label class="form-check-label" for="">
                                Area de Especialidad
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Prerrequisitos:</label>
                        <input type="text"
                        class="form-control" name="prerrequisito[]" id="" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Bachillerato</small>
                        <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarPrerrequisito()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarPrerrequisito()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Horas totales del ciclo:</label>
                        <input type="number"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 90</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Horas teóricas semanales:</label>
                        <input type="number"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 2</small>
                    </div>
                    <div class="mb-3">
                        <p class="text-utec font-custom">Tipo:</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="presencial">
                            <label class="form-check-label" for="">
                                Presencial
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="no presencial">
                            <label class="form-check-label" for="">
                                No presencial
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Horas teóricas practicas:</label>
                        <input type="number"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 2</small>
                    </div>
                    <div class="mb-3">
                        <p class="text-utec font-custom">Tipo:</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="presencial">
                            <label class="form-check-label" for="">
                                Presencial
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="no presencial">
                            <label class="form-check-label" for="">
                                No presencial
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Unidades valorativas:</label>
                        <input type="number"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 4</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Duración ciclo en semanas:</label>
                        <input type="number"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 18</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Duración de la hora clase(en minutos):</label>
                        <input type="number"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 50</small>
                    </div>
                    <div class="mb-3">
                        <p class="font-custom">Modalidad de entrega</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="semipresencial">
                            <label class="form-check-label" for="">
                                Presencial y No presencial
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="materia[]" value="presencial">
                            <label class="form-check-label" for="">
                                Presencial y semipresencial
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 border border-utec p-3 rounded">
                    <div class="mt-3 mb-3">
                        <label for="" class="form-label text-utec font-custom">Descripción Asignatura</label>
                        <textarea class="form-control" name="materia[]" id="" rows="15"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Funcion Clave:</label>
                        <input type="text"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Resolver problemas aplicando las ciencias de la computación.</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Unidad de competencia:</label>
                        <input type="text"
                        class="form-control" name="materia[]" id="" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Resolver problemas de lógica computacional, utilizando las estructuras de control y estructuras de datos.</small>
                    </div>
                </div>
                <div class="mb-3 border border-utec p-3 rounded">
                    <label for="" class="form-label text-utec font-custom">Elemento de competencia:</label>
                    <input type="text"
                    class="form-control" name="elemento[]" id="" aria-describedby="helpId">
                    <small id="helpId" class="form-text text-muted">Ejemplo: Diseñar algoritmos y diagramas de flujo para la solución de problemas.</small>
                    <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarElemento()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-plus"></i>
                        </span>
                    </button>
                    <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarElemento()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-minus"></i>
                        </span>
                    </button>
                </div>
                <div class="mb-3 border border-utec p-3 rounded">
                    <p class="text-utec font-custom">Valores Institucionales a desarrollar:</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="valores[]" value="Compromiso agresivo">
                        <label class="form-check-label" for="">
                            Compromiso agresivo
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="valores[]" value="Innovación permanente">
                        <label class="form-check-label" for="">
                            Innovación permanente
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="valores[]" value="Respeto y pensamiento positivo">
                        <label class="form-check-label" for="">
                            Respeto y pensamiento positivo
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="valores[]" value="Liderazgo institucional">
                        <label class="form-check-label" for="">
                        Liderazgo institucional
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="valores[]" value="Solidaridad">
                        <label class="form-check-label" for="">
                        Solidaridad
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="valores[]" value="Integridad">
                        <label class="form-check-label" for="">
                        Integridad
                        </label>
                    </div>
                </div>
                <div class="mb-3 border border-utec p-3 rounded">
                    <div id="contenido_asignatura" class="mb-3">
                        <h3 class="text-utec font-custom">Contenido de la Asignatura</h3>
                        <div class="mb-3">
                            <label for="" class="form-label text-utec font-custom">Ingresar unidad de aprendizaje:</label>
                            <input type="text"
                                class="form-control" name="contenido1[]" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Analisis de datos y operaciones básicas</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-utec font-custom">Ingresar competencia:</label>
                            <input type="text"
                                class="form-control" name="contenido1[]" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Resolver problemas aplicando lógica computacional, utilizando las estructuras de control.</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-utec font-custom">Ingresar habilidades:</label>
                            <input type="text"
                                class="form-control" name="habilidades1[]" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Establecer las bases de datos y operaciones básicas para las fases de la resolución de problemas.</small>
                            <button id="agregarH" type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarHabilidades(1)" >
                                <span class="icon profile-icon">
                                    <i class="fas fa-plus"></i>
                                </span>
                            </button>
                            <button id="eliminarH" type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarHabilidades(1)" >
                                <span class="icon profile-icon">
                                    <i class="fas fa-minus"></i>
                                </span>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-utec font-custom">Ingresar conocimientos:</label>
                            <input type="text"
                                class="form-control" name="conocimientos1[]" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Reconocer los tipos de datos y como los utilizaran en los algoritmos.</small>
                            <button id="agregarC" type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarConocimientos(1)" >
                                <span class="icon profile-icon">
                                    <i class="fas fa-plus"></i>
                                </span>
                            </button>
                            <button id="eliminarC" type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarConocimientos(1)" >
                                <span class="icon profile-icon">
                                    <i class="fas fa-minus"></i>
                                </span>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-utec font-custom">Ingresar descripción metodología(opcional):</label>
                            <input type="text"
                                class="form-control" name="contenido1[]" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Se utilizarán diversos medios digitales como:</small>
                            <label for="" class="d-block form-label text-utec font-custom mt-2">Ingresar metodología:</label>
                            <input type="text"
                                class="form-control" name="metodologia1[]" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Exámenes en línea</small>
                            <button id="agregarM" type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarMetodologia(1)" >
                                <span class="icon profile-icon">
                                    <i class="fas fa-plus"></i>
                                </span>
                            </button>
                            <button id="eliminarM" type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarMetodologia(1)" >
                                <span class="icon profile-icon">
                                    <i class="fas fa-minus"></i>
                                </span>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-utec font-custom">Ingresar descripción Criterios(opcional):</label>
                            <input type="text"
                                class="form-control" name="contenido1[]" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Se utilizarán diversos medios digitales como:</small>
                            <label for="" class="d-block form-label text-utec font-custom mt-2">Ingresar criterio:</label>
                            <input type="text"
                                class="form-control" name="criterioContenido1[]" id="" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Exámenes en línea</small>
                            <button id="agregarCC" type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarCriterioC(1)" >
                                <span class="icon profile-icon">
                                    <i class="fas fa-plus"></i>
                                </span>
                            </button>
                            <button id="eliminarCC" type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarCriterioC(1)" >
                                <span class="icon profile-icon">
                                    <i class="fas fa-minus"></i>
                                </span>
                            </button>
                        </div>
                        <div class="mb-3">
                            <h3 class="text-utec font-custom">Tiempo estimado en semanas</h3>
                            <label for="" class="form-label text-utec font-custom">Ingresar semana inicial:</label>
                            <input type="number"
                                class="form-control" name="contenido1[]" id="" aria-describedby="helpId" step="1">
                            <small id="helpId" class="form-text text-muted">Ejemplo: 1</small>
                            <label for="" class="d-block form-label text-utec font-custom mt-2">Ingresar semana final:</label>
                            <input type="number"
                                class="form-control" name="contenido1[]" id="" aria-describedby="helpId" step="1">
                            <small id="helpId" class="form-text text-muted">Ejemplo: 1</small>
                            <label for="" class="d-block form-label text-utec font-custom mt-2">Ingresar estimado de horas:</label>
                            <input type="number"
                                class="form-control" name="contenido1[]" id="" aria-describedby="helpId" step="1">
                            <small id="helpId" class="form-text text-muted">Ejemplo: 15</small>
                            <label for="" class="d-block form-label text-utec font-custom mt-2">Ingresar actitudes:</label>
                            <input type="number"
                                class="form-control" name="contenido1[]" id="" aria-describedby="helpId" step="1">
                            <small id="helpId" class="form-text text-muted">Ejemplo: Responsable, creativo y ordenado.</small>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="text-utec h6">¿Quieres ingresar otro contenido de asignatura(+) o eliminar(-)?</p>
                    <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarContenidoAsignatura()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-plus"></i>
                        </span>
                    </button>
                    <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarContenidoAsignatura()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-minus"></i>
                        </span>
                    </button>
                </div>
                <div class="mt-3 mb-3">
                    <label for="" class="form-label text-utec font-custom">Estrategia metodologica</label>
                    <textarea class="form-control" name="materia[]" id="" rows="12"></textarea>
                </div>
                <div class="mb-3 border border-utec p-3 rounded">
                    <h3 class="text-utec font-custom">Criterios de evaluación</h3>
                    <div class="mb-3">
                        <label for="" class="form-label">Ingresar Indicador de logro:</label>
                        <input type="text"
                            class="form-control" name="indicador[]" id="" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Explicar las fases de la resolución de problemas</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Ingresar criterio de evaluación:</label>
                        <input type="text"
                            class="form-control" name="criterio[]" id="" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 1.	Explica correctamente las fases de la solución de problemas.</small>
                        <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarCriterioE()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarCriterioE()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Sistema de evaluación presencial:</label>
                        <input type="text"
                            class="form-control" name="Spresencial[]" id="" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Controles de lectura.</small>
                        <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarSpresencial()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarSpresencial()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Sistema de evaluación no presencial:</label>
                        <input type="text"
                            class="form-control" name="SNopresencial[]" id="" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Controles de lectura en línea.</small>
                        <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarSNopresencial()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarSNopresencial()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="mb-3 border border-utec p-3 rounded">
                    <label for="" class="form-label text-utec font-custom">Material de apoyo:</label>
                    <input type="text"
                        class="form-control" name="apoyo[]" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Ejemplo: Aguilar, L. J. (2011). Programación en Java 6: Algoritmos, programación orientada a objetos e interfaz gráfica de usuario. México: McGraw-Hill. 3 Ejemplares.</small>
                    <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarApoyo()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-plus"></i>
                        </span>
                    </button>
                    <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarApoyo()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-minus"></i>
                        </span>
                    </button>
                </div>
                <div class="mb-3 border border-utec p-3 rounded">
                    <h3 class="text-utec font-custom">Recursos Digitales</h3>
                    <div id="recurso">
                        <label for="" class="form-label text-utec font-custom">Titulo:</label>
                        <input type="text"
                        class="form-control" name="recurso[]" id="" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Biblioteca UTEC.</small>
                        <label for="" class="d-block form-label text-utec font-custom mt-2">Link/URL:</label>
                        <input type="text"
                        class="form-control" name="recurso[]" id="" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: https://biblioteca.utec.edu.sv/web/index.php/tutorials/e-recursos.</small>
                    </div>
                    <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarRecurso()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-plus"></i>
                        </span>
                    </button>
                    <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarRecurso()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-minus"></i>
                        </span>
                    </button>
                </div>
                <div class="mb-3 border border-utec p-3 rounded">
                    <h3 class="text-utec font-custom">Aula virtual</h3>
                    <label for="">Ingresar Imagen:</label>
                    <input type="file" name="img" id="" class="form-control">
                </div>
            </div>
        </form>
    </div>
</div>