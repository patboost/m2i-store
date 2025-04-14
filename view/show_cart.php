<?php 
    $title = "MVC_STORE: Cart";

    ob_start();
?>

<h1 class="text-center">Votre panier</h1>

<?php 
    if (isset($_SESSION['panier'])) {
        echo "<h3>Votre panier n'est pas vide</h3>";
    }
    else {
        echo "<h3>Votre panier est vide</h3>";
    }

    $content = ob_get_clean();
    require "view/template.php";

?>