<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
  body { font-family: Verdana, sans-serif; font-size: 13px; margin: 14px; }
  fieldset { background: #dde; width: 430px; padding: 10px; }
  .field { clear: both; text-align: right; line-height: 25px; }
  label { float: left; width: 35%; margin-right: .5em; padding-top: .2em; text-align: right; }
  .error { color: #c00; font-size: 11px; }
</style>
</head>
<body>
<h1>Register</h1>
<?php
$errors = array();
if (isset($_POST['surname']))
{
    require 'validate.inc';
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'passwd');
    validateAddress($errors, $_POST, 'address');
    validateState($errors, $_POST, 'state');
    validateCountry($errors, $_POST, 'country');
    validateGender($errors, $_POST, 'sex');

    if ($errors)
    {
        echo '<h3 class="error">Invalid, correct the following errors:</h3><ul>';
        foreach ($errors as $field => $error)
            echo '<li>' . htmlspecialchars("$field: $error") . '</li>';
        echo '</ul>';

        // tampilkan kembali form beserta isian sebelumnya
        include 'form.inc';
    }
    else
    {
        echo '<h3>Form submitted successfully with no errors</h3>';
        foreach ($_POST as $key => $value)
            if ($key != 'passwd')   // password tidak ditampilkan
                echo '(' . htmlspecialchars($key) . ') => (' . htmlspecialchars($value) . ')<br/>';
    }
}
else
{
    // tampilkan form kosong
    include 'form.inc';
}
?>

</body>
</html>
