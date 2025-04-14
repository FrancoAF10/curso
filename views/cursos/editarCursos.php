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
          <button class="btn btn-sm btn-primary" type="submit">Actualizar</button>
          <button class="btn btn-sm btn-secondary" type="reset">cancelar</button>
  
        </div>
      </div>

    </form>
  </div>     
  <script>
  document.addEventListener("DOMContentLoaded", () => {
  const URL = new URLSearchParams(window.location.search);
  const idCurso = URL.get("idCursos");

  // obtenemos los datos dentro de las casillas
  function llenarFormulario(curso) {
    document.querySelector("#titulo").value = curso.titulo;
    document.querySelector("#duracion").value = curso.duracionHoras;
    document.querySelector("#nivel").value = curso.nivel;
    document.querySelector("#precio").value = curso.precio;
    document.querySelector("#fecha").value = curso.fechaInicio;
    document.querySelector("#categoria").value = curso.idCategoria; 
  }


  function obtenerCurso() {
    const parametros = new URLSearchParams();
    parametros.append("task", "getById");
    parametros.append("idCursos", idCurso);

    fetch(`../../app/controllers/CursosController.php?${parametros}`, { method: "GET" })
      .then(response => response.json())
      .then(data => {
        if (data.length > 0) {
          llenarFormulario(data[0]); 
        }
      })
      .catch(error => console.error(error));
  }
//cargamos las categorias en el select
  function obtenerCategoria() {
    fetch(`../../app/controllers/CursosController.php?task=getCategorias`, { method: "GET" })
      .then(response => response.json())
      .then(data => {
        const selectCategoria = document.querySelector("#categoria");
        data.forEach(categoria => {
          const option = document.createElement("option");
          option.value = categoria.idCategoria;
          option.textContent = categoria.categoria;  
          selectCategoria.appendChild(option);
        });
      })
      .catch(error => console.error(error));
  }

  function actualizarCurso(event) {
    event.preventDefault();  

    // obtenemos los datos
    const titulo = document.querySelector("#titulo").value;
    const duracion = document.querySelector("#duracion").value;
    const nivel = document.querySelector("#nivel").value;
    const precio = document.querySelector("#precio").value;
    const fecha = document.querySelector("#fecha").value;
    const categoria = document.querySelector("#categoria").value;

    // Creamos un objeto con los datos a enviar
    const cursoActualizado = {
      idCursos: idCurso,  // obtenemo el id porque va a ser el registro que se va a usar
      titulo: titulo,
      duracionHoras: duracion,
      nivel: nivel,
      precio: precio,
      fechaInicio: fecha,
      idCategoria: categoria
    };

    fetch("../../app/controllers/CursosController.php", {
      method: "PUT", 
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(cursoActualizado)
    })
      .then(response => response.json())
      .then(data => {
        if (data.filas > 0) {
          alert("Actualización exitosa");
          window.location.href = "../../views/cursos/listarCursos.php";
        } else {
          alert("No se pudo actualizar el curso");
        }
      })
      .catch(error => console.error(error));
  }

  const formulario = document.querySelector("#formulario-registro");
  formulario.addEventListener("submit", function(event) {
  event.preventDefault();

  if (confirm("¿Está seguro de actualizar este curso?")) {
    actualizarCurso(event);  
  }
});

  obtenerCurso();  
  obtenerCategoria();  
});

</script>

</body>
</html>