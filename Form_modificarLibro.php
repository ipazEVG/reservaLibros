<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Modificar Libro</title>
</head>
<body>
    <header>
        <a href="https://fundacionloyola.com/vguadalupe/" target="_blank"><img src="img/logoEVG.png" alt=""></a>
        <nav>
            <a href="">Manual de Reserva</a>
            <a href="">Reserva Presencial</a>
        </nav>
    </header>

    <main>
        <a type="button" href="index.html" id="volver"><img src="img/undo_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" id="imgVolver"></a>
        <h1 id="ltLibro">Modificar Libro</h1>

        <?php
            require_once 'crud.php';
            $crud = new CRUD();

            // Verificar si el ISBN está presente en la URL
            if (isset($_GET['isbn'])) {
                $isbn = $_GET['isbn'];

                // Obtener los detalles del libro desde la base de datos
                $consulta = "SELECT * FROM libros WHERE ISBN = '$isbn'";
                $resultado = $crud->conexion->query($consulta);

                if ($resultado->num_rows > 0) {
                    $libro = $resultado->fetch_assoc();
                } else {
                    echo "No se encontró el libro.";
                    exit;
                }
            } else {
                echo "No se ha proporcionado un ISBN.";
                exit;
            }
        ?>

        <!-- Formulario para modificar el libro -->
        <form action="modificarlibro.php" method="post">
            <div id="cajaForm">
                <label for="titulo">Título</label><br/>
                <input type="text" name="titulo" value="<?php echo $libro['titulo']; ?>"><br/>

                <label for="isbn">ISBN</label><br/>
                <input type="text" name="isbn" value="<?php echo $libro['ISBN']; ?>" readonly><br/>

                <label for="editorial">Editorial</label>
                <select id="editorial" name="editorial">
                    <?php
                        $editoriales = $crud->mostrar_editoriales();
                        foreach ($editoriales as $editorial) {
                            $selected = ($editorial['idEditorial'] == $libro['idEditorial']) ? "selected" : "";
                            echo "<option value='" . $editorial['idEditorial'] . "' $selected>" . $editorial['nomEditorial'] . "</option>";
                        }
                    ?>
                </select><br/>

                <label for="precio">Precio del Libro</label><br/>
                <input type="text" name="precio" value="<?php echo $libro['precio']; ?>"><br/>
            </div>
            <input type="submit" value="Modificar Libro" id="enviar">
        </form>
    </main>

    <footer>
        <p>Escuela Virgen de Guadalupe</p>
        <p>Grupo 2</p>
    </footer>
</body>
</html>
