// ==========================
// Name Validation
// ==========================

function validateName(input) {

    input.value = input.value.replace(/[^a-zA-Z ]/g, '');

}

// ==========================
// Phone Validation
// ==========================

function validatePhone(input) {

    input.value = input.value.replace(/\D/g, '');

    if (input.value.length > 10) {

        input.value = input.value.slice(0, 10);

    }

}

// ==========================
// Email Validation
// ==========================

function validateEmail(input) {

    const emailPattern =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (
        input.value !== '' &&
        !emailPattern.test(input.value)
    ) {

        input.setCustomValidity(
            'Enter valid email'
        );

    } else {

        input.setCustomValidity('');

    }

}

// ==========================
// Aadhaar Validation
// ==========================

function validateAadhaar(input) {

    input.value =
        input.value.replace(/\D/g, '');

    if (input.value.length > 12) {

        input.value =
            input.value.slice(0, 12);

    }

}

// ==========================
// Pincode Validation
// ==========================

function validatePincode(input) {

    input.value =
        input.value.replace(/\D/g, '');

    if (input.value.length > 6) {

        input.value =
            input.value.slice(0, 6);

    }

}

// ==========================
// Percentage Validation
// ==========================

function validatePercentage(input) {

    let value =
        parseFloat(input.value);

    if (value > 100) {

        input.value = 100;

    }

    if (value < 0) {

        input.value = 0;

    }

}

// ==========================
// Future Date Block
// ==========================

function validateDOB(input) {

    let today = new Date()
        .toISOString()
        .split('T')[0];

    if (input.value > today) {

        alert(
            'Future date not allowed'
        );

        input.value = '';

    }

}