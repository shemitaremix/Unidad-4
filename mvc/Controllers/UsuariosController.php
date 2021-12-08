<?php
use Models\Usuario;

include "Models/Conexion.php";
include "Models/Usuario.php";

class UsuariosController
{
    
    function __construct(){
        
    }
    public function elpapu(){
        echo "Hola tu nombre es:". $_GET["nombre"]." tienes " . $_GET["años"]. "años, tu correo seria ". $_GET["correo"]. "de misma manera que tu telefono es ". $_GET["telefono"]. " con la contraseña ". $_GET["contraseña"]. "y tu sexo ". $_GET["sexo"] . "desde el controlador ";
    }

    public function saludar(){
        echo "Hola desde el controlador de usuarios";        
    }

    public function testEncriptar()
    {
        echo password_hash("123", PASSWORD_DEFAULT);
    }

    // action index
    public function index() 
    {
        $idUsuario = $_SESSION["usuario"];
        // Sesión está iniciada correctamente
        $usuario = Usuario::find($idUsuario);
        require_once "Views/racks/inicio.html";
        echo "<script>alert('algo')</script>";
    }

    public function mydenuncias(){

    }

    public function create()
    {
        if(isset($_POST)) {
            echo "Registrado";
            $usuario = new \Models\Usuario();

            $usuario->Nombre = $_POST["nombre"];
            $usuario->Apellido = $_POST["apellido"];
            $usuario->Edad = $_POST["edad"];
            $usuario->Ocupacion = $_POST["ocupacion"];
            $usuario->Telefono = $_POST["telefono"];
            $usuario->Correo = $_POST["correo"];
            $usuario->Contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);;
            $usuario->insert();
            echo json_encode(["status" => "success", "Usuario" => $usuario]);
            $_SESSION["flash"] = "CUENTA CREADA";
                    header("Location:/cliente_servidor_1/?controller=Usuarios&action=login");
        }
    }

    public function login()
    {
        require_once "Views/login.php";
    }

    public function createview()
    {
        require_once "Views/create.php";
    }

    
}