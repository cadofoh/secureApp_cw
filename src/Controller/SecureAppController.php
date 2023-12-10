<?php
// src/Controller/SecureAppController.php

require_once '../src/Model/SecureAppModel.php';
require_once '../src//View/SecureAppView.php';

class SecureAppController
{
    private $model;
    private $view;

    public function __construct(SecureAppModel $model, SecureAppView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleFormSubmission()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form inputs
            $dateInput1 = $_POST['dateInput1'] ?? '';
            $dateInput2 = $_POST['dateInput2'] ?? '';
            $phoneInput = $_POST['phoneInput'] ?? '';
            $jsonInput = $_POST['jsonInput'] ?? '';
            $emailInput = $_POST['emailInput'] ?? '';
            $passwordInput = $_POST['passwordInput'] ?? '';
            $postcodeInput = $_POST['postcodeInput'] ?? '';
            $creditCardInput = $_POST['creditCardInput'] ?? '';
            $ipInput = $_POST['ipInput'] ?? '';
            $additionalInput = $_POST['additionalInput'] ?? '';

            // Validate and store data
            $result = $this->model->storeData(
                $dateInput1,
                $dateInput2,
                $phoneInput,
                $jsonInput,
                $emailInput,
                $passwordInput,
                $postcodeInput,
                $creditCardInput,
                $ipInput,
                $additionalInput
            );
            if (is_array($result)) {
                // Errors occurred, update $errors array
                $errors = $result;
            } elseif ($result) {
                echo 'Data stored successfully!';
                return; // Don't render the form if data is stored successfully
            } else {
                $errors['general'] = 'Error storing data. Please check your inputs.';
            }
        }

        // Render the HTML form with errors
        $this->view->renderForm($errors);
    }
}
