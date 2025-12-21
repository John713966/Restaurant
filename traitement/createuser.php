<?php
session_start();
try {
    require("../BD/connexion.php");
    if (isset($_POST['btncreate'])) {
        $username = htmlspecialchars($_POST['username']);
        $passwd = htmlspecialchars($_POST['passwd']);
        $statut = htmlspecialchars($_POST['statut']);

        $hache = password_hash($passwd, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `user`(`username`, `passwd`, `statut`) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $hache);
        $stmt->bindParam(3, $statut);

        if ($stmt->execute([$username, $hache, $statut])) {
            header("location:../page/index.html");
        } else {
            echo "Error d'insertion !!!";
        }
    }
} catch (Exception $e) {
    die("Error" . $e->getMessage());
}
