function agregarSelect(){
    const select1 = document.getElementById('selects')
    const select2 = select1.cloneNode(true);
    select1.parentNode.insertBefore(select2, select1.nextSibling);
}

function agregarExperiencias(){
    const divInputs = document.getElementById("experiencias");
    const input = divInputs.cloneNode(true);
    input.value = "";
    divInputs.parentNode.insertBefore(input, divInputs.nextSibling);
}

function agregarParticipacion(){
    const select1 = document.getElementById('selectsPar');
    const select2 = select1.cloneNode(true);
    select1.parentNode.insertBefore(select2, select1.nextSibling);
}

function agregarCreador(){
    const select1 = document.getElementById('selectsCreador');
    const select2 = select1.cloneNode(true);
    select1.parentNode.insertBefore(select2, select1.nextSibling);
}

function agregarComGeneral(){
    const selectCom = document.getElementById('comGeneral');
    const select2 = selectCom.cloneNode(true);
    selectCom.parentNode.insertBefore(select2, selectCom.nextSibling);
}

function agregarComBasica(){
    const selectBasica = document.getElementById('comBasica');
    const select2 = selectBasica.cloneNode(true);
    selectBasica.parentNode.insertBefore(select2, selectBasica.nextSibling);
}

function agregarComEspecialidad(){
    const selectEspecialidad = document.getElementById('comEspecialidad');
    const select2 = selectEspecialidad.cloneNode(true);
    selectEspecialidad.parentNode.insertBefore(select2, selectEspecialidad.nextSibling);
}

function agregarAreas(){
    const selectAreas = document.getElementById('areas');
    const select2 = selectAreas.cloneNode(true);
    selectAreas.parentNode.insertBefore(select2, selectAreas.nextSibling);
}