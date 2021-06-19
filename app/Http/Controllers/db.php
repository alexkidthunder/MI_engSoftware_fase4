<?php
    $connect = mysqli_connect(env('DB_HOST', 'null'),env('DB_USERNAME', 'null'),env('DB_PASSWORD', 'null')) or die("Falha ao conectar o servidor"); /*conectar ao servidor */
    $db = mysqli_select_db($connect,env('DB_DATABASE', 'null')) or die("Falha ao selecionar o banco de dados"); /* Selecionando o banco de dados */
?>

<?php
    //$connect = mysqli_connect("localhost","root","") or die("Falha ao conectar o servidor"); /*conectar ao servidor */
   // $db = mysqli_select_db($connect,"hospital_universitario") or die("Falha ao selecionar o banco de dados"); /* Selecionando o banco de dados */
?>