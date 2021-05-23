<?php
class ErroresController  
{
  public function __construct($msg = "Entrada no valida")
  {
    $info = array('success' => false, 'msg' => $msg);
    echo json_encode($info);
    exit(0);
  }
}
