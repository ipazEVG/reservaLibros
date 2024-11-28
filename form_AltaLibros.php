<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Alta_libros</title>
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
    <a type="button" href="index.html" id="volver"><img src="img\undo_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" id="imgVolver"></a>
        <h1 id="ltLibro">Alta de Libros</h1>
        <form action="altalibros.php" method="post" accept-charset="UTF-8">
            <div id="cajaForm">
                <label for="titulo">Título</label><br/>
                <input type="text" placeholder="Título" name="titulo"><br/> 

                <label for="isbn">ISBN</label><br/>
                <input type="text" placeholder="ISBN" name="isbn"><br/>

                <label for="editorial">Editorial</label>
                <select id="editorial" name="editorial">
                    <?php
                        // Incluir el archivo CRUD.php para acceder a la clase CRUD
                        require_once 'crud.php';
                            
                            // Crear una instancia de la clase CRUD
                            $mostrarEditorial= new CRUD();
                            $editoriales = $mostrarEditorial->mostrar_editoriales();
                        foreach ($editoriales as $editorial) {
                                echo "<option value='" .$editorial['idEditorial']. "'>" . $editorial['nomEditorial'] . "</option>";
                        }
                    ?>
                </select><br/>
                
                
                <label for="precio">Precio del Libro</label><br/>
                <input type="text" placeholder="Precio" name="precio"><br/>
            </div>
            <input type="submit" value="Enviar" id="enviar">
        </form>
    </main>
    <footer>
        <p>Escuela Virgen de Guadalupe</p>
        <p>Grupo 2</p>
    </footer>
   <div>
</body>
</html>
