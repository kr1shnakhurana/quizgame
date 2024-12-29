const switchToRegister = document.getElementById('switch-to-register');
const switchToLogin = document.getElementById('switch-to-login');
const formContainer = document.querySelector('.form-container');

switchToRegister.addEventListener('click', () => {
    formContainer.classList.add('active');
});

switchToLogin.addEventListener('click', () => {
    formContainer.classList.remove('active');
});
