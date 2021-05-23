<?php
class Usuarios extends BaseDeDatos 
{
  public function __construct()
  {
    $this->conectar();
  }

  public function validarLogin($user,$pass)
  {
    $result = $this->conexion->query(
      "Select * from usuarios where user='{$user}' and password=md5('{$pass}')"
    );

    if ($registro = $result->fetch_assoc()) {
      $registro["token"] = $this->generarToken();
      $this->guardarToken($registro["token"],$user);
      return $registro;
    } else {
      return false;
    }
  }

  private function generarToken()
  {
    $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $upper = str_split($letters);
    $number = range(0,9);
    shuffle($upper);
    shuffle($number);
    $arrayTotal = array_merge($upper,$number);
    $randomKey = array_rand($arrayTotal,1);
    $c = $arrayTotal[$randomKey];
    $time = time();
    $token = sha1($c.$time);
    return $token;
  }

  private function guardarToken($token, $user)
  {
    $this->conexion->query(
      "insert into token set token='{$token}', user='{$user}', ip='{$_SERVER['REMOTE_ADDR']}', fecha=now()"
    );
  }

  public function validarToken($token)
  {
    $result = $this->conexion->query(
      "Select * from token where token='{$token}'"
    );
    $r = parent::getArrayFromResult($result);
    return (count($r) > 0 ? true : false );
  }
}
