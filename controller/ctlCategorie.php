<?php 
    require "model/categorie.php";

    function ctlGetAllCats() {
        $cats = getAllCategories();

        require "view/show_cats.php";
    }

?>