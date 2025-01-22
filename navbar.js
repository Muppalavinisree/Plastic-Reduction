// JavaScript for mobile menu toggle
const menuBtn = document.getElementById('menu-btn');
const closeMenuBtn = document.getElementById('close-menu-btn');
const menuLinks = document.querySelector('.menu-links');

menuBtn.addEventListener('click', () => {
    menuLinks.classList.add('active');
});

closeMenuBtn.addEventListener('click', () => {
    menuLinks.classList.remove('active');
});
