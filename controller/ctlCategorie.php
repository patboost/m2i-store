<?php 
    require "model/categorie.php";

    function ctlGetAllCats() {
        $cats = getAllCategories();

        require "view/show_cats.php";
    }

    function ctlshowCatForm(){
        require "view/form_cat.php";
    }

    function ctlAddCat() {
        if (isset($_POST['nom']) && isset($_POST['desc'])){
            $cat = new Categorie();
            $cat->setNom(htmlspecialchars($_POST['nom']))
                ->setDescription(htmlspecialchars($_POST['desc']));
            
            $ret = addCategorie($cat);
            header("location: index.php?action=get_all_cats");
        }
    }

?>