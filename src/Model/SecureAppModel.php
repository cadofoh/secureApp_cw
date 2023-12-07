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
            $errors['phoneInput'] = 'Invalid phone number format Please use the format +44 1234 56789.';
        }

        if (!$this->isValidJson($jsonInput)) {
            $errors['jsonInput'] = 'Invalid JSON format Please provide valid JSON data.';
        }

        if (!$this->isValidEmail($emailInput)) {
            $errors['emailInput'] = 'Invalid email format. Please provide a valid email';
        }

        $passwordErrors = $this->isValidPassword($passwordInput);

        if (!empty($passwordErrors)) {
            $errors['passwordInput'] = $passwordErrors;
        }

        if (!$this->isValidPostcode($postcodeInput)) {
            $errors['postcodeInput'] = 'Invalid UK postcode format. Please use a valid format (e.g., B11 4NX)';
        }

        if (!$this->isValidCreditCard($creditCardInput)) {
            $errors['creditCardInput'] = 'Invalid credit card format. Please provide a valid credit card number';
        }

        if (!$this->isValidIpAddress($ipInput)) {
            $errors['ipInput'] = 'Please provide a valid IP address. eg. 192.168.0.1';
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
        // Validate UK phone number format: +44 7911 123456
        $pattern = '/^\+\d{2}\s\d{4}\s\d{6}$/';

        // Use preg_match to test the phone number against the pattern
        return preg_match($pattern, $phoneNumber) === 1;
    }

    private function isValidJson($jsonInput)
    {
      return true;
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
        $errors = [];

        // Minimum length requirement
        if (strlen($passwordInput) < 8) {
            $errors[] = 'Password must be at least 8 characters long.';
        }

        // Check for at least one uppercase letter
        if (!preg_match('/[A-Z]/', $passwordInput)) {
            $errors[] = 'Password must contain at least one uppercase letter.';
        }

        // Check for at least one lowercase letter
        if (!preg_match('/[a-z]/', $passwordInput)) {
            $errors[] = 'Password must contain at least one lowercase letter.';
        }

        // Check for at least one digit
        if (!preg_match('/\d/', $passwordInput)) {
            $errors[] = 'Password must contain at least one digit.';
        }

        // Check for at least one special character
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $passwordInput)) {
            $errors[] = 'Password must contain at least one special character.';
        }

        // If there are errors, return them
        return $errors;
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
