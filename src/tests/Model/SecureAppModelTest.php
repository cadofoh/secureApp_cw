<?php
// src/tests/Model/SecureAppModelTest.php
use PHPUnit\Framework\TestCase;

require_once __DIR__ .  '/../../Model/SecureAppModel.php';
require_once __DIR__ .  '/../../View/SecureAppView.php';
class SecureAppModelTest extends TestCase
{
    public function testIsValidDate_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidDate('2023-12-01'));
    }

    public function testIsValidPhoneNumber_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidPhoneNumber('+44 1234 567890'));
    }

    public function testIsValidXml_ValidXml_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidXml("<root>
    <element>value</element>
</root>"));
    }

    public function testIsValidCreditCard_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidCreditCard('4111111111111111'));
    }

    public function testIsValidIpAddress_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidIpAddress('192.168.0.1'));
    }


    public function testIsValidJson_ValidJson_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidJson('{"key": "value"}'));
    }
    public function testIsValidEmail_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidEmail('test@example.com'));
    }
    public function testIsValidPassword_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue(empty($model->isValidPassword('Password123!')));
    }

    public function testIsValidPostcode_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidPostcode('B11 4NX'));
    }
    public function testStoreData_GeneralValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => 'invalid_date',
            'dateInput2' => 'invalid_date',
            'phoneInput' => 'invalid_phone',
            'jsonInput' => 'invalid_json',
            'emailInput' => 'invalid_email',
            'passwordInput' => 'invalid_password',
            'postcodeInput' => 'invalid_postcode',
            'creditCardInput' => 'invalid_credit_card',
            'ipInput' => 'invalid_ip_address',
            'xmlInput' => 'invalid_xml',
        );

        $this->expectException(ValidationException::class);
        $model->storeData(...array_values($invalidData));
    }


    public function testStoreData_InvalidDateInput1_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => 'invalid_date',
            'dateInput2' => '2023-12-01',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => '4111111111111111',
            'ipInput' => '192.168.0.1',
            'xmlInput' => '<root><element>value</element></root>',
        );

        // Set the expected exception and message
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid date format');

        // Call the storeData method with the invalid date data
        $model->storeData(...array_values($invalidData));
    }

    public function testStoreData_InvalidDateInput2_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => 'invalid_date',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => '4111111111111111',
            'ipInput' => '192.168.0.1',
            'xmlInput' => '<root><element>value</element></root>',
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid date format');

        $model->storeData(...array_values($invalidData));
    }


    public function testStoreData_InvalidPhoneInput_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => '2023-12-02',
            'phoneInput' => 'invalid_phone',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => '4111111111111111',
            'ipInput' => '192.168.0.1',
            'xmlInput' => '<root><element>value</element></root>',
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid phone number format. Please use the format +44 1234 567890.');

        $model->storeData(...array_values($invalidData));
    }


    public function testStoreData_InvalidJsonInput_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => '2023-12-02',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => 'invalid_json',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => '4111111111111111',
            'ipInput' => '192.168.0.1',
            'xmlInput' => '<root><element>value</element></root>',
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid JSON format. Please provide valid JSON data.');
        $model->storeData(...array_values($invalidData));
    }

    public function testStoreData_InvalidEmailInput_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => '2023-12-02',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'invalid_email',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => '4111111111111111',
            'ipInput' => '192.168.0.1',
            'xmlInput' => '<root><element>value</element></root>',
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid email format. Please provide a valid email');

        $model->storeData(...array_values($invalidData));
    }

    public function testStoreData_InvalidPasswordInput_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => '2023-12-02',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'invalid_password',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => '4111111111111111',
            'ipInput' => '192.168.0.1',
            'xmlInput' => '<root><element>value</element></root>',
        );

        $this->expectException(ValidationException::class);
        $model->storeData(...array_values($invalidData));
    }

    public function testStoreData_InvalidPostcodeInput_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => '2023-12-02',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'invalid_postcode',
            'creditCardInput' => '4111111111111111',
            'ipInput' => '192.168.0.1',
            'xmlInput' => '<root><element>value</element></root>',
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid UK postcode format. Please use a valid format (e.g., B11 4NX)');

        $model->storeData(...array_values($invalidData));
    }

    public function testStoreData_InvalidCreditCardInput_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => '2023-12-02',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => 'invalid_credit_card',
            'ipInput' => '192.168.0.1',
            'xmlInput' => '<root><element>value</element></root>',
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid credit card format. Please provide a valid credit card number');

        $model->storeData(...array_values($invalidData));
    }

    public function testStoreData_InvalidIpAddressInput_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => '2023-12-02',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => '4111111111111111',
            'ipInput' => 'invalid_ip_address',
            'xmlInput' => '<root><element>value</element></root>',
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Please provide a valid IP address. eg. 192.168.0.1');

        $model->storeData(...array_values($invalidData));
    }

    public function testStoreData_InvalidXmlInput_ValidationExceptionThrown()
    {
        $model = new SecureAppModel();
        $invalidData = array(
            'dateInput1' => '2023-12-01',
            'dateInput2' => '2023-12-02',
            'phoneInput' => '+44 1234 567890',
            'jsonInput' => '{"key": "value"}',
            'emailInput' => 'test@example.com',
            'passwordInput' => 'ValidPassword123!',
            'postcodeInput' => 'B11 4NX',
            'creditCardInput' => '4111111111111111',
            'ipInput' => '192.168.0.1',
            'xmlInput' => 'invalid_xml',
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid XML format. Please provide valid XML');
        $model->storeData(...array_values($invalidData));
    }
}
