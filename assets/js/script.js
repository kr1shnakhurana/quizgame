// Add scroll effect to navbar
window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.transparent-navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
