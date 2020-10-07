<?php
class Product
{
  private $articleName;
  private $price;

    public function __construct($articleName, $price) {
        $this->articleName = $articleName;
        $this->price = $price;
    }
    
    public function getArticleName() {
        return $this->articleName;
    }

    public function getPrice() {
        return $this->price;
    }
}
?>
