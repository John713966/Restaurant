<?php
require("../BD/connexion.php");
$res = "SELECT *FROM categorie";
$stmt = $pdo->query($res);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Categorie</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../Libs/bootstrap.min.css">
    <link rel="stylesheet" href="../Libs/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
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
            width: 70%;
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

<body class="is-preload">
    <div id="page-wrapper">
        <div id="footer" class="curent">
            <div class="container">
                <div class="row">
                    <section class="col-12 col-12-narrower">
                        <h3>Categorie</h3>
                        <form method="post" action="../traitement/Ajoutercategorie.php">
                            <div class="col-6 col-12-mobilep">
                                <input type="text" name="nomcategorie" id="nomcategorie" placeholder="categorie" required />
                            </div>
                            <div class="col-12">
                                <br>
                                <ul class="actions">
                                    <li><input type="submit" class="btn btn-primary" value="Ajouter" name="btnajouter" /></li>
                                </ul>
                            </div>

                        </form>

                        <h2 class="text-center">Liste des Categories </h2>
                        <table border="2" class="table table-striped" id="ttable">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>Categorie</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['nomcategorie']; ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['idcategorie'] ?>"><i class="fas fa-edit fs-5 me-3"></i></a>
                                            <a href="../traitement/deletecategorie.php?id=<?php echo $row['idcategorie'] ?>"><i class="fas fa-trash fs-5 me-3"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>

    </div>
    <?php
    require("../include/footermin.html");
    ?>
    <script src="../Libs/jquery-3.7.1.js"></script>
    <script src="../Libs/bootstrap.bundle.min.js"></script>
    <script src="../Libs/dataTables.js"></script>
    <script src="../Libs/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#ttable')
    </script>
    <!-- Scripts -->
    <script src="../assets/js/jquery.dropotron.min.js"></script>
    <script src="../assets/js/browser.min.js"></script>
    <script src="../assets/js/breakpoints.min.js"></script>
    <script src="../assets/js/util.js"></script>


    <script src="../assets/js/main.js"></script>
</body>

</html>