
<?php
class Excel_export_model extends CI_Model
{
 function fetch_data($id)
 {    

  $query = $this->db->get_where("user_register",array('id'=>$id));
  return $query->result();
 }

 
}
