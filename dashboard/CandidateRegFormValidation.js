function showError(input, message) {
    const errorElement = input.nextElementSibling;
    input.classList.add('error');
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

function hideError(input) {
    const errorElement = input.nextElementSibling;
    input.classList.remove('error');
    errorElement.style.display = 'none';
}

function validateInput(event) {
    const input = event.target;
    const value = input.value.trim();
    let isValid = true;

    // Clear any existing error messages
    hideError(input);

    // Specific validation rules for each field
    if (input.id === 'guardian_aadhar' || input.id === 'candidate_aadhar') {
        if (!/^\d{12}$/.test(value)) {
            showError(input, "Aadhar number must be exactly 12 digits.");
            isValid = false;
        }
    } else if (input.id === 'contact_no') {
        if (!/^\d{10}$/.test(value)) {
            showError(input, "Contact number must be exactly 10 digits.");
            isValid = false;
        }
    } else if (input.id === 'account_no') {
            if (!/^\d{9,18}$/.test(value)) {
            showError(input, "Account number should be between 9 and 18 digits.");
            isValid = false;
    }
    } else if (input.id === 'ifsc') {
        if (!/^[A-Z]{4}0[A-Z0-9]{6}$/.test(value)) {
            showError(input, "Please enter a valid IFSC code.");
            isValid = false;
        }
    } else if (!value) {
        // General validation for required fields
        showError(input, "This field is required.");
        isValid = false;
    }

    return isValid;
}

function validateSelect(event) {
    const select = event.target;
    const value = select.value;
    if (!value) {
        showError(select, "Please make a selection.");
    } else {
        hideError(select);
    }
}

window.onload = function() {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input[type="text"], input[type="tel"], input[type="date"]');
    const selects = form.querySelectorAll('select');

    // Add blur event listener for each input and select element
    inputs.forEach(input => {
        input.addEventListener('blur', validateInput);
    });

    selects.forEach(select => {
        select.addEventListener('blur', validateSelect);
    });

    // Form submit validation
    form.addEventListener('submit', function(event) {
        let isFormValid = true;

        // Check all inputs
        inputs.forEach(input => {
            if (!validateInput({ target: input })) {
                isFormValid = false;
            }
        });

        // Check all selects
        selects.forEach(select => {
            if (!select.value) {
                showError(select, "Please make a selection.");
                isFormValid = false;
            }
        });

        // Prevent form submission if any validation fails
        if (!isFormValid) {
            event.preventDefault();
        }
    });
}