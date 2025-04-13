<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!--BoostsTrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--Font Awesone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  

<div class="container">
  <button type="button" class="btn btn-secondary" onclick="window.location.href='.././cursos/registrarCursos.php'">Agregar Curso</button>
  <div class="card mt-3">
    <div class="card-header">Lista de Cursos Registrados</div>
    <div class="card-body">
      <table class="table table-striped table-sm" id="tabla-Cursos">
        <colgroup>
          <col style="width:5%;"><!--id-->
          <col style="width:17%;"><!--Categoria-->
          <col style="width:17%;"><!--Titulo-->
          <col style="width:11%;"><!--Duración-->
          <col style="width:15%;"><!--Nivel-->
          <col style="width:10%;"><!--Precio-->
          <col style="width:15%;"><!--Fecha-->
          <col style="width:10%;"><!--acciones-->
        </colgroup>
        <thead>
          <tr>
            <th>ID</th>
            <th>CATEGORIA</th>
            <th>TITULO</th>
            <th>DURACION (HORAS)</th>
            <th>NIVEL</th>
            <th>PRECIO</th>
            <th>FECHA INICIO</th>
            <th>ACCIONES</th>

          </tr>
        </thead>

        <tbody>
        <!-- Contenido de forma dinámica -->
        </tbody>

      </table>
    </div>
  </div>
</div>
<script>
 
   const tabla=document.querySelector("#tabla-Cursos tbody");
  function obtenerDatos(){
     

    fetch(`../../app/controllers/CursosController.php?task=getAll`,{
      method:'GET'
    })
    .then(response =>{return response.json()})
    .then(data =>{
      tabla.innerHTML=``;
      data.forEach(element => {
        tabla.innerHTML+=`
        <tr>
          <td>${element.idCursos}</td>
          <td>${element.categoria}</td>
          <td>${element.titulo}</td>
          <td>${element.duracionHoras}</td>
          <td>${element.nivel}</td>
          <td>${element.precio}</td>
          <td>${element.fechaInicio}</td>
          <td>
          
            <a href='editarCursos.php?idCursos=${element.idCursos}' title='Editar' class='btn btn-info btn-sm edit'><i class="fa-solid fa-pencil"></i></a>
            <a href='#' title='Eliminar' data-idcursos='${element.idCursos}' class='btn btn-danger btn-sm delete'><i class="fa-solid fa-trash"></i></a>
            
          </td>

        </tr>
        `
      });
    })
    .catch(error =>{console.error(error)});
  }
  document.addEventListener("DOMContentLoaded",()=>{
    obtenerDatos();
    tabla.addEventListener("click",(event)=>{

      const enlace=event.target.closest('a');
      if(enlace && enlace.classList.contains('delete')){
        event.preventDefault();
        const idcursos=enlace.getAttribute('data-idcursos');
          if(confirm("¿Está seguro de eliminar el registro?")){
            fetch(`../../app/controllers/CursosController.php/${idcursos}`,{method:'DELETE'})
            .then(response =>{return response.json()})
            .then(datos=>{
              if(datos.filas>0){

                const filaEliminar=enlace.closest('tr');
                if (filaEliminar){filaEliminar.remove();}
              }
            })
            .catch(error=>{console.error(error)});
          }
      }
    });
  });
</script>
</body>
</html>