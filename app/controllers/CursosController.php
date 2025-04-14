<?php

if(isset($_SERVER['REQUEST_METHOD'])){
  
  require_once "../models/Cursos.php";
  $cursos = new Cursos();

  switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
      header("Content-Type: application/json; charset=utf-8");

      if($_GET["task"]=='getAll'){
        echo json_encode($cursos->getAll());
      }else if($_GET["task"]=='getCategorias'){
        echo json_encode($cursos->getCategorias());
      }else if($_GET["task"]=='getById'){
        echo json_encode($cursos->getById($_GET['idCursos']));
      }
      break;

      case "POST":
        $input = file_get_contents("php://input");
        $dataJSON=json_decode($input,true);

        $registro=[
          "titulo"          =>$dataJSON["titulo"],
          "duracionHoras"   =>$dataJSON["duracionHoras"],
          "nivel"           =>$dataJSON["nivel"],
          "precio"          =>$dataJSON["precio"],
          "fechaInicio"     =>$dataJSON["fechaInicio"],
          "idCategoria"     =>$dataJSON["idCategoria"],

        ];
        $filasAfectadas=$cursos->add($registro);

        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["filas"=>$filasAfectadas]);
      break;
      
      case "PUT":
        header("Content-Type: application/json; charset=utf-8");
      
        $input = file_get_contents("php://input");
        $dataJSON = json_decode($input, true);
      
        $actualizacion = [
          "idCursos"       => $dataJSON["idCursos"],
          "titulo"         => $dataJSON["titulo"],
          "duracionHoras"  => $dataJSON["duracionHoras"],
          "nivel"          => $dataJSON["nivel"],
          "precio"         => $dataJSON["precio"],
          "fechaInicio"    => $dataJSON["fechaInicio"],
          "idCategoria"    => $dataJSON["idCategoria"]
        ];
      
        $filasAfectadas = $cursos->update($actualizacion);
        echo json_encode(["filas" => $filasAfectadas]);
        break;
      

      case "DELETE":
          header("Content-Type: application/json; charset=utf-8");

          $url= $_SERVER['REQUEST_URI'];
          $arrayURL=explode('/',$url);
          $idcursos=end($arrayURL);
          $filasafectadas=$cursos-> delete (['idCursos'=>$idcursos]);
          echo json_encode(['filas'=>$filasafectadas]);
          break;
        
    }
    
}