<?php

/**
 * StoreVilla Pro Custom Shortcodes
 *
 * @package StoreVilla Pro
 */
// Allow shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

 // Enable font size & font family selects in the editor
 if (!function_exists('storevilla_pro_mce_buttons')) {

     function storevilla_pro_mce_buttons($buttons) {
         array_unshift($buttons, 'fontselect','fontsizeselect','styleselect'); // Add Font Size Select
         return $buttons;
     }

 }
 add_filter('mce_buttons_2', 'storevilla_pro_mce_buttons');

// Customize mce editor font sizes
if (!function_exists('storevilla_pro_mce_text_sizes')) {

    function storevilla_pro_mce_text_sizes($initArray) {
        $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px 40px 46px 52px 60px";
        return $initArray;
    }
}
add_filter('tiny_mce_before_init', 'storevilla_pro_mce_text_sizes');


// Declare script for new button
function storevilla_pro_add_tinymce_plugin($plugin_array) {
    $plugin_array['storevilla_pro_mce_button'] = get_template_directory_uri() . '/js/shortcodes.js';
    return $plugin_array;
}
add_filter('mce_external_plugins', 'storevilla_pro_add_tinymce_plugin');

// Register new button in the editor
function storevilla_pro_register_mce_button($buttons) {
    array_push($buttons, 'storevilla_pro_mce_button');
    return $buttons;
}
add_filter('mce_buttons', 'storevilla_pro_register_mce_button');


if (!function_exists('sv_paragraph_br_fix')) {

    function sv_paragraph_br_fix($content, $paragraph_tag = false, $br_tag = false) {
        $content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);

        $content = preg_replace('#<br \/>#', '', $content);

        if ($paragraph_tag)
            $content = preg_replace('#<p>|</p>#', '', $content);
        return trim($content);
    }
}
if (!function_exists('sv_content_helper')) {
    function sv_content_helper($content, $paragraph_tag = false, $br_tag = false) {
        return sv_paragraph_br_fix(do_shortcode(shortcode_unautop($content)), $paragraph_tag, $br_tag);
    }
}

function sv_testimonial_shortcode($atts, $content = null) {
    extract(shortcode_atts(
        array(
            'image' => '',
            'image_shape' => 'round',
            'client' => '',
            'designation' => ''
         ), $atts, 'sv_testimonial'));

    $testimonial = '<div class="sv-testimonial clearfix">';
    if ($image):
        $testimonial .= '<div class="sv-client-image"><img src="' . $image . '"/></div>';
    endif;
    
    $testimonial .= '<div class="sv-client-testimonial">';
    $testimonial .= '<div class="sv-client-testimonial-heading">';
    if ($client):
        $testimonial .= '<h4 class="sv-client-name">' . $client . '</h4>';
    endif;
    if ($designation):
        $testimonial .= '<h6 class="sv-client-position">' . $designation . '</h5>';
    endif;
    $testimonial .= '</div>';
    if ($content):
        $testimonial .= '<div class="sv-client-message">' . sv_content_helper($content) . '</div>';
    endif;
    $testimonial .= '</div>';
    $testimonial .= '</div>';
    return $testimonial; //Return the HTML.
}
add_shortcode('sv_testimonial', 'sv_testimonial_shortcode');

function sv_team_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'name' => '',
        'designation' => '',
        'image' => '',
    ), $atts, 'sv_team'));

    $team = '<div class="sv-team">';
    if ($image):
        $team .= '<div class="sv-member-image"><img src="' . $image . '"/></div>';
    endif;
    $team .= '<h4 class="sv-member-name">' . $name . '</h4>'; 
    if ($designation):
        $team .= '<h6 class="sv-member-position">' . $designation . '</h6>';
    endif;
    $team .= '<div class="sv-line"></div>';    
    $team .= '<div class="sv-member-message">' . sv_content_helper($content) . '</div>';
    $team .= '</div>';
    return $team; //Return the HTML.
}
add_shortcode('sv_team', 'sv_team_shortcode');

function sv_social_shortcodes($atts) {
    extract(shortcode_atts( array(
        'facebook' => '',
        'twitter' => '',
        'gplus' => '',
        'linkedin' => '',
        'youtube' => '',
        'dribble' => ''
    ), $atts, 'sv_social'));

    $social = '<div class="social-shortcode">';
    if ($facebook) {
        $social .= '<a href="' . esc_url($facebook) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
    }
    if ($twitter) {
        $social .= '<a href="' . esc_url($twitter) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
    }
    if ($gplus) {
        $social .= '<a href="' . esc_url($gplus) . '" target="_blank"><i class="fa fa-google"></i></a>';
    }
    if ($linkedin) {
        $social .= '<a href="' . esc_url($linkedin) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
    }
    if ($youtube) {
        $social .= '<a href="' . esc_url($youtube) . '" target="_blank"><i class="fa fa-youtube-play"></i></a>';
    }
    if ($dribble) {
        $social .= '<a href="' . esc_url($dribble) . '" target="_blank"><i class="fa fa-dribbble"></i></a>';
    }
    $social .='</div>';
    return $social;
}
add_shortcode('sv_social', 'sv_social_shortcodes');

function sv_divider_shortcode($atts) {
    extract(shortcode_atts( array(
        'color' => '#CCCCCC',
        'style' => 'solid',
        'width' => '100%',
        'thickness' => '1px',
        'mar_top' => '20px',
        'mar_bot' => '20px',
    ), $atts, 'sv_divider'));
    $divider = '<div class="divider" style="margin-top:' . $mar_top . '; margin-bottom:' . $mar_bot . '; border-top:' . $thickness . ' ' . $style . ' ' . $color . ';width:' . $width . '"/></div>';
    return $divider;
}
add_shortcode('sv_divider', 'sv_divider_shortcode');

function sv_spacing_shortcode($atts) {
    extract(shortcode_atts( array(
        'spacing_height' => '10px',
    ), $atts, 'sv_spacing'));
    $sv_spacing = '<hr class="sv-spacing" style="height:' . $spacing_height . '"/>';
    return $sv_spacing;
}
add_shortcode('sv_spacing', 'sv_spacing_shortcode');

function sv_accordian_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'title' => '',
        'icon' => '',
    ), $atts, 'sv_accordian'));

    if ($icon) {
        $icon = '<i class="fa ' . $icon . '"></i>';
    }
    $accordion = '<div class="sv_accordian">';
    $accordion .='<div class="sv_accordian_title">' . $icon . ' ' . $title . '</div>';
    $accordion .='<div class="sv_accordian_content">' . sv_content_helper($content) . '</div>';
    $accordion .='</div>';
    return $accordion;
}
add_shortcode('sv_accordian', 'sv_accordian_shortcode');

function sv_accordian_shortcode_wrap($atts, $content = null) {
    extract(shortcode_atts( array(
        'class' => '',
    ), $atts, 'sv_accordian_wrap'));
    return '<div class="accordion-wrap ' . $class . '">' . sv_content_helper($content) . '</div>';
}
add_shortcode('sv_accordian_wrap', 'sv_accordian_shortcode_wrap');

function sv_toggle_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'title' => '',
        'status' => 'close'
    ), $atts, 'sv_toggle'));

    $accordion = '<div class="sv_toggle ' . $status . '">';
    $accordion .='<div class="sv_toggle_title">' . $title . '</div>';
    $accordion .='<div class="sv_toggle_content">' . sv_content_helper($content) . '</div>';
    $accordion .='</div>';
    return $accordion;
}
add_shortcode('sv_toggle', 'sv_toggle_shortcode');

function sv_call_to_action_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'button_text' => 'View',
        'button_url' => '#',
        'button_align' => 'center'
    ), $atts, 'sv_call_to_action'));

    $call_to_action = '<div class="sv_call_to_action clearfix ' . $button_align . '">';
    $call_to_action .='<div class="sv_call_to_action_content">' . sv_content_helper($content) . '</div>';
    $call_to_action .='<a href="' . esc_url($button_url) . '" class="sv_call_to_action_button">' . $button_text . '</a>';
    $call_to_action .='</div>';
    return $call_to_action;
}
add_shortcode('sv_call_to_action', 'sv_call_to_action_shortcode');

function sv_tagline_box_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'sv_tagline_text' => 'Enter you Tag Line text here',
        'tag_box_style' => 'sv-all-border-box',
    ), $atts, 'sv_tagline_box'));

    $sv_tagline_box = '<div class="sv_tagline_box clearfix ' . $tag_box_style . '">';
    $sv_tagline_box .= sv_content_helper($content);
    $sv_tagline_box .='</div>';
    return $sv_tagline_box;
}
add_shortcode('sv_tagline_box', 'sv_tagline_box_shortcode');

function sv_drop_csv_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'font_size' => '26',
    ), $atts, 'sv_drop_cap'));

    $drop_cap = '<span class="sv_drop_cap" style="font-size:' . $font_size . 'px">';
    $drop_cap .= $content;
    $drop_cap .='</span>';
    return $drop_cap;
}
add_shortcode('sv_drop_cap', 'sv_drop_csv_shortcode');

function sv_slide_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'caption' => '',
        'link' => '',
        'target' => '_self'
    ), $atts, 'sv_slide'));
    $sv_slide = '<div class="sv-slide">';
    if ($link):
        $sv_slide .= '<a href="' . $link . '" target="' . $target . '">';
    endif;
    $sv_slide .= '<img title="' . $caption . '" src="' . $content . '">';
    if ($link):
        $sv_slide .= '</a>';
    endif;
    $sv_slide .= '</div>';
    return $sv_slide;
}
add_shortcode('sv_slide', 'sv_slide_shortcode');

function sv_slider_shortcode($atts, $content = null) {
    $sv_slider = '<div class="shortcode-slider"><div class="slider_wrap">';
    $sv_slider .= sv_content_helper($content);
    $sv_slider .= '</div></div>';
    return $sv_slider;
}
add_shortcode('sv_slider', 'sv_slider_shortcode');

function sv_tab_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'title' => '',
    ), $atts, 'sv_tab'));

    $sv_tab = '<div class="sv_tab ' . sanitize_title($title) . '">';
    $sv_tab .='<div class="tab-title" id="' . sanitize_title($title) . '">' . $title . '</div>';
    $sv_tab .= sv_content_helper($content);
    $sv_tab .='</div>';
    return $sv_tab;
}
add_shortcode('sv_tab', 'sv_tab_shortcode');

function sv_tab_wrsv_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'type' => 'horizontal',
    ), $atts, 'sv_tab_group'));
    $sv_tab_wrap = '<div class="clearfix sv_tab_wrap ' . $type . '">';
    $sv_tab_wrap .= sv_content_helper($content);
    $sv_tab_wrap .= '</div>';
    return $sv_tab_wrap;
}
add_shortcode('sv_tab_group', 'sv_tab_wrsv_shortcode');

function sv_column_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'span' => '6',
    ), $atts, 'sv_column'));
    $sv_column = '<div class="sv_column sv-span' . $span . '">';
    $sv_column .= sv_content_helper($content);
    $sv_column .= '</div>';
    return $sv_column;
}
add_shortcode('sv_column', 'sv_column_shortcode');

function sv_column_wrsv_shortcode($atts, $content = null) {
    $sv_column_wrap = '<div class="clearfix sv-row">';
    $sv_column_wrap .= sv_content_helper($content);
    $sv_column_wrap .= '</div>';
    return $sv_column_wrap;
}
add_shortcode('sv_column_wrap', 'sv_column_wrsv_shortcode');

function sv_list_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'list_type' => 'sv-list1',
    ), $atts, 'sv_list'));
    $sv_list = '<ul class="sv-list ' . $list_type . '">';
    $sv_list .= sv_content_helper($content);
    $sv_list .= '</ul>';
    return $sv_list;
}
add_shortcode('sv_list', 'sv_list_shortcode');

function sv_li_shortcode($atts, $content = null) {
    $sv_li = '<li>';
    $sv_li .= sv_content_helper($content);
    $sv_li .= '</li>';
    return $sv_li;
}
add_shortcode('sv_li', 'sv_li_shortcode');

function sv_button_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'button_size' => 'sv-medium-bttn',
        'button_type' => 'sv-bg-bttn',
        'button_url' => '#',
        'button_color' => 'sv-default-bttn',
        'button_align' => 'sv-align-none',
    ), $atts, 'sv_button'));
    $sv_button = '<a href="'.esc_url($button_url).'" class="bttn '.$button_type.' '.$button_size.' '.$button_color.' '.$button_align.'">';
    $sv_button .= sv_content_helper($content);
    $sv_button .= '</a>';
    return $sv_button;
}
add_shortcode('sv_button', 'sv_button_shortcode');

function sv_dropcaps_shortcode($atts, $content = null) {
    extract(shortcode_atts( array(
        'style' => 'sv-normal',
    ), $atts, 'sv_dropcaps'));
    $sv_dropcaps = '<span class="sv-dropcaps '.$style.'">';
    $sv_dropcaps .= sv_content_helper($content);
    $sv_dropcaps .= '</span>';
    return $sv_dropcaps;
}
add_shortcode('sv_dropcaps', 'sv_dropcaps_shortcode');