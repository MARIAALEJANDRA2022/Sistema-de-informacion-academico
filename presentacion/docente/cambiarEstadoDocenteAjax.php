<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
$docente = new Docente($_GET["id"]);
$docente->consultar();
if ($docente->getEstado()=="Activo"){
    $docente->cambiarEstado("Inactivo");
    echo "<script>alert('Estado cambiado');setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "';\",100);</script>";
}else{
    $docente->cambiarEstado("Activo");
    echo "<script>alert('Estado cambiado');setTimeout(\"location.href = 'index.php?pid=" . base64_encode("presentacion/docente/consultarDocente.php") . "';\",100);</script>";
}
?>