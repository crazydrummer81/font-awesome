<?php

function fa_css_to_json() {
    $css_path = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
    $json_path = 'json';
    $json_filename = $json_path.'/fa.json';
    $css_content = file_get_contents($css_path);

    $items = array();

    $regexp = '/\.([a-zA-Z0-9_-]+)\:before.content...f([0-9a-f]{3})/'; //.*\"f([0-9af])\"
    preg_match_all($regexp, $css_content, $items, PREG_SET_ORDER);
    // var_dump_pre($items);

    return $items;
}

?>