<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// environment variables
$container['dot'] = function ($c) {
    return new Dotenv\Dotenv(__DIR__."/../");
};

// database pdo connector
$container['db'] = function ($c) {
    $host = getenv('DB_HOST');
    $name = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $dsn = 'mysql:host='.$host.';dbname='.$name;

    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
};

$container['adapter'] = function ($c) {
    return new AddressJockey\LibraryDatabases\PdoAdapter($c);
};

$container['addressesMapper'] = function ($c) {
    return new AddressJockey\Mappers\AddressesMapper($c->adapter);
};

$container['peopleMapper'] = function ($c) {
    return new AddressJockey\Mappers\PeopleMapper(
        $c->adapter,
        $c->addressesMapper
    );
};
