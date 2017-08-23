<?php

// Register Sidebar
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar 1', 
		'id'   => 'sidebar_1',
		'before_widget' => '<li class="widget">', 
		'after_widget' => '</li>', 
		'before_title' => '<h3>', 
		'after_title' => '</h3>' 
 
	));
 
	register_sidebar(array(
		'name' => 'Sidebar 2', 
		'id'   => 'sidebar_2',
		'before_widget' => '<li class="widget">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>' 
 
	));
}

 //Call Sidebar
 //if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : dynamic_sidebar( 'Sidebar 1' ); endif; 




// ************************** 
// Register Widgets Without Options
// ************************** 
function widget_content_1() {
    // print some HTML for the widget to display here
    echo "Your Widget Test";
}
 function widget_content_2() {
    // print some HTML for the widget to display here
    echo "Your Widget Test";
}

if( function_exists( 'register_sidebar_widget' ) ) {   
	wp_register_sidebar_widget(
		'your_widget_1',        // your unique widget id
		'Your Widget',          // widget name
		'widget_content',  // callback function
		array(                  // options
			'description' => 'Description of what your widget does'
		)
	);

	wp_register_sidebar_widget(
		'your_widget_1',        // your unique widget id
		'Your Widget 2',          // widget name
		'widget_content_2',  // callback function
		array(                  // options
			'description' => 'Description of what your widget does'
		)
	);
}  

// ************************** 
// Register Widgets With Options
// ************************** 
class MyNewWidget extends WP_Widget {
	
	// Instantiate the parent object
	function MyNewWidget() {
		$widget_ops = array('classname'=>'widget_name','description'=>'This is the description');
		parent::__construct(false,'This is the title',$widget_ops);
	}

	// Widget output
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
		$showPosts = empty($instance['showPosts']) ? 10 : $instance['showPosts'];
		$cat = empty($instance['cat']) ? 0 : $instance['cat'];

		echo $before_widget;
		echo $before_title . $title . $after_title;
		the_rand_posts("showPosts=$showPosts&cat='$cat'&class='$class'");  // this is a custom function, just for example
		echo $after_widget;
	}
	
	// Save widget options
	//function update( $new_instance, $old_instance ) {
	//}

	// admin options form
	function form( $instance ) {
		// Default Value
		$instance = wp_parse_args((array)$instance,array('title'=>'Random Posts','showPosts'=>10,'cat'=>0));

		$title = htmlspecialchars($instance['title']);
		$showPosts = htmlspecialchars($instance['showPosts']);
		$cat = htmlspecialchars($instance['cat']);
		echo '<p><label for="'.$this->get_field_name('title').'">Title:<input style="width:200px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p><label for="'.$this->get_field_name('showPosts').'">Amount:<input style="width:200px;" id="'.$this->get_field_id('showPosts').'" name="'.$this->get_field_name('showPosts').'" type="text" value="'.$showPosts.'" /></label></p>';
		echo '<p><label for="'.$this->get_field_name('cat').'">分类ID:<input style="width:200px" id="'.$this->get_field_id('cat').'" name="'.$this->get_field_name('cat').'" type="text" value="'.$cat.'" /></label></p>';
	}
}

function myall_register_widgets() {
	register_widget( 'MyNewWidget' );
}
add_action( 'widgets_init', 'myall_register_widgets' );

/******************************
A widget where you may have Text, 
HTML, Javascript, Flash and/or Php 
as content with linkable/clickable widget title.
 ******************************/
class LinkableTitleHtmlAndPhpWidget extends WP_Widget {

    function LinkableTitleHtmlAndPhpWidget() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('A widget where you may have Text, HTML, Javascript, Flash and/or Php as content with linkable/clickable widget title.'));
        $control_ops = array('width' => 400, 'height' => 350);
        $this->WP_Widget('LinkableTitleHtmlAndPhpWidget', __('Linkable Title Html and Php Widget'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance);
        $titleUrl = apply_filters('widget_title', empty($instance['titleUrl']) ? '' : $instance['titleUrl'], $instance);
        $titleColor = apply_filters('widget_title', empty($instance['titleColor']) ? '' : $instance['titleColor'], $instance);
        $forceTitleUnderline = $instance['forceTitleUnderline'] ? '1' : '0';
        $removeTextContentDivTag = $instance['removeTextContentDivTag'] ? '1' : '0';
        $newWindow = $instance['newWindow'] ? '1' : '0';
        $text = apply_filters( 'widget_text', $instance['text'], $instance );

        $titleStyle = ($forceTitleUnderline == '1' ? "text-decoration: underline !important;" : "");
        $titleStyle .= (strlen($titleColor) > 0 ? "color: {$titleColor};" : "");
        if(strlen($titleStyle) > 0) {
            $titleStyle = ' style="' . $titleStyle . '"';
        }

        echo $before_widget;
        if( $titleUrl && $title )
            $title = '<a href="' . $titleUrl . '"' . ($newWindow == '1'?' target="_blank"':'') . $titleStyle . ' title="'.$title.'">'.$title.'</a>';
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
        <?php echo ($removeTextContentDivTag == '1' ? '' : '<div class="textwidget">');?><?php if($instance['filter']) { ob_start(); eval("?>$text<?php "); $output = ob_get_contents(); ob_end_clean(); echo wpautop($output); } else eval("?>".$text."<?php "); ?><?php echo ($removeTextContentDivTag == '1' ? '' : '</div>');?>
        <?php
        echo $after_widget;
    }
    
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['titleUrl'] = strip_tags($new_instance['titleUrl']);
        $instance['titleColor'] = $new_instance['titleColor'] ? $new_instance['titleColor'] : "";
        $instance['forceTitleUnderline'] = $new_instance['forceTitleUnderline'] ? 1 : 0;
        $instance['removeTextContentDivTag'] = $new_instance['removeTextContentDivTag'] ? 1 : 0;
        $instance['newWindow'] = $new_instance['newWindow'] ? 1 : 0;
        if ( current_user_can('unfiltered_html') )
            $instance['text'] =  $new_instance['text'];
        else
            $instance['text'] = wp_filter_post_kses( $new_instance['text'] );
        $instance['filter'] = isset($new_instance['filter']);
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'titleUrl' => '', 'text' => '' ) );
        $title = strip_tags($instance['title']);
        $titleUrl = strip_tags($instance['titleUrl']);
        $titleColor = strip_tags($instance['titleColor']);
        $forceTitleUnderline = $instance['forceTitleUnderline'] ? 'checked="checked"' : '';
        $removeTextContentDivTag = $instance['removeTextContentDivTag'] ? 'checked="checked"' : '';
        $newWindow = $instance['newWindow'] ? 'checked="checked"' : '';
        $text = format_to_edit($instance['text']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('titleUrl'); ?>"><?php _e('Title Url:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('titleUrl'); ?>" name="<?php echo $this->get_field_name('titleUrl'); ?>" type="text" value="<?php echo esc_attr($titleUrl); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('titleColor'); ?>"><?php _e('Title Color:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('titleColor'); ?>" name="<?php echo $this->get_field_name('titleColor'); ?>" type="text" value="<?php echo esc_attr($titleColor); ?>" /></p>
        <p><input class="checkbox" type="checkbox" <?php echo $forceTitleUnderline; ?> id="<?php echo $this->get_field_id('forceTitleUnderline'); ?>" name="<?php echo $this->get_field_name('forceTitleUnderline'); ?>" />
        <label for="<?php echo $this->get_field_id('forceTitleUnderline'); ?>"><?php _e('Force widget title underline'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php echo $removeTextContentDivTag; ?> id="<?php echo $this->get_field_id('removeTextContentDivTag'); ?>" name="<?php echo $this->get_field_name('removeTextContentDivTag'); ?>" />
        <label for="<?php echo $this->get_field_id('removeTextContentDivTag'); ?>"><?php _e('Remove Text Content Div Tag'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php echo $newWindow; ?> id="<?php echo $this->get_field_id('newWindow'); ?>" name="<?php echo $this->get_field_name('newWindow'); ?>" />
        <label for="<?php echo $this->get_field_id('newWindow'); ?>"><?php _e('Open the link/url in a new window'); ?></label></p>
        
        <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text, Html, Javascript, Flash and/or Php:'); ?></label>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.'); ?></label></p>
        <?php
    }
}
function LinkableTitleHtmlAndPhpWidgetInit() {
    register_widget('LinkableTitleHtmlAndPhpWidget');
}

add_action('widgets_init', 'LinkableTitleHtmlAndPhpWidgetInit');

// Unregister widgets
function remove_some_wp_widgets(){
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init','remove_some_wp_widgets', 1);
// WP_Widget_Pages                   = Pages Widget
// WP_Widget_Calendar                = Calendar Widget
// WP_Widget_Archives                = Archives Widget
// WP_Widget_Links                   = Links Widget
// WP_Widget_Meta                    = Meta Widget
// WP_Widget_Search                  = Search Widget
// WP_Widget_Text                    = Text Widget
// WP_Widget_Categories              = Categories Widget
// WP_Widget_Recent_Posts            = Recent Posts Widget
// WP_Widget_Recent_Comments         = Recent Comments Widget
// WP_Widget_RSS                     = RSS Widget
// WP_Widget_Tag_Cloud               = Tag Cloud Widget
// WP_Nav_Menu_Widget                = Menus Widget

?>