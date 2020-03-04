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
    public function createСhicken(): chicken
    {
        return new Chicken;
    }
    
    public function createCow(): cow
    {
        return new Cow;
    }
}


class Crib
{
    
    public $storageChicken = [];
    public $storageCow = [];

    public function addStorageChicken($qty,FactoryAnimal $factory )
    {
        for ($i=1; $i <= $qty ; $i++) { 
            
            $this->storageChicken[] = $factory->createСhicken();
        }
        
    }

    public function addStorageCow($qty, FactoryAnimal $factory)
    {
        for ($i=1; $i <= $qty ; $i++) { 
            $this->storageCow[] = $factory->createCow();
        }
        
    }
}


class ProductPicker
{
    
    public $milk = 0;
    public $egg = 0;
    

    public function getMilk(Crib $crib)
    { 
        foreach ($crib->storageCow as $value){
            $this->milk += $value->getProduct();
        }

    }

    public function getEgg(Crib $crib)
    { 
        foreach ($crib->storageChicken as $value){
            
            $this->egg += $value->getProduct();
        }

    }
}


$crib = new Crib();
$factory = new FactoryAnimal();
$crib->addStorageChicken(20, $factory);
$crib->addStorageCow(10, $factory);


$picker = new ProductPicker();
$picker->getMilk($crib);
$picker->getEgg($crib);


echo "Всего собрано: молоко {$picker->milk}" . "\n";
echo "Всего собрано: яйца {$picker->egg}" . "\n";