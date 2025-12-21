<?php
require("../BD/connexion.php");
$res = "select nom categorie";
$stmt = $pdo->query("select nomcategorie from categorie")
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>plat-boisson</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css" />
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
        <div id="footer">
            <div class="container">
                <div class="row">

                    <section class="col-6 col-12-narrower">
                        <h3>Plat-Boisson</h3>
                        <form method="post" action="../traitement/ajouterproduit.php">
                            <div class="row gtr-50">
                                <div class="col-6 col-12-mobilep">
                                    <select name="nomcategorie" required>
                                        <option value="">--Choississez--</option>
                                        <?php
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <option <?php $nomcategorie = $row['nomcategorie'] ?>><?php echo $row['nomcategorie'] ?></option>"
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6 col-12-mobilep">
                                    <input type="text" name="nomproduit" id="produit" placeholder="produit" required />
                                </div>
                                <div class="col-6 col-12-mobilep" id="inpt">
                                    <input type="number" name="prixproduit" id="prix" placeholder="prix" aria-valuemin="10" />

                                </div>

                                <div class="col-12">
                                    <ul class="actions">
                                        <li><input type="submit" class="btn btn-primary" value="Enregistrer" name="btnproduit" /></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <?php
        require("../include/footermin.html");
        ?>

        <!-- Scripts -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/jquery.dropotron.min.js"></script>
        <script src="../assets/js/browser.min.js"></script>
        <script src="../assets/js/breakpoints.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <script src="../assets/js/main.js"></script>
</body>

</html>