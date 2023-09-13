<?php
include "../conexion/conexion.php";
$conexion = conectar2();
$nombreCamp = $_POST['nombre_camp'];
$lugar = $_POST['lugar_camp'];
$anio = $_POST['year'];
$fecha = $_POST['fecha'];
$rama_id = $_POST['rama'];
$archivos = $_FILES["archivos"];

$numero_archivos = count($archivos["name"]);

for ($i = 0; $i < $numero_archivos; $i++) {

	$tipo_mime = mime_content_type($archivos["tmp_name"][$i]);
	$tipos_imagen_admitidos = array("image/jpeg", "image/png", "image/gif", "image/jpg", "video/mp4", "video/ogg", "video/webm", "video/wmv");

if(!in_array($tipo_mime, $tipos_imagen_admitidos)){
	echo "<script>alert('El archivo $archivo no es una imagen o video'); window.location='subirFotos.php'</script>";
}else{
	$nombre_base = basename($archivos["name"][$i]);
	$nombre_final = date("d-m-y")."-".date("H-i-s")."-".$nombre_base;

	if (in_array($tipo_mime, array("video/mp4", "video/ogg", "video/webm", "video/wmv"))) {
		$ruta_video = "../videosSubidos/".$nombre_final;
		move_uploaded_file($archivos["tmp_name"][$i], $ruta_video);
	} else {
		$ruta = "../FotosSubidas/".$nombre_final;
		move_uploaded_file($archivos["tmp_name"][$i], $ruta);
	}
	$sql = "INSERT INTO fotos(nombreCamp,lugarCamp,anioCamp,fecha,id_rama,ruta,ruta_video) VALUES ('$nombreCamp','$lugar','$anio','$fecha','$rama_id','$ruta','$ruta_video')";
	$resultado = mysqli_query($conexion,$sql);
	if($resultado){
		echo "<script>alert('Se han enviado los archivos correctamente'); window.location='subirFotos.php'</script>";
	}else{
		printf("Errormessage: %s\n",mqli_error($conexion));
	}
}
}
?>
