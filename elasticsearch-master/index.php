<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <ul>
            <ul><a href='add.php'>Add data</a></ul>
        </ul>
        <form action="index.php" method="get" autocomplete="off">
        <label>
            <h3>Search for something in the Elastic Search Database!</h3>
            <input type="text" name="q">
        </label>
        <input type="submit" value="Search">
    </form>
    <div class=results>
        <?php
                require_once 'vendor/autoload.php';
                require_once 'tw_autoloader.php';
                    ini_set('display_errors', 'On');


                $es = new Elasticsearch\Client();

                if($_GET!=NULL){
                    $q = $_GET['q'];
             
            $search = \Classes\curlFunction::Search($q);
                $array_tweet = array();
                foreach($search['hits']['hits'] as $hits){
                    foreach($hits['_source'] as $message){

                        $array_tweet[] = $message;
                        
                            echo $message . '<br>';
                            
                    }
    
    
                }
                    print_r($array_tweet);
        
            ?>
        </div>
    
    
    
    </body>
</html>
