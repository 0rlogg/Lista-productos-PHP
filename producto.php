<?php


spl_autoload_register(function ($clase) {
    require("$clase.php");
});

$conexion = new DB();
$codigo = $_POST['codigo'];
$producto = $conexion->obtener_producto($codigo);

if (isset($_POST['submit'])){
    header('index.php');
}

if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $nombre_corto = $_POST['nombre_corto'];
    $cod = $_POST['codigo'];
    $pvp = floatval($_POST['pvp']);
    $descripcion = $_POST['descripcion'];
    $resultado = $conexion->modificar_datos($nombre, $nombre_corto, $descripcion, $pvp, $cod);
    $producto = $conexion->obtener_producto($codigo);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edición productos</title>
    <style>
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
</head>
<body>
<div>

<form name="edicionproducto" action="index.php" method="post">
<h1>Datos del producto</h1>
    <label for="codigo">Codigo : </label>
<input type="text" name="codigo" value="<?php echo $producto['cod'] ?>" id="" ><br />
    <label for="codigo">Nombre :  </label>
<input type="text" name="nombre" value="<?php echo $producto['nombre'] ?>" id=""><br />
    <label for="codigo">Nombre Corto  : </label>
<input type="text" name="nombre_corto" value="<?php echo $producto['nombre_corto'] ?>" id=""><br />
    <label for="codigo">PVP : </label>
<input type="text" name="pvp" value="<?php echo $producto['PVP'] ?>" id=""><br />
    <label for="codigo">Descripcion : </label>
<input type="text" name="descripcion" id="" value = '<?php echo $producto['descripcion'] ?>'><br />
<input type="submit" value="Volver"> <input type="submit" onclick="edicionproducto.action='producto.php';" name="actualizar" value="Actulizar">
</div>
</form>
</body>
</html>