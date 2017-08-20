document.addEventListener("DOMContentLoaded", function() {
  var activatorHamburgerInOut = document.querySelector(".hamburger--in-out"),
  activatorHamburgerInMenu = document.querySelector(".hamburger--in-menu"),
  menuMobile = document.querySelector("#nav-hamburger"),
  logo = document.querySelector(".logo--nav-mobile"),
  logoNavbar = document.querySelector(".logo-navbar"), 
  menuMain = document.querySelector('#nav');


  activatorHamburgerInOut.addEventListener("click", function() {
    menuMobile.classList.toggle("is-active");
    logo.classList.toggle("is-active");
    if ( logoNavbar.classList.contains("logo-navbar--is-visible") ) {     
      logoNavbar.classList.remove("logo-navbar--is-visible");  
    }
    
    activatorHamburgerInOut.classList.toggle("is-active");
    activatorHamburgerInMenu.classList.toggle("is-active");
  });

  activatorHamburgerInMenu.addEventListener("click", function() {
    menuMobile.classList.toggle("is-active");
    logo.classList.toggle("is-active");
    logoNavbar.classList.toggle("logo-navbar--is-visible");
    if ( logoNavbar.classList.contains("logo-navbar--is-visible") ) {    
      logoNavbar.classList.add("logo-navbar--is-visible");  
    } else {
      logoNavbar.classList.remove("logo-navbar--is-visible");  
    }
    activatorHamburgerInMenu.classList.toggle("is-active");
    activatorHamburgerInOut.classList.toggle("is-active");
  })
  
});