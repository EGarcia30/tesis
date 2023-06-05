let ejecutar = false;
function cargarDatos() {
    try{
        const getIdPlan = document.getElementById('id_plan');
        const getInicio = document.getElementById('vigenciaInicio');
        const getFinal = document.getElementById('vigenciaFinal');
        const getReview = document.getElementById('fechaPresentacion');
        const getFun = document.getElementById('txtFundamentacion');
        const getCreador = document.getElementsByName('opcionCreador[]');
        const getGeneralidad = document.getElementsByName('opcionGeneralidad[]');
        const getProposito = document.getElementsByName('opcionProposito[]');

        !ejecutar ? ejecutar = localStorage.getItem('ejecutar') : ejecutar = false;

        if(ejecutar == "true"){
            getIdPlan.value = localStorage.getItem('idPlan');
            getInicio.value = localStorage.getItem('vigenciaInicio');
            getFinal.value = localStorage.getItem('vigenciaFinal');
            getReview.value = localStorage.getItem('review');
            getFun.value = localStorage.getItem('fundamentos');
            let generalidadArray =[];
            localStorage.getItem('generalidad').length >=1 ? generalidadArray = JSON.parse(localStorage.getItem('generalidad')) : generalidadArray = 0;
            if(generalidadArray.length > 0){
                for (let i = 0; i < getGeneralidad.length; i++) {
                    if(getGeneralidad[i].type == "hidden" || getGeneralidad[i].type == "text" ){
                        getGeneralidad[i].value = generalidadArray[i].toString();
                    }else{
                        getGeneralidad[i].value = parseInt(generalidadArray[i]);
                    }
                }
                const propositoArray = JSON.parse(localStorage.getItem('proposito'));
                for (let i = 0; i < getProposito.length; i++) {
                    getProposito[i].value = propositoArray[i].toString();
                }   
            }else{
                for (let i = 0; i < getGeneralidad.length; i++) {
                    if(getGeneralidad[i].type == "hidden" || getGeneralidad[i].type == "text" ){
                        getGeneralidad[i].value = getGeneralidad[i].value.toString();
                    }else{
                        getGeneralidad[i].value = parseInt(getGeneralidad[i].value);
                    }
                }
                for (let i = 0; i < getProposito.length; i++) {
                    getProposito[i].value = getProposito[i].value.toString();
                }
            }
            return;
        }
        else{
            getIdPlan.value = getIdPlan.value;
            getInicio.value = getInicio.value;
            getFinal.value = getFinal.value;
            getReview.value = getReview.value;
            getFun.value = getFun.value;
            for (let i = 0; i < getGeneralidad.length; i++) {
                if(getGeneralidad[i].type == "hidden" || getGeneralidad[i].type == "text" ){
                    getGeneralidad[i].value = getGeneralidad[i].value.toString();
                }else{
                    getGeneralidad[i].value = parseInt(getGeneralidad[i].value);
                }
            } 
            for (let i = 0; i < getProposito.length; i++) {
                getProposito[i].value = getProposito[i].value.toString();
            }
            localStorage.setItem('ejecutar',"true");
            return;
        }
    }
    catch(error){
        console.log(error);
    }
}

window.addEventListener('DOMContentLoaded', () => {
    cargarDatos();
});