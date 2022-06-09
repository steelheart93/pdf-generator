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
                <td><?php echo $row['CodigoEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Nombres:</b></td>
                <td><?php echo $row['NombresEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Apellidos:</b></td>
                <td><?php echo $row['ApellidosEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Correo electrónico:</b></td>
                <td><?php echo $row['CorreoEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Teléfono:</b></td>
                <td><?php echo $row['TelefonoEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Docente asignado:</b></td>
                <td><?php echo $row['NombreCompleto_Docente'] ?></td>
            </tr>
        </table>

        <br><br>
        <p class="text-center"><b>INFORMACIÓN DE LA PRÁCTICA</b></p>
        <table class="table table-bordered">
            <tr>
                <td><b>Tipo de práctica:</b></td>
                <td><?php echo $row['TipoPractica'] ?></td>
            </tr>
            <tr>
                <td><b>Entidad donde desarrolla la práctica:</b></td>
                <td><?php echo $row['NombresEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Dependencia donde desarrolla la práctica:</b></td>
                <td><?php echo $row['ApellidosEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Fecha de inicio:</b></td>
                <td><?php echo_date($row['CorreoEstudiante'])?></td>
            </tr>
            <tr>
                <td><b>Fecha de terminación:</b></td>
                <td><?php echo_date($row['CorreoEstudiante'])?></td>
            </tr>
            <tr>
                <td><b>Horario previsto:</b></td>
                <td><?php echo $row['TelefonoEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Horas de trabajo semanales:</b></td>
                <td><?php echo $row['TelefonoEstudiante'] ?></td>
            </tr>
            <tr>
                <td><b>Práctica remunerada:</b></td>
                <td><?php echo $row['TelefonoEstudiante'] ?></td>
            </tr>
        </table>


        <p class="text-justify">
            <b>LA UNIVERSIDAD DE CALDAS Y <?php echo strtoupper($row['NombreEmpresa_Convenio']); ?></b>, firmamos
            convenio TipoConvenio de FechaFirma_Convenio por un
            con prórroga ProrrogaConvenio, para el desarrollo de actividades
            conjuntas entre ellas las prácticas académicas, institucionales y pasantías, presentamos.
        </p>

        <table>
            <tr>
                <td class="custom-col-1">FACULTAD:</td>
                <td class="custom-col-2">
                    <b>FacultadEstudiante']); ?></b>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">PROGRAMA:</td>
                <td class="custom-col-2">
                    <b>ProgramaEstudiante']); ?></b>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">PRACTICA ACADEMICA DE:</td>
                <td class="custom-col-2">
                    <b>NombreCompleto_Estudiante']); ?></b>
                    <br>C.C. CedulaEstudiante']; ?>
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
                <td class="custom-col-1">ASESOR UNICALDAS:</td>
                <td class="custom-col-2">
                    <b><?php echo strtoupper($row['NombreCompleto_Docente']); ?></b>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">ASESOR <?php echo strtoupper($row['NombreEmpresa_Convenio']); ?>:</td>
                <td class="custom-col-2">
                    <b><?php echo strtoupper($row['NombreCompleto_Responsable']); ?></b>
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">DURACIÓN:</td>
                <td class="custom-col-2">
                    Desde el <?php echo_date($row['IniciaPractica']);?> y hasta el <?php echo_date($row['FinalizaPractica']);?>.
                </td>
            </tr>
            <tr>
                <td class="custom-col-1">NOTA:</td>
                <td class="custom-col-2">
                    La práctica se adelantara de manera ModalidadPractica']); ?>.
                </td>
            </tr>
        </table>

        <br>
        <p class="text-justify">
            La presente carta de compromiso se perfecciona con la firma del Ordenador de Gasto, el
            Asesor Institucional, el Asesor Académico y el estudiante. Para constancia se firma en
            Manizales, <?php echo_date($row['FechaDiligenciamiento']);?>.
        </p>

        <table>
            <tr>
                <td>
                    <br><br><br>
                    <b>PAULA LÓPEZ CHICA</b>
                    <br>Ordenadora de Gasto
                    <br>Vicerrectora de Proyección Universitaria (E)
                    <br>Asesora Institucional
                    <br>Universidad de Caldas
                </td>
            </tr>
            <tr>
                <td>
                    <br><br><br>
                    <b>JOSE FERNANDO BARAHONA</b>
                    <br>Director de Proyección Social
                    <br>Coordinador de Práctica
                    <br>Universidad de Manizales
                </td>
                <td>
                    <br><br><br>
                    <b>JUAN CAMILO MEJÍA CAMPUZANO</b>
                    <br>Practicante
                    <br>Administración de Empresas
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