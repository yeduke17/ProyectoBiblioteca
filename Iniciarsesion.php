<?php
$mensaje = null;

if ($_SERVER["REQUEST_METHOD"] == "POST"):
require_once "conexionBD.php";	    

$sql = "select * from informacion_usuario where nombre = ? and id_Usuario = ?;";		

    $datos = $conexion->prepare($sql);
    $datos->bind_param('ss',$_REQUEST['txtNombre'],$_REQUEST['txtid_Usuario']);
    $datos->execute();
    $datos = $datos->get_result();
    if($fila =$datos->fetch_assoc()):
        session_start();
        $_SESSION['idUsuario'] = $fila['id_Usuario'];
        $_SESSION['usuario'] = $fila['nombre'];		
        header('Location: biblioteca.php');
    else:
    $mensaje = "
        <div class='alert alert-danger' role='alert'>
            Datos incorrectos
        </div>
        ";
    endif;
endif;
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Inicio de sesión</title>
</head>
<body>
<div class="container">
<h1 class="text-center" style = "margin-top:50px;">Biblioteca Red En Familia</h1>
<h2 class="text-center">Inicio de sesión</h1>
<form method="post" action="Iniciarsesion.php">
<div class="mb-3">
    <label for="InputCed1" class="form-label">Nombre</label>
    <input type="text" class="form-control" name = "txtNombre" id="InputCed1" required>
</div>
<div class="mb-3">
    <label for="InputPassword1" class="form-label">Password</label>
    <input type="password" name = "txtid_Usuario" class="form-control" id="InputPassword1" required>
</div>

<button type="submit" class="btn btn-primary">Ingresar</button>
</form> 

</div>
<?=$mensaje;?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>