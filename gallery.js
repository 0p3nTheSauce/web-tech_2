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
