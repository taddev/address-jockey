<?php
// Routes

use AddressJockey\Models\People;

$app->get('/addresses/{address_id}', function ($request, $response, $args) {
    $address_id = (int) $args['address_id'];
    $this->logger->info('Looking up address '. $address_id);

    $address = $this->addressesMapper->findById($address_id);

    return $response->withJson($address);
});

$app->get('/addresses', function ($request, $response, $args) {
    $this->logger->info("Looking up all addresses");

    $addresses = $this->addressesMapper->findAll();

    return $response->withJson($addresses);
});

$app->get('/people/{people_id}', function ($request, $response, $args) {
    $people_id = (int) $args['people_id'];
    $this->logger->info('Looking up person '. $people_id);

    $person = $this->peopleMapper->findById($people_id);

    return $response->withJson($person);
});

$app->get('/people', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Looking up all people");

    $people = $this->peopleMapper->findAll();

    // Render index view
    return $response->withJson($people);
});

$app->get('/[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});
