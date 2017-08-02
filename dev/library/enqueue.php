<?php

function juju_enqueue() {
  wp_register_style( 'juju_main', get_template_directory_uri() . '/assets/stylesheets/main.css' );
  wp_register_script( 'juju_app', get_template_directory_uri() . '/assets/scripts/app.js', array(), false, true );

  wp_enqueue_style( 'juju_main' );
  wp_enqueue_script( 'juju_app' );
}

add_action( 'wp_enqueue_scripts', 'juju_enqueue' );