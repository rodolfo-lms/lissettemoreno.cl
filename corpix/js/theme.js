"use strict";

is_visible_init();
corpix_slick_navigation_init();

jQuery(document).ready(function($) {
    corpix_sticky_init();
    corpix_search_init();
    corpix_side_panel_init();
    corpix_mobile_header();
    corpix_woocommerce_helper();
    corpix_woocommerce_login_in();
    corpix_init_timeline_appear();
    corpix_accordion_init();
    corpix_services_accordion_init();
    corpix_progress_bars_init();
    corpix_carousel_slick();
    corpix_image_comparison();
    corpix_counter_init();
    corpix_countdown_init();
    corpix_img_layers();
    corpix_page_title_parallax();
    corpix_extended_parallax();
    corpix_portfolio_parallax();
    corpix_message_anim_init();
    corpix_scroll_up();
    corpix_link_scroll();
    corpix_skrollr_init();
    corpix_sticky_sidebar();
    corpix_videobox_init();
    corpix_parallax_video();
    corpix_tabs_init();
    corpix_circuit_service();
    corpix_select_wrap();
    jQuery( '.tpc_module_title .carousel_arrows' ).corpix_slick_navigation();
    jQuery( '.tpc-filter_wrapper .carousel_arrows' ).corpix_slick_navigation();
    jQuery( '.tpc-products > .carousel_arrows' ).corpix_slick_navigation();
    jQuery( '.corpix_module_custom_image_cats > .carousel_arrows' ).corpix_slick_navigation();
    corpix_scroll_animation();
    corpix_woocommerce_mini_cart();
    corpix_text_background();
    corpix_dynamic_styles();
    corpix_learnpress_helper();
});

jQuery(window).load(function () {
    corpix_images_gallery();
    corpix_isotope();
    corpix_blog_masonry_init();
    setTimeout(function(){
        jQuery('#preloader-wrapper').fadeOut();
    },1100);

    corpix_particles_custom();
    corpix_particles_image_custom();
    corpix_menu_lavalamp();
    jQuery(".tpc-currency-stripe_scrolling").each(function(){
        jQuery(this).simplemarquee({
            speed: 40,
            space: 0,
            handleHover: true,
            handleResize: true
        });
    })
});





(function($) {
    "use strict";


//===== Global LMS course filter 
    $(document).on('change', '.corpix-course-filter-form', function(e) {
        e.preventDefault();
        $(this).closest('form').submit();
    });
    $('.corpix-pagination ul li a.prev, .corpix-pagination ul li a.next').closest('li').addClass('pagination-parent');
    // category menu
    $('.header-cat-menu ul.children').closest('li.cat-item').addClass('category-has-childern');
    $(".corpix-archive-single-cat .category-toggle").on('click', function() {
        $(this).next('.corpix-archive-childern').slideToggle();
        if ($(this).hasClass('fa-plus')) {
            $(this).removeClass('fa-plus').addClass('fa-minus');
        } else {
            $(this).removeClass('fa-minus').addClass('fa-plus');
        }
    });
    $('.corpix-archive-childern input').each(function() {
        if ($(this).is(':checked')) {
            var aChild = $(this).closest('.corpix-archive-childern');
            aChild.show();
            aChild.siblings('.fa').removeClass('fa-plus').addClass('fa-minus');
        }
    });
    $('.corpix-sidebar-filter input').on('change', function() {
        $('.corpix-sidebar-filter').submit();
    });


    //===== Grid view/List view
    $(function() {
        $('#corpix_showdiv1').click(function() {
            $('div[id^=corpixdiv]').hide();
            $('#corpixdiv1').show();
        });
        $('#corpix_showdiv2').click(function() {
            $('div[id^=corpixdiv]').hide();
            $('#corpixdiv2').show();
        });
    })


// ======= Filter top show/hide

// Handler that uses various data-* attributes to trigger
// specific actions, mimicing bootstraps attributes
const triggers = Array.from(document.querySelectorAll('[data-toggle="collapse"]'));

window.addEventListener('click', (ev) => {
  const elm = ev.target;
  if (triggers.includes(elm)) {
    const selector = elm.getAttribute('data-target');
    collapse(selector, 'toggle');
  }
}, false);

const fnmap = {
  'toggle': 'toggle',
  'show': 'add',
  'hide': 'remove'
};
const collapse = (selector, cmd) => {
  const targets = Array.from(document.querySelectorAll(selector));
  targets.forEach(target => {
    target.classList[fnmap[cmd]]('show');
  });
}

// ======= AOS.init();
$( document ).ready(function() {
    AOS.init({
        duration: 1200,
        once: true,
    });
});
 
})(jQuery);
