<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path'=> __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/stores", function () use ($app) {
        $store_name = $_POST['name'];
        $new_store = new Store($store_name);
        $new_store->save();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    }); 

    return $app;

?>
