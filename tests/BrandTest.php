<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/Brand.php";
require_once "src/Store.php";
$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);
class BrandTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Brand::deleteAll();
        // Store::deleteAll();
    }
    function testGetBrandName()
    {
        $brand_name = "Nike";

        $test_brand = new Brand($brand_name);
        $result = $test_brand->getBrandName();

        $this->assertEquals($brand_name, $result);
    }
    function testSetBrandName()
    {
        $brand_name = "Nike";
        $test_brand = new Brand($brand_name, $due_date);

        $test_brand->setBrandName("Nike");
        $result = $test_brand->getBrandName();

        $this->assertEquals("Nike", $result);
    }
    function test_getId()
    {
        $id = 1;
        $brand_name = "Nike";

        $test_brand = new Brand($brand_name, $id);
        $result = $test_brand->getId();

        $this->assertEquals(1, $result);
    }
    function test_save()
    {
        $brand_name = "Nike";
        $id = 1;
        $test_brand = new Brand($brand_name, $id);

        $test_brand->save();
        $result = Brand::getAll();

        $this->assertEquals($test_brand, $result[0]);
    }
    function testSaveSetsId()
    {
            $brand_name = "Nike";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);

            $test_brand->save();

            $this->assertEquals(true, is_numeric($test_brand->getId()));
    }
    function test_getAll()
    {
        $brand_name = "Nike";
        $id = 1;
        $test_brand = new Brand($brand_name, $id);
        $test_brand->save();
        $brand_name2 = "Adidas";
        $id2 = 2;
        $test_brand2 = new Brand($brand_name2, $id2);
        $test_brand2->save();

        $result = Brand::getAll();

        $this->assertEquals([$test_brand, $test_brand2], $result);
    }
    function test_deleteAll()
    {
        $brand_name = "Nike";
        $id = 1;
        $test_brand = new Brand($brand_name, $id);
        $test_brand->save();

        $brand_name2 = "Adidas";
        $id2 = 2;
        $test_brand2 = new Brand($brand_name2, $id2);
        $test_brand2->save();

        Brand::deleteAll();
        $result = Brand::getAll();

        $this->assertEquals([], $result);
    }
    function test_find()
    {
        $brand_name = "Nike";
        $id = 1;
        $test_brand = new Brand($brand_name, $id);
        $test_brand->save();
        $brand_name2 = "Adidas";
        $id2 = 2;
        $test_brand2 = new Brand($brand_name2, $id2);

        $test_brand2->save();
        $result = Brand::find($test_brand->getId());

        $this->assertEquals($test_brand, $result);
    }
    function testUpdate()
    {
        $brand_name = "Nike";
        $id = 1;
        $test_brand = new Brand($brand_name, $id);
        $test_brand->save();
        $new_brand_name = "Adidas";

        $test_brand->update($new_brand_name);

        $this->assertEquals("Adidas", $test_brand->getBrandName());
    }
    function testDeleteBrand()
    {
        $brand_name = "Nike";
        $id = 1;
        $test_brand = new Brand($brand_name, $id);
        $test_brand->save();
        $brand_name2 = "Adidas";
        $id2 = 2;
        $test_brand2 = new Brand($brand_name2, $id2);
        $test_brand2->save();

        $test_brand->delete();

        $this->assertEquals([$test_brand2], Brand::getAll());
    }
    // function testAddStore()
    // {
    //     $name = "Work stuff";
    //     $id = 1;
    //     $test_store= new Store($name, $id);
    //     $test_store->save();
    //     $brand_name = "Nike";
    //     $id2 = 2;
    //     $test_brand = new Brand($brand_name, $id2);
    //     $test_brand->save();
    //
    //     $test_brand->addStore($test_store);
    //
    //     $this->assertEquals($test_brand->getStores(), [$test_store]);
    // }
    // function testGetStores()
    // {
    //     $name = "Work stuff";
    //     $id = 1;
    //     $test_store= new Store($name, $id);
    //     $test_store->save();
    //
    //     $name2 = "Volunteer stuff";
    //     $id2 = 2;
    //     $test_store2 = new Store($name2, $id2);
    //     $test_store2->save();
    //
    //     $brand_name = "Nike";
    //     $id3 = 3;
    //     $test_brand = new Brand($brand_name, $id3);
    //     $test_brand->save();
    //
    //     $test_brand->addStore($test_store);
    //     $test_brand->addStore($test_store2);
    //
    //     $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
    // }
    // function testDelete()
    // {
    //     $store_name = "Footlocker";
    //     $id = 1;
    //     $test_store= new Store($store_name, $id);
    //     $test_store->save();
    //
    //     $brand_name = "Nike";
    //     $id2 = 2;
    //     $test_brand = new Brand($brand_name, $id2);
    //     $test_brand->save();
    //
    //     $test_brand->addStore($test_store);
    //     $test_brand->delete();
    //     $this->assertEquals([], $test_store->getBrands());
    // }
}
?>
