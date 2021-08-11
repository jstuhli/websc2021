<?php
header("Cache-Control: public, max-age=3600");
?>
<!DOCTYPE html>
<html>
<head>
    <style>body {background-color: #<?php echo  rand(100000,999999);?></style>
</head>
<body>
<a href="/">Reload</a>
</body>
</html>
