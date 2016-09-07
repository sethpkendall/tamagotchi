<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/tamagotchi.php';

    session_start();
    if (empty($_SESSION['needs'])) {
        $_SESSION['needs'] = array();
    }
    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('tama-name.html.twig');
    });

    $app->get("/start-care", function() use ($app) {
        $name = $_GET['name'];
        $tamagotchi = new Tamagotchi($name);
        $tamagotchi->save();

        return $app['twig']->render('tama-vision.html.twig', array('needs2' => Tamagotchi::getAll()));
    });

    $app->get("/food-button", function() use ($app) {
        $feed = $_SESSION['needs'][0];
        $feed->feed();
        return $app['twig']->render('tama-vision.html.twig', array('needs2' => Tamagotchi::getAll()));
    });

    $app->get("/play-button", function() use ($app) {
        $attention = $_SESSION['needs'][0];
        $attention->play();
        return $app['twig']->render('tama-vision.html.twig', array('needs2' => Tamagotchi::getAll()));
    });

    $app->get("/sleep-button", function() use ($app) {
        $rest = $_SESSION['needs'][0];
        $rest->rest();
        return $app['twig']->render('tama-vision.html.twig', array('needs2' => Tamagotchi::getAll()));
    });

    $app->get("/time-button", function() use ($app) {
        $time = $_SESSION['needs'][0];
        $time->time();
        if (($time->getFood()==0)||($time->getRest()==0)||($time->getAttention()==0)) {
            return $app['twig']->render('dead-tama.html.twig', array('needs2' => Tamagotchi::getAll()));
        } else {
            return $app['twig']->render('tama-vision.html.twig', array('needs2' => Tamagotchi::getAll()));
        }

    });

    $app->get("/reset", function() use ($app) {
        Tamagotchi::deleteAll();
        return $app['twig']->render('tama-name.html.twig');
    });

    return $app;
?>
