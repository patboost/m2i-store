<?php 

require_once "model/dbaccess.php";

class Produit {
    private int $id;
    private string $nom;
    private string $description;
    private int $categorie_id;
    private string $categorie_nom;
    private float $prix;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of categorie_id
     */
    public function getCategorieId(): int
    {
        return $this->categorie_id;
    }

    /**
     * Set the value of categorie_id
     */
    public function setCategorieId(int $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }

    /**
     * Get the value of prix
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     */
    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

     /**
     * Get the value of categorieNom
     */
    public function getCategorieNom(): string
    {
        return $this->categorie_nom;
    }

    /**
     * Set the value of categorieNom
     */
    public function setCategorieNom(string $categorieNom): self
    {
        $this->categorie_nom = $categorieNom;

        return $this;
    }
}


// ********************
// *  CRUD Produit    *
// ********************

// Récupérer tous les produits
function getAllProds() {
    $prods = [];
    $sqlReq = "SELECT * FROM produit";

    try {
        $ctxDB = dbConnect();
        
        $req = $ctxDB->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'produit');

        $prods = $req->fetchAll();
    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $prods;
    }
}

// Récupérer un produit
function getProdById(int $id) {
    $prod = null;

    $sqlReq = "SELECT * FROM produit";
    $sqlReq .= " WHERE id= :id";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $ret = $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        if($ret) {
            $prod = $req->fetch();
        }
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $prod;
    }
}

function getAllProdsWithCat(){
    $prods = [];
    $sqlReq = "SELECT produit.*, categorie.nom as categorie_nom FROM produit";
    $sqlReq .= " INNER JOIN categorie ON categorie_id = categorie.id";

    try {
        $ctxDB = dbConnect();
        
        $req = $ctxDB->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'produit');

        $prods = $req->fetchAll();
    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $prods;
    }
}

function addProd(Produit $prod){

    $ret = false;

    $sqlReq = "INSERT INTO produit (nom, description, categorie_id, prix)";
    $sqlReq .= " VALUES( :nom, :desc, :cat, :prix)";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);

        $req->bindValue(':nom', $prod->getNom(), PDO::PARAM_STR);
        $req->bindValue(':desc', $prod->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':cat', $prod->getCategorieId(), PDO::PARAM_INT);
        $req->bindValue(':prix', $prod->getPrix());

        $ret = $req->execute();
    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}



   



?>