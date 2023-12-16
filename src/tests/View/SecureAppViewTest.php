<?php
// src/tests/View/SecureAppViewTest.php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../View/SecureAppView.php';

class SecureAppViewTest extends TestCase 
{
    public function testRenderForm_NoErrors_FormElementsPresent()
    {
        $view = new SecureAppView();

        // Use output buffering to capture echoed content
        ob_start();
        $view->renderForm();
        $output = ob_get_clean();

        // Assert that the rendered output contains form elements
        $this->assertStringContainsString('<form', $output);
        $this->assertStringContainsString('id="dateInput1"', $output);
        $this->assertStringContainsString('id="dateInput2"', $output);
        $this->assertStringContainsString('id="phoneInput"', $output);
        $this->assertStringContainsString('id="jsonInput"', $output);
        $this->assertStringContainsString('id="emailInput"', $output);
        $this->assertStringContainsString('id="passwordInput"', $output);
        $this->assertStringContainsString('id="postcodeInput"', $output);
        $this->assertStringContainsString('id="creditCardInput"', $output);
        $this->assertStringContainsString('id="ipInput"', $output);
        $this->assertStringContainsString('id="xmlInput"', $output);
        $this->assertStringContainsString('button type="submit"', $output);
    }

    public function testRenderForm_WithErrors_ErrorsDisplayed()
    {
        $view = new SecureAppView();

        // Mock errors array
        $errors = [
            'dateInput1' => 'Invalid date format',
            'dateInput2' => 'Invalid date format',
            'phoneInput' => 'Invalid phone number',
            'jsonInput' => 'Invalid JSON format',
            'emailInput' => 'Invalid email format',
            'postcodeInput' => 'Invalid UK postcode format',
            'creditCardInput' => 'Invalid credit card format',
            'ipInput' => 'Invalid IP address format',
            'xmlInput' => 'Invalid XML format',
        ];

        // Use output buffering to capture echoed content
        ob_start();
        $view->renderForm($errors);
        $output = ob_get_clean();

        // Assert that the rendered output contains error messages
        foreach ($errors as $error) {
            $this->assertStringContainsString($error, $output);
        }
    }

    public function testRenderForm_WithXmlContent_XmlContentDisplayed()
    {
        $view = new SecureAppView();

        // Mock XML content
        $xmlContent = '<document><item attribute="value">Content</item></document>';

        // Use output buffering to capture echoed content
        ob_start();
        $view->renderForm([], $xmlContent);
        $output = ob_get_clean();

        // Assert that the rendered output contains the provided XML content
        $this->assertStringContainsString(htmlspecialchars($xmlContent), $output);
    }

    public function testRenderForm_WithAllElements_AllElementsDisplayed()
    {
        $view = new SecureAppView();

        // Mock errors array
        $errors = [
            'dateInput1' => 'Invalid date format',
            'dateInput2' => 'Invalid date format',
            'phoneInput' => 'Invalid phone number',
            'jsonInput' => 'Invalid JSON format',
            'emailInput' => 'Invalid email format',
            'postcodeInput' => 'Invalid UK postcode format',
            'creditCardInput' => 'Invalid credit card format',
            'ipInput' => 'Invalid IP address format',
            'xmlInput' => 'Invalid XML format',
        ];

        // Mock XML content
        $xmlContent = '<document><item attribute="value">Content</item></document>';

        // Use output buffering to capture echoed content
        $testarray =[];
        ob_start();
        $view->renderForm($errors, $xmlContent, $testarray);
        $output = ob_get_clean();

        // Assert that the rendered output contains all elements
        $this->assertStringContainsString('<form', $output);
        $this->assertStringContainsString('button type="submit"', $output);

        foreach ($errors as $error) {
            $this->assertStringContainsString($error, $output);
        }

        $this->assertStringContainsString(htmlspecialchars($xmlContent), $output);

       
    }
}