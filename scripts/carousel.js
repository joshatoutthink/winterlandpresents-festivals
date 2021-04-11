window.addEventListener("DOMContentLoaded", initializeCarousels);

function initializeCarousels() {
  //only run if carousel on page
  if (!document.querySelector(".carousel__wrapper")) {
    return;
  }

  document.querySelectorAll(".carousel__wrapper").forEach((carousel) => {
    startCarousel(carousel);
  });
}

function startCarousel(carousel) {
  const prevButton = carousel.querySelector('[data-action="previous-slide"]');
  const nextButton = carousel.querySelector('[data-action="next-slide"]');

  prevButton.addEventListener("click", (e) => changeSlide(carousel, -1));
  nextButton.addEventListener("click", (e) => changeSlide(carousel, 1));
}

function changeSlide(carousel, dir) {
  const slides = [...carousel.querySelectorAll(".carousel__slide")];
  const activeSlide = slides.find((slide) => slide.dataset.state == "active");
  const nextSlide = slides.find((slide) => slide.dataset.state == "next");
  const prevSlide = slides.find((slide) => slide.dataset.state == "previous");
  slides.forEach((slide) => (slide.dataset = "idle"));

  const cardChangeFn = dir === -1 ? getPrevSlide : getNextSlide;
  console.log(nextSlide);
  cardChangeFn({ slides, activeSlide, nextSlide, prevSlide });
}

function getPrevSlide({ slides, activeSlide, nextSlide, prevSlide }) {
  setNewPreviousSlide(slides, prevSlide);
  prevSlide.dataset.state = "active";
  activeSlide.dataset.state = "next";
  nextSlide.dataset.state = "idle";
}
function getNextSlide({ slides, activeSlide, nextSlide, prevSlide }) {
  setNewNextSlide(slides, nextSlide);
  nextSlide.dataset.state = "active";
  activeSlide.dataset.state = "previous";
  prevSlide.dataset.state = "idle";
}

function setNewNextSlide(slides, nextSlide) {
  const slideId = parseInt(nextSlide.dataset.slideId);
  const newNextSlideId = (slideId + 1) % slides.length;
  const newNextSlide = slides[newNextSlideId];
  newNextSlide.dataset.state = "next";
}
function setNewPreviousSlide(slides, prevSlide) {
  const slideId = parseInt(prevSlide.dataset.slideId);
  const newPrevSlideId = slideId - 1 >= 0 ? slideId - 1 : slides.length - 1;
  const newPreviousSlide = slides[newPrevSlideId];
  newPreviousSlide.dataset.state = "previous";
}
