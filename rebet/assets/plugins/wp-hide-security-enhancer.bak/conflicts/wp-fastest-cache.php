<?php


    class WPH_conflict_handle_wp_fastest_cache
        {
                        
            static function init()
                {
                    add_action('plugins_loaded',        array('WPH_conflict_handle_wp_fastest_cache', 'wpcache') , -1);    
                }                        
            
            static function is_plugin_active()
                {
                    
                    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                    
                    if(is_plugin_active( 'wp-fastest-cache/wpFastestCache.php' ))
                        return TRUE;
                        else
                        return FALSE;
                }
            
            static public function wpcache()
                {   
                    if( !   self::is_plugin_active())
                        return FALSE;
                    
                    global $wph;
                    
                    //add bufer filtering for sueprcache plugin when using css/js combine functionality
                    add_filter('wpfc/file_get_contents_curl', array($wph, 'url_replace'), 999);
                    
                    add_filter('wpfc/cache/callback', array($wph, 'url_replace'), 999);
                    
                               
                }
                            
        }


?>