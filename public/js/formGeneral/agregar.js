function agregarGrado(){
    const select1 = document.querySelector('#selects:last-of-type')
    const select2 = select1.cloneNode(true);
    select1.parentNode.insertBefore(select2, select1.nextSibling);
}

function eliminarGrado(){
    var validationInput = document.querySelectorAll('#selects');
    // find existing input element
    var existingInput = document.querySelectorAll('#selects:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarExperiencia(){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", "experiencia[]");

    // find existing input element
    var existingInput = document.querySelector('input[name="experiencia[]"]:last-of-type');

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarExperiencia(){
    var validationInput = document.querySelectorAll('input[name="experiencia[]"]');
    // find existing input element
    var existingInput = document.querySelectorAll('input[name="experiencia[]"]:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarParticipacion(){
    const select1 = document.querySelector('#selectsPar:last-of-type');
    const select2 = select1.cloneNode(true);
    select1.parentNode.insertBefore(select2, select1.nextSibling);
}

function eliminarParticipacion(){
    var validationInput = document.querySelectorAll('#selectsPar');
    // find existing input element
    var existingInput = document.querySelectorAll('#selectsPar:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarCreador(){
    const select1 = document.getElementById('selectsCreador');
    const select2 = select1.cloneNode(true);
    select1.parentNode.insertBefore(select2, select1.nextSibling);
}

function eliminarCreador(){
    var validationInput = document.querySelectorAll('#selectsCreador');
    // find existing input element
    let existingInput = document.querySelectorAll('#selectsCreador:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

/*function agregarComGeneral(){
    const selectCom = document.querySelector('#comGeneral:last-of-type');
    const select2 = selectCom.cloneNode(true);
    // Get the inputs to clear in the cloned areas container
    var inputsToClear = select2.querySelectorAll("input");
    // Clear the values of the inputs in the cloned areas container
    inputsToClear.forEach(function(input) {
        input.value = "";
    });
    selectCom.parentNode.insertBefore(select2, selectCom.nextSibling);
}*/

function agregarComGeneral() {
    const selectsCom = document.querySelectorAll('#comGeneral');
    if (selectsCom.length === 0) {
        console.error('No se encontró ningún elemento con id="comGeneral"');
        return;
    }
    const selectCom = selectsCom[selectsCom.length - 1];  // Último elemento
    const select2 = selectCom.cloneNode(true);
    
    // Limpiar inputs del clon
    var inputsToClear = select2.querySelectorAll("input");
    inputsToClear.forEach(function(input) {
        input.value = "";
    });
    
    selectCom.parentNode.insertBefore(select2, selectCom.nextSibling);
    
    // Cambiar ID del nuevo elemento para evitar duplicados
    select2.id = 'comGeneral_' + Date.now();
}

function eliminarComGeneral(){
    var validationInput = document.querySelectorAll('#comGeneral');
    // find existing input element
    var existingInput = document.querySelectorAll('#comGeneral:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarComBasica(){
    const selectBasica = document.querySelector('#comBasica:last-of-type');
    const select2 = selectBasica.cloneNode(true);
    // Get the inputs to clear in the cloned areas container
    var inputsToClear = select2.querySelectorAll("input");
    // Clear the values of the inputs in the cloned areas container
    inputsToClear.forEach(function(input) {
        input.value = "";
    });
    selectBasica.parentNode.insertBefore(select2, selectBasica.nextSibling);
}

function eliminarComBasica(){
    var validationInput = document.querySelectorAll('#comBasica');
    // find existing input element
    var existingInput = document.querySelectorAll('#comBasica:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarComEspecialidad(){
    const selectEspecialidad = document.querySelector('#comEspecialidad:last-of-type');
    const select2 = selectEspecialidad.cloneNode(true);
     // Get the inputs to clear in the cloned areas container
    var inputsToClear = select2.querySelectorAll("input");
     // Clear the values of the inputs in the cloned areas container
    inputsToClear.forEach(function(input) {
        input.value = "";
    });
    selectEspecialidad.parentNode.insertBefore(select2, selectEspecialidad.nextSibling);
}

function eliminarComEspecialidad(){
    var validationInput = document.querySelectorAll('#comEspecialidad');
    // find existing input element
    var existingInput = document.querySelectorAll('#comEspecialidad:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarAreas(){
    const selectAreas = document.querySelector('#areas:last-of-type');
    const select2 = selectAreas.cloneNode(true);
    // Get the inputs to clear in the cloned areas container
    var inputsToClear = select2.querySelectorAll("input");
    // Clear the values of the inputs in the cloned areas container
    inputsToClear.forEach(function(input) {
        input.type == "checkbox" ? input.checked = false : input.value = ""
    });
    var textareaToClear = select2.querySelectorAll("textarea");
    // Clear the values of the inputs in the cloned areas container
    textareaToClear.forEach(function(text) {
        text.value = "";
    });
    selectAreas.parentNode.insertBefore(select2, selectAreas.nextSibling);
}

function eliminarAreas(){
    var validationInput = document.querySelectorAll('#areas');
    // find existing input element
    var existingInput = document.querySelectorAll('#areas:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarPrerrequisito(){
    const select1 = document.getElementById('selectsPrerrequisito');
    const select2 = select1.cloneNode(true);
    select1.parentNode.insertBefore(select2, select1.nextSibling);
}

function eliminarPrerrequisito(){
    var validationInput = document.querySelectorAll('#selectsPrerrequisito');
    // find existing input element
    let existingInput = document.querySelectorAll('#selectsPrerrequisito:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarElemento(){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", "elemento[]");

    // find existing input element
    var existingInput = document.querySelector('input[name="elemento[]"]:last-of-type');

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarElemento(){
    var validationInput = document.querySelectorAll('input[name="elemento[]"]');
    // find existing input element
    var existingInput = document.querySelectorAll('input[name="elemento[]"]:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarHabilidades(valor){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", `habilidades${valor}[]`);

    // find existing input element
    var existingInput = document.querySelector(`input[name="habilidades${valor}[]"]:last-of-type`);

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarHabilidades(valor){
    var validationInput = document.querySelectorAll(`input[name="habilidades${valor}[]"]`);
    // find existing input element
    var existingInput = document.querySelectorAll(`input[name="habilidades${valor}[]"]:last-of-type`);

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarConocimientos(valor){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name",`conocimientos${valor}[]`);

    // find existing input element
    var existingInput = document.querySelector(`input[name="conocimientos${valor}[]"]:last-of-type`);

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarConocimientos(valor){
    var validationInput = document.querySelectorAll(`input[name="conocimientos${valor}[]"]`);
    // find existing input element
    var existingInput = document.querySelectorAll(`input[name="conocimientos${valor}[]"]:last-of-type`);

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarMetodologia(valor){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", `metodologia${valor}[]`);

    // find existing input element
    var existingInput = document.querySelector(`input[name="metodologia${valor}[]"]:last-of-type`);

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarMetodologia(valor){
    var validationInput = document.querySelectorAll(`input[name="metodologia${valor}[]"]`);
    // find existing input element
    var existingInput = document.querySelectorAll(`input[name="metodologia${valor}[]"]:last-of-type`);

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarCriterioC(valor){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", `criterioContenido${valor}[]`);

    // find existing input element
    var existingInput = document.querySelector(`input[name="criterioContenido${valor}[]"]:last-of-type`);

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarCriterioC(valor){
    var validationInput = document.querySelectorAll(`input[name="criterioContenido${valor}[]"]`);
    // find existing input element
    var existingInput = document.querySelectorAll(`input[name="criterioContenido${valor}[]"]:last-of-type`);

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarCriterioE(valor){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", `criterio${valor}[]`);

    // find existing input element
    var existingInput = document.querySelector(`input[name="criterio${valor}[]"]:last-of-type`);

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarCriterioE(valor){
    var validationInput = document.querySelectorAll(`input[name="criterio${valor}[]"]`);
    // find existing input element
    var existingInput = document.querySelectorAll(`input[name="criterio${valor}[]"]:last-of-type`);

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarSpresencial(valor){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", `Spresencial${valor}[]`);

    // find existing input element
    var existingInput = document.querySelector(`input[name="Spresencial${valor}[]"]:last-of-type`);

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarSpresencial(valor){
    var validationInput = document.querySelectorAll(`input[name="Spresencial${valor}[]"]`);
    // find existing input element
    var existingInput = document.querySelectorAll(`input[name="Spresencial${valor}[]"]:last-of-type`);

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarSNopresencial(valor){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", `SNopresencial${valor}[]`);

    // find existing input element
    var existingInput = document.querySelector(`input[name="SNopresencial${valor}[]"]:last-of-type`);

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarSNopresencial(valor){
    var validationInput = document.querySelectorAll(`input[name="SNopresencial${valor}[]"]`);
    // find existing input element
    var existingInput = document.querySelectorAll(`input[name="SNopresencial${valor}[]"]:last-of-type`);

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarApoyo(){
    // create input element
    var input = document.createElement("input");

    // set input type and name attributes
    input.setAttribute("type", "text");
    input.setAttribute("class","form-control mt-2");
    input.setAttribute("name", "apoyo[]");

    // find existing input element
    var existingInput = document.querySelector('input[name="apoyo[]"]:last-of-type');

    // insert new input element after existing input element
    existingInput.insertAdjacentElement("afterend", input);
}

function eliminarApoyo(){
    var validationInput = document.querySelectorAll('input[name="apoyo[]"]');
    // find existing input element
    var existingInput = document.querySelectorAll('input[name="apoyo[]"]:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

function agregarRecurso(){
    const selectRecurso = document.querySelector('#recurso:last-of-type');
    const select2 = selectRecurso.cloneNode(true);
    // Get the inputs to clear in the cloned areas container
    var inputsToClear = select2.querySelectorAll("input");
    // Clear the values of the inputs in the cloned areas container
    inputsToClear.forEach(function(input) {
        input.value = "";
    });
    selectRecurso.parentNode.insertBefore(select2, selectRecurso.nextSibling);
}

function eliminarRecurso(){
    var validationInput = document.querySelectorAll('#recurso');
    // find existing input element
    var existingInput = document.querySelectorAll('#recurso:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
    }
}

var contador = 1;

function agregarContenidoAsignatura(){
    const selectContenidoAsignatura = document.querySelector('#contenido_asignatura:last-of-type');
    const select2 = selectContenidoAsignatura.cloneNode(true);
    let inputContenido = select2.querySelectorAll(`input[name="contenido${contador}[]"]`);
    let inputHabilidades = select2.querySelectorAll(`input[name="habilidades${contador}[]"]`);
    let inputConocimientos = select2.querySelectorAll(`input[name="conocimientos${contador}[]"]`);
    let inputMetodologia = select2.querySelectorAll(`input[name="metodologia${contador}[]"]`);
    let inputCriterioC = select2.querySelectorAll(`input[name="criterioContenido${contador}[]"]`);
    contador++
    select2.querySelector('#agregarH').setAttribute("onclick", `agregarHabilidades(${contador})`);
    select2.querySelector('#eliminarH').setAttribute("onclick", `eliminarHabilidades(${contador})`);
    select2.querySelector('#agregarC').setAttribute("onclick", `agregarConocimientos(${contador})`);
    select2.querySelector('#eliminarC').setAttribute("onclick", `eliminarConocimientos(${contador})`);
    select2.querySelector('#agregarM').setAttribute("onclick", `agregarMetodologia(${contador})`);
    select2.querySelector('#eliminarM').setAttribute("onclick", `eliminarMetodologia(${contador})`);
    select2.querySelector('#agregarCC').setAttribute("onclick", `agregarCriterioC(${contador})`);
    select2.querySelector('#eliminarCC').setAttribute("onclick", `eliminarCriterioC(${contador})`);

    inputContenido.forEach(input => {
        input.setAttribute("name", `contenido${contador}[]`);
    })
    inputHabilidades.forEach(input => {
        input.setAttribute("name", `habilidades${contador}[]`);
    })
    inputConocimientos.forEach(input => {
        input.setAttribute("name", `conocimientos${contador}[]`);
    })
    inputMetodologia.forEach(input => {
        input.setAttribute("name", `metodologia${contador}[]`);
    })
    inputCriterioC.forEach(input => {
        input.setAttribute("name", `criterioContenido${contador}[]`);
    })
    // Get the inputs to clear in the cloned areas container
    var inputsToClear = select2.querySelectorAll("input");
    // Clear the values of the inputs in the cloned areas container
    inputsToClear.forEach(function(input) {
        input.value = "";
    });
    selectContenidoAsignatura.parentNode.insertBefore(select2, selectContenidoAsignatura.nextSibling);
}

function eliminarContenidoAsignatura(){
    var validationInput = document.querySelectorAll('#contenido_asignatura');
    // find existing input element
    var existingInput = document.querySelectorAll('#contenido_asignatura:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
        contador--;
    }
}

var x = 1;

function agregarCriterioEvaluacion(){
    const selectCriterioEvaluacion = document.querySelector('#criterio_evaluacion:last-of-type');
    const select2 = selectCriterioEvaluacion.cloneNode(true);
    let inputIndicador = select2.querySelectorAll(`input[name="indicador${x}[]"]`);
    let inputCriterio = select2.querySelectorAll(`input[name="criterio${x}[]"]`);
    let inputSpresencial = select2.querySelectorAll(`input[name="Spresencial${x}[]"]`);
    let inputSNopresencial = select2.querySelectorAll(`input[name="SNopresencial${x}[]"]`);

    x++
    select2.querySelector('#agregarCE').setAttribute("onclick", `agregarCriterioE(${x})`);
    select2.querySelector('#eliminarCE').setAttribute("onclick", `eliminarCriterioE(${x})`);
    select2.querySelector('#agregarSP').setAttribute("onclick", `agregarSpresencial(${x})`);
    select2.querySelector('#eliminarSP').setAttribute("onclick", `eliminarSpresencial(${x})`);
    select2.querySelector('#agregarSNP').setAttribute("onclick", `agregarSNopresencial(${x})`);
    select2.querySelector('#eliminarSNP').setAttribute("onclick", `eliminarSNopresencial(${x})`);

    inputIndicador.forEach(input => {
        input.setAttribute("name", `indicador${x}[]`);
    })
    inputCriterio.forEach(input => {
        input.setAttribute("name", `criterio${x}[]`);
    })
    inputSpresencial.forEach(input => {
        input.setAttribute("name", `Spresencial${x}[]`);
    })
    inputSNopresencial.forEach(input => {
        input.setAttribute("name", `SNopresencial${x}[]`);
    })
    // Get the inputs to clear in the cloned areas container
    var inputsToClear = select2.querySelectorAll("input");
    // Clear the values of the inputs in the cloned areas container
    inputsToClear.forEach(function(input) {
        input.value = "";
        
    });
    selectCriterioEvaluacion.parentNode.insertBefore(select2, selectCriterioEvaluacion.nextSibling);
}

function eliminarCriterioEvaluacion(){
    var validationInput = document.querySelectorAll('#criterio_evaluacion');
    // find existing input element
    var existingInput = document.querySelectorAll('#criterio_evaluacion:last-of-type');

    if(validationInput.length !== 1){
        existingInput.forEach(e => {
            e.remove()
        });
        x--;
    }
}