<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path'=> __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/stores", function () use ($app) {
        $store_name = $_POST['name'];
        $new_store = new Store($store_name);
        $new_store->save();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    $app->get("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands()));
    });

    $app->post("/stores/{id}/add_brand", function($id) use ($app) {
        $store = Store::find($id);
        $brand_name = $_POST['brand_name'];
        $new_brand = new Brand($brand_name);
        $new_brand->save();
        $store->addBrand($new_brand);
        $brands = $store->getBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands));

    });

    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand'=> $brand, 'stores' => $brand->getStores()));
    });

    $app->post("/brand/{id}/add_store", function($id) use ($app) {
        $brand = Brand::find($id);
        $store_name = $_POST['store_name'];
        $new_store = new Store($store_name);
        $new_store->save();
        $brand->addStore($new_store);
        $stores = $brand->getStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores));

    });

    // $app->get("/", function() use ($app){
    //     return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    // });
    //
    // $app->post("/stores", function () use ($app) {
    //     $store_name = $_POST['name'];
    //     $new_store = new Store($store_name);
    //     $new_store->save();
    //     return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    // });

    return $app;

?>
