<?php
namespace Models;

class Usuario extends Conexion
{
    public $id_Usuario; 
    public $Nombre;
    public $Apellido;   
    public $Edad;
    public $Ocupacion;
    public $Telefono;
    public $Correo;
    public $Contrasena;


    function insert()
    {
        //$this->Fecha_Registro= date("Y-m-d");
        $pre = mysqli_prepare($this->con, "INSERT INTO usuario(Nombre, Apellido, Edad, Ocupacion, Telefono, Correo, Contrasena) VALUES (?,?,?,?,?,?,?)");
        $pre-> bind_param("sssssss",$this->Nombre, $this->Apellido, $this->Edad, $this->Ocupacion, $this->Telefono,$this->Correo, $this->Contrasena);
        $pre-> execute();

    #   $pre_ =mysqli_prepare($this->con, "SELECT LAST_INSERT_ID() id_Usuario");

    #   $pre_->execute();

    #   $r= $pre_->get_result();

    #   $this->id_Usuario= $r->fetch_assoc()["id_Usuario"];

        
    }


    static function selectAll()
    {
        $me = new Conexion();
        $pre = mysqli_prepare($me->con, "SELECT * FROM usuario");
        $pre->execute();
        $res = $pre->get_result();

        $usuarios = [];
        while ($usuario = $res->fetch_object(Usuario::class)){
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    static function find($id)
    {
        $me = new Conexion();
        $pre = mysqli_prepare($me->con, "SELECT * FROM usuario WHERE id_Usuario= ?");
        $pre->bind_param("i", $id);
        $pre->execute();
        $res = $pre->get_result();

        return $res->fetch_object(Usuario::class);
    }

    static function findByEmail($email){
        $me = new Conexion();
        $pre = mysqli_prepare($me->con, "SELECT * FROM usuario where Correo=?");
        $pre->bind_param("s", $email);
        $pre->execute();
        $re = $pre->get_result();
        echo json_encode($re);
        return $re->fetch_object(Usuario::class);
    }

    function nombreCompleto()
    {
        return $this->nombre . " " . $this->apellido;
    }


    

    function update(){
        $pre = mysqli_prepare($this->con, "UPDATE usuario SET Nombre=?, Apellido = ?, Edad = ?, Ocupacion = ?, Telefono = ?, Correo =?, Contrasena = ? WHERE id_Usuario = ? ");
        $pre-> bind_param("sssssssi",$this->Nombre, $this->Apellido, $this->Edad, $this->Ocupacion, $this->Telefono,$this->Correo, $this->Contrasena, $this->id_Usuario);
        $pre-> execute();
        return true;
    }
}