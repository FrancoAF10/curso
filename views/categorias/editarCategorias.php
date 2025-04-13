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
            <div class="card-header bg-primary">Actualizar Categoria</div>
            <div class="card-body">

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="categoria" placeholder="Categoria" >
                    <label for="categoria">Categoria</label>
                </div>

            </div>
            <div class="card-footer text-end">
            <button class="btn btn-sm btn-primary" type="submit">Actualizar</button>
            <button class="btn btn-sm btn-secondary" type="reset">cancelar</button>
    
            </div>
        </div>
    </form>
</div>
<script>

    document.addEventListener("DOMContentLoaded",()=>{
    function obtenerRegistroCurso(){

      const URL= new URLSearchParams(window.location.search);
      const idcategoria=URL.get('idCategoria');

      const parametros=new URLSearchParams();
      parametros.append("task","getById");
      parametros.append("idCategoria",idcategoria)
      
      fetch(`../../app/controllers/CategoriasController.php?${parametros}`,{method:'GET'})
      .then(response=>{return response.json()})
      .then(data=>{console.log(data)})
      .catch(error=>{console.error(error)});
        
      }
      obtenerRegistroCurso();
    });

  </script>
</body>
</html>