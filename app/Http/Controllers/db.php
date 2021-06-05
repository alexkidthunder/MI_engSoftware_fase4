<?php
$host = env('DB_HOST', 'null');
$port= env('DB_PORT', 'null');
$dbname= env('DB_DATABASE', 'null');
$user= env('DB_USERNAME', 'null');
$password= env('DB_PASSWORD', 'null');

$connection_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$db = pg_connect($connection_string) or die("Falha ao conectar o servidor"); /*conectar ao servidor */
?>

