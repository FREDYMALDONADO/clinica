<?php
include_once 'config.php';
include_once 'class/usuarios.php';
$crud = new crud($conn);
if (isset($_POST['btn-del'])) {
    $id = $_GET['delete_id'];
    $crud->delete($id);
    header("Location:eliminar_users.php?alerta");
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
    <title>DELETE</title>
</head>

<body>
    <div class="container"><br>
        <?php
        if (isset($_GET['alerta'])) {
        ?>
            <div class="alert alert-success">
                <strong>Hecho!</strong> Usuario Eliminado Correcctamente!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger">
                <strong>Alerta!</strong> Esta Seguro que requiere Eliminar el Ususario
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['delete_id'])) {
        ?>
            <table class='table table-bordered'>
                <tr>
                    <th>ID</th>
                    <th>USUARIO</th>
                    <th>EMAIL</th>
                </tr>
                <?php
                $stmt = $conn->prepare("SELECT * FROM tbl_usuario WHERE id=:id");
                $stmt->execute(array(":id" => $_GET['delete_id']));
                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                ?>
                    <tr>
                        <td><?php echo ($row['id']); ?></td>
                        <td><?php echo ($row['username']); ?></td>
                        <td><?php echo ($row['email']); ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        }
        ?>
    </div>
    <div class="container">
        <p>
            <?php
            if (isset($_GET['delete_id'])) {
            ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> Yes</button>
            <a href="admi_users.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> No</a>
        </form>
    <?php
            } else {
    ?>
        <a href="admi_users.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i>Regresar</a>
    <?php
            }
    ?>
    </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>