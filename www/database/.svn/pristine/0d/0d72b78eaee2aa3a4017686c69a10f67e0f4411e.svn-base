<?php

class CacheMiddleware extends \Slim\Middleware
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function call()
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $uri = $request->getResourceUri();

        if ($request->isGet() && preg_match("/\.json$/", $uri)) { // Data file route

            $id = substr($uri, 1, strrpos($uri, "/") - 1);
            $file = substr($uri, strrpos($uri, "/") + 1, -5);
            $column = $this->getTagColumn($file);

            // In case of etag fixing
//            $requestTag = $app->request->headers->get('If-None-Match');
//            $app->request->headers->set('If-None-Match', str_replace("-gzip", "", $requestTag));

            // Get cache array or create
//            $cache = null;
//            if (file_exists("cache.json")) {
//                $cache = json_decode(file_get_contents("cache.json"), true);
//            } else {
//                $cache = Array();
//            }

            // Set ETag and Content-Type
            $sql = "SELECT $column 'Tag' FROM conference WHERE ID=:id;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            try {
                $this->app->etag($row['Tag']);
            } catch (Slim\Exception\Stop $e) {
                // We need to catch the exception, but no handling is needed
            }
//            $this->app->expires('+30 second');
            $response->headers->set('Content-Type', 'application/json');

            // If ETag hasn't changed since last request
//            if ($cache["$id-$file"]["Tag"] == $row['Tag']) {
//                echo file_get_contents("cache/$id/$file");
//                return;
//            }


            // Run next middleware
            $this->next->call();

            // Create cache folder if it doesn't exist
//            if (!file_exists("cache/")) {
//                mkdir("cache/");
//            }
            // Create conference folder is it doesn't exist
//            if (!file_exists("cache/$id/")) {
//                mkdir("cache/$id/");
//            }
            // Cache response
//            file_put_contents("cache/$id/$file", $response->getBody());
            // Record cache

//            $cache["$id-$file"] = Array(
//                    "Tag" => $row['Tag'],
//                    "Exp" => strtotime("+1 Day")
//            );

//            file_put_contents("cache.json", json_encode($cache));

        } else { // Non data file route
            $this->next->call();
        }
    }

    public function getTagColumn($file)
    {
        switch ($file) {

            case "conference":
                return "Conference_Tag";

            case "schedule":
                return "Schedule_Tag";

            case "speaker":
                return "Speaker_Tag";

            case "sponsor":
                return "Sponsor_Tag";

            case "conference-feedback":
                return "C_Feedback_Tag";

            case "session-feedback":
                return "S_Feedback_Tag";

            default:
                return "";
        }
    }
}