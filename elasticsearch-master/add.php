<?php
require_once 'app/init.php';
ini_set("memory_limit", "-1");
ini_set('display_errors', 'On');

if(!empty($_POST)){
    if(isset($_POST['title'], $_POST['body'], $POST['keywords'])) {
        
        $title = $_POST['title'];
        $body = $_POST['body'];
        $keywords = explode(',', $_POST['keywords']);
        
        echo 'title';
    
    }

}



?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <ul>
            <ul><a href='index.php'>Search data</a></ul>
        </ul>
        <form action="add.php" method="get" autocomplete="off">
        <label>
            <h3>Search twitter for terms to add to the elastic search datdabase</h3>
            <input type="text" name="q">
        </label>
        <input type="submit" value="Add">
    </form>
    <div class=results>
        <?php
                    require_once 'vendor/autoload.php';
                    require_once 'tw_autoloader.php';
                    ini_set('display_errors', 'On');

                if($_GET!=NULL){
                    $term = $_GET['q'];
                    $url = 'search/tweets.json';
                    $getfield = '?q=' . $term;
                    $settings = \Classes\Config::password();
                    $obj = \Classes\TwitterFunctions::get_field($url, $getfield, $settings);
                    foreach($obj as $items){
                        foreach($items as $item){
                            if(!empty($item)){
                                $val = $item['text'];
                                $feed_item = array("text" => $val);
                                $add = \Classes\curlFunction::Import($feed_item);
                                print_r($add);
                                //echo $item['text'] . '<br>';

                            }
                        }

                    }
                    
                }
            ?>
        </div>
    
    
    
    </body>
</html>


