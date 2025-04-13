<?php
require_once "../config/Database.php";
class Cursos{
  private $conexion;
  public function __construct() {
    $this->conexion = Database::getConexion();
  }
  /**
   * Devuelve un conjunto de cursos contenidos en un arreglo
   * @return array
   */
  public function getAll(): array{
    $sql="SELECT * FROM vista_cursos";
    $stmt = $this->conexion->prepare($sql); //preparación
    $stmt->execute(); //ejecución
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno
  }
  public function getCategorias(): array{
    $sql="SELECT * FROM CATEGORIA ";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
  }
  /**
   * Registra un nuevo curso en la base de datos
   * @param mixed $params
   * @return int
   */
  public function add($params = []): int{
   $sql="CALL spu_registrar_cursos (?,?,?,?,?,?)";
   $stmt = $this->conexion->prepare($sql);
   $stmt->execute(
    array(
      $params["titulo"],
      $params["duracionHoras"],
      $params["nivel"],
      $params["precio"],
      $params["fechaInicio"],
      $params["idCategoria"]
    )
    );
    return $stmt->rowCount();
  }
  public function update($params = []): int{
    return 0;
  }
  public function delete($params = []): int{
    $sql= "DELETE FROM CURSOS WHERE idCursos=?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array(
        $params["idCursos"],
      )
      );
    return $stmt->rowCount();
  }
  public function getById ($idcursos): array{
    $sql= "SELECT * FROM CURSOS WHERE idCursos=?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array($idcursos)
      );  
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
}

