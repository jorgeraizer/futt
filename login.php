<?php
session_start();

$email = $_POST["email"];
$senha = $_POST["senha"];
include("conecta.php");

if (!empty($email) && !empty($senha)) {
    $comando = $pdo->prepare("SELECT * FROM cadastro WHERE email=:email AND senha=:senha");
    $comando->bindParam(":email", $email);
    $comando->bindParam(":senha", $senha);
    $resultado = $comando->execute();
    while ($linhas = $comando->fetch()) {

        $nome=$linhas["nome"];

        }


    if ($comando->rowCount() > 0) {
        $_SESSION["logado"] = true;
        $_SESSION["nome"] = $nome;
        // Verifica se o email é "admin" para redirecionar para a página específica
        if ($email == "admin") {
            header("Location: pagina_adm.php");
            exit; // Certifique-se de que o script não será executado além deste ponto
        } else {
            header("Location:pagina_inicial.php");
            exit; // Certifique-se de que o script não será executado além deste ponto
        }
    } else {
        header("Location:pagina_inicial.php");
        exit; // Certifique-se de que o script não será executado além deste ponto
        $_SESSION["nome"] = "Deslogado"; //
    }
} else {
    header("Location:pagina_inicial.php");
    exit; // Certifique-se de que o script não será executado além deste ponto
}
?>