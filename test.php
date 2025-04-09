<h1>Page de test</h1>

<?php 

    require_once "model/produit.php";
    require_once "model/categorie.php";

    // $prods = getAllProds();

    // var_dump($prods);

    $cats = getAllCategories();
    print_r($cats);

?>