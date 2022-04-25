<?php
session_start();
include('config.php');
include_once 'class/cliente.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$crud = new crudcliente($conn);
//validacion del boton actualizar
if (isset($_POST['btn-update'])) {
    
    $id = $_GET['edit_id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $enfemedad = $_POST['enfermedad'];
    $dui = $_POST['dui'];

    // print_r([$id, $nombre, $direccion, $telefono, $dui]);

    //hace referencia a la funcion update
    if ($crud->update($id, $nombre,$apellido,$edad, $direccion, $telefono,$enfemedad, $dui)) {
        $msg = "<b>WOW, Actualizacion exitosa!</b>";
    } else {
        $msg = "<b>ERROR, algo anda mal</b>";
    }
}
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    extract($crud->getID($id));
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once "menu.php" ?>
    <title>PACIENTES</title>
</head>

<body>

    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
                <h3>ACTUALIZAR PACIENTE</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" value="<?php echo $nombre; ?>" class="form-control" type="text" name="nombre">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" value="<?php echo $apellido; ?>" class="form-control" type="text" name="apellido">
                        </div>
                    <div class="form-group">
                        <label for="edad">Edad</label>
                        <input id="edad" value="<?php echo $edad; ?>" class="form-control" type="text" name="edad">
                        </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input id="direccion" value="<?php echo $direccion; ?>" class="form-control" type="text" name="direccion">
                        </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input id="telefono" value="<?php echo $telefono; ?>" class="form-control" type="text" name="telefono">
                        </div>
                        
                    <div class="form-group">
                        <label for="enfermedad">Enfermedas del paciente</label>
                        <input id="enfermedad" value="<?php echo $enfermedad; ?>" class="form-control" type="text" name="enfermedad">
                        </div>
                    <div class="form-group">
                        <label for="dui">Dui</label>
                        <input id="dui" value="<?php echo $dui; ?>" class="form-control" type="text" name="dui">
                    </div><br>
                    <button class="btn btn-primary" name="btn-update" type="submit">Actualizar</button>
                </form>
            </div>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>