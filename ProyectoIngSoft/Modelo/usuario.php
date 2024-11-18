<?php
class Usuario {
    private $nombre;
    private $correo;
    private $contraseña;
    private $rol;

    public function __construct($nombre, $correo, $contraseña, $rol) {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
        $this->rol = $rol;
    }

    private function conectarDB() {
        $conn = new mysqli('localhost', 'root', '', 'gestion_usuarios');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    }

    public function guardar() {
        $conn = $this->conectarDB();
        $mensaje = '';
        
        try {
            // Verificar si el correo ya existe
            $check_sql = "SELECT id FROM usuarios WHERE correo = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("s", $this->correo);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            
            if ($result->num_rows > 0) {
                $check_stmt->close();
                $conn->close();
                return "Error: El correo ya está registrado";
            }
            $check_stmt->close();
            
            $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $this->nombre, $this->correo, $this->contraseña, $this->rol);
            
            if ($stmt->execute()) {
                $mensaje = "Usuario creado con éxito";
            } else {
                $mensaje = "Error: " . $stmt->error;
            }
            
            $stmt->close();
            
        } catch (Exception $e) {
            $mensaje = "Error: " . $e->getMessage();
        }
        
        $conn->close();
        return $mensaje;
    }

    public static function obtenerUsuarios($pagina = 1, $porPagina = 10) {
        $conn = new mysqli('localhost', 'root', '', 'gestion_usuarios');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        
        $inicio = ($pagina - 1) * $porPagina;
        $usuarios = [];
        
        try {
            $sql = "SELECT id, nombre, correo, rol FROM usuarios LIMIT ? OFFSET ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $porPagina, $inicio);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            
            $stmt->close();
            
        } catch (Exception $e) {
            error_log("Error al obtener usuarios: " . $e->getMessage());
        }
        
        $conn->close();
        return $usuarios;
    }

    public static function contarUsuarios() {
        $conn = new mysqli('localhost', 'root', '', 'gestion_usuarios');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        
        $total = 0;
        
        try {
            $sql = "SELECT COUNT(*) as total FROM usuarios";
            $resultado = $conn->query($sql);
            $total = $resultado->fetch_assoc()['total'];
        } catch (Exception $e) {
            error_log("Error al contar usuarios: " . $e->getMessage());
        }
        
        $conn->close();
        return $total;
    }

    public static function obtenerPorId($id) {
        $conn = new mysqli('localhost', 'root', '', 'gestion_usuarios');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        
        try {
            $sql = "SELECT id, nombre, correo, rol FROM usuarios WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $usuario = $result->fetch_assoc();
            
            $stmt->close();
            $conn->close();
            
            return $usuario;
        } catch (Exception $e) {
            error_log("Error al obtener usuario: " . $e->getMessage());
            return null;
        }
    }
    
    public static function actualizar($id, $nombre, $correo, $contraseña = null, $rol) {
        $conn = new mysqli('localhost', 'root', '', 'gestion_usuarios');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        
        try {
            if ($contraseña !== null) {
                // Si se proporciona contraseña, actualizarla también
                $sql = "UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ?, rol = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $hashedPassword = password_hash($contraseña, PASSWORD_BCRYPT);
                $stmt->bind_param("ssssi", $nombre, $correo, $hashedPassword, $rol, $id);
            } else {
                // Si no se proporciona contraseña, actualizar solo los otros campos
                $sql = "UPDATE usuarios SET nombre = ?, correo = ?, rol = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $nombre, $correo, $rol, $id);
            }
            
            $result = $stmt->execute();
            $stmt->close();
            $conn->close();
            
            return $result;
        } catch (Exception $e) {
            error_log("Error al actualizar usuario: " . $e->getMessage());
            return false;
        }
    }
    
    public static function eliminar($id) {
        $conn = new mysqli('localhost', 'root', '', 'gestion_usuarios');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        
        try {
            $sql = "DELETE FROM usuarios WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            
            $result = $stmt->execute();
            $stmt->close();
            $conn->close();
            
            return $result;
        } catch (Exception $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
}
?>