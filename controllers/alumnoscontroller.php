<?php
require "models/alumnos.php";
class alumnosController extends Controller
{
  private $alumnos;
  public function __construct($param1, $param2)
  {
    $this->alumnos = new Alumnos();
    parent::__construct($param1, $param2);
  }

  public function getAll()
  {
    $info = array('success'=>true, 'data'=>$this->alumnos->getAll());
    echo json_encode($info);
  }

  public function getOne()
  {
    if (isset($_POST['idalu'])) {
      $info = array('success'=>true, 'data'=>$this->alumnos->getOne($_POST['idalu']));
    } else {
      $info = array('success'=>false, 'msg'=>'El parametro idalu es obligatorio');
    }
    
    echo json_encode($info);
  }

  public function add()
  {
    if (isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['laboratorio1']) && isset($_POST['laboratorio2']) && isset($_POST['parcial'])) {
      $this->alumnos->add($_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['laboratorio1'], $_POST['laboratorio2'], $_POST['parcial']);
      $info = array('success'=>false, 'msg'=>'Alumno agregado con exito');
    } else {
      $info = array('success'=>false, 'msg'=>'Los parametros nombre, direccion, telefono, laboratorios y parcial son obligatorios');
    }
    echo json_encode($info);
  }

  public function edit()
  {
    if (isset($_POST['idalu']) && isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['laboratorio1']) && isset($_POST['laboratorio2']) && isset($_POST['parcial'])) {
      $this->alumnos->edit($_POST['idalu'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['laboratorio1'], $_POST['laboratorio2'], $_POST['parcial']);
      $info = array('success'=>false, 'msg'=>'Registro actualizado con exito');
    } else {
      $info = array('success'=>false, 'msg'=>'Los parametros idalu, nombre, direccion, telefono, laboratorios y parcial son obligatorios');
    }
    echo json_encode($info);
  }

  public function delete()
  {
    if (isset($_POST['idalu'])) {
      $record = $this->alumnos->getOne($_POST['idalu']);
      if (count($record) > 0) {
        $this->alumnos->delete($_POST['idalu']);
        $info = array('success'=>true, 'msg'=>'Registro eliminado con existo');
      } else {
        $info = array('success'=>false, 'msg'=>'El registro que desea eliminar no existe');
      }
    } else {
      $info = array('success'=>false, 'msg'=>'El parametro idalu es obligatorio');
    }
    
    echo json_encode($info);
  }
}