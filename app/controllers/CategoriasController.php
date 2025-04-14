<?php

if(isset($_SERVER['REQUEST_METHOD'])){
  
  require_once "../models/Categorias.php";
  $categoria = new Categoria();

  switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
      header("Content-Type: application/json; charset=utf-8");
      if($_GET["task"]=='getAll'){
        echo json_encode($categoria->getAll() );
      }else if($_GET["task"]=='getById'){
        echo json_encode($categoria->getById($_GET['idCategoria']));
      }
      break;

      case "POST":
        $input = file_get_contents("php://input");
        $dataJSON=json_decode($input,true);

        $registro=[
          "categoria"     =>$dataJSON["categoria"],
        ];
        $filasAfectadas=$categoria->add($registro);


        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["filas"=>$filasAfectadas]);
      break;

      case "PUT":
        $input = file_get_contents("php://input");
        $dataJSON = json_decode($input, true);

        $registro = [
            "idCategoria" => $dataJSON["idCategoria"],
            "categoria"   => $dataJSON["categoria"]
        ];

        $filasAfectadas = $categoria->update($registro);

        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["filas" => $filasAfectadas]); 
        break;
      
      case "DELETE":
          header("Content-Type: application/json; charset=utf-8");
          $url= $_SERVER['REQUEST_URI'];
          $arrayURL=explode('/',$url);
          $idCategoria=end($arrayURL);

          $filasafectadas=$categoria-> delete (['idCategoria'=>$idCategoria]);
          echo json_encode(['filas'=>$filasafectadas]);
          break;
        
    }
    
}