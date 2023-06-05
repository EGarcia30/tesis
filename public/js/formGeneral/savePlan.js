function saveInformation(){
    const getIdPlan = document.getElementById('id_plan').value;
    const getInicio = document.getElementById('vigenciaInicio').value;
    const getFinal = document.getElementById('vigenciaFinal').value;
    const getReview = document.getElementById('fechaPresentacion').value;
    const getFun = document.getElementById('txtFundamentacion').value;
    const getCreador = document.getElementsByName('opcionCreador[]');
    const getGeneralidad  = document.getElementsByName('opcionGeneralidad[]');
    const getProposito = document.getElementsByName('opcionProposito[]');
    const getComGeneral = document.getElementsByName('opcionCompetencia[]');
    const getComBasica = document.getElementsByName('opcionBasica[]');
    const getComEspecialidad = document.getElementsByName('opcionEspecialidad[]');
    const getAreas = document.getElementsByName('opcionAreas[]');

    const valCreador = [];
    const valGeneralidad = [];
    const valProposito = [];
    const valComGeneral = [];
    const valComBasica = [];
    const valComEspecialidad = [];
    const valAreas = [];

    for(let i = 0; i < getCreador.length; i++){
        valCreador.push(getCreador[i].value);
    }

    for(let i = 0; i < getGeneralidad.length; i++){
        valGeneralidad.push(getGeneralidad[i].value);
    }

    for(let i = 0; i < getProposito.length; i++){
        valProposito.push(getProposito[i].value);
    }

    for(let i = 0; i < getComGeneral.length; i++){
        valComGeneral.push(getComGeneral[i].value);
    }

    for(let i = 0; i < getComBasica.length; i++){
        valComBasica.push(getComBasica[i].value);
    }

    for(let i = 0; i < getComEspecialidad.length; i++){
        valComEspecialidad.push(getComEspecialidad[i].value);
    }

    for(let i = 0; i < getAreas.length; i++){
        valAreas.push(getAreas[i].value);
    }

    const objCreador = JSON.stringify(valCreador);
    const objGeneralidad = JSON.stringify(valGeneralidad);
    const objProposito = JSON.stringify(valProposito);
    const objComGeneral = JSON.stringify(valComGeneral);
    const objComBasica = JSON.stringify(valComBasica);
    const objComEspecialidad = JSON.stringify(valComEspecialidad);
    const objAreas = JSON.stringify(valAreas);

    localStorage.setItem('idPlan', getIdPlan);
    localStorage.setItem('vigenciaInicio', getInicio);
    localStorage.setItem('vigenciaFinal', getFinal);
    localStorage.setItem('review', getReview);
    localStorage.setItem('fundamentos', getFun);
    localStorage.setItem('creador', objCreador);
    localStorage.setItem('generalidad', objGeneralidad);
    localStorage.setItem('proposito', objProposito);
    localStorage.setItem('comGeneral', objComGeneral);
    localStorage.setItem('comBasica', objComBasica);
    localStorage.setItem('comEspecialidad', objComEspecialidad);
    localStorage.setItem('areas', objAreas);
}

function emptyInformation(){
    localStorage.setItem('idPlan', '');
    localStorage.setItem('vigenciaInicio', '');
    localStorage.setItem('vigenciaFinal', '');
    localStorage.setItem('review', '');
    localStorage.setItem('fundamentos', '');
    localStorage.setItem('creador', '');
    localStorage.setItem('generalidad', '');
    localStorage.setItem('proposito', '');
    localStorage.setItem('comGeneral', '');
    localStorage.setItem('comBasica', '');
    localStorage.setItem('comEspecialidad', '');
    localStorage.setItem('areas', '');
    localStorage.setItem('ejecutar', "false")
}

function setInformation(){
    $('#enviar').submit(function(e){
        const idPlan = localStorage.getItem('idPlan');
        const inicio = localStorage.getItem('vigenciaInicio');
        const final = localStorage.getItem('vigenciaFinal');
        const review = localStorage.getItem('review')
        const fundamento = localStorage.getItem('fundamentos');
        const creador = JSON.parse(localStorage.getItem('creador'));
        const generalidad = JSON.parse(localStorage.getItem('generalidad'));
        const proposito = JSON.parse(localStorage.getItem('proposito'));
        const comGeneral = JSON.parse(localStorage.getItem('comGeneral'));
        const comBasica = JSON.parse(localStorage.getItem('comBasica'));
        const comEspecialidad = JSON.parse(localStorage.getItem('comEspecialidad'));
        const areas = JSON.parse(localStorage.getItem('areas'));

        $.post({
            type: "POST",
            url: `/tesis/plan/editor/${idPlan}`,
            data: {
                vigInicio: inicio,
                vigFinal: final,
                review: review,
                fundamento: fundamento,
                creador: creador,
                generalidad: generalidad,
                proposito: proposito,
                comGeneral: comGeneral,
                comBasica: comBasica,
                comEspecialidad: comEspecialidad,
                areas: areas
            }
        })  
    });
};