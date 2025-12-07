//Hamburger Menu
var Menu = {
    el: {
    ham: jQuery('.menu-m'),
    menuTop: jQuery('.menu-top'),
    menuMiddle: jQuery('.menu-middle'),
    menuBottom: jQuery('.menu-bottom')
    },
    init: function() {
    Menu.bindUIactions();
    },
    bindUIactions: function() {
    Menu.el.ham
    .on(
    'click',
    function(event) {
    Menu.activateMenu(event);
    event.preventDefault();
    }
    );
    },
    activateMenu: function() {
    Menu.el.menuTop.toggleClass('menu-top-click');
    Menu.el.menuMiddle.toggleClass('menu-middle-click');
    Menu.el.menuBottom.toggleClass('menu-bottom-click'); 
    }
    };
Menu.init();

// // Header change on scroll
// $(document).ready(function() {
//   $(window).scroll(function(){
//       if ($(this).scrollTop() > 30) {
//          $('.logo_header').addClass('logo-change-on-scroll'); 
//          $('.logo_site').addClass('logo-change-on-scroll'); 
//          $('.headerbar').addClass('reduce-header-height-on-scroll');
//         //  $('.navbar-toggler2').addClass('scroll-hamburger');
//          $('header').addClass('shadow-show-on-scroll');
//          $('body').addClass('body-on-scroll');
//       } else {
//          $('.logo_header').removeClass('logo-change-on-scroll');
//          $('.logo_site').removeClass('logo-change-on-scroll');
//          $('.headerbar').removeClass('reduce-header-height-on-scroll');
//         //  $('.navbar-toggler2').removeClass('scroll-hamburger');
//          $('header').removeClass('shadow-show-on-scroll');
//          $('body').removeClass('body-on-scroll');
//       }
//       if ($(this).scrollTop() > 30) {
//         $('body:not(.admin-bar)').addClass('body-on-scroll');
//      } else {
//         $('body:not(.admin-bar)').removeClass('body-on-scroll');
//      }
//   });
// });

// for rightmenu.php header
// $(document).ready(function() {
//   $('.navbar-toggler').click(function() {
//     $('.menu-menu-1-container').toggleClass('act');
//   });

//   $('li a').click(function() {
//     $('.menu-menu-1-container').removeClass('act');
//     $('.menu-bottom').removeClass('menu-bottom-click');
//     $('.menu-top').removeClass('menu-top-click');
//   });
// });
 
// Search Result
// $('.control').click( function(){
//   $('body').addClass('search-active');
//   $('.fa-search-loc').addClass('d-none');
//   $('.input-search').focus();
// });
// Search Result END

// $('.icon-close').click( function(){
//   $('body').removeClass('search-active');
//   $('.fa-search-loc').removeClass('d-none');
// });



// var prevScrollpos = window.pageYOffset;
// window.onscroll = function() {
// var currentScrollPos = window.pageYOffset;
//   if (prevScrollpos > currentScrollPos) {
//     document.getElementById("standard-header").style.cssText = "top: 0px; transition: .5s";
//   } else {
//     document.getElementById("standard-header").style.cssText = "top: -45px; transition: .5s;";
//   }
//   prevScrollpos = currentScrollPos;
// }

// $(document).ready(function() {
//   const navbarToggler = $('.navbar-toggler');
//   const site = $('.site-home, .site, .site-main, .page-all, .site-other');
//   const body = $('html');
//   navbarToggler.on('click', function() {
//     body.toggleClass('no-scroll');
//     site.toggleClass('filter-style');
//   });
//   });


// Menu for standard header with blur effect
$(document).ready(function() {
  const navbarToggler = $('.navbar-toggler-standard');
  const site = $('.site');
  const body = $('body');

  navbarToggler.on('click', function() {
    if (body.hasClass('no-scroll')) {
      body.removeClass('no-scroll');
      site.removeClass('filter-style');
      $(window).scrollTop(body.data('scroll-position')); // Restore previous scroll position
    } else {
      body.data('scroll-position', $(window).scrollTop()); // Save current scroll position
      body.addClass('no-scroll');
      site.addClass('filter-style');
    }
  });
});


// Close navbar when click on link ( used for Landingpages )
function closeNavbar() {
  $(".navbar-toggler").attr("aria-expanded", "false");
  $(".navbar-collapse").removeClass("show");
  $(".menu-top").removeClass("menu-top-click");
  $(".menu-middle").removeClass("menu-middle-click");
  $(".menu-bottom").removeClass("menu-bottom-click");
  $("body").removeClass("no-scroll");
  $(".site").removeClass("filter-style");
  $(".menu-menu-1-container").removeClass("act");
  toggleScroll();
}
$(".navbar-collapse li a").on("click", function() {
  closeNavbar();
});


//For all navigation, add menu-open class on body
document.addEventListener('DOMContentLoaded', function () {
  var navbar = document.getElementById('navbarNav');

  navbar.addEventListener('show.bs.collapse', function () {
    document.body.classList.add('menu-open');
  });

  navbar.addEventListener('hide.bs.collapse', function () {
    document.body.classList.remove('menu-open');
  });
});


// var swiper = new Swiper(".mySwiper", {
//   pagination: {
//     el: ".swiper-pagination",
//   },
// });

var swiper = new Swiper(".mySwiper-boxes-section", {
  slidesPerView: 1,
  spaceBetween: 15,
  loop: true,
  autoHeight: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 15,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 16,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 16,
    },
  },
});

// Reviews Swiper
var swiperReviews = new Swiper(".mySwiper-reviews", {
  slidesPerView: 1,
  effect: "fade",
  fadeEffect: {
    crossFade: true
  },
  allowTouchMove: false,
  watchSlidesProgress: true,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

var swiperGallery = new Swiper(".mySwiper-gallery", {
  slidesPerView: "auto",
    spaceBetween: 16,
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    }, 
    breakpoints: {
        768: { spaceBetween: 15 },
        1024: { spaceBetween: 15 }
    }
});


//Calculate Header Height and set Page Offset
// jQuery(document).ready(function($) {
//     function adjustPageOffset() {
//         var headerHeight = $('header').outerHeight(); // measure <header> height
//         $('#page').css('top', headerHeight + 'px');
//     }

//     // Run on load
//     adjustPageOffset();

//     // Run again on resize (in case header height changes)
//     $(window).on('resize', function() {
//         adjustPageOffset();
//     });
// });


// Move YITH Wishlist Button into custom wrapper
jQuery(function($) {

    // $(".product-actions-wrapper").each(function() {

    //     var wrapper = $(this);

    //     // find closest wishlist button related to this product
    //     var wishlist = wrapper.closest("li.product, .product-collection, .product").find(".yith-add-to-wishlist-button-block").first();

    //     if (wishlist.length) {
    //         wrapper.append(wishlist);
    //     }

    // });

    // hide wishlist everywhere except single product page
if (!$('body').hasClass('single-product')) {
    $(".yith-add-to-wishlist-button-block").remove();
}

// only run product action logic on single product page
if ($('body').hasClass('single-product')) {
    $(".product-actions-wrapper").each(function () {
        var wrapper = $(this);
        var wishlist = wrapper.closest("li.product, .product-collection, .product")
                              .find(".yith-add-to-wishlist-button-block")
                              .first();

        if (wishlist.length) {
            wrapper.append(wishlist);
        }
    });
}

});


    

// jQuery(function($) {

//     $(".product-actions-wrapper").each(function() {

//         var wrapper = $(this);

//         // find closest wishlist button related to this product
//         var wishlist = wrapper.closest("li.product, .product-collection, .product").find(".yith-add-to-wishlist-button-block").first();

//         if (wishlist.length) {
//             // Only append if on single product page (not on archive/card pages)
//             if ($('body').hasClass('single-product')) {
//                 wrapper.append(wishlist);
//             } else {
//                 // Hide wishlist button on archive/card pages
//                 wishlist.remove();
//             }
//         }

//     });

// });
// Move YITH Wishlist Button into custom wrapper END


// jQuery(function($) {

//     // run after YITH initializes
//     setTimeout(function() {

//         var wishlist = $(".yith-add-to-wishlist-button-block--single").first();
//         var form = $(".summary form.cart");

//         if (wishlist.length && form.length) {
//             form.append(wishlist);
//         }

//     }, 100);

// });


//Gallery Custom for Product Page
document.addEventListener("DOMContentLoaded", function () {
    const bigImage = document.querySelector('.woocommerce-product-gallery__image img');
    const thumbnails = document.querySelectorAll('.woocommerce-product-gallery__image');

    if (!bigImage || thumbnails.length < 2) return;

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function (e) {
            e.preventDefault();
            
            const newSrc = this.querySelector('img').getAttribute('data-large_image');
            const newSrcset = this.querySelector('img').getAttribute('data-srcset') || '';
            const newSizes = this.querySelector('img').getAttribute('sizes') || '';

            bigImage.src = newSrc;
            bigImage.srcset = newSrcset;
            bigImage.sizes = newSizes;
        });
    });
});

// // Calculate Header Height
// function adjustPageOffset() {
//     var headerHeight = $('header').outerHeight(); // Measure <header> height
    
//     if (headerHeight > 0) {
//         // Set the header height as a global CSS variable
//         document.documentElement.style.setProperty('--header-height', headerHeight + 'px');
//     }
// }

// // Run immediately and on ready
// if (document.readyState === 'loading') {
//     document.addEventListener('DOMContentLoaded', function() {
//         setTimeout(function() {
//             adjustPageOffset();
//         }, 70);
//     });
// } else {
//     setTimeout(function() {
//         adjustPageOffset();
//     }, 70);
// }

// // Run again on resize (in case header height changes)
// jQuery(window).on('resize', function() {
//     adjustPageOffset();
// });


//add backdrop for mobile menu
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    let backdrop;
    let scrollDisabled = false;

    const addBackdrop = () => {
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'mobile-menu-backdrop';
            // document.body.appendChild(backdrop);
document.querySelector('#page').appendChild(backdrop);
        }
    };

    const removeBackdrop = () => {
        if (backdrop) {
            backdrop.remove();
            backdrop = null;
        }
    };

    const preventScroll = (e) => {
        if (!e.target.closest('.navbar-nav-mobile')) {
            e.preventDefault();
        }
    };

    const disableScroll = () => {
        if (!scrollDisabled) {
            document.addEventListener('touchmove', preventScroll, { passive: false });
            scrollDisabled = true;
        }
    };

    const enableScroll = () => {
        if (scrollDisabled) {
            document.removeEventListener('touchmove', preventScroll, { passive: false });
            scrollDisabled = false;
        }
    };

    const observer = new MutationObserver(() => {
        if (body.classList.contains('menu-open')) {
            addBackdrop();
            disableScroll();
        } else {
            removeBackdrop();
            enableScroll();
        }
    });

    observer.observe(body, { attributes: true, attributeFilter: ['class'] });
});
