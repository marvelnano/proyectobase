<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Módulo</title>
</head>

<body style="background: #fff;">
    <div class="container">
        <div class="row" style="border-radius: 8px; margin: 20px; padding: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
            <legend>Crear Módulo</legend>
            <label class="col col-3">Módulo</label>
            <div class="col col-4">            
                <input class="modulo" type="text" style="width: 100%;" />
            </div>
            <div class="col col-3">
                <span>Ingrese nombre de módulo en minúsculas</span>
            </div> 
            <div class="col col-2">             
                <button class="btn-primary crearModulo">Grabar</button>
            </div>          
        </div>

        <div class="row" style="border-radius: 8px; margin: 20px; padding: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
            <legend>Crear Controlador</legend>
            <label class="col col-3">Controlador</label>
            <div class="col col-4">            
                <input class="controlador" type="text" style="width: 100%;" />
            </div>
            <div class="col col-3">            
                <span>Ingrese nombre de controlador sin espacios y la primera palabra en mayúscula</span>
            </div>  
            <div class="col col-2">             
                <button class="btn-primary crearControlador">Grabar</button>
            </div>
        </div>
    <div>
</body>

</html>