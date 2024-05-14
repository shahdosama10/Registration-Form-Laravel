// Function to validate the form and handle submission

function validateForm(event) {

    event.preventDefault();

    // get the current language 
    var language = document.getElementById('language').getAttribute('data-language');
    

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
    var confirmPassword = formData.get('password_confirmation');
    var email = formData.get('email');
    var userImage = formData.get('user_image');
    // Fetch CSRF token from meta tag
    

    // Regular expression patterns
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*()\-_=+{};:,<.>~])[a-zA-Z0-9!@#$%^&*()\-_=+{};:,<.>~]{8,}$/;
    var phonePattern = /^\+?([0-9]\s?){6,14}[0-9]$/;
    var namePattern = /^[a-zA-Z\s]+$/;

   

    // Form validation
    if (fullName.trim() === '' || !namePattern.test(fullName)) {
        showError('full_name',messages.full_nameError);
        scrollToError('full_name');
        return false;
    }

    if (userName.trim() === '') {
       showError('user_name',messages.usernameError);
        scrollToError('user_name');
        return false;
    }

    if (birthdate === '') {
        showError('birthdate', messages.birthdateError);
        scrollToError('birthdate');
        return false;
    }

    var birthYear = new Date(birthdate).getFullYear();
    if (birthYear > 2005) {
       showError('birthdate', messages.birthdateError2);
        scrollToError('birthdate');
        return false;
    }

    if (phone.trim() === '' || !phonePattern.test(phone)) {
        showError('phone', messages.phoneError);
        scrollToError('phone');
        return false;
    }

    if (address.trim() === '') {
        showError('address', messages.addressError);
        scrollToError('address');
        return false;
    }

    if (!passwordPattern.test(password)) {
        showError('password', messages.passwordError);
        scrollToError('password');
        return false;
    }


    if (password !== confirmPassword) {
        showError('password_confirmation', messages.confirm_passwordError);
        scrollToError('password_confirmation');
        return false;
    }

    if (!emailPattern.test(email)) {
        showError('email', messages.emailError);
        scrollToError('email');
        return false;
    }

    if (!userImage) {
        showError('user_image', messages.user_imageError);
        scrollToError('user_image');
        return false;
    }


    var token = $('meta[name="csrf-token"]').val();

    var registerRoute = $('#registerRoute').val();

    $.ajaxSetup({
       headers : {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
       } 
    });

    // If the form validation passes, proceed with form submission
    $.ajax({
        type: 'POST',
        url: registerRoute, // Point to Laravel route
        data: formData,
        dataType : 'json',
        processData: false,
        contentType: false,
        cache : false,
        
        success: function(response) {
            // Handle successful response
            alert(messages.registration_success);
            if (response['message'].trim() === "Registration successful!") { 
                // Reload the page or perform other actions as needed
                window.location.reload();
            }
        },
        error: function(error) {
            var errorMessage = "An error occurred.";
            if (error.responseJSON && error.responseJSON.message) {
                errorMessage = error.responseJSON.message;
            }
            alert(messages.registration_failed+'\n'+errorMessage);
            
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
    return false; // Prevent default form submission
}

// Function to handle AJAX form submission

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
    var url = "getActors?month=" + month + "&day=" + day;
    xhr.open("GET", url, true);
    xhr.send();
}
