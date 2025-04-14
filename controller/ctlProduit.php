<?php 

require_once "model/produit.php";
// require_once "model/categorie.php";


// Tous les produits
function ctlGetAllProd(){
    
    // Récupérer les produits à partir du model
    $prods = getAllProds(); 

    // Construire la vue
    require "view/show_prods.php";
}

function ctlGetAllProductWithCategorie() {
    $prods = getAllProdsWithCat();
    require "view/show_prods.php";
}

function ctlAddProd() {


    if(isset($_POST['nom'])) {
        $prod = new Produit();

        // init nouveau Produit
        $prod->setNom(htmlspecialchars($_POST['nom']))
            ->setCategorieId(htmlspecialchars($_POST['cat']))
            ->setPrix(htmlspecialchars($_POST['prix']))
            ->setDescription(htmlspecialchars($_POST['desc']));
        
        // Ecrire le produit dans la BDD
        $ret = addProd($prod);
        
        if($ret) {
            // Retour à la page des produits
            header("location: index.php?action=get_all_prods");
        } 
    }

    // Récupérer la liste des catégories
    // Pour choisir une catégorie à la création d'un produit
    // (champs catégorie du formulaire de création d'un produit)
    $cats = getAllCategories();
    require "view/form_prod.php";

}

function getProdsFromCart(){
    $prods = [];

    // Extraire du panier la liste des produits (clé)
    $prodIds = array_keys($_SESSION['panier']);
    if(!empty($prodIds)) {

        // Récupérer le détails des produits du panier
        $prods = getSelectedProds($prodIds);
    }

}

?>