<?php
namespace memberpress\courses\controllers;

if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

use memberpress\courses as base;
use memberpress\courses\lib as lib;
use memberpress\courses\models as models;
use memberpress\courses\helpers as helpers;

class Questions extends lib\BaseCtrl {
  public function load_hooks() {
    add_action('init', array($this, 'register_block_types'));
  }

  public function register_block_types() {
    if (!function_exists('register_block_type')) {
      return;
    }

    foreach(models\Question::get_types() as $type) {
      register_block_type( "memberpress-courses/$type-question", array(
        'api_version' => 1,
        'attributes' => array ( 'questionId' => array( 'type' => 'integer', 'default' => 0) ),
        'render_callback' => base\HELPERS_NAMESPACE . '\Questions::render_question',
      ) );
    }
  }
}
