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
    function addStore($store)
    {
        $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
    }


    function getStores()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
        JOIN brands_stores ON (brands.id = brands_stores.brand_id) JOIN stores
        ON (brands_stores.store_id = stores.id)
        WHERE brands.id = {$this->getId()};");

        $stores = array();

        foreach($returned_stores as $store) {
            $name = $store['store_name'];
            $id = $store['id'];
            $new_store = new Store($name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
        var_dump($stores);
    }

    // function getAuthor()
    //    {
    //        $returned_authors = $GLOBALS['DB']->query("SELECT authors.* FROM books
    //        JOIN authors_books ON (books.id = authors_books.book_id) JOIN authors
    //        ON (authors_books.author_id = authors.id)
    //        WHERE books.id = {$this->getId()};");
    //
    //        $authors = array();
    //
    //        foreach ($returned_authors as $author) {
    //            $name = $author['name'];
    //            $id = $author['id'];
    //            $new_author = new Author($name, $id);
    //            array_push($authors, $new_author);
    //        }
    //
    //        return $authors;
    //    }
}
?>
