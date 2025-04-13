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
              <option value="1">Básico</option>
              <option value="2">Intermedio</option>
              <option value="3">Avanzado</option>

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

    document.addEventListener("DOMContentLoaded",()=>{
    function obtenerRegistro(){

      const URL= new URLSearchParams(window.location.search);
      const idcurso=URL.get('idCursos');

      const parametros=new URLSearchParams();
      parametros.append("task","getById");
      parametros.append("idCursos",idcurso)
      
      fetch(`../../app/controllers/CursosController.php?${parametros}`,{method:'GET'})
      .then(response=>{return response.json()})
      .then(data=>{console.log(data)})
      .catch(error=>{console.error(error)});
      }
      obtenerRegistro();
    });

  </script>
</body>
</html>