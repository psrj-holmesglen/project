<?php

require 'connection.php';
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$db = getConnection();

$app->add(new CacheMiddleware($db));

require 'get.php';
require 'post.php';

$app->post('/Login', function () {

    global $app, $db;

    $app->response->headers->set('Content-Type', 'application/json');
    $post = $app->request()->post();

   // $sql = "SELECT ID, DATE_ADD(End_Time, INTERVAL 2 DAY) 'Exp' FROM conference WHERE Token=:token AND Download_Avail=1;";
	$sql = "SELECT ID, DATE_ADD(End_Time, INTERVAL 2 DAY) 'Exp' FROM conference WHERE Token=:token ;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam("token", $post['Token']);
    $stmt->execute();

    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
});

// Cache garbage collect
//$app->hook('slim.after', function () use ($app) {
//
//    if (file_exists("cache.json")) {
//        $cache = json_decode(file_get_contents("cache.json"), true);
//
//        foreach ($cache as $key => $data) {
//            if ($data['Exp'] < time()) {
//                $file = explode("-" , $key);
//                unset($cache[$key]);
//                if (file_exists("cache/$file[0]/$file[1]")){
//                unlink("cache/$file[0]/$file[1]");
//            }
//        }
//        }
//
//        file_put_contents("cache.json", json_encode($cache));
//    }
//});

$app->run();