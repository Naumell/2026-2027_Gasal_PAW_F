<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Posted data (GET)</title>
</head>
<body>
<h3>Posted data (GET): </h3>
<?php
foreach ($_GET as $key => $value)
    echo "($key) => ($value)<br/>";
?>
</body>
</html>
