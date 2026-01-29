jQuery(document).ready(function ($) {
    let $handHeld = $('.fframe_handheld');
    $handHeld.on('click', function () {
        $(this).parent().find('.fframe_menu').toggleClass('fframe_menu_open');
    });
    $('.fframe_menu_item a').on('click', function () {
        $handHeld.parent().find('.fframe_menu').removeClass('fframe_menu_open');
    });

    jQuery('.update-nag,.notice, #wpbody-content > .updated, #wpbody-content > .error').remove();
});
