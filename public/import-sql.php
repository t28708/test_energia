<?php 

	////////////////////////////////////////////////
	// стандартное подключение к mysql уже созданной базе
	$servername = "localhost";
	$database = "gitbase";
	$username = "homestead";
	$password = "secret";
	// Создаем соединение
	$conn = mysqli_connect($servername, $username, $password, $database);
	// Проверяем соединение
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully <br>";
	

	/////////////////////////////////////////////////


	// read json file POSTS
	$filename = 'https://jsonplaceholder.typicode.com/posts';
	$json = file_get_contents($filename);

	//convert json object to php associative array
	$data = json_decode($json, true);

	$num_posts = 0;

	foreach($data as $row)  
	{	
		$query ="INSERT INTO posts (`id`, `userId`, `title`, `body`) VALUES ('$row[id]', '$row[userId]', '$row[title]', '$row[body]')";
		//echo $query; die;

		$result = mysqli_query($conn, $query) or die('Ошибка ' . mysqli_error($conn) . '- таблицы созданы - <a href="/trunc-table.php">попробуйте очистить'); 
	    
	    if($result)
	    {
	        //echo "<span style='color:blue;'>Данные добавлены</span><br>"; // потом для удобства можно использовать
	    }

	    $num_posts++;
	 }

	 

	 //bind_param сейчас в моде, но у нас 4 поля, сделаем 4 запроса руками

	 // *read json file POSTS

	 // read json file COMMENTS

	$filename = 'https://jsonplaceholder.typicode.com/comments';
	$json = file_get_contents($filename);

	//convert json object to php associative array
	$data = json_decode($json, true);

	$num_comments = 0;

	foreach($data as $row)  
	{	
		$query ="INSERT INTO comments (`id`, `postId`, `name`, `email`, `body`) VALUES ('$row[id]', '$row[postId]', '$row[name]', '$row[email]', '$row[body]')";
		//echo $query; die;

		$result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn)); 
	    
	    if($result)
	    {
	        //echo "<span style='color:blue;'>Данные добавлены</span><br>"; // потом для удобства можно использовать
	    }

	    $num_comments++;
	 }

	

	 // *read json file COMMENTS

	 echo 'Загружено ' . $num_posts .' записей и ' . $num_comments  . ' комментариев';

	 echo "<br> <a href='/'>На главную</a>";

	 mysqli_close($conn);

?>