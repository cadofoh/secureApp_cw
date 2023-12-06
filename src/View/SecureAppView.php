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
        echo '<form name="secureAppForm" onsubmit="return validateForm()" method="post" action="index.php">';

        // Input 1: Date Input 1
        echo '<div class="form-group">';
        echo '<label for="dateInput1">Date Input 1:</label>';
        echo '<input type="text" class="form-control" name="dateInput1" placeholder="yyyy-mm-dd" required>';
        echo '<small class="form-text text-muted">Format: yyyy-mm-dd</small>';
        echo '<span class="text-danger">' . ($errors['dateInput'] ?? '') . '</span>';
        echo '</div>';


        // Input 2: Date Input 2
        echo '<div class="form-group">';
        echo '<label for="dateInput2">Date Input 2:</label>';
        echo '<input type="text" class="form-control" name="dateInput2" placeholder="dd/mm/yyyy" required>';
        echo '<small class="form-text text-muted">Format: yyyy-mm-dd</small>';
        echo '<span class="text-danger">' . ($errors['dateInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 3: Phone Input
        echo '<div class="form-group">';
        echo '<label for="phoneInput">Phone Input:</label>';
        echo '<input type="text" class="form-control" name="phoneInput" placeholder="+44 20 7946 0958" required>';
        echo '<small class="form-text text-muted">Example: +44 20 7946 0958</small>';
        echo '<span class="text-danger">' . ($errors['phoneInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 4: JSON Input
        echo '<div class="form-group">';
        echo '<label for="jsonInput">JSON Input:</label>';
        echo '<textarea class="form-control" name="jsonInput" placeholder=\'{"name": "John Doe", "age": 30, "city": "New York"}\' required></textarea>';
        echo '<small class="form-text text-muted">Example: {"name": "John Doe", "age": 30, "city": "London"}</small>';
        echo '<span class="text-danger">' . ($errors['jsonInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 5: Email Input
        echo '<div class="form-group">';
        echo '<label for="emailInput">Email Input:</label>';
        echo '<input type="email" class="form-control" name="emailInput" placeholder="john.doe@example.com" required>';
        echo '<small class="form-text text-muted">Example: john.doe@example.com</small>';
        echo '<span class="text-danger">' . ($errors['emailInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 6: Password Input
        echo '<div class="form-group">';
        echo '<label for="passwordInput">Password Input:</label>';
        echo '<input type="password" class="form-control" name="passwordInput" placeholder="SecurePassword123!" required>';
        echo '<small class="form-text text-muted">Example: SecurePassword123!</small>';
        echo '<span class="text-danger">' . ($errors['passwordInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 7: Postcode Input
        echo '<div class="form-group">';
        echo '<label for="postcodeInput">Postcode Input:</label>';
        echo '<input type="text" class="form-control" name="postcodeInput" placeholder="B11 4NX" required>';
        echo '<small class="form-text text-muted">Example: B16 0RP</small>';
        echo '<span class="text-danger">' . ($errors['postcodeInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 8: Credit Card Input
        echo '<div class="form-group">';
        echo '<label for="creditCardInput">Credit Card Input:</label>';
        echo '<input type="text" class="form-control" name="creditCardInput" placeholder="4111 1111 1111 1111" required>';
        echo '<small class="form-text text-muted">Example: 4111 1111 1111 1111</small>';
        echo '<span class="text-danger">' . ($errors['creditCardInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 9: IP Address Input
        echo '<div class="form-group">';
        echo '<label for="ipInput">IP Address Input:</label>';
        echo '<input type="text" class="form-control" name="ipInput" placeholder="192.168.0.1" required>';
        echo '<span class="text-danger">' . ($errors['ipInput'] ?? '') . '</span>';
        echo '</div>';

        // Input 10: Any Additional Input
        echo '<div class="form-group">';
        echo '<label for="additionalInput">Additional Input:</label>';
        echo '<input type="text" class="form-control" name="additionalInput" placeholder="Additional Input" required>';
        echo '<span class="text-danger">' . ($errors['additionalInput'] ?? '') . '</span>';
        echo '</div>';

        echo '<button type="submit" class="btn btn-primary">Submit</button>';
        echo '</form>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    }
}
