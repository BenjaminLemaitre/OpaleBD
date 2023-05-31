let slider = tns({
  container: ".my-slider",
  items: 3,
  gutter: 20,
  slideBy: 1,
  controlsPosition: "bottom",
  navPosition: "bottom",
  mouseDrag: true,
  autoplay: true,
  autoplayButtonOutput: false,
  controlsContainer: "#custom-control",
  responsive: {
    0: {
      items: 1,
      nav: false,
      controls: true,
      edgePadding: 70,
    },
    768: {
      items: 2,
      nav: true,
      controls: true,
      edgePadding: 70,
    },
    1000: {
      items: 5,
      edgePadding:0,
    }
  }
  // mode: 'gallery',
  // speed: 2000,
  // animateIn: "scale",
  // controls: false,
  // nav: false,
  // edgePadding: 20,
  // loop: false,
});