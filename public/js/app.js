$(document).ready(function() {
    /**
     * Animations
     */

    // On Start
    $('.home-banner, .profile-banner').css({'height': '0'}).animate({'height': '240px'}, 500, 'swing', function() {
        $('.home-banner, .profile-banner').find('.banner-content').animate({'opacity': '1.0'}, 1000, 'swing');
    });
    $('.content-banner').css({'height': '0'}).animate({'height': '100px'}, 500, 'swing', function() {
        $('.content-banner .banner-content').animate({'opacity': '1.0'}, 1000, 'swing');
    });

    $('.banner-1').animate({'width': '100px'}, 700, 'swing');
    $('.banner-2').animate({'width': '160px'}, 600, 'swing');


    /**
     * Dropdown
     */

    // Hide all menus on start
    $('.dropdown-menu').hide().css({'visibility': 'visible'});

    $('.dropdown').click(function(event) {
        $(this).children('.dropdown-menu:first').slideToggle(300);
    });

    $(window).click(function() {
        $('.dropdown-menu').slideUp(300);
    });

    $('.dropdown, .dropdown-menu').click(function(event) {
        event.stopPropagation();
    });

    /**
     * Sidebar
     */
    $('.sidebar .sidebar-item[href]').each(function() {
        if (this.href == window.location.href) {
            $(this).addClass('sidebar-item-active');
        }
    });

    $('.sidebar-item-active').click(function(event) {
        event.preventDefault();
    });

});