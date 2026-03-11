<?php
/* Collection of Walker classes */
    /*
        wp_nav_menu()
        <div class="menu-container">
            <ul> //start_lvl()
                <li><a><span> //start_el()
                </a></span></li> //end_el()
                <li><a>b link</a></li>
            </ul> //end_lvl()
        </div>
    */
class Walker_Nav_Primary extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $classes = 'dropdown-menu';
        if ( $depth > 0 ) {
            $classes .= ' sub-menu';
        }
        $output .= "\n$indent<ul class=\"" . esc_attr( $classes ) . "\">\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
         $indent  = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
       $indent = ($depth) ? str_repeat( "\t", $depth ) : '';
       $li_attributes = '';
       $class_names = $value = ''; 
       $classes = empty( $item -> classes ) ? array() : (array) $item->classes;
       $classes[] = ($args->walker -> has_children) ? 'dropdown' : '';
       // every time we have args have children we put walker to go to sub levels
       // either it ($item -> current || $item -> current_item_ancestor) ? 'active' : '';
       $classes[] =($item -> current || $item -> current_item_ancestor) ? 'active' : '';
       $classes[] = 'menu-item-' . $item -> ID;
       if($depth && $args -> walker -> has_children){
            $classes[] = 'dropdown-submenu';
       }
       $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

       $class_names = ' class="' . esc_attr($class_names) . '"';

       $id = apply_filters('nav_menu_item_id','menu-item-'.$item->ID, $item, $args);
       $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
       $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
       // we need to check if attribute argument is not empty
       $attributes =  ! empty($item -> attr_title) ? ' title="' . esc_attr($item -> attr_title) . '"' : '';
       $attributes .= ! empty($item -> target) ? ' target="' . esc_attr($item -> target) . '"' : '';
       // check the rel 
       $attributes .= ! empty($item -> xfn) ? ' rel="' . esc_attr($item -> xfn) . '"' : '';
       $attributes .= ! empty($item -> url) ? ' href="' . esc_attr($item -> url) . '"' : '';
       $attributes .= ! empty($args-> walker -> has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"':'';
       // print the proper tag that need to be there in order it to generate
       $item_output = $args -> before;
       $item_output .= '<a' . $attributes . '>'; 
       $item_output .= $args -> link_before . apply_filters('the_title', $item -> title, $item -> ID) . $args -> link_after;
       $item_output .= ($depth == 0 && $args -> walker->has_children) ? ' <b class="caret"></b></a>' : '</a>';
       $item_output .= $args -> after;
      $item_output = apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
      $output .= $item_output;
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
         $output .= "</li>\n";
    }
}
