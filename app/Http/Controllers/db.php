<?php
    $connect = mysqli_connect("us-cdbr-east-04.cleardb.com","b4e2cf5fbf24e6","56ccb943") or die("Falha ao conectar o servidor"); /*conectar ao servidor */
    $db = mysqli_select_db($connect,"heroku_30c49258aaa92a9") or die("Falha ao selecionar o banco de dados"); /* Selecionando o banco de dados */
?>