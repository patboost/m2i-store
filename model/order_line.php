<?php 

class OrderLine_m2i {
    private int $ol_id;
    private int $ol_qty;
    private float $montant;
    private int $prod_id;
    private int $order_id;

    /**
     * Get the value of ol_id
     */
    public function getOlId(): int
    {
        return $this->ol_id;
    }

    /**
     * Set the value of ol_id
     */
    public function setOlId(int $ol_id): self
    {
        $this->ol_id = $ol_id;

        return $this;
    }

    /**
     * Get the value of ol_qty
     */
    public function getOlQty(): int
    {
        return $this->ol_qty;
    }

    /**
     * Set the value of ol_qty
     */
    public function setOlQty(int $ol_qty): self
    {
        $this->ol_qty = $ol_qty;

        return $this;
    }

    /**
     * Get the value of montant
     */
    public function getMontant(): float
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     */
    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of prod_id
     */
    public function getProdId(): int
    {
        return $this->prod_id;
    }

    /**
     * Set the value of prod_id
     */
    public function setProdId(int $prod_id): self
    {
        $this->prod_id = $prod_id;

        return $this;
    }

    /**
     * Get the value of order_id
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     */
    public function setOrderId(int $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }
}

function create_ol(OrderLine_m2i $ol) {

    $ret = false;

    $sqlReq = "INSERT INTO order_line_m2i (ol_qty, ol_montant, prod_id, order_id)";

    $sqlReq .= " VALUES(:qty, :montant, :prod_id, :order_id)";
    
    try {

        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':qty', $ol->getOlQty());
        $req->bindValue(':montant', $ol->getMontant());
        $req->bindValue(':prod_id', $ol->getProdId());
        $req->bindValue(':order_id', $ol->getOrderId());

        $ret = $req->execute();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $ret;
    }
}