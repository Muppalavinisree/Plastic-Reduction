const header=document.querySelector("header");
const menubtn=document.querySelector("#menu-btn");
const closemenubtn=document.querySelector("#close-menu-btn");

menubtn.addEventListener("click", ()=>{
    header.classList.toggle("show-mobile-menu");

});

closemenubtn.addEventListener("click", ()=>{
    menubtn.click();

});
document.querySelectorAll('.image-container img').forEach(image => {
    image.onclick = () => {
        document.querySelector('.pop-image').style.display = 'block';
        document.querySelector('.pop-image img').src = image.getAttribute('src');
    }
});

document.querySelector('.pop-image span').onclick = () => {
    document.querySelector('.pop-image').style.display = 'none';
}
