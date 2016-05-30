<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

//Debug
$app['debug'] = true;

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new Projet_LO07\DAO\UserDAO($app['db']);
            }),
        ),
    ),
    'security.role.hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN'),
    ),
));

// Register services.
$app['dao.conference'] = $app->share(function ($app) {
    return new Projet_LO07\DAO\ConferenceDAO($app['db']);
});
$app['dao.categorie'] = $app->share(function ($app) {
    return new Projet_LO07\DAO\CategorieDAO($app['db']);
});
$app['dao.laboratoire'] = $app->share(function ($app) {
    return new Projet_LO07\DAO\LaboratoireDAO($app['db']);
});
$app['dao.equipe'] = $app->share(function ($app) {
    return new Projet_LO07\DAO\EquipeDAO($app['db']);
});
$app['dao.organisation'] = $app->share(function ($app) {
    return new Projet_LO07\DAO\OrganisationDAO($app['db']);
});
$app['dao.user'] = $app->share(function ($app) {
    $userDAO = new Projet_LO07\DAO\UserDAO($app['db']);
    $userDAO->setLaboDAO($app['dao.laboratoire']);
    $userDAO->setEquipeDAO($app['dao.equipe']);
    $userDAO->setOrgaDAO($app['dao.organisation']);
    return $userDAO;
});
$app['dao.article'] = $app->share(function ($app) {
    $articleDAO = new Projet_LO07\DAO\ArticleDAO($app['db']);
    $articleDAO->setConferenceDAO($app['dao.conference']);
    $articleDAO->setCategorieDAO($app['dao.categorie']);
    return $articleDAO;
});
$app['dao.articles_users'] = $app->share(function ($app) {
    $articles_usersDAO = new Projet_LO07\DAO\Articles_UsersDAO($app['db']);
    $articles_usersDAO->setArticleDAO($app['dao.article']);
    $articles_usersDAO->setUserDAO($app['dao.user']);
    return $articles_usersDAO;
});