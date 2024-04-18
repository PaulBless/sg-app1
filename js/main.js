(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });


    // Hero Header carousel
    $(".header-carousel").owlCarousel({
        // animateOut: 'slideOutDown',
        animateOut: 'fadeOut',
        items: 1,
        autoplay: true,
        smartSpeed: 4000,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
    });


    // International carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        items: 1,
        smartSpeed: 1500,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ]
    });


    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })

        // hide top bar & show on page scroll
        // $('#nav1').css.style('display', 'none');
    });


    // testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:1
            },
            992:{
                items:1
            },
            1200:{
                items:1
            }
        }
    });

    // show/hide divisions navigation
    $(window).scroll(function() {
        const nav1 = document.getElementById('nav1');
        const nav2 = document.getElementById('nav2');

        if (window.scrollY > nav2.offsetHeight) {
            nav1.classList.add('show'); // Add 'show' class when scrolled past nav2 height
        } else {
            nav1.classList.remove('show'); // Remove 'show' class on scroll up
        }
    });

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });

    // click to go top of page
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    // clients logo
    $('.client-logo').owlCarousel({
        loop: true,
        margin: 0,
        dots: false,
        nav: false,
        autoplay: true,
        navText: ["<i class='icofont icofont-thin-left'></i>", "<i class='icofont icofont-thin-right'></i>"],
        responsive: {
            0: {
                items: 3
            },
            300: {
                items: 3
            },
            600: {
                items: 4
            },
            1000: {
                items: 6
            }
        }
    });

    // divisions slider
    $(".divisions-carousel").owlCarousel({
        autoplay: true,
        loop: true,
        margin: 15,
        dots: false,
        slideTransition: "linear",
        autoplayTimeout: 4500,
        autoplayHoverPause: true,
        autoplaySpeed: 4500,
        responsive: {
          0: {
            items: 2
          },
          500: {
            items: 3
          },
          600: {
            items: 4
          },
          800: {
            items: 4
          },
          1200: {
            items: 4
          }
        }
    });
      
    // contact form submit
    $("#contactForm123").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('.submit-btn').text('please wait...').attr('disabled', 'disabled');

        //
        jQuery.ajax({
            url: "../apis/contact_form.php",
            // data:'userName='+$("#userName").val()+'&userEmail='+$("#userEmail").val()+'&subject='+$("#subject").val()+'&content='+$(content).val(),
            type: "POST",
            data: formData,
            success:function(data){
                $("#mail-status").html(data);
                $('.submit-btn').text('Send Message').attr('disabled', false);
            },
            error:function (){
                $('.submit-btn').text('Send Message').attr('disabled', false);
            }
            
        });
    });

    $("#contactUs").submit(function(e) {
    
    // appointment booking form submit
    $("#appointmentForm").submit(function(e) {
        let formData = $(this).serialize();

    });

    // talent pool form submit using ajax
    $('#talentPoolForm').submit(function(e) {
        e.preventDefault();
        if(valid) {
            $.ajax({
            url: "../apis/contact_mail.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
            $("#mail-status").html(data);
            $('#loader-icon').hide();
            },
            error: function(){} 	        
            
            });
        }
    });

    
    function validateContact() {
        var valid = true;	
        $(".demoInputBox").css('background-color','');
        $(".info").html('');
        
        if(!$("#userName").val()) {
            $("#userName-info").html("(required)");
            $("#userName").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#userEmail").val()) {
            $("#userEmail-info").html("(required)");
            $("#userEmail").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#userEmail").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            $("#userEmail-info").html("(invalid)");
            $("#userEmail").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#subject").val()) {
            $("#subject-info").html("(required)");
            $("#subject").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#content").val()) {
            $("#content-info").html("(required)");
            $("#content").css('background-color','#FFFFDF');
            valid = false;
        }
        
        return valid;
    }

    
    function validateTPool() {
        
    }

    // check only numbers on keypress event
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }  

    // function to check inputs
    function acceptLetters(e)
    {
        // allow letters and whitespaces only.
        var inputValue = event.which;
        if(!(inputValue >= 65 && inputValue <= 123) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }
    }

})(jQuery);

