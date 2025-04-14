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
    $prodInCart = [];

    if(isset($_SESSION['panier'])){

        //TODO Get Product From Cart
        $prods = getProdsFromCart();
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
    header('location: index.php?action=get_all_prods');
}
?>