<?php
require("../BD/connexion.php");
$res = "select * from produits order by nomcategorie ";
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
    <title>liste des Produits</title>
    <style>
        .nav-link {
            color: white !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Liste des Produits </h2>
        <table border="2" class="table table-striped" id="ttable">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Categorie</th>
                    <th>Nom produits</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $i = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['nomcategorie']; ?></td>
                        <td><?php echo $row['nomproduit']; ?></td>
                        <td><?php echo $row['prixproduit']; ?> HTG</td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['idproduit'] ?>"><i class="fas fa-edit fs-5 me-3"></i></a>
                            <a href="edit.php?id=<?php echo $row['idproduit'] ?>"><i class="fas fa-trash fs-5 me-3"></i></a>

                        </td>
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