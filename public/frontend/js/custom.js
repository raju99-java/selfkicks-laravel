// back to top
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
    });
    $(document).ready(function() {
    $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({
        scrollTop: 0
        }, "slow");
        return false;
    });
});
// accordion
    var acc = document.getElementsByClassName("custom-accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
     acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
    });
}
// owl carousel home page slider
/// slider ///
$(function () {
    $(".owl-new-slider").owlCarousel({
      loop: true,
      dots: false,
      nav: true,
      navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
      ],
      navContainer: ".container-fluid .custom-nav",
      // animateOut: "slideOutRight",
      // animateIn: "flipInY",
      autoplay: true,
      autoplayTimeout: 3000,
      autoplaySpeed: 2500,
      fluidSpeed:true,
      items: 1,
      margin: 0,
      stagePadding: 0,
      smartSpeed: 2000
    });
  });
  //video carousel
  $(function () {
  $(".video-slider").owlCarousel({
    loop: true,
    dots: false,
    nav: true,
    dots: false,
    animateOut: "slideOutRight",
    animateIn: "flipInY",
    autoplay: true,
    autoplayTimeout: 3000,
    autoplaySpeed: 2500,
    fluidSpeed:true,
    items: 6,
    margin: 0,
    stagePadding: 0,
    smartSpeed: 2000,
    responsive: {
			0: {
				items: 2
			},
			480: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 6
			}
		},
  });
  });
// $(document).ready(function(){

//   $('.owl-next').prepend(`	
//         <span class="angle-right">
//         <i class="fa fa-angle-right" aria-hidden="true"></i>
//         </span>
// 			`);

//   $('span aria-label="Next"').hide();
// });

// big video carousel////
$(function () {
  $(".big-video-slider").owlCarousel({
    loop: true,
    dots: false,
    nav: true,
    dots: false,
    animateOut: "slideOutRight",
    animateIn: "flipInY",
    autoplay: true,
    autoplayTimeout: 4000,
    autoplaySpeed: 2500,
    fluidSpeed:true,
    items: 3,
    margin: 0,
    stagePadding: 0,
    smartSpeed: 3000,
    responsive: {
			0: {
				items: 1
			},
			480: {
				items: 1
        // slideSpeed: 3000  
			},
			768: {
				items: 1
			},
			992: {
				items: 3
			}
		},
  });
});
// big video carousel////
$(function () {
  $(".another-slider").owlCarousel({
    loop: true,
    dots: false,
    nav: true,
    dots: false,
    animateOut: "slideOutRight",
    animateIn: "flipInY",
    autoplay: true,
    autoplayTimeout: 3000,
    autoplaySpeed: 2500,
    fluidSpeed:true,
    items: 6,
    margin: 0,
    stagePadding: 0,
    smartSpeed: 2000,
    responsive: {
			0: {
				items: 2
			},
			480: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 6
			}
		},
  });
  });
// place holder animation js
var $inputItem = $(".js-inputWrapper");
$inputItem.length && $inputItem.each(function() {
    var $this = $(this),
        $input = $this.find(".formRow--input"),
        placeholderTxt = $input.attr("placeholder"),
        $placeholder;
    
    $input.after('<span class="placeholder">' + placeholderTxt + "</span>"),
    $input.attr("placeholder", ""),
    $placeholder = $this.find(".placeholder"),
    
    $input.val().length ? $this.addClass("active") : $this.removeClass("active"),
        
    $input.on("focusout", function() {
        $input.val().length ? $this.addClass("active") : $this.removeClass("active");
    }).on("focus", function() {
        $this.addClass("active");
    });
});