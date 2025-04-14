<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <form action="" autocomplete="off" id="formulario-registro">

      <div class="card mt-2">
        <div class="card-header bg-primary">Registro de Cursos</div>
        <div class="card-body">

          <div class="form-floating mb-2">
            <select name="categoria" id="categoria" class="form-select" >
              <option value="">Seleccione Categoría</option>
            </select>
            <label for="categoria">Categoria</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="titulo" placeholder="Titulo" >
            <label for="Titulo">Titulo</label>
          </div>

          
          <!--Compartir fila-->
          <div class="row g-2">

            <div class="col">

            <div class="form-floating mb-2">
            <input type="number" class="form-control text-end" id="duracion" placeholder="duracion" >
            <label for="duracion">Duracion (Horas)</label>
          </div>  

            </div>
            
            <div class="col">

            <div class="form-floating mb-2">
            <select name="Nivel" id="nivel" class="form-select" >
              <option value="">Seleccione</option>
              <option value="Básico">Básico</option>
              <option value="Intermedio">Intermedio</option>
              <option value="Avanzado">Avanzado</option>

            </select>
            <label for="Nivel">Nivel</label>
          </div>

            </div>
          </div>
           <!--fin fila-->

          <!--Compartir fila-->
          <div class="row g-2">

            <div class="col">

              <div class="form-floating mb-2">
                <input type="number" step="any" class="form-control text-end" id="precio" placeholder="Precio" >
                <label for="precio">Precio</label>
              </div>  

            </div>
            
            <div class="col">

              <div class="form-floating mb-2">
                <input type="date"  class="form-control" id="fecha" placeholder="Fecha" >
                <label for="Fecha">Fecha Inicio</label>
              </div>

            </div>
          </div>
           <!--fin fila-->

        </div>
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-primary" type="submit">guardar</button>
          <button class="btn btn-sm btn-secondary" type="reset">cancelar</button>
  
        </div>
      </div>

    </form>
  </div>   
  <script>
     document.addEventListener("DOMContentLoaded", () => {
    const Seleccionacategoria = document.querySelector("#categoria");     
    fetch("../../app/controllers/CursosController.php?task=getCategorias")
      .then(response => response.json())
      .then(data => {
        //obtenemos las categorias llenando los select
        data.forEach(categoria => {
          Seleccionacategoria.innerHTML += `<option value="${categoria.idCategoria}">${categoria.categoria}</option>`;
        });
      })
      .catch(error => {console.error(error);
      });
    });

    const formulario=document.querySelector("#formulario-registro");
    
    function registrarNuevoCurso(){
      fetch(`../../app/controllers/CursosController.php`,{
        method:'POST',
        headers:{'Content-Type' : 'application/json'},
        body:JSON.stringify({
          idCategoria       :document.querySelector('#categoria').value,
          titulo            :document.querySelector('#titulo').value,
          duracionHoras     :parseInt(document.querySelector('#duracion').value),
          nivel             :document.querySelector('#nivel').value,
          precio            :parseFloat(document.querySelector('#precio').value),
          fechaInicio       :document.querySelector('#fecha').value,

        })
      })
      .then(response =>{return response.json()})
      .then(data => {
        if(data.filas>0){
          formulario.reset();
          window.location.href = "../../views/cursos/listarCursos.php";
          alert("Guardado correctamente");
        }
      })
      .catch(error=> {console.error(error)});
    }
    formulario.addEventListener("submit",function(event){
      event.preventDefault();

      if(confirm("¿Está seguro de registrar?")){
        registrarNuevoCurso();
      }
    });

  </script>
</body>
</html>