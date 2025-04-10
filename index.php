<?php 

    require "controller/ctlProduit.php";
    require "controller/ctlCategorie.php";
    require "controller/ctlSecurity.php";
    
    session_start();

    function home() {
        $title = "MVC_STORE";

        ob_start();
?>      
        <h3 class="text-center mt-5">Bienvenue sur MVC_STORE</h3>

        <p class="text-center mt-5">Ici vous trouverez votre bonheur !!!</p>

<?php 
        $content = ob_get_clean();
        require "view/template.php";

    }

    // ********
    // ROUTEUR
    // ********
    if(isset($_GET['action'])){
        $action = htmlspecialchars($_GET['action']);

        switch ($action) {

            // Page par défaut
            case 'home':
                home();
                break;

            // ********
            // Produits
            // ********
            case 'get_all_prods':
                ctlGetAllProd();
                break;


            // *****
            // CATEGORIES
            // ***********
            case 'get_all_cats':
                ctlgetAllCats();
                break;

            case 'form_cat':
                ctlshowCatForm();
                break;

            case 'add_cat':
                ctlAddCat();
                break;

            // SECURITY
            // ********
            case 'login':
                ctlLogin();
                break;

            case 'logout':
                ctlLogout();
                break;

            default:
            // Si action inconnue
            header("location: index.php?action=home");
                break;
        }
    }
    else {
        // Si pas action lors on envoie sur la page home
        header("location: index.php?action=home");
    }
?>