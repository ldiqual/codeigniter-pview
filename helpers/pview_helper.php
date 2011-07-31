<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('set_parent')) {
  function set_parent() {
    return call_user_func_array(array(get_instance()->pview, 'set_parent'), func_get_args());
  }
}

if (!function_exists('content_for')) {
  function content_for() {
    return call_user_func_array(array(get_instance()->pview, 'content_for'), func_get_args());
  }
}

if (!function_exists('end_content_for')) {
  function end_content_for() {
    return call_user_func_array(array(get_instance()->pview, 'end_content_for'), func_get_args());
  }
}

if (!function_exists('content_of')) {
  function content_of() {
    return call_user_func_array(array(get_instance()->pview, 'content_of'), func_get_args());
  }
}

if (!function_exists('show')) {
  function show() {
    return call_user_func_array(array(get_instance()->pview, 'show'), func_get_args());
  }
}

if (!function_exists('content_exists')) {
  function content_exists() {
    return call_user_func_array(array(get_instance()->pview, 'content_exists'), func_get_args());
  }
}

?>
