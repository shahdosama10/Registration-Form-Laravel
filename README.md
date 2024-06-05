# Laravel Registration Form

This project implements a user registration form in Laravel with features including automatic email notifications, multi-language support, and automated testing.

## Prerequisites

Ensure you have the following installed:

- PHP
- Composer
- MySQL

## Installation

Run the following commands:

    cd registration_form
    composer install
    php artisan key:generate
    php artisan migrate

## Project Features

1. **Registration Form**:
   
   - Personal details: `full_name`, `user_name`, `birthdate`, `phone`, `address`, `password`, `confirm_password`, `user_image`, and `email`.
     
   - Client-side and server-side validations.
     
   - Store user data in a MySQL database.
     
   - Password encryption using Laravel.
  
   - Upload Image in the server.

2. **Automatic Email Notification**:
   
   - Send an email titled "New registered user" with the content "A new user <username> is registered to the system" when a new user registers.

3. **Multi-language Support**:
   
   - Support for English and Arabic.

4. **Header and Footer**:
   
   - Use Laravel Master layout to include custom header and footer in the welcome page.

5. **API Integration**:
    
   - Support AJAX to check actors born on the same day using MDBI API (`https://rapidapi.com/apidojo/api/imdb8/`).

6. **Automated Testing**:
    
   - Include automated tests using Laravel testing".
  

## Contributors

We would like to thank the following contributors to this project:

- [**Shahd Osama**](https://github.com/shahdosama10).
- [**Shahd Mostafa**](https://github.com/ShahdMostafa30).
- [**Maryam Osama**](https://github.com/maryamosama33).
- [**Ahmed Saad**](https://github.com/ahmedsaad123456).
- [**Seif Ibrahim**](https://github.com/Seif-Ibrahim1).
- [**Ahmed Adel**](https://github.com/Dola112).

---

Feel free to contribute to this project by opening issues or submitting pull requests.




