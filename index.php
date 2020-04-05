<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/DB.php';

Flight::route('GET /clubs', function() {
    $db = new DB();
    Flight::json($db->get_all_clubs());
});


Flight::route('GET /clubs/id/@id', function($id) {
    $db = new DB();
    Flight::json($db->get_club_by_id($id));
});

Flight::route('GET /clubs/name/@name', function($name) {
    $db = new DB();
    Flight::json($db->get_club_by_name($name));
});

Flight::route('GET /clubs/league/@id', function($id) {
    $db = new DB();
    Flight::json($db->get_clubs_by_league($id));
});

Flight::start();

$db = new DB();