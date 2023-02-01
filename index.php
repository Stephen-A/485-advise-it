<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');
require_once $_SERVER["DOCUMENT_ROOT"].'/../config.php';

// Start Session
session_start();

// Create an instance of the base class
$f3 = Base::instance();

// Create instance of Controller
$con = new Controller($f3);

// Define default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});

// Define home route
$f3->route('GET /advise-it', function() {
    $GLOBALS['con']->home();
});

// Define create new student plan route
$f3->route('GET|POST /new-plan', function($f3) {
    $GLOBALS['con']->createNewStudentPlan($f3->get('PARAMS.student_token'));
});

$f3->route('GET /print-student-plan/@student_token', function($f3) {
    $GLOBALS['con']->printStudentPlan($f3->get('PARAMS.student_token'));
});

// Define view student plan route with student token as part of the url
$f3->route('GET|POST /view-plan/@student_token', function($f3) {
    $GLOBALS['con']->viewStudentPlan($f3->get('PARAMS.student_token'));
});

$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});

// Run fat-free
$f3->run();