<html>
<head>
	<title>Designco</title>
</head>
<body>
	<h1>Designco</h1>
	<nav>
        <ol>
    <?php
      echo file_get_contents("list.txt");
    ?>
        </ ol>
    </nav>

</body>
</html>