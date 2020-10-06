<?php
class Product implements Serializable
{
  private $name;
  private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
    public function serialize() {
        return serialize(implode(";", array($this->name, $this->price)));
    }
    public function unserialize($data) {
        $arr = explode(";", $data, 2);
        $arr = explode("\"", $data);
        $arr = explode("\"", $arr[1]);
        $arr = explode(";", $arr[0]);

        $this->name = $arr[0];
        $this->price = $arr[1];
    }
    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
  }
}
?>
