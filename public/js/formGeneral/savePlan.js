function saveInformation(){
    const getIdPlan = document.getElementById('id_plan').value;
    const getInicio = document.getElementById('vigenciaInicio').value;
    const getFinal = document.getElementById('vigenciaFinal').value;
    const getReview = document.getElementById('fechaPresentacion').value;
    const getFun = document.getElementById('txtFundamentacion').value;
    const getCreador = document.getElementsByName('opcionCreador[]');
    const getGeneralidad  = document.getElementsByName('opcionGeneralidad[]');
    const getProposito = document.getElementsByName('opcionProposito[]');

    const valCreador = [];
    const valGeneralidad = [];
    const valProposito = []

    for(let i = 0; i < getCreador.length; i++){
        valCreador.push(getCreador[i].value);
    }

    for(let i = 0; i < getGeneralidad.length; i++){
        valGeneralidad.push(getGeneralidad[i].value);
    }

    for(let i = 0; i < getProposito.length; i++){
        valProposito.push(getProposito[i].value);
    }

    const objCreador = JSON.stringify(valCreador);
    const objGeneralidad = JSON.stringify(valGeneralidad);
    const objProposito = JSON.stringify(valProposito);

    localStorage.setItem('idPlan', getIdPlan);
    localStorage.setItem('vigenciaInicio', getInicio);
    localStorage.setItem('vigenciaFinal', getFinal);
    localStorage.setItem('review', getReview);
    localStorage.setItem('fundamentos', getFun);
    localStorage.setItem('creador', objCreador);
    localStorage.setItem('generalidad', objGeneralidad);
    localStorage.setItem('proposito', objProposito);
}

function emptyInformation(){
    localStorage.setItem('idPlan', '');
    localStorage.setItem('vigenciaInicio', '');
    localStorage.setItem('vigenciaFinal', '');
    localStorage.setItem('review', '');
    localStorage.setItem('fundamentos', '');
    localStorage.setItem('creador', '');
    localStorage.setItem('generalidad', '');
    localStorage.setItem('proposito', '')
}

$(function(){
    $(enviar).click(function(){
        const idPlan = localStorage.getItem('idPlan');
        const inicio = localStorage.getItem('vigenciaInicio');
        const final = localStorage.getItem('vigenciaFinal');
        const review = localStorage.getItem('review')
        const fundamento = localStorage.getItem('fundamentos');
        const creador = JSON.parse(localStorage.getItem('creador'));
        const generalidad = JSON.parse(localStorage.getItem('generalidad'));
        const proposito = JSON.parse(localStorage.getItem('proposito'));

        $.post({
            type: "POST",
            url: `/tesis/plan/create/${idPlan}`,
            data: {
                vigInicio: inicio,
                vigFinal: final,
                review: review,
                fundamento: fundamento,
                creador: creador,
                generalidad: generalidad,
                proposito: proposito
            }
        })  
    });
});