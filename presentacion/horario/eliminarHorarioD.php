<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if($_SESSION["rol"] == "administrador"){
    $horario = new HorarioD();
    $horario -> eliminar($_GET["id"],$_GET["materia"], $_GET["grupo"]);
    echo "<script>alert('Horario Eliminado');window.location = 'index.php?pid=".base64_encode("presentacion/horario/consultarHorarioD.php")."';</script>";
}else{
    echo "Lo siento. Usted no tiene permisos";
}
?>