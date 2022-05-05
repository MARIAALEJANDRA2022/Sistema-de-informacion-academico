<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php 
$alumno = new Alumno($_GET["id"]);
$alumno->consultar();
if ($alumno->getEstado()=="Activo"){
    $alumno->cambiarEstado("Inactivo");
    //echo "<i class='fas fa-user-alt-slash' data-toggle='tooltip' data-placement='bottom' title='Deshabilitado'></i>";
    echo "<script>alert('Estado cambiado');setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/alumno/consultarAlumno.php") . "';\",100);</script>";
    
}else{
    $alumno->cambiarEstado("Activo");
    //echo "<i class='fas fa-user-alt' data-toggle='tooltip' data-placement='bottom' title='Habilitado'></i>";
    echo "<script>alert('Estado cambiado');setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/alumno/consultarAlumno.php") . "';\",100);</script>";
}
?>
