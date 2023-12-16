<?php
// src/tests/Model/SecureAppModelTest.php
use PHPUnit\Framework\TestCase;

require_once __DIR__ .  '/../../Model/SecureAppModel.php';
class SecureAppModelTest extends TestCase
{
    public function testIsValidDate_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidDate('2023-12-01'));
    }

    public function testIsValidDate_InvalidFormat_ThrowsValidationException()
    {
        $model = new SecureAppModel();
        $this->expectException(ValidationException::class);
        $model->isValidDate('invalid_date');
    }

    public function testIsValidPhoneNumber_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidPhoneNumber('+44 1234 567890'));
    }

    public function testIsValidPhoneNumber_InvalidFormat_ThrowsValidationException()
    {
        $model = new SecureAppModel();
        $this->expectException(ValidationException::class);
        $model->isValidPhoneNumber('invalid_phone');
    }



    public function testIsValidXml_ValidXml_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidXml("<root>
    <element>value</element>
</root>"));
    }

    public function testIsValidXml_InvalidXml_ThrowsValidationException()
    {
        $model = new SecureAppModel();
        $this->expectException(ValidationException::class);
        $model->isValidXml('');
    }


    public function testIsValidCreditCard_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidCreditCard('4111111111111111'));
    }

    public function testIsValidCreditCard_InvalidFormat_ThrowsValidationException()
    {
        $model = new SecureAppModel();
        $this->expectException(ValidationException::class);
        $model->isValidCreditCard('invalid_credit_card');
    }

    public function testIsValidIpAddress_ValidFormat_ReturnsTrue()
    {
        $model = new SecureAppModel();
        $this->assertTrue($model->isValidIpAddress('192.168.0.1'));
    }

    public function testIsValidIpAddress_InvalidFormat_ThrowsValidationException()
    {
        $model = new SecureAppModel();
        $this->expectException(ValidationException::class);
        $model->isValidIpAddress('invalid_ip_address');
    }

}