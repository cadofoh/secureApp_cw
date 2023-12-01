<?php
// src/View/SecureAppView.php

class SecureAppView
{
    public function renderForm()
    {
        echo '<html>';
        echo '<head>';
        echo '<title>SecureApp Form</title>';
        echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
        echo '<script src="js/script.js"></script>'; 
        echo '</head>';
        echo '<body>';
        echo '<h1>SecureApp Form</h1>';
        echo '<form name="secureAppForm" onsubmit="return validateForm()" method="post" action="index.php">';

        // Input 1: Date Input 1
        echo '<label for="dateInput1">Date Input 1:</label>';
        echo '<input type="text" name="dateInput1" placeholder="yyyy-mm-dd" required>';
        echo '<br>';

        // Input 2: Date Input 2
        echo '<label for="dateInput2">Date Input 2:</label>';
        echo '<input type="text" name="dateInput2" placeholder="dd/mm/yyyy" required>';
        echo '<br>';

        // Input 3: Phone Input
        echo '<label for="phoneInput">Phone Input:</label>';
        echo '<input type="text" name="phoneInput" placeholder="+44 20 7946 0958" required>';
        echo '<br>';

        // Input 4: JSON Input
        echo '<label for="jsonInput">JSON Input:</label>';
        echo '<textarea name="jsonInput" placeholder=\'{"name": "John Doe", "age": 30, "city": "New York"}\' required></textarea>';
        echo '<br>';

        // Input 5: Email Input
        echo '<label for="emailInput">Email Input:</label>';
        echo '<input type="email" name="emailInput" placeholder="john.doe@example.com" required>';
        echo '<br>';

        // Input 6: Password Input
        echo '<label for="passwordInput">Password Input:</label>';
        echo '<input type="password" name="passwordInput" placeholder="SecurePassword123!" required>';
        echo '<br>';

        // Input 7: Address Input
        echo '<label for="addressInput">Address Input:</label>';
        echo '<input type="text" name="addressInput" placeholder="123 Main St, Cityville, Country" required>';
        echo '<br>';

        // Input 8: Credit Card Input
        echo '<label for="creditCardInput">Credit Card Input:</label>';
        echo '<input type="text" name="creditCardInput" placeholder="4111 1111 1111 1111" required>';
        echo '<br>';

        // Input 9: IP Address Input
        echo '<label for="ipInput">IP Address Input:</label>';
        echo '<input type="text" name="ipInput" placeholder="192.168.0.1" required>';
        echo '<br>';

        // Input 10: Any Additional Input
        echo '<label for="additionalInput">Additional Input:</label>';
        echo '<input type="text" name="additionalInput" placeholder="Additional Input" required>';
        echo '<br>';

        echo '<button type="submit">Submit</button>';
        echo '</form>';
        echo '</body>';
        echo '</html>';
    }
}
?> 