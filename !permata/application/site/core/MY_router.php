<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//PATCHES 404_override issues with autoloading libraries, see 3 lines below

class MY_Router extends CI_Router {
   
   
   
   /**
     * Validates the supplied segments.  Attempts to determine the path to
     * the controller.
     *
     * @access    private
     * @param    array
     * @return    array
     */
    function _validate_request($segments)
    {
        if (count($segments) == 0)
        {
            return $segments;
        }

        // Does the requested controller exist in the root folder?
        if (file_exists(APPPATH.'controllers/'.str_replace('-', '_', $segments[0]).EXT))
        {
            return $segments;
        }

        // Is the controller in a sub-folder?
        if (is_dir(APPPATH.'controllers/'.$segments[0]))
        {
            // Set the directory and remove it from the segment array
            $this->set_directory($segments[0]);
            $segments = array_slice($segments, 1);

            if (count($segments) > 0)
            {
                // Does the requested controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().str_replace('-', '_', $segments[0]).EXT))
                {
                    show_404($this->fetch_directory().$segments[0]);
                }
            }
            else
            {
                // Is the method being specified in the route?
                if (strpos($this->default_controller, '/') !== FALSE)
                {
                    $x = explode('/', $this->default_controller);

                    $this->set_class($x[0]);
                    $this->set_method($x[1]);
                }
                else
                {
                    $this->set_class($this->default_controller);
                    $this->set_method('index');
                }

                // Does the default controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.EXT))
                {
                    $this->directory = '';
                    return array();
                }

            }

            return $segments;
        }


        // If we've gotten this far it means that the URI does not correlate to a valid
        // controller class.  We will now see if there is an override
        if ( ! empty($this->routes['404_override']))
        {
            $x = explode('/', $this->routes['404_override']);

            $this->set_class($x[0]);
            $this->set_method(isset($x[1]) ? $x[1] : 'index');

            return $x;
        }


       /** @Daryl: redirects to a central controller, allows you to avoid writing a controller for each URL (class / method)  **/
       $this->set_class('static_content');
       $this->set_method('index');    
       return array('static_content', 'index', $segments[0]); 
       
        
        
        // Nothing else to do at this point but show a 404
        show_404($segments[0]);
    } 
    
    /**
    * @Daryl: override
    * 
    */
    function set_class($class)
    {
       $class_n = str_replace(array('/', '.'), '', $class);  
       $class_n = str_replace('-', '_', $class_n);  
       //echo $class_n."<br />";
       $this->class = $class_n;
    }
    
    /**
    * @Daryl: override
    * 
    */
    function set_method($method)
    {
        $method_n = str_replace('-', '_', $method);
        //echo $method_n."<br />";
        $this->method = $method_n;
    }
    
    
}