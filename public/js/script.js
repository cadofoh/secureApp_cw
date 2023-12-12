// public/js/script.js

// Front-end validation functions
function validateDateFormatYMD(value) {
  const dateRegex = /^\d{4}-\d{2}-\d{2}$/;

  if (!dateRegex.test(value)) {
    return false; // Incorrect format
  }

  const parts = value.split("-");
  const year = parseInt(parts[0], 10);
  const month = parseInt(parts[1], 10);
  const day = parseInt(parts[2], 10);

  // Validate the date using JavaScript's Date object
  const dateObject = new Date(year, month - 1, day); // Months are zero-based in JavaScript

  // Check if the provided year, month, and day are valid
  return (
    dateObject.getFullYear() === year &&
    dateObject.getMonth() === month - 1 &&
    dateObject.getDate() === day
  );
}

function validateDateFormatDMY(value) {
  const dateRegex = /^\d{2}\/\d{2}\/\d{4}$/;

  if (!dateRegex.test(value)) {
    return false; // Incorrect format
  }

  const parts = value.split("/");
  const day = parseInt(parts[0], 10);
  const month = parseInt(parts[1], 10);
  const year = parseInt(parts[2], 10);

  // Validate the date using JavaScript's Date object
  const dateObject = new Date(year, month - 1, day); // Months are zero-based in JavaScript

  // Check if the provided day, month, and year are valid
  return (
    dateObject.getFullYear() === year &&
    dateObject.getMonth() === month - 1 &&
    dateObject.getDate() === day
  );
}
function validatePhoneNumber(value) {
  // Implement your phone number validation logic here
  return /^\+44\s?(\d\s?){9,10}$/.test(value);
}

function isValidJson(jsonString) {
  try {
    JSON.parse(jsonString);
    return true;
  } catch (e) {
    return false;
  }
}

function validateEmail(value) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
}

function validatePassword(value) {
  const hasLowercase = /[a-z]/.test(value);
  const hasUppercase = /[A-Z]/.test(value);
  const hasDigit = /\d/.test(value);
  const hasSpecialChar = /[^a-zA-Z\d]/.test(value); // Check for non-alphanumeric characters
  const hasMinLength = value.length >= 8;

  const isValidPassword =
    hasLowercase && hasUppercase && hasDigit && hasSpecialChar && hasMinLength;

  return isValidPassword;
}

function validatePostcode(value) {
  return /^[A-Z]{1,2}\d{1,2}[A-Z]?\s?\d[A-Z]{2}$/i.test(value);
}

function validateCreditCard(value) {
  return /^\d{4} \d{4} \d{4} \d{4}$/.test(value);
}

function validateIpAddress(value) {
  return /^(\d{1,3}\.){3}\d{1,3}$/.test(value);
}

function validateXml(xmlString, xsdString) {
  const parser = new DOMParser();
  const xmlDoc = parser.parseFromString(xmlString, "application/xml");

  // Check if the document is well-formed
  if (xmlDoc.getElementsByTagName("parsererror").length > 0) {
    return false; // XML is not well-formed
  }

  // If a schema is provided, perform schema validation
  if (xsdString) {
    const schema = parser.parseFromString(xsdString, "application/xml");
    const validator = new XSLTProcessor();
    validator.importStylesheet(schema);

    try {
      const result = validator.transformToDocument(xmlDoc);
      const errors = result.getElementsByTagName("parsererror");
      return errors.length === 0; // No validation errors
    } catch (e) {
      return false; // An error occurred during validation
    }
  }

  return true; // XML is well-formed (no schema validation)
}

document.addEventListener("DOMContentLoaded", function () {
  var timeoutId;
  // Add event listener after the DOM is fully loaded
  var dateInput1Element = document.getElementById("dateInput1");
  if (dateInput1Element) {
    dateInput1Element.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(
          dateInput1Element,
          validateDateFormatYMD,
          "dateInput1Error"
        );
      }, 1000);
    });
  }

  var dateInput2Element = document.getElementById("dateInput2");
  if (dateInput2Element) {
    dateInput2Element.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(
          dateInput2Element,
          validateDateFormatDMY,
          "dateInput2Error"
        );
      }, 1000);
    });
  }

  var phoneInputElement = document.getElementById("phoneInput");
  if (phoneInputElement) {
    phoneInputElement.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(
          phoneInputElement,
          validatePhoneNumber,
          "phoneInputError"
        );
      }, 1000);
    });
  }

  var jsonInputElement = document.getElementById("jsonInput");
  if (jsonInputElement) {
    jsonInputElement.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(jsonInputElement, isValidJson, "jsonInputError");
      }, 1000);
    });
  }

  var emailInputElement = document.getElementById("emailInput");
  if (emailInputElement) {
    emailInputElement.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(emailInputElement, validateEmail, "emailInputError");
      }, 1000);
    });
  }

  var passwordInputElement = document.getElementById("passwordInput");
  if (passwordInputElement) {
    passwordInputElement.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(
          passwordInputElement,
          validatePassword,
          "passwordInputError"
        );
      }, 1000);
    });
  }

  var postcodeInputElement = document.getElementById("postcodeInput");
  if (postcodeInputElement) {
    postcodeInputElement.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(
          postcodeInputElement,
          validatePostcode,
          "postcodeInputError"
        );
      }, 1000);
    });
  }

  var creditCardInputElement = document.getElementById("creditCardInput");
  if (creditCardInputElement) {
    creditCardInputElement.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(
          creditCardInputElement,
          validateCreditCard,
          "creditCardInputError"
        );
      }, 1000);
    });
  }

  var ipInputElement = document.getElementById("ipInput");
  if (ipInputElement) {
    ipInputElement.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(ipInputElement, validateIpAddress, "ipInputError");
      }, 1000);
      validateField(this, validateIpAddress, "ipInputError");
    });
  }

  var xmlInputElement = document.getElementById("xmlInput");
  if (xmlInputElement) {
    xmlInputElement.addEventListener("keyup", function () {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        validateField(xmlInputElement, validateXml, "xmlInputError");
      }, 1000);
    });
  }
});

function validateField(field, validationFunction, errorSpanId) {
  var value = field.value;
  var isValid = validationFunction(value);

  if (isValid) {
    field.classList.remove("is-invalid");
    document.getElementById(errorSpanId).textContent = "";
  } else {
    field.classList.add("is-invalid");

    // Customize error messages based on the field type
    var fieldName = field.name;
    var errorMessage = "";

    switch (fieldName) {
      case "dateInput1":
        errorMessage = "Please use yyyy-mm-dd.";
        break;
      case "dateInput2":
        errorMessage = "Please use dd/mm/yyyy.";
        break;
      case "phoneInput":
        errorMessage = "Invalid phone number format.";
        break;
      case "jsonInput":
        errorMessage = "Invalid JSON format.";
        break;
      case "emailInput":
        errorMessage = "Please provide a valid email.";
        break;
      case "passwordInput":
        errorMessage =
          "Password should be at least 8 characters long with at least one uppercase letter, one lowercase letter, one digit, and one special character";
        break;
      case "postcodeInput":
        errorMessage = "Please use a valid format.";
        break;
      case "creditCardInput":
        errorMessage = "Please provide a valid credit card number.";
        break;
      case "ipInput":
        errorMessage = "Please provide a valid IP address.";
        break;
      case "xmlInput":
        errorMessage = "Invalid XML format";
        break;
      default:
        errorMessage = "Invalid format.";
    }

    document.getElementById(errorSpanId).textContent = errorMessage;
  }
}
