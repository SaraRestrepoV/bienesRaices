<?php
    //base de datos

    require '../../includes/config/database.php';
    $db = conectarDB();

    //Arreglo con mensajes de error
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    //Ejecutar el código después de que el usuario envía el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //echo "<pre>";
        //var_dump($_POST);
        //echo "</pre>";

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedorId = $_POST['vendedor'];

        if (!$titulo) {
            $errores[] = "Debes añadir un título";
        };
        if (!$precio) {
            $errores[] = "El precio es obligatorio";
        };
        if (strlen($descripcion) < 50) {
            $errores[] = "La descripción es obligatoria y debe tener mínimo 50 caracteres";
        };
        if (!$habitaciones) {
            $errores[] = "Debes añadir la cantidad de habitaciones";
        };
        if (!$wc) {
            $errores[] = "Debes añadir la cantidad de baños de la propiedad";
        };
        if (!$estacionamiento) {
            $errores[] = "Debes añadir la cantidad de espacios de estacionamiento de la propiedad";
        };
        if (!$vendedorId) {
            $errores[] = "Elige un vendedor";
        };

        //echo "<pre>";
        //var_dump($errores);
        //echo "</pre>";

        //Revisar que el arreglo de errores esté vacío

        if (empty($errores)) {
            //Insertar en la base de datos

            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId)
            VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId' )";

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                echo "Insertado correctamente";
            }
        } else {

        }
    };

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde"> Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título propiedad" value="<?php echo $titulo;?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio;?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpej, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones;?>">;

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc;?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="0" max="9" value="<?php echo $estacionamiento;?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">--Seleccione--</option>
                    <option value="1">Karen</option>
                    <option value="2">Sara</option>
                </select>

                <input type="submit" value="Crear Propiedad" class="boton boton-verde">
            </fieldset>
        </form>
    </main>

    <?php
    incluirTemplate('footer');
?>