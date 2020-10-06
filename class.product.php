<?php
class Product
{
  private $articlename;
  private $price;

    public function __construct($articlename, $price) {
        $this->articlename = $articlename;
        $this->price = $price;
    }

    public function getArticleName() {
        return $this->article;
    }

    public function getPrice() {
        return $this->price;
    }
}
?>
