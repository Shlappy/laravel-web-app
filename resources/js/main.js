// Between filter slider
function sliders() {
  var sliderFilter = document.querySelectorAll('.slider-between.slider-product');
  sliderFilter.forEach((sliderEl) => {
    const min = parseInt(sliderEl.getAttribute('min'), 10);
    const max = parseInt(sliderEl.getAttribute('max'), 10);
  
    const sliderWrapper = sliderEl.parentElement;
    let minInput = sliderWrapper.getElementsByClassName('slider__input-min')[0];
    let maxInput = sliderWrapper.getElementsByClassName('slider__input-max')[0];
  
    noUiSlider.create(sliderEl, {
      start: [min, max],
      connect: true,
      range: {
        'min': min,
        'max': max
      }
    });
  
    sliderEl.noUiSlider.on('update.filter', function (values, handle) {
      let value = values[handle];
  
      if (handle) {
        maxInput.value = Math.round(value);
      } else {
        minInput.value = Math.round(value);
      }
    });
  
    sliderEl.noUiSlider.on('change.filter', function (values, handle) {
      sliderEl.dispatchEvent(optionChange);
    });
  
    minInput.addEventListener('change', function () {
      sliderEl.noUiSlider.set([this.value, null]);
    });
  
    maxInput.addEventListener('change', function () {
      sliderEl.noUiSlider.set([null, this.value]);
    });
  })
}

// Collapsible animated dropdowns
function collapsible() {
  let coll = document.getElementsByClassName("collapsible");
  let i;
  
  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });
  }
}

window.scrollToTop = function (pos = 0) {
  window.scrollTo({
    top: pos,
    behavior: 'smooth'
  });
}


window.addEventListener('DOMContentLoaded', (event) => {
  collapsible();
  sliders();
});