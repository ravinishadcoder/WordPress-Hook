<?php
add_filter('post_log_message',function($message){
    $message=$message . ' It was saved at'. date("l jS \of F Y h:i:s A");
    return $message;
});

add_action('save_post','log_when_saved');

function log_when_saved($post_id){
    if(!(wp_is_post_revision($post_id))||wp_is_post_autosave($post_id)){
        return;
    }
$post_log= get_stylesheet_directory().'/post_log.txt';
$message= apply_filters('post_log_message',get_the_title($post_id).'was just saved!');
if(file_exists($post_log)){
    $file=fopen($post_log,'a');
    fwrite($file,$message."\n");
}else{
    $file=fopen($post_log,'w');
    fwrite($file,$message."\n");
}
fclose($file);
}


?>