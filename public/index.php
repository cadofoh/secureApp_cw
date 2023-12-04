<?php
// public/index.php

require_once '../src/config/db.php';
require_once '../src/Controller/SecureAppController.php';
require_once '../src/Model/SecureAppModel.php';
require_once '../src/View/SecureAppView.php';

$model = new SecureAppModel($db);
$view = new SecureAppView();
$controller = new SecureAppController($model, $view);

// Handle form submission and render the form
$controller->handleFormSubmission();
