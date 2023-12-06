<?php
// src/Model/SecureAppModel.php

class SecureAppModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function storeData(
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
    ) {
        $errors = [];

        // Validate inputs
        if (!$this->isValidDate($dateInput1) || !$this->isValidDate($dateInput2)) {
            $errors['dateInput'] = 'Invalid date format';
        }

        if (!$this->isValidPhoneNumber($phoneInput)) {
            $errors['phoneInput'] = 'Invalid phone number format Please use the format +44 20 7946 0958.';
        }

        if (!$this->isValidJson($jsonInput)) {
            $errors['jsonInput'] = 'Invalid JSON format Please provide valid JSON data.';
        }

        if (!$this->isValidEmail($emailInput)) {
            $errors['emailInput'] = 'Invalid email format. Please provide a valid email';
        }

        if (!$this->isValidPassword($passwordInput)) {
            $errors['passwordInput'] = 'Invalid password format. Please follow the password requirements.';
        }

        if (!$this->isValidPostcode($postcodeInput)) {
            $errors['postcodeInput'] = 'Invalid UK postcode format. Please use a valid format (e.g., B11 4NX)';
        }

        if (!$this->isValidCreditCard($creditCardInput)) {
            $errors['creditCardInput'] = 'Invalid credit card format. Please provide a valid credit card number';
        }

        if (!$this->isValidIpAddress($ipInput)) {
            $errors['ipInput'] = 'Invalid IP address format. Please provide a valid IP address. eg. 192.168.0.1';
        }

        // Add validations for other fields

        // If there are errors, return them
        if (!empty($errors)) {
            return $errors;
        }

        // Input validation passed, store data in the database
        try {
            $stmt = $this->db->prepare(
                'INSERT INTO client_data 
                   (dateInput1, dateInput2, phoneInput, jsonInput, emailInput, passwordInput, 
                   postcodeInput, creditCardInput, ipInput, additionalInput) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
            );

            $stmt->execute([
                $dateInput1, $dateInput2, $phoneInput, $jsonInput, $emailInput, $passwordInput,
                $postcodeInput, $creditCardInput, $ipInput, $additionalInput
            ]);

            return true;
        } catch (PDOException $e) {
            // Log or handle the database error as needed
            return false;
        }
    }

    private function isValidDate($date)
    {
        // Validate against 'yyyy-mm-dd' format
        $dateTime1 = DateTime::createFromFormat('Y-m-d', $date);

        // Validate against 'dd/mm/yyyy' format
        $dateTime2 = DateTime::createFromFormat('d/m/Y', $date);

        return ($dateTime1 && $dateTime1->format('Y-m-d') === $date) ||
            ($dateTime2 && $dateTime2->format('d/m/Y') === $date);
    }

    private function isValidPhoneNumber($phoneNumber)
    {
        // Implement phone number validation logic, return true if valid, false otherwise
        // Example: Use regular expressions to validate the phone number format
        return true;
    }

    private function isValidJson($jsonInput)
    {
        // URL of the JSONLint API
        $jsonLintApiUrl = 'https://jsonlint.com/api';

        // Set up the POST request
        $postData = [
            'json' => $jsonInput,
        ];

        $options = [
            'http' => [
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'method'  => 'POST',
                'content' => http_build_query($postData),
            ],
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($jsonLintApiUrl, false, $context);

        // Decode the JSON response
        $result = json_decode($response);

        // Check if the JSON is valid
        return isset($result->error) ? false : true;
    }

    private function isValidEmail($emailInput)
    {
        // Regular expression for basic email validation
        $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';

        // Use preg_match to test the email against the pattern
        return preg_match($pattern, $emailInput) === 1;
    }

    private function isValidPassword($passwordInput)
    {
        // Implement password validation logic, return true if valid, false otherwise
        // Example: Check for password strength requirements
        return true;
    }

    private function isValidPostcode($postcodeInput)
    {
        // Regular expression for basic UK postcode validation
        $pattern = '/^[A-Z]{1,2}\d{1,2}[A-Z]?\s?\d[A-Z]{2}$/i';

        // Use preg_match to test the postcode against the pattern
        return preg_match($pattern, $postcodeInput) === 1;
    }

    public function isValidCreditCard($creditCardInput)
    {
        // Remove spaces and non-numeric characters
        $cleanCreditCardNumber = preg_replace('/\D/', '', $creditCardInput);

        // Check if the credit card number is numeric and passes the Luhn algorithm
        if (is_numeric($cleanCreditCardNumber) && $this->luhnCheck($cleanCreditCardNumber)) {
            return true;
        }

        return false;
    }

    // Luhn algorithm check
    private function luhnCheck($number)
    {
        $number = (string)$number;
        $sum = 0;

        for ($i = 0; $i < strlen($number); $i++) {
            $digit = (int)$number[$i];

            if ($i % 2 === 0) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return ($sum % 10 === 0);
    }

    private function isValidIpAddress($ipInput)
    {
        // Use filter_var to validate the IP address
        return filter_var($ipInput, FILTER_VALIDATE_IP) !== false;
    }
}
