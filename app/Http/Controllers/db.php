<?php
    $connect = mysqli_connect("$_ENV['DB_HOST']","$_ENV['DB_USERNAME']","$_ENV['DB_PASSWORD']") or die("Falha ao conectar o servidor"); /*conectar ao servidor */
    $db = mysqli_select_db($connect,"$_ENV['DB_DATABASE']") or die("Falha ao selecionar o banco de dados"); /* Selecionando o banco de dados */
?>