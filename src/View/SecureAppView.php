<?php
// src/View/SecureAppView.php

class SecureAppView
{
    public function renderForm($errors = [])
    {
        echo '<html>';
        echo '<head>';
        echo '<title>SecureApp Form</title>';
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
        echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
        echo '<script src="js/script.js"></script>';
        echo '</head>';
        echo '<body class="bg-light">';
        echo '<div class="container mt-5">';
        echo '<h1 class="text-center">SecureApp Form</h1>';
        echo '<form name="secureAppForm" method="post" action="index.php">';

        // Input 1: Date Input 1
        echo '<div class="form-group">';
        echo '<label for="dateInput1">Date Input 1:</label>';
        echo '<input type="text" class="form-control" name="dateInput1" id="dateInput1" placeholder="yyyy-mm-dd" value="' . htmlspecialchars($_POST['dateInput1'] ?? '') . '" required>';
        echo '<small class="form-text text-muted">Format: yyyy-mm-dd</small>';
        echo '<span id="dateInput1Error" class="text-danger"></span>';
        echo '<span class="text-danger">' . ($errors['dateInput1'] ?? '') . '</span>';
        echo '</div>';


        // Input 2: Date Input 2
        echo '<div class="form-group">';
        echo '<label for="dateInput2">Date Input 2:</label>';
        echo
        '<input type="text" class="form-control" name="dateInput2"  id="dateInput2" placeholder="dd/mm/yyyy"  value="' . htmlspecialchars($_POST['dateInput2'] ?? '') . '" required>';
        echo '<small class="form-text text-muted">Format: dd/mm/yyyy</small>';
        echo '<span id="dateInput2Error" class="text-danger"></span>';
        echo '<span class="text-danger">' . ($errors['dateInput2'] ?? '') . '</span>';
        echo '</div>';

        // Input 3: Phone Input
        echo '<div class="form-group">';
        echo '<label for="phoneInput">UK Phone Number Input:</label>';
        echo '<input type="text" class="form-control" name="phoneInput"  id="phoneInput" value="' . htmlspecialchars($_POST['phoneInput'] ?? '') . '" required>';
        echo '<small class="form-text text-muted">Format: +44 1234 567890</small>';
        echo '<span id="phoneInputError" class="text-danger"></span>';
        echo '<span class="text-danger">' . ($errors['phoneInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 4: JSON Input
        echo '<div class="form-group">';
        echo '<label for="jsonInput">JSON Input:</label>';
        echo
        '<textarea class="form-control" name="jsonInput"  id="jsonInput" value="' . htmlspecialchars($_POST['jsonInput'] ?? '') . '" required> </textarea>';
        echo '<small class="form-text text-muted">Example: {"name": "John Doe", "age": 30, "city": "London"}</small>';
        echo '<span id="jsonInputError" class="text-danger"></span>';
        echo '<span class="text-danger">' . ($errors['jsonInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 5: Email Input
        echo '<div class="form-group">';
        echo '<label for="emailInput">Email Input:</label>';
        echo
        '<input type="email" class="form-control" name="emailInput"  id="emailInput" value="' . htmlspecialchars($_POST['emailInput'] ?? '') . '" required>';
        echo '<small class="form-text text-muted">Example: john.doe@example.com</small>';
        echo '<span id="emailInputError" class="text-danger"></span>';
        echo '<span class="text-danger">' . ($errors['emailInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 6: Password Input
        echo '<div class="form-group">';
        echo '<label for="passwordInput">Password Input:</label>';
        echo '<input type="password" class="form-control" name="passwordInput"  id="passwordInput" value="' . htmlspecialchars($_POST['passwordInput'] ?? '') . '" required>';
        echo '<small class="form-text text-muted">Password should be at least 8 characters long with at least one uppercase letter, one lowercase letter, one digit, and one special character. Example:G30&SgH?VeIh1</small>';
        echo '<span class="text-danger">';
        echo '<span id="passwordInputError" class="text-danger"></span>';
        if (isset($errors['passwordInput']) && is_array($errors['passwordInput'])) {
            foreach ($errors['passwordInput'] as $error) {
                echo $error . '<br>';
            }
        }
        echo '</span>';
        echo '</div>';

        // Input 7: Postcode Input
        echo '<div class="form-group">';
        echo '<label for="postcodeInput">UK Postcode Input:</label>';
        echo
        '<input type="text" class="form-control" name="postcodeInput"   id="postcodeInput" "value="' . htmlspecialchars($_POST['postcodeInput'] ?? '') . '" required>';
        echo '<small class="form-text text-muted">Example: B16 0RP</small>';
        echo '<span id="postcodeInputError" class="text-danger"></span>';
        echo '<span class="text-danger">' . ($errors['postcodeInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 8: Credit Card Input
        echo '<div class="form-group">';
        echo '<label for="creditCardInput">Credit Card Input:</label>';
        echo
        '<input type="text" class="form-control" name="creditCardInput"  id="creditCardInput" value="' . htmlspecialchars($_POST['creditCardInput'] ?? '') . '" required>';
        echo '<small class="form-text text-muted"> Example: 4111 1111 1111 1111</small>';
        echo '<span id="creditCardInputError" class="text-danger"></span>';
        echo '<span class="text-danger">' . ($errors['creditCardInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 9: IP Address Input
        echo '<div class="form-group">';
        echo '<label for="ipInput">IP Address Input:</label>';
        echo
        '<input type="text" class="form-control" name="ipInput" id="ipInput" value="' . htmlspecialchars($_POST['ipInput'] ?? '') . '" required>';
        echo '<small class="form-text text-muted">Example: 192.168.0.1</small>';
        echo '<span id="ipInputError" class="text-danger"></span>';
        echo '<span class="text-danger">' . ($errors['ipInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 10: XML Input
        echo '<div class="form-group">';
        echo '<label for="xmlInput">XML Input:</label>';
        echo
        '<textarea class="form-control" name="xmlInput"  id="xmlInput" value="' . htmlspecialchars($_POST['xmlInput'] ?? '') . '" required> </textarea>';
        echo '<span id="xmlInputError" class="text-danger"></span>';
        $xmlContent = '<document><item attribute="value">Content</item></document>';
        echo '<small class="form-text text-muted">Example: ' . htmlspecialchars($xmlContent) . '</small>';
        echo '<span class="text-danger">' . ($errors['xmlInput'] ?? '') . '</span>';
        echo '</div>';

        echo '<button type="submit" class="btn btn-primary">Submit</button>';
        echo '</form>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
        }
    }
