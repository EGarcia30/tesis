const menuBtns = document.querySelectorAll('.nav_link');
const forms = document.querySelectorAll('.form-container');
const formPor = document.getElementById('formInicio');

menuBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const target = btn.getAttribute('data-bs-target');
        if(target !== 'formInicio'){
            formPor.classList.add('form-container')
        }
        else{
            formPor.classList.remove('form-container')
        }
        forms.forEach(form => {
            form.classList.remove('form-show');
            if(form.getAttribute('id') === target){
                form.classList.add('form-show');
            }
        })
    })
})