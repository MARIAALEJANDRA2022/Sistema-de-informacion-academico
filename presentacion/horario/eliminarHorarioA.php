<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if($_SESSION["rol"] == "administrador"){
    $horario = new HorarioA();
    $horario -> eliminar($_GET["id"],$_GET["materia"]);
    $actualizar = new curso($_GET["materia"], $_GET["grupo"]);
    $actualizar->consultar();
    $actualizar -> actualizar($actualizar->getCantidad_estudiantes()-1, $actualizar->getCupos_disponibles()+1, $_GET["materia"], $_GET["grupo"]);
    echo "<script>alert('Horario Eliminado');window.location = 'index.php?pid=".base64_encode("presentacion/horario/consultarHorarioA.php")."';</script>";
}else{
    echo "Lo siento. Usted no tiene permisos";
}
?>