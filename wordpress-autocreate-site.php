<?php
/**
 * Plugin Name: Autocreate Site
 * Plugin URI: http://www.puhsd.org
 * Description: It Creates a website for a user on user creation
 * Version: 1.0.0
 * Author: Slobodan Stevanovic
 * Author URI: http://www.puhsd.org
 */



add_action( 'user_register', 'autocreate_site_action' );


function autocreate_site_action( $user_id ) {

      $user_info = get_userdata($user_id);
      $parts = explode("@", $user_info->user_email);
      $site_name = str_replace(".","-",$parts[0]);

      $current_site = get_current_site();
      $domain = strtolower( $site_name );
      $newdomain = $current_site->domain;
      $path      = $current_site->path . $domain . '/';
      $title = "{$site_name} Title";
      // $user_id = email_exists($email);
      $meta = array(
              'public' => 1
      );

      wpmu_create_blog( $newdomain, $path, $title, $user_id, $meta, $current_site->id );
      remove_user_from_blog($user_id, '1');


}
