(function( $ ) {
    'use strict';

    jQuery(document).ready(function(){
        tpc_verify_init();
        tpc_notice_init();
        tpc_accordion();
    });

    function tpc_verify_init(){
        var wait_load = false;
        var security, purchase_item, user_email, content, js_activation;
        var btn;
        jQuery(document).on('click', '.activate-license', function(e){
            e.preventDefault();
            if ( wait_load ) return;
            wait_load = true;
            security = jQuery(this).closest('.tpc-purchase').find('#security').val();    
            user_email = jQuery(this).closest('.tpc-purchase').find('input[name="user_email"]').val();    
            purchase_item = jQuery(this).closest('.tpc-purchase').find('input[name="purchase_item"]').val(),    
            content = jQuery(this).closest('.tpc-purchase').find('input[name="content"]'),    
            js_activation = jQuery(this).closest('.tpc-purchase').find('input[name="js_activation"]'),    

            btn = jQuery(this); 
            jQuery(btn).closest('.tpc-purchase').find('.notice-validation').remove();
            jQuery.ajax({
                type : "post", 
                cache: false,
                async: true,
                url : ajaxurl,
                dataType: "json",
                data : {
                    action: "purchase_activation",        
                    security: security,
                    purchase_code: purchase_item,
                    email: user_email,
                },
                beforeSend: function() {
                    // setting a timeout
                    btn.addClass('loading');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                success: function(response) {    
                    if(!response){
                        tpc_verify_alternative(security, purchase_item, user_email);
                    }else{
                        if(response.error == 1){
                            var node_str = '<div class="notice-validation notice notice-error error" style="display: none;">';
                            node_str += response.message;
                            node_str  += '</div>';
                            jQuery(btn).closest('.tpc-purchase').append(node_str);
                            jQuery('.notice-validation').fadeIn();
                        }
                        
                        if(response.success == 1){
                            var node_str = '<div class="notice-validation notice notice-success success" style="display: none;">';
                            node_str += response.message;
                            node_str  += '</div>';
                            jQuery(btn).closest('.tpc-purchase').append(node_str);
                            jQuery('.notice-validation').fadeIn();
                            setTimeout(function(){
                                window.location.reload();
                            }, 400);
                        }

                        btn.removeClass('loading');
                        wait_load = false;                           
                    }
 
                },
            }); 

            function tpc_verify_alternative( security, purchase_item, user_email ){  
                var dataParams = { security: security,
                    purchase_code: purchase_item,
                    email: user_email,
                    active_alternative_theme: 1,
                    action: "purchase_js_activation",     
                    domain_url: tpc_verify.domainUrl,
                    theme_name: tpc_verify.themeName };
                    dataParams = JSON.stringify( dataParams );
                jQuery.ajax({
                        type : "post", 
                        cache: false,
                        async: true,
                        url : tpc_verify.rtUrlActivate,
                        dataType: "json",
                        data : dataParams,
                        beforeSend: function() {},
                        error: function(jqXHR, textStatus, errorThrown) {},
                        success: function(response) {
                             if(response.error == 1){
                                var node_str = '<div class="notice-validation notice notice-error error" style="display: none;">';
                                node_str += response.message;
                                node_str  += '</div>';
                                jQuery(btn).closest('.tpc-purchase').append(node_str);
                                jQuery('.notice-validation').fadeIn();
                            }

                            if(response.success == 1){
                                var node_str = '<div class="notice-validation notice notice-success success" style="display: none;">';
                                node_str += tpc_verify.message;
                                node_str  += '</div>';
                                jQuery(btn).closest('.tpc-purchase').append(node_str);
                                jQuery('.notice-validation').fadeIn();
                                jQuery(content).val( JSON.stringify(response.content) );  
                                jQuery(js_activation).val('1');  
                                jQuery(btn).closest('.tpc-purchase').submit();
                                
                            }
                            btn.removeClass('loading');
                            wait_load = false;  
                        },
                    });  
            }          
        });    
        jQuery(document).on('submit', '.deactivation_form', function(e){
            e.preventDefault();
            if ( wait_load ) return;
            wait_load = true; 

            security = jQuery(this).find('#security').val();
            btn = jQuery(this).find('.deactivate_theme-license'); 
            
            var dataParams = { security: security,
                purchase_code: tpcverify.purchaseCode,
                email: tpcverify.email,
                deactivate_theme: 1,
                action: "purchase_js_deactivate",     
                domain_url: tpcverify.domainUrl,
                theme_name: tpcverify.themeName };
                dataParams = JSON.stringify( dataParams );
            jQuery.ajax({
                    type : "post", 
                    cache: false,
                    async: true,
                    url : tpcverify.rtUrlDeactivate,
                    dataType: "json",
                    data : dataParams,
                    beforeSend: function() {
                        // setting a timeout
                        btn.addClass('loading');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {},
                    success: function(response) {
                        btn.removeClass('loading');
                        wait_load = false;
                        e.currentTarget.submit();
                    },
                });
        });    
    }

    function tpc_notice_init(){
        jQuery(document).on('click', '.dismiss_notices', function(e){
            e.preventDefault();
            var notice = jQuery(this).closest('.notice').fadeOut();
            jQuery.ajax({
                type : "post", 
                cache: false,
                async: true,
                url : ajaxurl,
                data : {
                    action    : 'dismissed_notice',
                    nonce    : tpcverify.ajax_nonce,
                },
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(response) {},
            });    
        });
    }

   //===== Add class for dummy import
    jQuery(function() {

        jQuery('body.corpix_unlock .ocdi .ocdi__gl-item-buttons a.ocdi__gl-item-button.button.button-primary').each(function() {
            var text = this.innerHTML;
            var firstSpaceIndex = text.indexOf("Import Demo");
            var rrrr = "Unlock";
            this.innerHTML = '<span class="firstWordClass ">' + rrrr + '</span>';
        });
        var temp="admin.php?page=corpix-theme-active";
        $("body.corpix_unlock .ocdi .ocdi__gl-item-buttons a.ocdi__gl-item-button.button").attr('href',' '+temp);
    });

})( jQuery );

function tpc_accordion(){
    jQuery('body').on('click', '.tpc_accordion_heading', function(e){
        e.preventDefault();
        var parent = jQuery(this).parent('.tpc_accordion_wrapper');
        var body =  jQuery(parent).children('.tpc_accordion_body');

        if(jQuery(parent).hasClass('open'))
        {
            jQuery(body).slideUp('fast');
            jQuery(parent).removeClass('open').addClass('close');
        } else {
            jQuery(body).slideDown('fast');
            jQuery(parent).removeClass('close').addClass('open');
        }
    });
}


