<?php
include_once "functions.php";
$conexion = conectar_bd();

// $id, llega desde index.php
$row = consultar_tabla($conexion, "dbo.vistaminuta", '"No_CartaCompromiso" = ' . $id);
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
            font-size: 0.9em !important;
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

        <p class="text-center font-weight-bold" style="white-space: pre-line;">
            VICERRECTORÍA DE PROYECCIÓN UNIVERSITARIA
            PRÁCTICAS ACADÉMICAS
        </p>

        <p>Manizales, <?php echo_date($row['FechaCreacion']);?></p>

        <p class="text-center font-weight-bold">
            CARTA COMPROMISO N° <?php echo $row['No_CartaCompromiso']; ?> AL CONVENIO <?php echo strtoupper($row['TipoConvenio']); ?> N° <?php echo $row['No_Convenio']; ?>
        </p>

        <p class="text-justify">
            <b>LA UNIVERSIDAD DE CALDAS Y <?php echo strtoupper($row['NombreEmpresa_Convenio']); ?></b>, firmamos
            convenio <?php echo strtolower($row['TipoConvenio']); ?> de <?php echo_date($row['FechaFirma_Convenio']);?> por un
            período de <?php echo ($row['DuracionAnos_Convenio'] > 0) ? ($row['DuracionAnos_Convenio'] . " año(s)") : ($row['DuracionMeses_Convenio'] . " mes(es)"); ?>,
            con prórroga <?php echo strtolower($row['ProrrogaConvenio']); ?>, para el desarrollo de actividades
            conjuntas entre ellas las prácticas académicas, institucionales y pasantías, presentamos
            el estudiante que adelantará la practica en el <?php echo $row['PeriodoPractica']; ?> periodo académico de <?php echo $row['AnoPractica']; ?>.
        </p>

        <table>
            <tr>
                <td class="custom-col-1">FACULTAD:</td>
                <td class="custom-col-2">
                    <b><?php echo strtoupper($row['FacultadEstudiante']); ?></b>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">PROGRAMA:</td>
                <td class="custom-col-2">
                    <b><?php echo strtoupper($row['ProgramaEstudiante']); ?></b>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">PRACTICA ACADEMICA DE:</td>
                <td class="custom-col-2">
                    <b><?php echo strtoupper($row['NombreCompleto_Estudiante']); ?></b>
                    <br>C.C. <?php echo $row['CedulaEstudiante']; ?>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">ACTIVIDADES:</td>
                <td class="custom-col-2">
                    <?php $actividades = explode(";", $row['ObjetivosEspecificos_Practica']);?>
                    <?php for ($i = 1; $i < count($actividades); $i++) {?>
                        <b><?php echo $i . "."; ?></b> <?php echo $actividades[$i - 1]; ?>
                        <br>
                    <?php }?>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">ASESOR <?php echo strtoupper($row['NombreEmpresa_Convenio']); ?>:</td>
                <td class="custom-col-2">
                    <b><?php echo strtoupper($row['NombreCompleto_Responsable']); ?></b>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">ASESOR UNICALDAS:</td>
                <td class="custom-col-2">
                    <b><?php echo strtoupper($row['NombreCompleto_Docente']); ?></b>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">DURACIÓN:</td>
                <td class="custom-col-2">
                    Desde el <?php echo_date($row['IniciaPractica']);?> y hasta el <?php echo_date($row['FinalizaPractica']);?>.
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">APOYO ECONOMICO:</td>
                <td class="custom-col-2">
                    <b>$<?php echo number_format($row['TotalRemuneracion']); ?></b> con cargo al CDP Nº <?php echo $row['No_CDP']; ?>, para ser
                    <br>cancelados así:
                    <?php $valores = explode(",", substr($row['Valores_Pagos'], 1, -1));?>
                    <?php $fechas = explode(",", substr($row['Fechas_Pagos'], 1, -1));?>
                    <?php for ($i = 0; $i < count($valores); $i++) {?>
                        <br><b><?php echo $i + 1 . "."; ?></b> Cuota de $<?php echo number_format($valores[$i]); ?> el <?php echo_date(substr($fechas[$i], 1, -1));?>
                    <?php }?>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">NOTA:</td>
                <td class="custom-col-2">
                    <?php echo $row['Anotaciones']; ?>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">NOTA:</td>
                <td class="custom-col-2">
                    La práctica se adelantara de manera <?php echo strtolower($row['ModalidadPractica']); ?>.
                </td>
            </tr>
        </table>

        <br>
        <p class="text-justify">
            La presente carta de compromiso se perfecciona con la firma del Ordenador de Gasto, el
            Asesor Institucional, el Asesor Académico y el estudiante. Para constancia se firma en
            Manizales, <?php echo_date($row['FechaCreacion']);?>.
        </p>

        <table class="table table-borderless">
            <tr>
                <td>
                    <br><br><br>
                    <b><?php echo strtoupper($row['NombreCompleto_Responsable']); ?></b>
                    <br><?php echo ucfirst($row['CargoResponsable']); ?>
                    <br>Asesor Institucional
                    <br><?php echo ucfirst($row['NombreEmpresa_Convenio']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <br><br><br>
                    <b><?php echo strtoupper($row['NombreCompleto_Docente']); ?></b>
                    <br>Docente
                    <br>Coordinador de Práctica
                    <br>Universidad de Caldas
                </td>
                <td>
                    <br><br><br>
                    <b><?php echo strtoupper($row['NombreCompleto_Estudiante']); ?></b>
                    <br>Prácticante
                    <br><?php echo ucfirst($row['ProgramaEstudiante']); ?>
                    <br>Universidad de Manizales
                </td>
            </tr>
            <tr>
                <td style="font-size: 0.6em;">
                    <br><br>
                    <b>Proyecto:</b> Esperanza Román
                    <br>Profesional Especializado
                    <br>Vicerrectoría de Proyección Universitaria
                </td>
            </tr>
        </table>
    </div>
</body>

</html>