//
// map.js
// Theme module
//

const maps = document.querySelectorAll('[data-map]');
const accessToken = 'pk.eyJ1Ijoia3BtbG9rIiwiYSI6ImNrcWs1Ynd0dDEyN20ycG54ZGxncnRncWgifQ.3c3OY3wDtnjyyRI0CJ-vhQ';

maps.forEach((map) => {
  const elementOptions = map.dataset.map ? JSON.parse(map.dataset.map) : {};

  const defaultOptions = {
    container: map,
    style: 'mapbox://styles/kpmlok/cksho94xc1zt117k02uxrjktw',
    scrollZoom: false,
    interactive: false,
  };

  const options = {
    ...defaultOptions,
    ...elementOptions,
  };

  // Get access token
  mapboxgl.accessToken = accessToken;

  // Init map
  new mapboxgl.Map(options);
});
