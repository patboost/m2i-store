<?php 

require_once "model/produit.php";


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

?>