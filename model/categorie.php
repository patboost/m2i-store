<?php 

require_once "model/dbaccess.php";

class Categorie {
    private int $id;
    private string $nom;
    private string $description;
    

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
}


// ******
//  CRUD
// ******

function getAllCategories() {
    $cats = [];

    try {
        $ctxDb = dbConnect();
        $sqlReq = "SELECT * FROM categorie";

        $req = $ctxDb->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $cats = $req->fetchAll();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $cats;
    }
}