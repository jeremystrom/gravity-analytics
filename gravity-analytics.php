<?php

/*
Plugin Name: Gravity Forms + Google Analytics
Plugin URI: http://www.sheltoninteractive.com
Description: Hooks google analytics event tracking to Gravity Forms ajax submissions. Inspired by <a href="http://www.nvisionsolutions.ca/gravity-forms-scalable-event-tracking-google-analytics/" target="_blank">this post</a>.
Version: 0.1
Author: Jeremy Strom | Shelton Interactive
Author Email: jeremy@sheltoninteractive.com
License:

  Copyright 2011 Jeremy Strom (jeremy@sheltoninteractive.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

class gravity_analytics {

  /*--------------------------------------------*
   * Constants
   *--------------------------------------------*/
  const name = 'Gravity Analytics';
  const slug = 'gravity_analytics';

  /**
   * Constructor
   */
  function __construct() {
    //register an activation hook for the plugin
    register_activation_hook(__FILE__, array($this, 'install_gf_analytics'));

    //Hook up to the init action
    add_action('init', array($this, 'init_gf_analytics'));
  }

  /**
   * Runs when the plugin is activated
   */
  function install_gf_analytics() {
    // do not generate any output here
  }

  /**
   * Runs when the plugin is initialized
   */
  function init_gf_analytics() {
    add_action("gform_get_form_filter", array($this, "gform_event_tracking_labels"), 10, 2);
    if(!is_admin()) {
      $url = plugins_url('js/gf-analytics.js', __FILE__);
      wp_enqueue_script(self::slug, $url, null, null, true);
    }
  }

  public function gform_event_tracking_labels($form_string, $form) {
    $script = '<script>';
    $script .= 'if (window.gf_event_form_labels === undefined){ window.gf_event_form_labels = new Object(); }';
    $script .= 'window.gf_event_form_labels[' . $form['id'] . '] = "Form: ' . strip_tags($form['title']) . ' ID: ' . $form['id'] . '";';
    $script .= '</script>';
    return $form_string . $script;
  }
} // end class
new gravity_analytics();

?>