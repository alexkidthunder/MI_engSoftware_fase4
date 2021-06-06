<?php
    $dbconfig = parse_ini_file(".env");
    $host = $dbconfig["DB_HOST"];
    $user = $dbconfig["DB_USERNAME"];
    $password = $dbconfig["DB_PASSWORD"];
    $database = $dbconfig["DB_DATABASE"];

    $connect = mysqli_connect($host,$user,$password) or die("Falha ao conectar o servidor"); /*conectar ao servidor */
    $db = mysqli_select_db($connect,$database) or die("Falha ao selecionar o banco de dados"); /* Selecionando o banco de dados */
?>