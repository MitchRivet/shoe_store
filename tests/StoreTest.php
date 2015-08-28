<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";
    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }
        function test_getStoreName()
        {
            $store_name = "Footlocker";
            $test_store = new Store($store_name);
            $result = $test_store->getStoreName();
            $this->assertEquals($store_name, $result);
        }
        function testSetStoreName()
        {
            $store_name = "Footlocker";
            $test_store = new Store($store_name);
            $test_store->setStoreName("PayLess");
            $result = $test_store->getStoreName();
            $this->assertEquals("PayLess", $result);
        }
        function test_getId()
        {
            //Arrange
            $store_name = "Footlocker";
            $id = 1;
            $test_Store = new Store($store_name, $id);
            //Act
            $result = $test_Store->getId();
            //Assert
            $this->assertEquals(1, $result);
        }
        function test_save()
        {
            $store_name = "Footlocker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $result = Store::getAll();
            $this->assertEquals($test_store, $result[0]);
        }
        function testUpdate()
        {
            $store_name = "Footlocker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $new_store_name = "PayLess";
            $test_store->update($new_store_name);
            $this->assertEquals("PayLess", $test_store->getStoreName());
        }
        function testDeleteStore()
        {
            $store_name = "Footlocker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $store_name2 = "PayLess";
            $id2 = 2;
            $test_store2 = new Store($store_name2, $id2);
            $test_store2->save();
            $test_store->delete();
            $this->assertEquals([$test_store2], Store::getAll());
        }
        function test_getAll()
        {
            $store_name = "Footlocker";
            $id = 1;
            $store_name2 = "PayLess";
            $id2 = 2;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $test_store2 = new Store($store_name2, $id2);
            $test_store2->save();
            $result = Store::getAll();
            $this->assertEquals([$test_store, $test_store2], $result);
        }
        function test_deleteAll()
        {
            $store_name = "Footlocker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $store_name2 = "PayLess";
            $id2 = 2;
            $test_store2 = new Store($store_name2, $id2);
            $test_store2->save();
            Store::deleteAll();
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }
        function test_find()
        {
            $store_name = "Footlocker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $store_name2 = "PayLess";
            $id2 = 2;
            $test_store2 = new Store($store_name2, $id2);
            $test_store2->save();
            //Act
            $result = Store::find($test_store->getId());
            //Assert
            $this->assertEquals($test_store, $result);
        }
        // function testAddBrand()
        // {
        //     $store_name = "Footlocker";
        //     $id = 1;
        //     $test_store = new Store($store_name, $id);
        //     $test_store->save();
        //     $brand_name = "Nike";
        //     $id2 = 2;
        //
        //     $test_brand = new Brand($brand_name, $id2);
        //     $test_brand->save();
        //     $test_store->addBrand($test_brand);
        //     $this->assertEquals($test_store->getBrands(), [$test_brand]);
        // }
        // function testGetBrands()
        // {
        //     $store_name = "Footlocker";
        //     $id = 1;
        //     $test_store = new Store($store_name, $id);
        //     $test_store->save();
        //
        //     $brand_name = "Nike";
        //     $id2 = 2;
        //     $test_brand = new Brand($brand_name, $id2);
        //     $test_brand->save();
        //
        //     $brand_name2 = "Adidas";
        //     $id3 = 3;
        //     $test_brand2 = new Brand($brand_name2, $id3);
        //     $test_brand2->save();
        //
        //     $test_store->addBrand($test_brand);
        //     $test_store->addBrand($test_brand2);
        //
        //     $this->assertEquals($test_store->getBrands(), [$test_brand, $test_brand2]);
        // }
        // function testDelete()
        // {
        //     $store_name = "Footlocker";
        //     $id = 1;
        //     $test_store = new Store($store_name, $id);
        //     $test_store->save();
        //     $brand_name = "Nike";
        //     $id2 = 2;
        //     $test_brand = new Brand($brand_name, $id2);
        //     $test_brand->save();
        //
        //     $test_store->addBrand($test_brand);
        //     $test_store->delete();
        //
        //     $this->assertEquals([], $test_brand->getStores());
        // }
    }
 ?>
