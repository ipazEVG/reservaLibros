<?php
// require_once 'formAltaLibros.php';
require_once 'crud.php';

// Recoger los datos del formulario
$titulo = $_POST['titulo'];
$isbn = $_POST['isbn'];
$idEditorial = $_POST['editorial']; 
$precio = $_POST['precio'];

// Validar que los datos no estén vacíos
if (empty($titulo) || empty($isbn) || empty($idEditorial) || empty($precio)) {
    header("Refresh: 2; url=index.html");
    echo "Tienes que rellenar los campos.";
}else{
  // Crear una instancia de CRUD de insertar el libro
$crud = new CRUD();
$resultado = $crud -> insertarLibro($titulo, $isbn, $idEditorial, $precio);
  header("Refresh: 2; url=index.html");
  echo 'Libro insertado correctamente.';
}

?>
