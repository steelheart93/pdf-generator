<?php
include_once "functions.php";
$conexion = conectar_bd();

// $id, llega desde index.php
$row = consultar_tabla($conexion, "dbo.vistapractica", '"IdPractica" = ' . $id);
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <title>PDF Generator</title>

    <!-- Custom CSS -->
    <style>
        body {
            font-size: 0.7em !important;
        }
        .custom-col-1{
            vertical-align: top;
            font-weight: bold;
            width: 220px;
        }
        .custom-col-2{
            text-align: justify;
        }
        td {
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-right">
            <img src="<?php echo encode_img_base64("logo.jpg"); ?>">
        </div>

        <table class="table">
            <tr>
                <td class="custom-col-1"><h5>PROPUESTA DE PRÁCTICA</h5></td>
                <td>
                <p class="text-right"><?php echo_date($row['FechaDiligenciamiento']);?></p>
                </td>
            </tr>
        </table>

        <p class="text-center"><b>INFORMACIÓN DEL ESTUDIANTE</b></p>
        <table class="table table-bordered">
            <tr>
                <td><b>Código:</b></td>
                <td><?php echo $row['CodigoEstudiante']; ?></td>
            </tr>
            <tr>
                <td><b>Nombres:</b></td>
                <td><?php echo $row['NombresEstudiante']; ?></td>
            </tr>
            <tr>
                <td><b>Apellidos:</b></td>
                <td><?php echo $row['ApellidosEstudiante']; ?></td>
            </tr>
            <tr>
                <td><b>Correo electrónico:</b></td>
                <td><?php echo $row['CorreoEstudiante']; ?></td>
            </tr>
            <tr>
                <td><b>Teléfono:</b></td>
                <td><?php echo $row['TelefonoEstudiante']; ?></td>
            </tr>
            <tr>
                <td><b>Docente asignado:</b></td>
                <td><?php echo $row['NombreCompleto_Docente']; ?></td>
            </tr>
        </table>

        <br><br>
        <p class="text-center"><b>INFORMACIÓN DE LA PRÁCTICA</b></p>
        <table class="table table-bordered">
            <tr>
                <td colspan=2><b>Tipo de práctica:</b></td>
                <td colspan=2><?php echo $row['TipoPractica']; ?></td>
            </tr>
            <tr>
                <td colspan=2><b>Entidad donde desarrolla la práctica:</b></td>
                <td colspan=2><?php echo $row['NombreEmpresa_Convenio']; ?></td>
            </tr>
            <tr>
                <td colspan=2><b>Dependencia donde desarrolla la práctica:</b></td>
                <td colspan=2><?php echo $row['DependenciaPractica']; ?></td>
            </tr>
            <tr>
                <td colspan=2><b>Fecha de inicio:</b></td>
                <td colspan=2><?php echo_date($row['IniciaPractica']);?></td>
            </tr>
            <tr>
                <td colspan=2><b>Fecha de terminación:</b></td>
                <td colspan=2><?php echo_date($row['FinalizaPractica']);?></td>
            </tr>
            <tr>
                <td colspan=2><b>Horario previsto:</b></td>
                <?php $hEntrada = $row['HoraEntrada_Practica'];?>
                <?php $hSalida = $row['HoraSalida_Practica'];?>
                <td colspan=2><?php echo "Entrada a las $hEntrada - Salida a las $hSalida"; ?></td>
            </tr>
            <tr>
                <td><b>Horas de trabajo semanales:</b></td>
                <td><?php echo $row['HorasSemanales_Practica']; ?></td>
                <td><b>Práctica remunerada:</b></td>
                <td><?php echo $row['Remuneracion_Practica'] ? "SI" : "NO"; ?></td>
            </tr>
            <tr>
                <td colspan=2><b>Nombre del funcionario responsable de la entidad:</b></td>
                <td colspan=2><?php echo $row['NombreCompleto_Responsable']; ?></td>
            </tr>
            <tr>
                <td colspan=2><b>Cargo del funcionario:</b></td>
                <td colspan=2><?php echo $row['CargoResponsable']; ?></td>
            </tr>
            <tr>
                <td colspan=2><b>Teléfono del funcionario:</b></td>
                <td colspan=2><?php echo $row['TelefonoResponsable']; ?></td>
            </tr>
            <tr>
                <td colspan=2><b>Correo electrónico del funcionario:</b></td>
                <td colspan=2><?php echo $row['CorreoResponsable']; ?></td>
            </tr>
        </table>

        <br><br>
        <p class="text-center"><b>DESARROLLO DE LA PRÁCTICA</b></p>
        <table class="table table-bordered">
            <tr>
                <td><b>Principal área tématica de la práctica:</b></td>
                <td><?php echo $row['ObjetivoGeneral_Practica']; ?></td>
            </tr>
            <tr>
                <td><b>Principales funciones a desarrollar:</b></td>
                <td>
                    <?php $funciones = explode(";", $row['ObjetivosEspecificos_Practica']);?>
                    <?php for ($i = 1; $i < count($funciones); $i++) {?>
                        <b><?php echo $i . "."; ?></b> <?php echo $funciones[$i - 1]; ?>
                        <br>
                    <?php }?>
                </td>
            </tr>
        </table>

        <table class="table table-bordered">
            <tr>
                <td><b>Producto esperado en el desarrollo de la práctica</b></td>
                <td><b>Fecha de entrega</b></td>
            </tr>
            <?php $descripciones = explode(",", substr($row['Descripciones_Productos'], 1, -1));?>
            <?php $fechas = explode(",", substr($row['Fechas_Productos'], 1, -1));?>
            <?php for ($i = 0; $i < count($descripciones); $i++) {?>
                <tr>
                    <td><b><?php echo $i + 1 . "."; ?></b><?php echo $descripciones[$i]; ?></td>
                    <td><?php echo_date(substr($fechas[$i], 1, -1));?></td>
                </tr>
            <?php }?>
        </table>

        <br><br>
        <p class="text-center"><b>INFORMACIÓN PARA EL PROFESOR</b></p>
        <table class="table table-bordered">
            <tr>
                <td><b>Descripción del informe</b></td>
                <td><b>Fecha de entrega</b></td>
            </tr>
            <?php $descripciones = explode(",", substr($row['Descripciones_Informes'], 1, -1));?>
            <?php $fechas = explode(",", substr($row['Fechas_Informes'], 1, -1));?>
            <?php for ($i = 0; $i < count($descripciones); $i++) {?>
                <tr>
                    <td><b><?php echo $i + 1 . "."; ?></b><?php echo $descripciones[$i]; ?></td>
                    <td><?php echo_date(substr($fechas[$i], 1, -1));?></td>
                </tr>
            <?php }?>
        </table>

        <br><br><br>
        <table class="table table-borderless">
            <tr>
                <td>
                    <div class=border><br><br><br><br></div>
                    <br>
                    <b>Firma del estudiante solicitante</b>
                    <br><?php echo $row['NombresEstudiante'] . " " . $row['ApellidosEstudiante']; ?>
                </td>
                <td>
                    <div class=border><br><br><br><br></div>
                    <br>
                    <b>Firma del profesor asignado</b>
                    <br><?php echo $row['NombreCompleto_Docente']; ?>
                </td>
                <td>
                    <div class=border><br><br><br><br></div>
                    <br>
                    <b>Firma del funcionario responsable</b>
                    <br><?php echo $row['NombreCompleto_Responsable']; ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>