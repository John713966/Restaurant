<?php
require("../BD/connexion.php");
$stmt = $pdo->query("select  nomcategorie from categorie");
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Commande</title>
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

        #commander {
            float: right;
        }
    </style>
</head>

<body class="is-preload">
    <div id="page-wrapper">
        <div id="footer">
            <div class="container">
                <div class="row">

                    <section class="col-6 col-12-narrower">
                        <h3>Commande</h3>
                        <form method="post" action="../traitement/passercom.php">
                            <div class="row gtr-50">

                                <div class="col-6 col-12-mobilep">
                                    <select name="nomcategorie" id="nomcategorie" required>
                                        <option value="">--Choississez une catégorie--</option>
                                        <?php
                                        // Assurez-vous que $stmt est le résultat de votre requête SQL des catégories
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <option value="<?php echo $row['nomcategorie'] ?>"><?php echo $row['nomcategorie'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 col-12-mobilep">
                                    <select name="nomproduit" id="nomproduit" required>
                                        <option value="">--Sélectionnez d'abord une catégorie--</option>
                                    </select>
                                </div>

                                <div class="col-6 col-12-mobilep" id="inpt">
                                    <input type="number" name="quantite" id="prix" placeholder="quantite" required />
                                </div>
                                <div class="col-12">
                                    <ul class="actions">
                                        <li><input type="submit" class="btn btn-primary" value="Commander" id="commander" name="btncommande" /></li>
                                    </ul>
                                </div>
                            </div>
                        </form>

                        <script src="../assets/js/jquery.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                // 1. Écouter le changement sur la liste déroulante des catégories
                                $('#nomcategorie').on('change', function() {
                                    var selectedCategory = $(this).val(); // Récupère le nom de la catégorie sélectionnée

                                    if (selectedCategory) {
                                        // 2. Effectuer un appel AJAX au serveur
                                        $.ajax({
                                            type: 'POST',
                                            url: 'get_products.php', // Le fichier PHP qui va chercher les produits
                                            data: {
                                                category_name: selectedCategory
                                            },
                                            dataType: 'json', // On attend une réponse au format JSON
                                            success: function(products) {
                                                var productDropdown = $('#nomproduit');
                                                productDropdown.empty(); // Vider les options précédentes

                                                // Ajouter l'option par défaut
                                                productDropdown.append('<option value="">--Choisissez un produit--</option>');

                                                // 3. Boucler sur les produits retournés et les ajouter à la liste
                                                $.each(products, function(i, product) {
                                                    // On suppose que le tableau retourné a un champ 'nomproduit'
                                                    productDropdown.append('<option value="' + product.nomproduit + '">' + product.nomproduit + '</option>');
                                                });
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Erreur lors de la récupération des produits : " + error);
                                                // Afficher un message d'erreur si nécessaire
                                                $('#nomproduit').empty().append('<option value="">Erreur de chargement</option>');
                                            }
                                        });
                                    } else {
                                        // Si aucune catégorie n'est sélectionnée
                                        $('#nomproduit').empty();
                                        $('#nomproduit').append('<option value="">--Sélectionnez d\'abord une catégorie--</option>');
                                    }
                                });
                            });
                        </script>
                    </section>
                </div>
            </div>
            <?php
            require("../include/footermin.html");
            ?>

        </div>
        </script>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/jquery.dropotron.min.js"></script>
        <script src="../assets/js/browser.min.js"></script>
        <script src="../assets/js/breakpoints.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <script src="../assets/js/main.js"></script>


</body>

</html>