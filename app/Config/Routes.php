<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'Home::index');

// Authentication Routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::processLogin');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::processRegister');
    $routes->get('logout', 'AuthController::logout');
});

// Quran Routes
$routes->group('quran', function($routes) {
    $routes->get('/', 'QuranController::index');
    $routes->get('surah/(:num)', 'QuranController::surah/$1');
});

// Quiz Routes
$routes->group('quiz', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'QuranQuizController::index');
    $routes->get('start', 'QuranQuizController::start');
    $routes->post('submit', 'QuranQuizController::submit');
});

// Doa & Dzikir Routes
$routes->group('doa', function($routes) {
    $routes->get('/', 'DoaDzikirController::index');
    $routes->get('(:segment)', 'DoaDzikirController::detail/$1');
});

// Prayer Times Routes
$routes->get('shalat', 'PrayerController::index');

// Hadith Routes
$routes->group('hadith', function($routes) {
    $routes->get('/', 'HadithController::index');
    $routes->get('(:segment)/(:segment)', 'HadithController::detail/$1/$2');
});

// Story Routes
$routes->group('kisah', function($routes) {
    $routes->get('/', 'StoryController::index');
    $routes->get('(:num)', 'StoryController::detail/$1');
});

// Habit Tracker Routes (Requires Auth)
$routes->group('habit', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'HabitController::index');
    $routes->post('log', 'HabitController::log');
});
