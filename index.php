<?php

spl_autoload_register ( function ( $clase ) {
    require ( "$clase.php" );

});

$conexion = new DB();
$familias = $conexion -> obtener_familias ();

if ( isset( $_POST[ 'submit' ] ) ) {
    $familia = $_POST[ 'familia' ];
    $productos = $conexion -> obtener_productos ( $familia );

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css"
          rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <title>Home</title>
</head>
<body>

<form action="index.php" method="post">
    <h1 style="text-align: center">Listado de productos</h1>

    <h1 style="text-align: left">Seleccion de familia</h1>
    <select class="form-control" name="familia" id="">

        <?php
        foreach ( $familias as $familia )
            echo "<option value='{$familia['cod']}'> {$familia['nombre']}</option>"
        ?>

    </select>
    <br>
    <input type="submit" value="Ver productos" name="submit" class="btn btn-primary">
</form>

<?php if ( isset( $productos ) ): ?>
    <hr>
    <fieldset style="margin-left: 50px">
        <legend>Productos editables</legend>

        <?php
        foreach ( $productos as $producto ) {
            echo "<form action='producto.php' method='post'>\n";
            echo "{$producto['nombre_corto']} Precio {$producto['PVP']}€\n ";
            echo "<br>";
            echo "<input type='submit' value='editar' name ='submit' class='btn btn-success'><br />\n";
            echo "<input type='hidden' value='{$producto['cod']}' name ='codigo'><br />\n";
            echo "</form>\n\n";
        }
        ?>

    </fieldset>

<?php endif; ?>

</body>
</html>