<?php
 require_once 'vendor/autoload.php';
$es = new Elasticsearch\Client();
// Round-robin between two nodes:
$es = new Elasticsearch\Client(
    array(
        'hosts' => array(
            'search1:9200',
            'search2:9200'
        )
    )
);

//Connect to cluster at search1:9200, sniff all nodes and round-robin between them:
$es = new Elasticsearch\Client(
    array(
        'hosts' => array('search1:9200'),
        'connectionPoolClass' => '\Elasticsearch\ConnectionPool\SniffingConnectionPool'
    )
);

?>
