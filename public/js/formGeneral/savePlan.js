function saveInformation(){
    const getIdPlan = document.getElementById('id_plan').value;
    const getInicio = document.getElementById('vigenciaInicio').value;
    const getFinal = document.getElementById('vigenciaFinal').value;
    const getReview = document.getElementById('fechaPresentacion').value;
    const getFun = document.getElementById('txtFundamentacion').value;
    const getCreador = document.getElementById('creador').value;

    localStorage.setItem('idPlan', getIdPlan);
    localStorage.setItem('vigenciaInicio', getInicio);
    localStorage.setItem('vigenciaFinal', getFinal);
    localStorage.setItem('review', getReview);
    localStorage.setItem('fundamentos', getFun);
    localStorage.setItem('creador', getCreador);
}

function emptyInformation(){
    localStorage.setItem('idPlan', '');
    localStorage.setItem('vigenciaInicio', '');
    localStorage.setItem('vigenciaFinal', '');
    localStorage.setItem('review', '');
    localStorage.setItem('fundamentos', '');
    localStorage.setItem('creador', '');
}

$(function(){
    $(enviar).click(function(){
        const idPlan = localStorage.getItem('idPlan');
        const inicio = localStorage.getItem('vigenciaInicio');
        const final = localStorage.getItem('vigenciaFinal');
        const review = localStorage.getItem('review')
        const fundamento = localStorage.getItem('fundamentos');
        const creador = localStorage.getItem('creador');
    
        $.post({
            type: "POST",
            url: `/tesis/plan/create/${idPlan}`,
            data: {
                vigInicio: inicio,
                vigFinal: final,
                review: review,
                fundamento: fundamento,
                creador: creador
            }
        })  
    });
});