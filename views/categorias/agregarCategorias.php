<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
<div class="container">
    <form action="" autocomplete="off" id="formulario-registro-categoria">

      <div class="card mt-2">
            <div class="card-header bg-primary">Registro de Categoria</div>
            <div class="card-body">

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="categoria" placeholder="Categoria" >
                    <label for="categoria">Categoria</label>
                </div>

            </div>
            <div class="card-footer text-end">
            <button class="btn btn-sm btn-primary" type="submit">guardar</button>
            <button class="btn btn-sm btn-secondary" type="reset">cancelar</button>
    
            </div>
        </div>
    </form>
</div>
    <script>

    const formulario=document.querySelector("#formulario-registro-categoria");

    function registrarCategoria(){
      fetch(`../../app/controllers/CategoriasController.php`,{
        method:'POST',
        headers:{'Content-Type' : 'application/json'},
        body:JSON.stringify({
          categoria          :document.querySelector('#categoria').value,
        })
      })
      .then(response =>{return response.json()})
      .then(data => {
        if(data.filas>0){
          formulario.reset();
          window.location.href = "../../views/categorias/listarCategorias.php";
          alert("Guardado correctamente");
        }
      })
      .catch(error=> {console.error(error)});
    }
    formulario.addEventListener("submit",function(event){
      event.preventDefault();

      if(confirm("¿Está seguro de registrar?")){
        registrarCategoria();
      }
    });

  </script>
</body>
</html>