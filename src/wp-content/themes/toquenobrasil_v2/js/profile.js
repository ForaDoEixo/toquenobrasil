jQuery(document).ready(function() {


    //************* Abas do widget de oportunidades de artista *************////////
    
    jQuery('ul.widget_oportunidades_tabs li a').click(function() {
        
        jQuery(this).parents('ul').find('a').removeClass('current');
        jQuery(this).parents('div').find('div.oportunidades_tab').hide();
        jQuery(this).addClass('current');
        if (jQuery(this).hasClass('inscrito')) {
            jQuery(this).parents('div').find('div.inscrito').show();
        } else {
            jQuery(this).parents('div').find('div.selecionado').show();
        }
    });
    
    // inicializa abas
    jQuery('ul.widget_oportunidades_tabs li a.inscrito').click();



        
});