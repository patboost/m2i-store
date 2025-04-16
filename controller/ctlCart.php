<?php 

/**
 * Initialiser le Panier dans $_SESSION
 *
 * @return bool Ture si Création OK
 */
function createCart(): bool{
    if(!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    return true;
}

/**
 * Supprsssion Panier
 *
 * @return void
 */
function deleteCart() {
    if(isset($_SESSION['[panier']) && count($_SESSION['panier']) > 0){
        unset($_SESSION['panier']);
        header('location: index.php?action=show_cart');
    }
}

/**
 * Affiche le contenu du panier
 *
 * @return void
 */
function ctlShowCart(){
    $prodsInCart = [];

    if(isset($_SESSION['panier'])){

        $totalCmd = 0; // Coût total du panier

        $prodsInCart = getProdsFromCart(); // Infos Produits du panier

        // Nombre total d'articles dans le panier
        // panier [1=>3, 8=>1, 13=>25]
        // array_values(panier) => [3, 1, 25]
        //  array_sum(array_values(panier)) => 29
        $totalArticles = array_sum(array_values($_SESSION['panier']));

        foreach($prodsInCart as $p){
            $qty = $_SESSION['panier'][$p->getId()];
            $totalCmd += $p->getPrix()*$qty;
        }
    }
    require "view/show_cart.php";
}

/**
 * Ajouter un nouveau produit
 * Incrémenter la qty d'un produit existant
 *
 * @return void
 */
function ctlAddProdCart() {
    if (isset($_GET['id'])){
        $prodId = $_GET['id'];
        if(createCart()){
            if (isset($_SESSION['panier'][$prodId])){
                // Le produit existe 
                // On incrémente la Qty
                $_SESSION['panier'][$prodId]++;
            }
            else {
                // Le produit n'existe
                // on ajoute le produit avec une Qty=1
                $_SESSION['panier'][$prodId] = 1;
            }
        }
    }
    if (isset($_GET['mode'])){

        // Incrémenter qty dans le panier
        // A partir de la vue panier
        $mode = htmlspecialchars($_GET['mode']);
        if ($mode === 'cart') {
            header('location: index.php?action=show_cart');
            
        }
        else {
            // Ajout produit dans le panier
            // A partir de la vue Produits
            header('location: index.php?action=get_all_prods');
        }
    }
}

function ctlDecProdQty() {

    $id = 0;

    // Récupérer le produit à décrémenter
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
    }

    if (isset($_SESSION['panier'][$id])){
        $_SESSION['panier'][$id]--;

        if($_SESSION['panier'][$id] == 0) {
            // Supprimer le produit du panier
            unset($_SESSION['panier'][$id]);
        }
    }

    header('location:index.php?action=show_cart');
}

function ctlProdDel(){
    $id = 0;

    // Récupérer le produit à supprimer
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);

        // Supprimer le produit du panier
        if(isset($_SESSION['panier'][$id])) {
            unset($_SESSION['panier'][$id]);
        }

        if (empty($_SESSION['panier'])) {
            // PLus de produit dans le panier
            unset($_SESSION['panier']);
        }
    }
    header('location:index.php?action=show_cart');

}
?>