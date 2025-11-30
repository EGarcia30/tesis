const menuBtns = document.querySelectorAll('.nav_link');
const forms = document.querySelectorAll('.form-section');
const formPor = document.getElementById('formInicio');
const formMateria = document.getElementById('formMaterias');

menuBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const target = btn.getAttribute('data-bs-target');
        
        // Manejar clases especiales para formInicio y formMaterias
        if(target !== 'formInicio' && target !== 'formMaterias'){
            formPor?.classList.add('form-section');
            formMateria?.classList.add('form-section');
        } else {
            formPor?.classList.remove('form-section');
            formMateria?.classList.remove('form-section');
        }
        
        // Mostrar/ocultar formularios
        forms.forEach(form => {
            form.style.display = 'none'; // Ocultar todos
            form.classList.remove('form-show');
            
            if(form.getAttribute('id') === target){
                form.style.display = 'block'; // Mostrar el objetivo
                form.classList.add('form-show');
                
                // Scroll suave hacia arriba del formulario
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
        
        // Actualizar estado activo en el menú lateral
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
            if(item.getAttribute('data-bs-target') === target) {
                item.classList.add('active');
            }
        });
        
        // Cerrar menú lateral en móvil después de seleccionar
        if(window.innerWidth < 992) {
            const verticalMenu = document.getElementById('verticalMenu');
            const menuBackdrop = document.getElementById('menuBackdrop');
            verticalMenu?.classList.remove('active');
            menuBackdrop?.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});

// CSS adicional necesario
const style = document.createElement('style');
style.textContent = `
    .form-section {
        display: none;
    }
    
    .form-section.form-show {
        display: block;
        animation: fadeInUp 0.4s ease;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);

// Mostrar el primer formulario por defecto
document.addEventListener('DOMContentLoaded', () => {
    const firstForm = document.getElementById('formInicio');
    if(firstForm) {
        firstForm.style.display = 'block';
        firstForm.classList.add('form-show');
    }
});