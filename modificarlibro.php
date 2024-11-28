<?php
header("Refresh: 2; url=index.html");
// Incluir el archivo CRUD.php para acceder a la clase CRUD
require_once 'crud.php';

// Crear una instancia de la clase CRUD
$crud = new CRUD();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $idEditorial = $_POST['editorial'];

    // Llamar al método de modificación de la clase CRUD
    $resultado = $crud->modificarLibro($isbn, $titulo, $precio, $idEditorial);

    // Mostrar el resultado de la modificación
    echo $resultado;
} else {
    // Verificar si el ISBN está presente en la URL para cargar los datos del libro
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
   
}
?>
