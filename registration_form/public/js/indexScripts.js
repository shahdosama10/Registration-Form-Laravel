// Function to validate the form and handle submission
function validateForm(event) {
    // Clear previous error messages
    clearErrors();

    // Get form inputs
    var form = document.querySelector('.input_form');
    var formData = new FormData(form);

    var fullName = formData.get('full_name');
    var userName = formData.get('user_name');
    var birthdate = formData.get('birthdate');
    var phone = formData.get('phone');
    var address = formData.get('address');
    var password = formData.get('password');
    var confirmPassword = formData.get('confirm_password');
    var email = formData.get('email');
    var userImage = formData.get('user_image');

    // Regular expression patterns
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*()\-_=+{};:,<.>~])[a-zA-Z0-9!@#$%^&*()\-_=+{};:,<.>~]{8,}$/;
    var phonePattern = /^\+?([0-9]\s?){6,14}[0-9]$/;
    var namePattern = /^[a-zA-Z\s]+$/;

    // Form validation
    if (fullName.trim() === '' || !namePattern.test(fullName)) {
        showError('full_name', 'Please enter a valid full name.');
        scrollToError('full_name');
        return false;
    }

    if (userName.trim() === '') {
        showError('user_name', 'Please enter a username.');
        scrollToError('user_name');
        return false;
    }

    if (birthdate === '') {
        showError('birthdate', 'Please select your birthdate.');
        scrollToError('birthdate');
        return false;
    }

    var birthYear = new Date(birthdate).getFullYear();
    if (birthYear > 2005) {
        showError('birthdate', 'You must be born in 2005 or earlier to register.');
        scrollToError('birthdate');
        return false;
    }

    if (phone.trim() === '' || !phonePattern.test(phone)) {
        showError('phone', 'Please enter a valid phone number.');
        scrollToError('phone');
        return false;
    }

    if (address.trim() === '') {
        showError('address', 'Please enter your address.');
        scrollToError('address');
        return false;
    }

    if (!passwordPattern.test(password)) {
        showError('password', 'Password must be at least 8 characters long and contain at least one number and one special character.');
        scrollToError('password');
        return false;
    }

    if (password !== confirmPassword) {
        showError('confirm_password', 'Passwords do not match.');
        scrollToError('confirm_password');
        return false;
    }

    if (!emailPattern.test(email)) {
        showError('email', 'Please enter a valid email address.');
        scrollToError('email');
        return false;
    }

    if (!userImage) {
        showError('user_image', 'Please upload your profile picture.');
        scrollToError('user_image');
        return false;
    }

    // If the form validation passes, proceed with form submission
    submitFormData(formData);
    return false; // Prevent default form submission
}

// Function to handle AJAX form submission
function submitFormData(formData) {
    $.ajax({
        type: "POST",
        url: "{{ route('registerUser') }}", // Point to Laravel route
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Handle successful response
            alert(response);
            if (response.trim() === "Sign up successfully") {
                // Reload the page or perform other actions as needed
                window.location.reload();
            }
        },
        error: function(error) {
            // Handle error response from server
            alert('An error occurred: ' + error.responseText);
        }
    });
}

// Function to show error message for a form field
function showError(inputId, message) {
    var errorSpan = document.createElement('span');
    errorSpan.className = 'error-message';
    errorSpan.innerText = message;
    
    var inputField = document.getElementById(inputId);
    inputField.parentNode.insertBefore(errorSpan, inputField.nextSibling);
}

// Function to clear error messages
function clearErrors() {
    var errorMessages = document.getElementsByClassName('error-message');
    while (errorMessages.length > 0) {
        errorMessages[0].parentNode.removeChild(errorMessages[0]);
    }
}

// Function to scroll to the form field with an error
function scrollToError(inputId) {
    var inputField = document.getElementById(inputId);
    inputField.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function checkActors() {
    var birthdate = document.getElementById("birthdate").value;
    var birthdateParts = birthdate.split("-");
    var month = birthdateParts[1];
    var day = birthdateParts[2];
    var formattedDate = month + "-" + day;
    
    // Display status message
    document.getElementById("actorsResult").style.display = "block";
    document.getElementById("actorsResult").innerHTML = "Fetching actors...";

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                // Request successful
                document.getElementById("actorsResult").innerHTML = formattedActors;
                var actorsData = JSON.parse(xhr.responseText);
                var formattedActors = actorsData.map(function(actor) {
                    return "<div>" + actor + "</div>";
                }).join("");
                document.getElementById("actorsResult").innerHTML = "<pre>" +formattedActors + "</pre>" ;
            } else {
                // Request failed
                console.error("Error:", xhr.statusText);
                var errors = JSON.parse(xhr.responseText);
                document.getElementById("actorsResult").innerHTML = errors.error;
            }
        }
    };
    
    xhr.open("GET", "getActors?birthdate=" + formattedDate, true);
    xhr.send();
}
