<?php
$docs = ["minuta", "practica"];
$doc = $_GET['doc'] ?? "";
$id = $_GET['id'] ?? "";

if (isset($_GET['key'])) {
    if ($_GET['key'] != "SIAP") {
        echo "La clave no es correcta.";
        exit();
    } elseif (!in_array($doc, $docs)) {
        echo "El formato de documento no es válido.";
        exit();
    } elseif ($id == "") {
        echo "Debe ingresar un ID de documento.";
        exit();
    }
} else {
    echo "Debe ingresar la clave compartida.";
    exit();
}

include_once "vendor/autoload.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

ob_start();
include_once "$doc.php";

$html = ob_get_clean();
$html .= '<style>' . file_get_contents("bootstrap.min.css") . '</style>';

$dompdf->loadHtml($html);
$dompdf->render();

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");

echo $dompdf->output();
