const initSlider = (selector) => {
  //store section id
  let Section = $(selector);
  // strore slider class under section ID
  let SliderClass = Section.find(".owl-carousel");
  //store Next Prev button under sectinID=>ClassID
  let PrevBtn = Section.find(".btn-prev");
  let NextBtn = Section.find(".btn-next");

  //initliaze carousel under html section tag Id asign = selector
  SliderClass.owlCarousel({
    navText: [PrevBtn, NextBtn],
    center: true,
    slideTransition: "linear",
    loop: true,
    margin: 10,
    autoWidth: true,
    responsive: {
      0: {
        items: 2,
        nav: true,
      },
      768: {
        items: 3,
        nav: true,
      },

      992: {
        items: 4,
        nav: true,
      },
    },
  });
};

//iniliaze latest arrivals product slider
// initSlider("#slider-latest");

//iniliaze latest arrivals product slider
initSlider("#slider-popular");
