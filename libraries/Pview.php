<?php defined('BASEPATH') or exit('No direct script access allowed');

if(!class_exists('Pview'))
{
  class Pview
  {
    
    protected $parent = null;
    protected $available_sections = array();
    protected $current_section = null;
    protected $ci;
    
    public function __construct()
    {
      if (!function_exists('ob_start')){
        trigger_error("Buffering functions 'ob_get_clean' and 'ob_get_clean' are not available. They are necessary for Pview to work properly.");
        exit();
      }
      $this->ci =& get_instance();
    }
    
    public function set_parent($file)
    {
      if (!is_null($this->parent) && $this->parent == $file){
        trigger_error("Infinite loop detected: you can't set twice the same parent.");
        exit();
      }
      $this->parent = $file;
    }
    
    public function content_for($str)
    {
      $this->current_section = $str;
      ob_start();
    }
    
    public function end_content_for()
    {
      if (is_null($this->current_section)){
        trigger_error('No opening content_for() has been triggered.');
        exit();
      }
      $this->available_sections[$this->current_section] = ob_get_clean();
      $this->current_section = null;
    }
    
    public function content_of($str)
    {
      if (!isset($this->available_sections[$str])){
        trigger_error('View for section "'.$str.'" does not exist.');
        exit();
      }
      
      echo $this->available_sections[$str];
    }
    
    public function show()
    {
      if (is_null($this->parent)){
        trigger_error('No parent defined.');
        exit();
      }
      include(APPPATH.'/views/'. $this->parent .'.html.php');
    }
    
    public function content_exists($str)
    {
      return isset($this->available_sections[$str]);
    }
    
    public function __get($name)
    {
      return $this->ci->$name;
    }
  }
}
?>
