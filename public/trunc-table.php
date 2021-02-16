<?php

	$dbh = mysqli_connect('localhost', 'homestead', 'secret', 'gitbase') or die("Ошибка " . mysqli_error($dbh));

	if (!$dbh) {
		die("Connection failed: " . mysqli_connect_error());
	}
	//echo "Connected successfully <br>";

	$sql = 'DELETE FROM `posts` WHERE `id` > 0'; // ругается на ключ, поэтому ход конём
	$result = mysqli_query($dbh, $sql) or die('Ошибка ' . mysqli_error($dbh));

	$sql = 'DELETE FROM `comments` WHERE `id` > 0';
	$result = mysqli_query($dbh, $sql) or die('Ошибка ' . mysqli_error($dbh));

	if($result)
	    {
	        echo "<span style='color:blue;'>Данные очищены</span><br>"; // потом для удобства можно использовать
	    }

	echo "<br> <a href='/'>На главную</a>";
	    
	   


?>