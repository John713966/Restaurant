<?php
session_start();
require("../BD/connexion.php");
$res = "select SUM(total),taxe from commande ";
$stmt = $pdo->query($res);
$res1 = "Select username from user";
$stmt1 = $pdo->query($res1);
$res2 = "Select nomcategorie from categorie";
$stmt2 = $pdo->query($res2);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Libs/bootstrap.min.css">
    <link rel="stylesheet" href="../libs/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>Comptabilite </title>
    <style>
        select {
            width: 100%;
            height: 50px;
            padding: 10px;
            font-size: 10px;
            border: none;
            border-radius: 5px;
        }

        select:focus {
            border-color: #18e0e7ff;
            box-shadow: 0 0 4px #18e0e7ff;
            outline: none;
        }

        select,
        select option {
            padding: 8px;
            font-size: 12px;
        }

        #prix {
            padding: 8px;
            height: 50px;
            width: 85%;
            border: none;
            border-radius: 5px;
        }

        #prix:focus {
            border-color: #18e0e7ff;
            box-shadow: 0 0 4px #18e0e7ff;
            outline: none;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <h2 class="text-center"><strong>Comptabilite</strong></h2>
        <table border="2" class="table table-striped" id="table">
            <thead>
                <tr>
                    <th>Montant des ventes </th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Taxe</th>
                    <th>Total </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>HTG <?php echo $row['taxe']; ?> </td>
                        <td>HTG <?php echo $row['SUM(total)']; ?> </td>
                    </tr>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">TOTAL Generale plus taxe ------>HTG <?php echo $row['SUM(total)']; ?> </td>
                </tr>
            <?php
                }
            ?>
            </tfoot>
        </table>
        <br>
        <div id="footer" class="curent">
            <div class="container-fluide">
                <div class="row">
                    <form method="post" action="../page/rapportuser.php">
                        <div class="row">
                            <div class="col-md-6">
                                <table border="2" class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th colspan="3">
                                                <h5><strong>Rapport de vente entre deux dates</strong></h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Date Debut</th>
                                            <th>Date Fin</th>
                                            <th>Utilisateur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="date" name="datedebut" id="prix">
                                            </td>
                                            <td>
                                                <input type="date" name="datefin" id="prix">
                                            </td>
                                            <td>
                                                <select name="username">
                                                    <option value="">--Choississez--</option>
                                                    <?php
                                                    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <option value="<?php echo $row1['username']; ?>"><?php echo $row1['username']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <Tfoot>
                                        <tr>
                                            <td>
                                                <div class="col-12">
                                                    <input type="submit" class="btn btn-success" value="Rapport" name="btnrapport" />
                                                </div>
                                            </td>
                                        </tr>
                                    </Tfoot>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table border="2" class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th colspan="3">
                                                <h5><strong>Rapport de vente par Categorie</strong></h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Date Debut</th>
                                            <th>Date Fin</th>
                                            <th>Categorie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="date" name="datedebut1" id="prix">
                                            </td>
                                            <td>
                                                <input type="date" name="datefin1" id="prix">
                                            </td>
                                            <td>
                                                <select name="categorie" id="">
                                                    <option value="">--Choississez--</option>
                                                    <?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $row2['nomcategorie']; ?>"><?php echo $row2['nomcategorie']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                        </tr>
                                    </tbody>
                                    <Tfoot>
                                        <tr>
                                            <td>
                                                <div class="col-12">
                                                    <input type="submit" class="btn btn-success" value="Rapport" name="btnpport" />
                                                </div>
                                            </td>
                                        </tr>
                                    </Tfoot>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src=" ../libs/jquery-3.7.1.js">
        </script>
        <script src="../libs/bootstrap.bundle.min.js"></script>
        <script src="../libs/dataTables.js"></script>
        <script src="../libs/dataTables.bootstrap5.js"></script>
        <script>
            new DataTable('#ttable')
        </script>

</body>

</html>