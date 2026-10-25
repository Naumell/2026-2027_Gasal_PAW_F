<?php
// Semua fungsi menyimpan pesan error ke array $errors dengan key = nama field

function validateName(&$errors, $field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/"; // format surname (alfabet)
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '')
        $errors[$field_name] = 'Surname is required';
    else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = "Surname may only contain letters, apostrophe and hyphen";
}

function validateEmail(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '')
        $errors[$field_name] = 'Email address is required';
    else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL))
        $errors[$field_name] = 'Email address is not valid (example: name@mail.com)';
}

function validatePassword(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] === '')
        $errors[$field_name] = 'Password is required';
    else if (strlen($field_list[$field_name]) < 6)
        $errors[$field_name] = 'Password must be at least 6 characters';
}

function validateAddress(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '')
        $errors[$field_name] = 'Street Address is required';
    else if (strlen(trim($field_list[$field_name])) < 10)
        $errors[$field_name] = 'Street Address is too short (minimum 10 characters)';
}

function validateState(&$errors, $field_list, $field_name)
{
    $allowed = array('1', '2', '3', '4', '5', '6', '7', '8');
    if (!isset($field_list[$field_name]) || $field_list[$field_name] === '-1')
        $errors[$field_name] = 'Please choose your state';
    else if (!in_array($field_list[$field_name], $allowed, true))
        $errors[$field_name] = 'State value is not valid';
}

function validateGender(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]))
        $errors[$field_name] = 'Please select your gender';
    else if ($field_list[$field_name] !== 'male' && $field_list[$field_name] !== 'female')
        $errors[$field_name] = 'Gender value is not valid';
}

// field hidden bisa dimanipulasi pengguna, jadi tetap harus divalidasi di server
function validateCountry(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] !== 'Indonesia')
        $errors[$field_name] = 'Country value has been changed';
}
// Vegetarian bersifat opsional (checkbox) sehingga tidak perlu divalidasi.
?>
