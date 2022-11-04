$(window).scroll(function() {
    if ($(window).scrollTop() === 0) {
    // We are at the top of the page and want to remove the class
    $('#topNav').removeClass('navbar-fixed-top');
    } else {
    $('#topNav').addClass('navbar-fixed-top');
    }
    });