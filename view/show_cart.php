<?php 
    $title = "MVC_STORE: Cart";

    ob_start();
?>

<h1 class="text-center">Votre panier</h1>

<?php 
    if (isset($_SESSION['panier'])) {
        echo "<h3>Votre panier n'est pas vide</h3>";
        if (count($prodsInCart)>0){
?>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" class="text-center">Produit</th>
                    <th scope="col" class="text-center">Quantité</th>
                    <th scope="col" class="text-center">Prix</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($prodsInCart as $p) {
                            $qty = $_SESSION['panier'][$p->getId()];
                    ?>
                            <tr class="table-primary">
                                <td><?= $p->getNom() ?></td>
                                <td class="text-center">
                                    <a href="index.php?action=cart_prod_dec&id=<?= $p->getId() ?>" class="btn btn-success">-</a>
                                    <?= $qty ?>
                                    <a href="index.php?action=add_cart&id=<?= $p->getId() ?>&mode=cart" class="btn btn-success">+</a>
                                </td>
                                <td class="text-center"><?= $p->getPrix() * $qty ?> €</td>
                                <td>
                                    <a href="index.php?action=cart_prod_del&id=<?= $p->getId() ?>" class="btn btn-danger">Supprimer</a>
                                </td>
                                <td>
                            </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <th class="text-end">Résumé commande</th>
                        <td class="text-center"><?= $totalArticles ?></td>
                        <td class="text-center"><?= $totalCmd ?> €</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <a href="index.php?action=commander" class="btn btn-success">Commander</a>
<?php
        }
    }
    else {
        echo "<h3>Votre panier est vide</h3>";
    }

    $content = ob_get_clean();
    require "view/template.php";

?>