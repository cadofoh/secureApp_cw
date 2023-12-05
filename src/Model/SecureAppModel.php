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
        // Validate inputs
        if (
            !$this->isValidDate($dateInput1) || !$this->isValidDate($dateInput2) ||
            !$this->isValidPhoneNumber($phoneInput) || !$this->isValidJson($jsonInput) ||
            !$this->isValidEmail($emailInput) || !$this->isValidPassword($passwordInput) ||
            !$this->isValidPostcode($postcodeInput) || !$this->isValidCreditCard($creditCardInput) ||
            !$this->isValidIpAddress($ipInput)
        ) {
            // One or more inputs are invalid
            return false;
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

    private function isValidJson($json)
    {
        // URL of the JSONLint API
        $jsonLintApiUrl = 'https://jsonlint.com/api';

        // Set up the POST request
        $postData = [
            'json' => $json,
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

    private function isValidEmail($email)
    {
        // Regular expression for basic email validation
        $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';

        // Use preg_match to test the email against the pattern
        return preg_match($pattern, $email) === 1;
    }

    private function isValidPassword($password)
    {
        // Implement password validation logic, return true if valid, false otherwise
        // Example: Check for password strength requirements
        return true;
    }

    private function isValidPostcode($postcode)
    {
        // Implement address validation logic, return true if valid, false otherwise
        // Example: Check for address format or use external APIs for validation
        return true;
    }

    private function isValidCreditCard($creditCard)
    {
        // Implement credit card validation logic, return true if valid, false otherwise
        // Example: Use algorithms like Luhn's algorithm to check credit card numbers
        return true;
    }

    private function isValidIpAddress($ipAddress)
    {
        // Implement IP address validation logic, return true if valid, false otherwise
        // Example: Use filter_var() with FILTER_VALIDATE_IP
        return true;
    }
}
