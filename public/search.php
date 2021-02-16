<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Поиск php +js</title>
<link rel="stylesheet" type="text/css" href="my.css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">

$(function() {

    $(".search_button").click(function() {
        // получаем то, что написал пользователь
        var searchString    = $("#search_box").val();
        console.log(searchString.length)
        // формируем строку запроса
        var data            = 'search='+ searchString;

        // если searchString не пустая и больше 2. Можно оставить больше двух
        if ((searchString) && (searchString.length >2)) {
            // делаем ajax запрос
            $.ajax({
                type: "POST",
                url: "do_search.php",
                data: data,
                beforeSend: function(html) { // запустится до вызова запроса
                    $("#results").html('');
                    $("#searchresults").show();
                    $(".word").html(searchString);
                    $(".word2").html('');
               },
               success: function(html){ // запустится после получения результатов
                    $("#results").show();
                    $("#results").append(html);
              }
            });
        } else {
            $(".word2").html('<b>введите больше двух символов</b>');
        }
        return false;
    });
});
</script>

</head>
<body>
    <h3 style="text-align:center;">Введите строку поиска</h3>
    <div id="container">
        <div style="margin:20px auto; text-align: center;">
            <form method="post" action="do_search.php">
                <input type="text" name="search" id="search_box" placeholder='поиск' class='search_box'/>
                <input type="submit" value="Поиск" class="search_button" /><br />
            </form>
            <span class="word2"></span>
        </div>
        
    <div>

    <div id="searchresults">Искомая строка <b><span class="word"></span></b></div>
        <ul id="results" class="update">
        </ul>

    </div>

    <br> <a href='/'>На главную</a>
    

</body>
</html>