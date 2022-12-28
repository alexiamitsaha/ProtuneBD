<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'user_music_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'type'    => 'text'
    ),
    'user_music_number' => array(
        'label'   => __('Number of Songs', 'miraculous'),
        'type'    => 'text'
    ),
    'audio_type' => array(
        'label'   => __('Audio Type', 'miraculous'),
        'type'    => 'select',
        'choices' => get_custom_type_category('music-type')
       ),
   );
?>