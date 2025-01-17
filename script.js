// script.js
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            const nome = form.querySelector('input[name="nome"]').value;
            const quantidade = form.querySelector('input[name="quantidade"]').value;

            if (nome.trim() === '' || quantidade <= 0) {
                event.preventDefault();
                alert('Por favor, preencha todos os campos corretamente.');
            }
        });
    });
});



//arquivo script.js do navebar icon
document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.querySelector('.navbar .menu-icon');
    const menu = document.querySelector('.navbar .menu');

    if (menuIcon && menu) {
        menuIcon.addEventListener('click', function() {
            menu.classList.toggle('active');
        });
    }
});