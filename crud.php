<?php
// Definición de la clase CRUD para gestionar operaciones con una base de datos
class CRUD {
    //-------------------------Conexión con la base de datos--------------------------------------------
       
        public $conexion; // Propiedad para almacenar la conexión con la BD

        // Constructor que se ejecuta automáticamente al crear una instancia de la clase
        public function __construct() {
            // Crea la conexión con la BD
            $this->conexion = new mysqli('localhost', 'root', '', 'proyectoreserva');

            // Control de errores. Verificar si hubo un error en la conexión
            if ($this->conexion->connect_error) {
                exit("Conexión fallida: ". $this->conexion->connect_error);
            }
        }
        
    // --------------------------------------Método insertar Libros------------------------------------
            public function insertarLibro($titulo, $isbn, $idEditorial, $precio ) {
                // Crear la consulta SQL para insertar el libro
                $insertarlibro = "INSERT INTO libros (ISBN, titulo, precio, idEditorial) VALUES ('$isbn', '$titulo', $precio, $idEditorial)";
                
                // Ejecuta la consulta
                if ($this->conexion->query($insertarlibro)) {
                    // Si fue exitosa devuelve un menxaje 
                    return 'Libro insertado correctamente.';
                } else {
                    // si no lo fue,  devuelve el mensaje de error
                    return 'Error al insertar libro: ' . $this->conexion->error;
                }
            }

    //---------------------------------------- Método mostrar editoriales ---------------------------
        public function mostrar_editoriales(){
            // Crea la consulta SQL para obtener todas las editoriales
            $consultaEditorial = "SELECT idEditorial, nomEditorial FROM editorial";
            $resultado = $this ->conexion->query($consultaEditorial);
            
             // Control de errores. Verifica si la consulta se ejecutó correctamente
            if (!$resultado) {
                exit("Error en la consulta: ". $this->conexion->error);

            }
            
            // verifica si la consulta a la base de datos devolvió las filas 
            if ($resultado->num_rows > 0) {
                // Con while recorremos cada fila de los resultados y con fetch_assoc()  toma una fila de la base de datos y la convierte en un array asociativo. Cada vez que el bucle pasa, guarda esa fila en una variable llamada $fila.
                while ($fila = $resultado->fetch_assoc()) {
                    $editoriales[] = $fila; // agregamos cada fila al array $editoriales. 
                    
                }
            } else {
                // Si no hay resultados, mostrar un mensaje
                return "No se encontraron editoriales.";
            }
            return $editoriales; // Devuelve el array con las editoriales
        }    


    //----------------------------------------Método listado de libro --------------------------------
    public function listarLibros() {
       // Creamos una consulta SQL para listar libros con el nombre de la editorial
        $consulta = "SELECT titulo, isbn, precio, nomEditorial , fechas_altas FROM libros
            INNER JOIN editorial ON libros.idEditorial = editorial.idEditorial ORDER BY fechas_altas DESC";
        // Se ejecuta la consulta
        $resultado = $this->conexion->query($consulta);

        // // Verificar si hay resultados
        if ($resultado->num_rows > 0) {
            $libros = []; // Guardamos los datos en el array $libros

            //Recorremos cada fila de los resultados y lo convertimos en un array asociativo con fetch_assoc(), Cada vez que el bucle pasa, guarda esa fila en una variable llamada $fila.
            while ($fila = $resultado -> fetch_assoc()) {
                $libros[] = $fila; // Agregamos cada fila al array $libros
            }
            return $libros; // Retorna el array $libros 
        } else {
            return []; // Retorna un array vacío si no hay resultados
        }
    }
    
    
    // --------------------------------------Metodo borrar Libros------------------------------------
        public function borrarLibro($isbn){
            // Creamos una consulta para eliminar los libros
            $borrarLibro = "DELETE FROM libros WHERE isbn ='$isbn'";
            $resultado = $this->conexion->query($borrarLibro);

            // Verificar cuántas filas fueron afectadas
            $fila_afectada = $this->conexion->affected_rows;
            if($fila_afectada > 0) {
                return 'Se ha eliminado correctamente.';
            } else {
                return 'No se ha eliminado correctamente.';
            }
        }
    // ------------------------------------------Método modificar libro-------------------------------
        public function modificarLibro($isbn, $titulo, $precio, $idEditorial) {
            // Hacer la consulta para modificar los datos del libro
            $modificarLibro = "UPDATE libros SET titulo = '$titulo', precio = $precio, idEditorial = $idEditorial WHERE ISBN = '$isbn'";

            // Ejecutar la consulta
            if ($this->conexion->query($modificarLibro)) {
                // Verificar si alguna fila fue afectada 
                if ($this->conexion->affected_rows > 0) {
                    // Si se modificó el libro
                    return 'Libro modificado correctamente.';
                } else {
                    // Si no se afectó ninguna fila
                    return 'No se realizaron cambios, verifica los datos.';
                }
            } else {
                // Si hubo un error
                return 'Error al modificar el libro: ' . $this->conexion->error;
            }
        }

}

?>
