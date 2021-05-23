<?php
class Alumnos extends BaseDeDatos 
{
  public function __construct()
  {
    $this->conectar();
  }

  public function getAll()
  {
    $result = $this->conexion->query(
      "Select idalu, nombre, direccion, telefono, laboratorio1, laboratorio2, parcial, ((laboratorio1*0.25)+(laboratorio2*0.25)+(parcial*0.5)) as notaFinal from alumnos"
    );
    return $this->getArrayFromResult($result);
  }

  public function getOne($id)
  {
    $result = $this->conexion->query(
      "Select idalu, nombre, direccion, telefono, laboratorio1, laboratorio2, parcial, ((laboratorio1*0.25)+(laboratorio2*0.25)+(parcial*0.5)) from alumnos where idalu='{$id}'"
    );
    return $this->getArrayFromResult($result);
  }

  public function add($nombre, $direccion, $telefono, $laboratorio1, $laboratorio2, $parcial)
  {
    $result = $this->conexion->query(
      "insert into alumnos set nombre='{$nombre}', direccion='{$direccion}', telefono='{$telefono}, laboratorio1='{$laboratorio1}, laboratorio2='{$laboratorio2}, parcial='{$parcial}'"
    );
    return true;
  }

  public function edit($idalu, $nombre, $direccion, $telefono, $laboratorio1, $laboratorio2, $parcial)
  {
    $result = $this->conexion->query(
      "update alumnos set nombre='{$nombre}', direccion='{$direccion}', telefono='{$telefono}', laboratorio1='{$laboratorio1}, laboratorio2='{$laboratorio2}, parcial='{$parcial}' where idalu='{$idalu}'"
    );
    return true;
  }

  public function delete($id)
  {
    $this->conexion->query(
      "delete from alumnos where idalu='{$id}'"
    );
    return true;
  }
}
