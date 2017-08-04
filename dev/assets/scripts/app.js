import ToggleClassOnScroll from './modules/ToggleClassOnScroll';
import glitchEffectButtons from './modules/GlitchEffectButtons';
import waypointsSticky from './vendor/waypoints.sticky';
import photoSwipe from './modules/photoSwipe';


document.addEventListener('DOMContentLoaded', function(event) {
  // toggled class in header
  var logoAnimated = new ToggleClassOnScroll( '.logo-navbar', 'logo-navbar--is-visible', '0' ),
      navRemovePadding = new ToggleClassOnScroll( '#nav', 'nav--no-padding', '0' ),
      navRemovePadding = new ToggleClassOnScroll( '#social-media', 'social-media--fixed', '0' );


  // activate glitch effect on buttons' hover
  glitchEffectButtons();

  // sticky navbar
  var stickyNavbar = new Waypoint.Sticky({
    element: document.getElementById('navbar'),
    stuckClass: 'navbar--fixed'
  })  

});









