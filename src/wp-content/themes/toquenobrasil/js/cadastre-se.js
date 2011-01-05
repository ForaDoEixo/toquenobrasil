 jQuery(document).ready(function() { 	
	 jQuery('#formularios-de-cadastro #abas').find('a').click(function(){		 
		 muda_aba_cadastre_se(this);
	 });

     jQuery('#origem_pais').change(function(){
        if(jQuery('#banda_pais').val() == '') {
            jQuery('#banda_pais').val(jQuery('#origem_pais').val());
        }
     });

     jQuery('#origem_estado').change(function(){
        if(jQuery('#banda_estado').val() == '') {
            jQuery('#banda_estado').val(jQuery('#origem_estado').val());
        }
     });

	 function muda_aba_cadastre_se(obj_clicado){		 
		 jQuery('#formularios-de-cadastro #abas').find('a').parent().removeClass('current');
		 jQuery(obj_clicado).parent().addClass('current');
		 muda_content_latest();
	 }
	 function muda_content_latest(){
		 jQuery('#formularios-de-cadastro #conteudo>div').hide();
		 
		 jQuery('#formularios-de-cadastro #conteudo #'+jQuery('#formularios-de-cadastro #abas').find('.current').attr('id').split('-')[1]).show();
	 }
	 muda_content_latest();
 });
