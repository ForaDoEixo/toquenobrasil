<?php


////////////////// ARTISTA SE INSCREVE EM UM EVENTO /////////////////

add_action('tnb_artista_inscreveu_em_um_evento', 'tnb_email_messages_artista_inscreveu_em_evento', 10, 2);
/**
 * O produtor deve ser notificado quando um artista tentou se cadastrar em seu
 * evento. O artista também deve ser notificado que sua inscrição foi realizada
 * corretamente.
 */
function tnb_email_messages_artista_inscreveu_em_evento($evento_id, $artista_id) {
    
    $header = 'cc:' . get_bloginfo('admin_email');

    $banda = get_userdata($artista_id);
    $event = get_post($evento_id);
    $event_name = $event->post_title; 
    $produtor = get_userdata($event->post_author);

    $options = get_option('custom_email_notices');

    //  PARA produtor e admin
    $subject = 'Inscrição TNB | ' . $event_name . ' | '. $banda->banda;
    $message = $options['msg_insc_produtor']?$options['msg_insc_produtor']:'';
    $info = "Informações\n";
    $info .= __("Evento") .      ": {$event_name}\n";
    $info .= __("Nome") .        ": {$banda->banda}\n";
    $info .= __("Perfil") .      ": ". get_author_posts_url($banda->ID)."\n";
    $info .= __("Responsável") . ": {$banda->responsavel}\n";
    $info .= __("Email") .       ": {$banda->user_email}\n";
    $info .= __("Telefone") .    ": {$banda->telefone_ddd} {$banda->telefone}\n";
    $info .= __("Residência") .  ": {$banda->banda_cidade} - {$banda->banda_estado}\n\n";
    $message = str_replace('{{INFORMACOES}}', $info, $message);

    $join_success = true;
    wp_mail($produtor->user_email, $subject, $message, $header);

    // PARA O ARTISTA
    $subject = 'Inscrição TNB | ' . $event_name ;
    $message = $options['msg_insc_artista']?$options['msg_insc_artista']:'';
    $message = str_replace('{{INFORMACOES}}', $event_name, $message);

    wp_mail($banda->user_email, $subject,$message);
}

////////////////// UM SUBEVENTO É ADICIONADO A UM SUPEREVENTO ///////

add_action('tnb_superevento_recebe_um_subevento','tnb_superevento_recebe_um_subevento');
/**
 * O produtor do super evento deve ser notificado quando seu
 * Superevento foi atrelado a um Subevento de outro produtor.
 */
function tnb_superevento_recebe_um_subevento($subevent_id) {
    $options = get_option('custom_email_notices');

    $subevent = get_post($subevent_id);
    $superevent = get_post($subevent->post_parent);
    $produtor = get_userdata($subevent->post_author);
    $produtor_super = get_userdata($superevent->post_author);

    $subject = 'TNB | ' . $superevent->post_title;

    $message = $options['msg_new_subevent']?$options['msg_new_subevent']:'';
    $info = __("Evento")             . ": {$subevent->post_title}\n";
    $info .= __("Produtor")           . ": {$produtor->user_nicename}\n";
    $info .= __("Perfil do produtor") . ": " . get_author_posts_url($produtor->ID) . "\n";
    $info .= __("Link para o evento") . ": " . get_permalink($subevent->ID);
    $message = str_replace('{{INFORMACOES}}', $info, $message);

    wp_mail($produtor_super->user_email, $subject,$message);
}

////////////////// UM SUBEVENTO É APROVADO EM UM SUPEREVENTO ////////

add_action('tnb_subevento_e_aprovado_em_um_superevento','tnb_subevento_e_aprovado_em_um_superevento');
/**
 * Quando um subevento é aprovado para um superevento, o dono do
 * subevento deve ser notificado.
 */
function tnb_subevento_e_aprovado_em_um_superevento($subevent_id) {
    $options = get_option('custom_email_notices');

    $subevent = get_post($subevent_id);
    $superevent = get_post($subevent->post_parent);
    $produtor = get_userdata($subevent->post_author);

    $subject = 'TNB | ' . $subevent->post_title;

    $message = $options['msg_subevent_approved']?$options['msg_subevent_approved']:'';
    $message = str_replace('{{INFORMACOES}}', $superevent->post_title, $message);

    wp_mail($produtor->user_email, $subject,$message);
}



////////////////// UM SUBEVENTO É DESATIVADO PORQUE O SUPEREVENTO FOI DESATIVADO ////////

add_action('tnb_subevento_desativado_por_superevento','tnb_subevento_desativado_por_superevento', 10, 2);
/**
 * Quando um superevento é desativado, todos seus subeventos são desativados também e os produtores dos subeventos são notificados
 */
function tnb_subevento_desativado_por_superevento($superevento, $subevento) {


    $options = get_option('custom_email_notices');

    $produtor = get_userdata($subevento->post_author);

    $subject = 'TNB | ' . $subevento->post_title;

    $message = $options['msg_evento_desativado_por_superevento']?$options['msg_evento_desativado_por_superevento']:'';
    $info = __("Super Evento desativado")             . ": {$superevento->post_title}\n";
    $info .= __("Seu Sub Evento desativado")           . ": {$subevento->post_title}\n";
    $message = str_replace('{{INFORMACOES}}', $info, $message);


    wp_mail($produtor->user_email, $subject,$message);
}

?>