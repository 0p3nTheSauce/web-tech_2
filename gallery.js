const slider = document.querySelector("#slider-images");
const slides = document.querySelectorAll(".image-container");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");


let slideIndex = 0;
slides[slideIndex].classList.add('active');
prevBtn.addEventListener('click', prevSlide);
nextBtn.addEventListener('click', nextSlide);
imageCounter

function prevSlide(){
    slides[slideIndex].classList.remove('active');
    slideIndex = (slideIndex === 0) ? slides.length -1 : slideIndex -1;
    slides[slideIndex].classList.add('active');
    slider.style.transform = `translateX(-${slideIndex * 100}%)`;
}

function nextSlide(){
    slides[slideIndex].classList.remove('active');
    slideIndex = (slideIndex === slides.length -1 ) ? 0 : slideIndex +1;
    slides[slideIndex].classList.add('active');
    slider.style.transform = `translateX(-${slideIndex * 100}%)`;
}


function getImageCount(){
    document.getElementById("imageCount").innerHTML
    = "Number of images present: " + document.images.length;

    let lastAdded = document.lastModified;
    document.getElementById("lastModified").innerHTML = "Images last modified: " + lastAdded;
}
/*
function describeImage(id){
    document.getElementById("describer").innerHTML
    = document.getElementById(id).nextSibling.innerHTML;
}
*/
/* dots and circles interactive
// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("image-container");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 0}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}*/