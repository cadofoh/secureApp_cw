<?php
// src/Model/SecureAppModel.php
require_once __DIR__ . '/../config/DatabaseConnection.php';
require_once __DIR__ .  '/../Exceptions/ValidationException.php';
class SecureAppModel
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance()->getConnection();
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
        $xmlInput
    ) {
        $errors = [];

        // Validate inputs
    try {

        if (!$this->isValidDate($dateInput1)) {
            $errors['dateInput1'] = 'Invalid date format';
        }
        
        if (!$this->isValidDate($dateInput2)) {
            $errors['dateInput2 '] = 'Invalid date format';
        }
        
        if (!$this->isValidPhoneNumber($phoneInput)) {
            $errors['phoneInput'] = 'Invalid phone number format. Please use the format +44 1234 56789.';
        }

        if (!$this->isValidJson($jsonInput)) {
            $errors['jsonInput'] = 'Invalid JSON format. Please provide valid JSON data.';
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
        if (!$this->isValidXml($xmlInput)) {
            $errors['xmlInput'] = 'Invalid XML format. Please provide valid XML';
        }
        
    } catch (ValidationException $e) {
            // Catch ValidationException and add the error to the $errors array
            error_log($e->getMessage());
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
                   postcodeInput, creditCardInput, ipInput, xmlInput) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
            );

            $stmt->execute([
                $dateInput1, $dateInput2, $phoneInput, $jsonInput, $emailInput, $passwordInput,
                $postcodeInput, $creditCardInput, $ipInput, $xmlInput
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

        if ($dateTime1 && $dateTime1->format('Y-m-d') === $date) {
            return true;
        } elseif ($dateTime2 && $dateTime2->format('d/m/Y') === $date) {
            return true;
        }

        throw new ValidationException('Invalid date format');
    }


    private function isValidPhoneNumber($phoneNumber)
    {
        // Validate UK phone number format: +44 1234 567890
        $pattern = '/^\+\d{2}\s\d{4}\s\d{6}$/';

        if (preg_match($pattern, $phoneNumber) === 1) {
            return true;
        }
        throw new ValidationException('Invalid phone number format. Please use the format +44 1234 56789.');
    }

    private function isValidJson($jsonInput)
    {
        // Try to decode the JSON string
        $decoded = json_decode($jsonInput);

        if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new ValidationException('Invalid JSON format. Please provide valid JSON data.');
        }
        return true;
    }

    private function isValidEmail($emailInput)
    {
        // Regular expression for basic email validation
        $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';

        if (preg_match($pattern, $emailInput) === 1) {
            return true;
        }

        throw new ValidationException('Invalid email format. Please provide a valid email.');
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

        // If there are errors, throw ValidationException
        if (!empty($errors)) {
            throw new ValidationException('Invalid password format', 0, null, $errors);
        }

        // If there are no errors, return an empty array
        return [];
    }

    private function isValidPostcode($postcodeInput)
    {
        // Regular expression for basic UK postcode validation
        $pattern = '/^[A-Z]{1,2}\d{1,2}[A-Z]?\s?\d[A-Z]{2}$/i';

        // Use preg_match to test the postcode against the pattern
        if (preg_match($pattern, $postcodeInput) !== 1) {
            throw new ValidationException('Invalid UK postcode format. Please use a valid format (e.g., B11 4NX)');
        }

        return true;
    }

    public function isValidCreditCard($creditCardInput)
    {
        // Remove spaces and non-numeric characters
        $cleanCreditCardNumber = preg_replace('/\D/', '', $creditCardInput);

        // Check if the credit card number is numeric and passes the Luhn algorithm
        if (!is_numeric($cleanCreditCardNumber) || !$this->luhnCheck($cleanCreditCardNumber)) {
            throw new ValidationException('Invalid credit card format. Please provide a valid credit card number');
        }

        return true;
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
         if (filter_var($ipInput, FILTER_VALIDATE_IP) === false) {
            throw new ValidationException('Please provide a valid IP address. e.g., 192.168.0.1');
        }

        return true;
    }

    public function isValidXml($xmlInput)
    {
        // Try to load the XML string
        $xml = simplexml_load_string($xmlInput);

        // Check if the XML is valid
        return ($xml !== false);
    }
}
