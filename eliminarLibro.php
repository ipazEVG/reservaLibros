<?php
require_once 'crud.php';

if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
    $crud = new CRUD();
    $resultado = $crud->borrarLibro($isbn);

    // Redirigir a la lista de libros con un mensaje
    header("Location: listaLibros.php?");
    return 'Libro borrado correctamente';
} else {
    // Si no se envía un ISBN, redirigir con un mensaje de error
    header("Location: listaLibros.php" );
    exit;
}
?>
