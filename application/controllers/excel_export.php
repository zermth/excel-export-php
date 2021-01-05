<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_export extends CI_Controller {
 
  function index()
  {
    $this->load->library('excel'); // load Excel Library
    $object_excel = new PHPExcel();     

    $this->load->model('excel_export_model'); // load model
    $this->db->select("id,name_en");
    $this->db->from('microsite');   
    $query = $this->db->get()->result();      

    foreach($query as $key=>$item){ // key will set up array
      $projectid = $item->id;
      $projectname = $item->name_en;
      $export_data = $this->excel_export_model->fetch_data($projectid);
      $name = $projectname;     
      $curdir= getcwd();

      $dir= $curdir."\daily_report_excel"."/$name";

          if(!is_dir($dir))
          {
            mkdir($dir,0777,true); 
          }                  
    
    $object_excel->setActiveSheetIndex(0); // Create new worksheet
    $table_head = array('ID','Title','Name','Surename' ,'email' ,'Phone','campaign','line id','projectrent','shoptype','budget','unittype','unitsize','budget range','post query','time','project name'); //Set the names of header cells
    $head = 0;
  
    foreach($table_head as $value)
    {
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow($head, 1, $value);
    $head++;
    }
 
    $body = 2;//Add some data
    if($export_data == null){

    }else{
    foreach($export_data as $row)
    {
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(0,$body,$row->user_register_id);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(1,$body,$row->title);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(2,$body,$row->name);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(3,$body,$row->surename);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(4,$body,$row->email);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(5,$body,$row->phone);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(6,$body,$row->campaign);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(7,$body,$row->line_id);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(8,$body,$row->project_rent);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(9,$body,$row->shop_type);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(10,$body,$row->budget);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(11,$body,$row->unit_type);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(12,$body,$row->unit_size);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(13,$body,$row->budget_range);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(14,$body,$row->post_query);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(15,$body,$row->time);
    $object_excel->getActiveSheet()->setCellValueByColumnAndRow(16,$body,$projectname);
    
    foreach(range('A','Z') as $columnID) {
      $object_excel->getActiveSheet()->getColumnDimension($columnID)
          ->setAutoSize(true);
  }
    $body++;
    }

    $yesterday = date("d-m-y", strtotime("yesterday"));
    
    $object_excel_writer = PHPExcel_IOFactory::createWriter($object_excel, 'Excel5');// Explain format of Excel data
    $filename = $projectname."(".$yesterday.")".".xls";
    $curdir= getcwd().'\daily_report_excel/';
     $dir= $curdir.$projectname.'/'.$filename;
     $object_excel_writer->save($dir); 

    }
    }

  }   
}
      

  
 


