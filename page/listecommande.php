<?php
require("../BD/connexion.php");
$res = "select * from commande ORDER BY date";
$stmt = $pdo->query($res);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Libs/bootstrap.min.css">
    <link rel="stylesheet" href="../Libs/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>liste descommandes </title>
    <style>
        .nav-link {
            color: white !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Liste des Commandes</h2>
        <table border="2" class="table table-striped" id="ttable">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Nom produits</th>
                    <th>Quantite </th>
                    <th>prix unite </th>
                    <th>prix achat total </th>
                    <th>utlisateur</th>
                    <th>Date </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $i = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['nomproduit']; ?></td>
                        <td><?php echo $row['quantite']; ?> </td>
                        <td><?php echo $row['prix']; ?> </td>
                        <td><?php echo $row['total']; ?> </td>
                        <td><?php echo $row['user']; ?> </td>
                        <td><?php echo $row['date']; ?> </td>
                </tr>
            <?php
                    }
            ?>
            </tbody>
        </table>
    </div>
    <script src="../Libs/jquery-3.7.1.js"></script>
    <script src="../Libs/bootstrap.bundle.min.js"></script>
    <script src="../Libs/dataTables.js"></script>
    <script src="../Libs/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#ttable')
    </script>

</body>

</html>