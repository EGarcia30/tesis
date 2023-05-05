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