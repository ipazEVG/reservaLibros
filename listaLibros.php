<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body id="body1">
    <header>
        <a href="https://fundacionloyola.com/vguadalupe/" target="_blank"><img src="img/logoEVG.png" alt=""></a>
        <nav>
            <a href="">Manual de Reserva</a>
            <a href="">Reserva Presencial</a>
        </nav>
    </header>
    <div class="container">
        <a type="button" href="index.html" id="volver"><img src="img\undo_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" id="imgVolver"></a>
        <h1>Lista de libros</h1>
        <article>
        <?php
            require_once 'crud.php';
            $crud = new CRUD();
            $libros = $crud->listarLibros(); // Obtener la lista de libros

            if (!empty($libros)) {
                // Iterar sobre los libros y mostrarlos
                foreach ($libros as $libro) {
                    echo '<div class="list-item">';
                    echo '<span class="titulo">' .$libro['titulo'] . ' / '.$libro['isbn']. ' /'.$libro['nomEditorial']. ' /'.$libro['precio']. '€</span>';
                    echo '<div class="boton-fecha">';
                    //Botón modificar en el formulário 
                    echo '<a type="button" href="Form_modificarLibro.php?isbn=' . $libro['isbn'] . '" class="btn-modificar">Modificar</a>';
                      // Botón eliminar en un formulario
                        echo '<form method="POST" action="eliminarLibro.php" id = "formeliminar";">'; 
                        echo '<input type="hidden" name="isbn" value="' . $libro['isbn'] . '">';
                        echo '<button type="submit" class="btn-eliminar">Eliminar</button>';
                        echo '</form>';
                    
                    echo '<span class="fecha"> '.$libro['fechas_altas']. '</span>';
                    echo '</div></div><br/>';
                }
            } else {
                // Si no hay libros, muestra un mensaje
                echo '<div class="message error"><p>No se encontraron libros dados de alta.</p></div>';
            }
            ?>
        </article>
    </div>
    <footer>
            <p>Escuela Virgen de Guadalupe</p>
            <p>Grupo 2</p>
        </footer>
</body>
</html>
