<?php
//получаем данные через $_POST
if (isset($_POST['search'])) {
    // подключаемся к базе
    
    $dbh = mysqli_connect('localhost', 'homestead', 'secret', 'gitbase') or die("Ошибка " . mysqli_error($dbh));

    // а вдруг базы пусты а мы ищем
    $sql = "SELECT COUNT(*) as a FROM `posts`";
    $result = mysqli_query($dbh, $sql) or die("Ошибка " . mysqli_error($dbh));
    $row = $result->fetch_array();
    if ( $row['a']<1) {
        die('- ПУСТО в БД! - <a href="/import-sql.php">попробуйте наполнить таблицы');
    }
    
    //echo count($result);

    // никогда не доверяйте входящим данным! Фильтруйте всё! Но здесь мой дамп, поэтому не будем
    $word = ($_POST['search']);

    //$sql = "SELECT DISTINCT postId FROM `comments` WHERE `body` LIKE '%" . $word . "%'";
    //$sql = "SELECT posts.title FROM `posts` WHERE `id` in (SELECT DISTINCT comments.postId FROM `comments` WHERE `body` LIKE '%" . $word . "%')";
    //echo $sql;

$sql = "SELECT posts.title as title, comments.body as comments
        FROM `posts`
        JOIN `comments` ON `posts`.id = `comments`.postId
        WHERE `comments`.body LIKE '%" . $word . "%'       
        ORDER BY posts.title";


    $result = mysqli_query($dbh, $sql) or die("Ошибка " . mysqli_error($dbh)); 

    if($result)
    {
        echo "<ul>";
        while ($q = mysqli_fetch_array($result)) {
            $comm = str_replace($word, '<b><i>'.$word.'</i></b>', $q['comments']);
            echo "<li><b>title: </b>{$q['title']} **** <b>comment: </b>{$comm}</li>";
        }
        echo "</ul>";
    }


    
}
?>