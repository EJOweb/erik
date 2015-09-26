<?php

function get_category_icon($id = null)
{
    if (!$id) {
        global $post;
        $id = $post->ID;
    }

    //* Get category id
    $category = get_the_category();
    $category_id = $category[0]->cat_ID;

    //* Get category_icons
    $category_icons = get_option( "_category_icons", array() );

    //* Get current category icon
    return isset($category_icons[$category_id]) ? $category_icons[$category_id] : '';
}

?>