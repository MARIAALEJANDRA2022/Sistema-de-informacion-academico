<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$correo=$_POST["correo"];
$clave=$_POST["clave"];
$administrador=new Administrador("", "", "", $correo, $clave, "", "", "", "", "", "", "", "", "");
$alumno=new Alumno("", "", "", "", "", $correo, $clave, "", "", "", "", "", "", "", "", "", "");
$docente=new Docente("", "", "", "", "", $correo, $clave, "", "", "", "", "", "", "", "", "", "");
if($administrador->autenticar()){
    $_SESSION["id"]=$administrador->getCodigo();
    $_SESSION["rol"]="administrador";
    header("Location:index.php?pid=".base64_encode("presentacion/sesionAdministrador.php"));
}elseif($alumno->autenticar()){
    $_SESSION["id"]=$alumno->getCodigo();
    $_SESSION["rol"]="alumno";
    header("Location:index.php?pid=".base64_encode("presentacion/sesionAlumno.php"));
}elseif($docente->autenticar()){
    $_SESSION["id"]=$docente->getCodigo();
    $_SESSION["rol"]="docente";
    header("Location:index.php?pid=".base64_encode("presentacion/sesionDocente.php"));
}else{
    header("Location:index.php?error=1");
}