<h1>Page de test</h1>

<?php 

    require_once "model/produit.php";

    // $prods = getAllProds();

    // var_dump($prods);

    $prod = getProdById(1);
    print_r($prod);

?>