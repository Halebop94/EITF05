<?php
class Product implements Serializable
{
  private $name;
  private $price;
  private $amount;
    public function __construct($name, $price, $amount) {
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
    }
    public function serialize() {
        return serialize(implode(";", array($this->name, $this->price, $this->amount)));
    }
    public function unserialize($data) {
        $arr = explode(";", $data, 2);
        $arr = explode("\"", $data);
        $arr = explode("\"", $arr[1]);
        $arr = explode(";", $arr[0]);

        $this->name = $arr[0];
        $this->price = $arr[1];
        $this->amount = $arr[2];
    }
    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
  }
}
?>
