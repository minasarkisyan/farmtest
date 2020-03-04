<?php

abstract class Animal{
    
    private $id;

    public abstract function getProduct();

    
}


class Chicken extends Animal{
    
    static $id = 1;
    public $serialNumberAnimal = 0;

    function __construct() {
        
       $this->serialNumberAnimal = self::$id++;
        
    }
    
    public function getProduct(){
        return rand(0,1);
    }

}


class Cow extends Animal{
    
    static $id = 1;
    public $serialNumberAnimal = 0;

    function __construct() {
        
       $this->serialNumberAnimal = self::$id++;
        
    }

    public function getProduct(){
        return rand(8, 12);
    }
}


class FactoryAnimal
{   
    
    public static function createAnimal($type)
    {
        return new $type;
    }
}


class Crib
{
    
    public $storage = [];

    public function addStorageAnimal($qty, $type)
    {
        for ($i=1; $i <= $qty ; $i++) { 
            
            $this->storage[] = FactoryAnimal::createAnimal($type);
        }
        
    }
}


class ProductPicker
{
    
    public $product = 0;
    public $type;

    function __construct($type)
    {
        $this->type = $type;
    }

    public function getProduct(Crib $crib)
    { 
        foreach ($crib->storage as $value){
            $this->product += $value->getProduct();
        }

    }

    public function getTypeProduct($animal)
    {
        switch ($animal) {
            case 'Chicken':
                return "Собрано яиц: " .  $this->product . "шт.";
                break;
            case 'Cow':
                return "Надоено молока: " .  $this->product . "Литров";
                break;
            default:
                return "Сегодня пусто";
                break;
        }
    }
}


$cow = 'Cow';

$crib = new Crib();
$crib->addStorageAnimal(10, $cow);

$milk = new ProductPicker($cow);
$milk->getProduct($crib);

echo $milk->getTypeProduct($cow) . '<br>';

$chicken = 'Chicken';

$crib = new Crib();
$crib->addStorageAnimal(20, $chicken);

$egg = new ProductPicker($chicken);
$egg->getProduct($crib);

echo $egg->getTypeProduct($chicken) . '<br>';