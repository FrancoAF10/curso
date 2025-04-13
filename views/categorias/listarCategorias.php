<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorias</title>
  <!--BoostsTrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--Font Awesone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  

<div class="container mt-5">
  <button type="button" class="btn btn-secondary" onclick="window.location.href='.././categorias/agregarCategorias.php'">Agregar Categorias</button>

  <div class="card mt-3">
    <div class="card-header">Categorias Registradas</div>
    <div class="card-body">
      <table class="table table-striped table-sm" id="tabla-categorias">
        <colgroup>
          <col style="width:15%;"><!--id-->
          <col style="width:60%;"><!--categoria-->
          <col style="width:25%;"><!--acción-->

        </colgroup>
        <thead>
          <tr>
            <th>ID</th>
            <th>CATEGORIAS</th>
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
  
   const tabla=document.querySelector("#tabla-categorias tbody");
  function obtenerDatosCategoria(){
     
    fetch(`../../app/controllers/CategoriasController.php?task=getAll`,{
      method:'GET'
    })
    .then(response =>{return response.json()})
    .then(data =>{
      tabla.innerHTML=``;
      data.forEach(element => {
        tabla.innerHTML+=`
        <tr>
          <td>${element.idCategoria}</td>
          <td>${element.categoria}</td>
          <td>
          
            <a href='editarCategorias.php?idCategoria=${element.idCategoria}' title='Editar' class='btn btn-info btn-sm edit'><i class="fa-solid fa-pencil"></i></a>
            <a href='#' title='Eliminar' data-idcategoria='${element.idCategoria}' class='btn btn-danger btn-sm delete'><i class="fa-solid fa-trash"></i></a>
            
          </td>

        </tr>
        `
      });
    })
    .catch(error =>{console.error(error)});
  }
  document.addEventListener("DOMContentLoaded",()=>{
    obtenerDatosCategoria();
    tabla.addEventListener("click",(event)=>{
      const enlace=event.target.closest('a');
      if(enlace && enlace.classList.contains('delete')){
        event.preventDefault();
        const idcategoria=enlace.getAttribute('data-idcategoria');
          if(confirm("¿Está seguro de eliminar el registro?")){
            fetch(`../../app/controllers/CategoriasController.php/${idcategoria}`,{method:'DELETE'})
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