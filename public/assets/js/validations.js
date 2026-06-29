// COMMON HELPER FUNCTIONS USE IN FORMS

function isEmpty(value) {
    return !value || value.trim() === "";
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isValidPhone(phone) {
    return /^[6-9]\d{9}$/.test(phone);
}

function isValidAadhar(aadhar) {
    return /^\d{12}$/.test(aadhar);
}

function isValidPincode(pincode) {
    return /^\d{6}$/.test(pincode);
}

function isPositiveNumber(value) {
    return !isNaN(value) && Number(value) > 0;
}

function isDateBefore(startDate, endDate) {
    return new Date(startDate) <= new Date(endDate);
}

function maxLength(value, max) {
    return value.length <= max;
}

// Show inline error + highlight field
function showError(inputId, message) {
    const field = document.getElementById(inputId);
    field.classList.add("is-invalid"); // highlight with red border
    let errorElement = field.nextElementSibling;
    if (!errorElement || !errorElement.classList.contains("error-text")) {
        errorElement = document.createElement("small");
        errorElement.classList.add("error-text", "text-danger");
        field.insertAdjacentElement('afterend', errorElement);
    }
    errorElement.innerText = message;
}

// Clear error + remove highlight
function clearError(inputId) {
    const field = document.getElementById(inputId);
    field.classList.remove("is-invalid");
    const errorElement = field.nextElementSibling;
    if (errorElement && errorElement.classList.contains("error-text")) {
        errorElement.remove();
    }
}

// MODULE-SPECIFIC VALIDATIONS

// STUDENT FORM
function validateStudentForm() {
    let isValid = true;

    const fields = [
        { id: "first_name", message: "Please enter a valid first name." },
        { id: "last_name", message: "Please enter a valid last name." },
        { id: "gender", message: "Please select gender." },
        { id: "dob", message: "Please enter date of birth." },
        { id: "phone", validate: isValidPhone, message: "Phone number must be 10 digits starting with 6–9." },
        { id: "email", validate: isValidEmail, message: "Please enter a valid email address." },
        { id: "pincode", validate: isValidPincode, message: "Please enter a valid 6-digit pincode." },
        { id: "nationality", message: "Please enter nationality." },
        { id: "address", message: "Please enter full address." },
        { id: "enrollment_date", message: "Please select enrollment date." },
        { id: "current_education_level", message: "Please enter current education level." },
        { id: "student_caste", message: "Please enter student caste." },
        { id: "student_status", message: "Please select student status." },
        { id: "fathers_name", message: "Please enter father's name." },
        { id: "father_contact_number", validate: isValidPhone, message: "Please enter a valid father's contact number." },
        { id: "fathers_email", validate: isValidEmail, message: "Please enter a valid father's email." },
        { id: "fathers_occupation", message: "Please enter father's occupation." },
        { id: "mothers_name", message: "Please enter mother's name." },
        { id: "mother_contact_number", validate: isValidPhone, message: "Please enter a valid mother's contact number." },
        { id: "mothers_email", validate: isValidEmail, message: "Please enter a valid mother's email." },
        { id: "mother_occupation", message: "Please enter mother's occupation." },
        { id: "family_monthly_income", validate: isPositiveNumber, message: "Please enter a valid family income." },
        { id: "sibling_number", validate: isPositiveNumber, message: "Please enter a valid sibling count." },
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (field.validate) {
            if (!field.validate(value)) {
                showError(field.id, field.message);
                isValid = false;
            } else clearError(field.id);
        } else if (isEmpty(value)) {
            showError(field.id, field.message);
            isValid = false;
        } else clearError(field.id);
    });

    return isValid;
}

// PROGRAM FORM
function validateProgramForm() {
    let isValid = true;
    let errorMessages = [];

    const fields = [
        { id: "program_name", message: "Please enter a valid program name." },
        { id: "program_about", message: "Please provide a description for the program." },
        { id: "program_start_date", message: "Please select start date." },
        { id: "program_theme", message: "Please select a program theme." },
        { id: "applicable_for", message: "Please specify applicable audience." },
        { id: "program_status", message: "Please select program status." }
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (isEmpty(value)) {
            showError(field.id, field.message);
            errorMessages.push(field.message);
            isValid = false;
        } else clearError(field.id);
    });

    // Validate dates
    const startDate = document.getElementById("program_start_date").value;
    const endDate = document.getElementById("program_end_date").value;
    if (endDate && !isDateBefore(startDate, endDate)) {
        showError("program_end_date", "End date must be after start date.");
        errorMessages.push("End date must be after start date.");
        isValid = false;
    } else clearError("program_end_date");

    errorMessages.push("End date must be after start date.");

    return isValid;

}

// PROGRAMTHEME
function validateProgramThemeForm() {
    let isValid = true;
    const fields = [
        { id: "program_theme_name", message: "Please enter program theme name." },
        { id: "theme_description", message: "Please provide theme description." }
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (isEmpty(value)) { showError(field.id, field.message); isValid = false; } else clearError(field.id);
    });
    return isValid;
}


// BATCH FORM
function validateBatchForm() {
    let isValid = true;
    const fields = [
        { id: "batch_name", message: "Please enter a valid batch name." },
        { id: "program_id", message: "Please select a program." },
        { id: "center_id", message: "Please select a center." },
        { id: "batch_status", message: "Please select batch status." },
        { id: "start_time", message: "Please provide start time." },
        { id: "end_time", message: "Please provide end time." },
        { id: "batch_start_date", message: "Please select start date." },
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (isEmpty(value)) {
            showError(field.id, field.message);
            isValid = false;
        } else clearError(field.id);
    });

    // Validate dates
    const startDate = document.getElementById("batch_start_date").value;
    const endDate = document.getElementById("batch_last_date").value;
    if (endDate && !isDateBefore(startDate, endDate)) {
        showError("batch_last_date", "End date must be after start date.");
        isValid = false;
    } else clearError("batch_last_date");

    return isValid;
}

// ROLES
function validateRoleForm() {
    let isValid = true;
    const fields = [
        { id: "role_name", message: "Please enter a role name." },
        { id: "role_description", message: "Please enter a role description." }
    ];
    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (isEmpty(value)) {
            showError(field.id, field.message);
            isValid = false;
        } else clearError(field.id);
    });
    return isValid;
}

// USERS
function validateUserForm() {
    let isValid = true;
    const fields = [
        { id: "first_name", message: "Please enter first name." },
        { id: "last_name", message: "Please enter last name." },
        { id: "gender", message: "Please select gender." },
        { id: "dob", message: "Please select date of birth." },
        { id: "phone", validate: isValidPhone, message: "Enter valid phone number." },
        { id: "email", validate: isValidEmail, message: "Enter valid email." },
        { id: "pincode", validate: isValidPincode, message: "Enter valid pincode." },
        { id: "password", message: "Enter a strong password (min 8 chars)." },
        { id: "nationality", message: "Please enter nationality." },
        { id: "address", message: "Please enter address." },
        { id: "joining_date", message: "Please select joining date." },
        { id: "user_status", message: "Please select user status." }
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (field.validate) {
            if (!field.validate(value)) {
                showError(field.id, field.message);
                isValid = false;
            } else clearError(field.id);
        } else if (isEmpty(value)) {
            showError(field.id, field.message);
            isValid = false;
        } else clearError(field.id);
    });
    return isValid;
}

// CENTERs
function validateCenterForm() {
    let isValid = true;
    const fields = [
        { id: "center_name", message: "Please enter a center name." },
        { id: "center_status", message: "Please select center status." },
        { id: "center_address", message: "Please enter center address." },
        { id: "center_city", message: "Please enter city name." },
        { id: "center_state", message: "Please enter state." },
        { id: "center_pincode", validate: isValidPincode, message: "Please enter a valid 6‑digit pincode." },
        { id: "center_opening_date", message: "Please select opening date." },
        { id: "center_capacity", validate: isPositiveNumber, message: "Capacity must be a positive number." }
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (field.validate) {
            if (!field.validate(value)) { showError(field.id, field.message); isValid = false; } else clearError(field.id);
        } else if (isEmpty(value)) { showError(field.id, field.message); isValid = false; } else clearError(field.id);
    });
    return isValid;
}

// EVENTTYPE
function validateEventTypeForm() {
    let isValid = true;
    const fields = [
        { id: "event_type_name", message: "Please enter event type name." },
        { id: "event_type_about", message: "Please provide event description." }
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (isEmpty(value)) { showError(field.id, field.message); isValid = false; } else clearError(field.id);
    });
    return isValid;
}

// GOALTYPE
function validateGoalTypeForm() {
    let isValid = true;
    const fields = [
        { id: "goal_type_name", message: "Please enter goal type name." },
        { id: "goal_type_description", message: "Please provide goal type description." }
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (isEmpty(value)) { showError(field.id, field.message); isValid = false; } else clearError(field.id);
    });
    return isValid;
}

// RIGHTS
function validateRightsForm() {
    let isValid = true;
    const fields = [
        { id: "rights_title", message: "Please enter rights title." },
        { id: "rights_summary", message: "Please provide rights summary." },
        { id: "can_view", message: "Please select view permission." },
        { id: "can_edit", message: "Please select edit permission." },
        { id: "can_add", message: "Please select add permission." },
        { id: "can_delete", message: "Please select delete permission." }
    ];

    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (isEmpty(value)) { showError(field.id, field.message); isValid = false; } else clearError(field.id);
    });
    return isValid;
}

// FINANCE MODULES (Fees, Donations, Assets)
function validateFeeForm() {
    let isValid = true;
    const fields = [
        { id: "student_id", message: "Please select a student." },
        { id: "program_id", message: "Please select a program." },
        { id: "batch_id", message: "Please select a batch." },
        { id: "total_fees_amount", validate: isPositiveNumber, message: "Enter valid total fees amount." },
        { id: "fees_month", message: "Please select fees month." },
        { id: "due_date", message: "Please select due date." },
        { id: "fee_status", message: "Please select fee status." }
    ];
    fields.forEach(field => {
        const value = document.getElementById(field.id)?.value || "";
        if (field.validate) {
            if (!field.validate(value)) {
                showError(field.id, field.message);
                isValid = false;
            } else clearError(field.id);
        } else if (isEmpty(value)) {
            showError(field.id, field.message);
            isValid = false;
        } else clearError(field.id);
    });
    return isValid;
}
