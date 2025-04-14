<?php 

    require "controller/ctlProduit.php";
    require "controller/ctlCategorie.php";
    require "controller/ctlSecurity.php";
    require "controller/ctlUser.php";
    
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

        // Contrôle d'accès avant le routage
        // if (!getAccess($action)){
        //     header('location: view/access_denied.php');
        // }

        /// Routage suivant l'action demandée

        switch ($action) {

            // Page par défaut
            case 'home':
                home();
                break;

            // *********
            // PRODUITS
            // *********
            case 'get_all_prods':
                //ctlGetAllProd();
                ctlGetAllProductWithCategorie();
                break;

            case 'add_prod':
                if(getAccess($action)) {
                    ctlAddProd();
                }
                break;


            // ***********
            // CATEGORIES
            // ***********
            case 'get_all_cats':
                ctlgetAllCats();
                break;

            case 'form_cat':
                ctlshowCatForm();
                break;


            // *********
            // SECURITY
            // *********
            case 'login':
                ctlLogin();
                break;

            case 'logout':
                ctlLogout();
                break;

            case 'user_register':
                ctlUserRegister();
                break;

            // ******
            // USERS
            // ******
            case 'get_all_users':
                if(getAccess('get_all_users')) {
                    ctlGetAllUsers();
                }
                else {
                    header('location: index.php?action=home');
                }
                break;

            // ******************
            // ACTIONS INCONNUES
            // ******************
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