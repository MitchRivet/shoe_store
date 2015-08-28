<?php
class Brand
{
    private $brand_name;

    private $id;
    //Constructor
    function __construct($brand_name, $id = null)
    {
        $this->brand_name = $brand_name;

        $this->id = $id;
    }
    //Setter
    function setBrandName($new_brand_name)
    {
        $this->brand_name = (string) $new_brand_name;
    }
    //Getters
    function getBrandName()
    {
        return $this->brand_name;
    }

    function getId()
    {
        return $this->id;
    }
    //Save Method
    function save()
    {
        $statement = $GLOBALS['DB']->exec("INSERT INTO brands (brand_name)
        VALUES ('{$this->getBrandName()}')");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }
    //Static getAll
    static function getAll()
    {
        $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
        $brands = array();
        foreach($returned_brands as $brand) {
            $brand_name = $brand['brand_name'];
            $id = $brand['id'];
            $new_brand = new Brand($brand_name, $id);
            array_push($brands, $new_brand);
        }
        return $brands;
    }
    //Static deleteAll
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands;");
    }
    //Find function for Id
    static function find($search_id)
    {
        $found_brand = null;
        $brands = Brand::getAll();
        foreach($brands as $brand) {
            $brand_id = $brand->getId();
            if ($brand_id == $search_id) {
                $found_brand = $brand;
            }
        }
        return $found_brand;
    }
    function update($new_brand_name)
    {
        $GLOBALS['DB']->exec("UPDATE brands SET brand_name = '{$new_brand_name}' WHERE id = {$this->getId()};");
        $this->setBrandName($new_brand_name);
    }
    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE brand_id = {$this->getId()};");
    }
    // function addStore($store)
    // {
    //     $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
    // }
    // function getStores()
    // {
    //     $query = $GLOBALS['DB']->query("SELECT store_id FROM brands_stores WHERE brand_id = {$this->getId()};");
    //     $store_ids = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $stores = array();
    //     foreach($store_ids as $id) {
    //         $store_id = $id['store_id'];
    //         $result = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$store_id};");
    //         $returned_store = $result->fetchAll(PDO::FETCH_ASSOC);
    //         $name = $returned_store[0]['name'];
    //         $id = $returned_store[0]['id'];
    //             $new_store = new Store($name, $id);
    //         array_push($stores, $new_store);
    //     }
    //     return $stores;
    // }
}
?>
