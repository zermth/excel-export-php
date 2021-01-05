<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CreateDir extends CI_Controller{

    function index(){
       
        $this->db->select("name");
        $this->db->from('microsite');
        $query = $this->db->get();       
        if ($query->num_rows()) {
          foreach ($query->result_array() as $row) { 
              $name = $row['name'];        
              $curdir= getcwd();

              $dir= $curdir."\Project"."/$name";
      
                  if(!is_dir($dir))
                  {
                    mkdir($dir,0777,true); 
                  }                  
            }       
        } 
    }
}


?>