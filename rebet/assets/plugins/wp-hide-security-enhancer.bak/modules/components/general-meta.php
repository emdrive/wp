<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_general_meta extends WPH_module_component
        {
            function get_component_title()
                {
                    return "Meta";
                }
            
                                    
            function get_module_settings()
                {
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_generator_meta',
                                                                    'label'         =>  'Remove WordPress Generator Meta',
                                                                    'description'   =>  __('Remove the autogenerated meta generator tag within head (WordPress Version).',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_other_generator_meta',
                                                                    'label'         =>  'Remove Other Generator Meta',
                                                                    'description'   =>  __('Remove other meta generated tags within head (eg Theme Name, Theme Version).',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_dns_prefetch',
                                                                    'label'         =>  'Remove DNS Prefetch',
                                                                    'description'   =>  __('Remove DNS Prefetch meta generated tag.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );  
          
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_resource_hints',
                                                                    'label'         =>  'Remove Resource Hints',
                                                                    'description'   =>  __('Remove Resource Hints meta generated tags within head (eg dns-prefetch, preconnect).',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    ); 
          
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_wlwmanifest',
                                                                    'label'         =>  'Remove wlwmanifest Meta',
                                                                    'description'   =>  __('Remove the wlwmanifest tag within head.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
            
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_feed_links',
                                                                    'label'         =>  'Remove feed_links Meta',
                                                                    'description'   =>  __('Remove the feed_links tag within head.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'disable_json_rest_wphead_link',
                                                                    'label'         =>  __('Disable output the REST API link tag into page header',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  __('By default a REST API link tag is being append to HTML.',    'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  58
                                                                    
                                                                    );
                    
                    
               
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_rsd_link',
                                                                    'label'         =>  'Remove rsd_link Meta',
                                                                    'description'   =>  __('Remove the rsd_link tag within head.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
           
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_adjacent_posts_rel',
                                                                    'label'         =>  'Remove adjacent_posts_rel Meta',
                                                                    'description'   =>  __('Remove the adjacent_posts_rel tag within head.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_profile',
                                                                    'label'         =>  'Remove profile link',
                                                                    'description'   =>  __('Remove profile link meta tag within head.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_canonical',
                                                                    'label'         =>  'Remove canonical link',
                                                                    'description'   =>  __('Remove canonical link meta tag within head.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    return $this->module_settings;   
                }
                
                
                
            function _init_remove_generator_meta($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    add_filter('the_generator',     create_function('', 'return "";'));
                    remove_action( 'wp_head',       'wp_generator' ); 
                    
                    //make sure it's being replaced
                    add_filter( 'wph/ob_start_callback',         array(&$this, 'ob_start_callback_remove_generator_meta'));
                }
            
            
            function ob_start_callback_remove_generator_meta( $buffer )
                {
                    
                    $buffer = preg_replace_callback('/(<meta([^>]+)name=("|\')generator("|\')([^>]+)?\/?>)/im', array($this, "remove_generator_meta_preg_replace_callback"), $buffer);
           
                    return $buffer;
                    
                    
                }
            
            
            function remove_generator_meta_preg_replace_callback( $matches )
                {
                    
                    $found  =   isset($matches[0]) ?    $matches[0] :   '';
                    
                    if(empty($found))
                        return '';
                    
                    //check if content starts with WordPress
                    if(stripos($found, 'content="WordPress ')   !== FALSE)
                        return "";
                    
                    return $found;    
                    
                }
            
            
            function _init_remove_other_generator_meta($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    //remove other generator links
                    add_filter( 'wph/ob_start_callback',         array(&$this, 'ob_start_callback_remove_other_generator_meta'));
                }
            
            
            function ob_start_callback_remove_other_generator_meta( $buffer )
                {
                    
                    $buffer = preg_replace_callback('/(<meta([^>]+)name=("|\')generator("|\')([^>]+)?\/?>)/im', array($this, "remove_other_generator_meta_preg_replace_callback"), $buffer);
           
                    return $buffer;
                    
                }
                
            function remove_other_generator_meta_preg_replace_callback( $matches )
                {
                    $found  =   isset($matches[0]) ?    $matches[0] :   '';
                    
                    if(empty($found))
                        return '';
                    
                    //check if content starts with WordPress
                    if(stripos($found, 'content="WordPress ')   === FALSE)
                        return "";
                    
                    return $found;   
                }
                
                
            
            function _init_remove_dns_prefetch( $saved_field_data )
                {
                 
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    add_filter( 'wph/ob_start_callback',         array(&$this, 'ob_start_callback_remove_dns_prefetch')); 
                    
                }
                
            
            function ob_start_callback_remove_dns_prefetch( $buffer )
                {
                    
                    if(is_admin())
                        return $buffer;
                    
                    $result   = preg_match_all('/(<link([^>]+)rel=("|\')dns-prefetch("|\')([^>]+)?\/?>)/im', $buffer, $founds);
    
                    if(!isset($founds[0])   ||  count($founds[0])    <   1)
                        return $buffer;
    
                    if(count($founds[0]) > 0)
                        {
                            foreach ($founds[0]  as  $found)
                                {
                                    if(empty($found))
                                        continue;
                                        
                                    $buffer =   str_replace($found, "", $buffer);
                                    
                                }
                            
                        }
                    
                    return $buffer;    
                    
                }
            
                
            function _init_remove_resource_hints($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action( 'wp_head',             'wp_resource_hints',               2     );     
                    
                }
            
                
            function _init_remove_wlwmanifest($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action( 'wp_head',       'wlwmanifest_link' );     
                    
                }
                
                
            function _init_remove_feed_links($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action('wp_head',    'feed_links',          2);
                    remove_action('wp_head',    'feed_links_extra',    3);     
                    
                }
                
                
            function _init_disable_json_rest_wphead_link($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;

                    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
                    
                }
                
            function _init_remove_rsd_link($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action('wp_head',    'rsd_link');     
                    
                }
                
                
            function _init_remove_adjacent_posts_rel($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action('wp_head',    'adjacent_posts_rel_link_wp_head',  10,     0);     
                    
                }
                
                
            function _init_remove_profile($saved_field_data)
                {
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    
                    add_filter('wph/ob_start_callback', array($this, 'remove_profile_tag'));     
                    
                }
                
            function remove_profile_tag( $buffer )
                {
                     
                    if(is_admin())
                        return $buffer;
                    
                    $result   = preg_match_all('/(<link([^>]+)rel=("|\')profile("|\')([^>]+)?\/?>)/im', $buffer, $founds);
    
                    if(!isset($founds[0])   ||  count($founds[0])    <   1)
                        return $buffer;
    
                    if(count($founds[0]) > 0)
                        {
                            foreach ($founds[0]  as  $found)
                                {
                                    if(empty($found))
                                        continue;
                                        
                                    $buffer =   str_replace($found, "", $buffer);
                                    
                                }
                            
                        }
                    
                    return $buffer;
                         
                }
                
                
            function _init_remove_canonical($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action(  'wp_head', 'rel_canonical');
                                        
                    //use the earlier possible action to remove the admin canonical url
                    add_action( 'auth_redirect',        array(&$this,   'remove_wp_admin_canonical_url'));
                    
                    //make sure is removed if placed by other plugins
                    add_filter('wph/ob_start_callback', array($this, 'remove_canonical_tag'));
                }
            
            function remove_wp_admin_canonical_url()
                {
                    
                    remove_action(  'admin_head', 'wp_admin_canonical_url'   );                    
                    
                }
                
                
            function remove_canonical_tag( $buffer )
                {
                               
                    if(is_admin())
                        return $buffer;
                    
                    $result   = preg_match_all('/(<link([^>]+)rel=("|\')canonical("|\')([^>]+)?\/?>)/im', $buffer, $founds);
    
                    if(!isset($founds[0])   ||  count($founds[0])    <   1)
                        return $buffer;
    
                    if(count($founds[0]) > 0)
                        {
                            foreach ($founds[0]  as  $found)
                                {
                                    if(empty($found))
                                        continue;
                                        
                                    $buffer =   str_replace($found, "", $buffer);
                                    
                                }
                            
                            
                        }
                    
                    return $buffer;
           
                }


        }
        
?>