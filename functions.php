<?php
function encode_img_base64($img_path = false): string
{
    if ($img_path) {
        $path = $img_path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
    return '';
}

function echo_date($date)
{
    echo date('Y-m-d', strtotime(str_replace('-', '/', $date)));
}

function conectar_bd()
{
    $host = "ec2-3-217-251-77.compute-1.amazonaws.com";
    $dbname = "ddaa67d7asj6pp";
    $user = "fxjarmdomcgkrd";
    $password = "df6ad21e42d8f9fed035d4667fb8a040f6bf12e155d5176cd52ada6572e891ca";

    $connection = pg_connect("host=$host port=5432 dbname=$dbname
    user=$user password=$password options='--client_encoding=UTF8'")
    or die("> Connection failed.");

    return $connection;
}

function consultar_tabla($connection, $from, $where)
{
    $result = pg_query($connection, "SELECT * FROM $from WHERE $where");
    $row = pg_fetch_all($result)[0] or die("> Query failed.");
    // echo json_encode($rows);

    return $row;
}
