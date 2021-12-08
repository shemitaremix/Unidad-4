<?php 
namespace modelos;

class Denuncia extends Conexion
{

	public $id_Denuncia;
	public $id_Usuario;
	public $fecha;
	public $Lugar;
	public $direccion;
	public $Horario;
	public $Descripcion;
	public $Evidencia;
	
	function insert()
	{
		$pre = mysqli_prepare($this->con, "INSERT INTO denuncia (id_Usuario, fecha, Lugar, direccion, Horario, Descripcion, Evidencia) VALUES (?,?,?,?,?,?, ?)");
		$pre->bind_param("issssss",$this->id_Usuario, $this->fecha, $this->Lugar, $this->direccion, $this->Horario, $this->Descripcion,$this->Evidencia);
		$pre->execute();
		return true;
	}

	static function findID($id_Denuncia)
	{
		$me = new \modelos\Conexion();

		$pre = mysqli_prepare($me->con, "SELECT * FROM denuncia WHERE id_Denuncia = ?");
		$pre->bind_param( "i", $id_Denuncia);
		$pre->execute();
		$res = $pre->get_result();
		return $res->fetch_object(Denuncia::class);

	}

	static function findLugar($lugar)
	{
		$me = new \modelos\Conexion();

		$pre = mysqli_prepare($me->con, "SELECT * FROM denuncia WHERE Lugar = ?");
		$pre->bind_param( "s", $lugar);
		$pre->execute();
		$res = $pre->get_result();
		return $res->fetch_all();
	}

	static function all()
	{
		$me = new \modelos\Conexion();

		$pre = mysqli_prepare($me->con, "SELECT * FROM denuncia");
		$pre->execute();
		$res = $pre->get_result();
		return $res->fetch_all();


	}
	function update(){
		$pre = mysqli_prepare($this->con, "UPDATE denuncia SET fecha = ?, Lugar = ?, direccion=?, Horario = ?, Descripcion = ?, Evidencia =? WHERE id_Denuncia = ? ");
		$pre-> bind_param("ssssssi",$this->fecha, $this->Lugar, $this->direccion, $this->Horario, $this->Descripcion, $this->Evidencia, $this->id_Denuncia);
		$pre-> execute();
		return true;
	}

	
	static function delete($id_Denuncia)
	{
		$me = new \modelos\Conexion();

		$pre = mysqli_prepare($me->con, "DELETE FROM denuncia WHERE id_Denuncia = ?");
		$pre->bind_param( "i", $id_Denuncia);
		$pre->execute();
		$res = $pre->get_result();
		echo "Eliminado";
	}

}
 	
?>