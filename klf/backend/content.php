<?php
/*
 *  CONFIGURE EVERYTHING HERE
 */
error_reporting(E_ALL);
// echo "reached php...<br>";
print_r($_REQUEST);
include 'db_connnection.php';
// $conn = OpenCon();
class Content
{
    private $conn;

    public function __construct()
    {
        $this->conn = OpenCon();
    }

    public function getArticles()
    {
        try {
            $data = [];
            $stmt = 'SELECT * FROM article';
            foreach ($this->conn->query($stmt) as $row) {
                $r = array(
                    "article_id" => $row['article_id'],
                    "article_name" => $row['article_name'],
                    "article_description" => $row['article_description'],
                );
                array_push($data, $r);
            }
            switch ($_REQUEST["dat"]["ret"]) {
                case "array":
                    return $data;
                    break;
                case "json":
                    $j_data = json_encode($data);
                    return $j_data;
                    break;
                case "count":
                    return count($data);
                    break;
            }
            // $conn = null;

        } catch (PDOException $err) {
            echo "ERROR: Unable to connect: " . $err->getMessage();
            return -1;
        }
    }

    public function getArticleContent()
    {
        try {
            $data = [];
            $stmt = "SELECT * FROM content WHERE article_id='" . $_REQUEST["dat"]["article_id"] . "'";
            foreach ($this->conn->query($stmt) as $row) {
                $r = array(
                    "content_id" => $row['content_id'],
                    "content_text" => $row['content_text'],
                    "article_id" => $row['article_id'],
                    "description" => $row['description'],
                    "htmlID" => $row['htmlID'],
                );
                array_push($data, $r);
            }
            switch ($_REQUEST["dat"]["ret"]) {
                case "array":
                    return $data;
                    break;
                case "json":
                    $j_data = json_encode($data);
                    return $j_data;
                    break;
                case "count":
                    return count($data);
                    break;
            }
            // $conn = null;

        } catch (PDOException $err) {
            echo "ERROR: Unable to connect: " . $err->getMessage();
            return -1;
        }
    }

    public function newContent()
    {
        $article_id = $_REQUEST["dat"]["article_id"];
        $content = $_REQUEST["dat"]["content"];
        $msg = "";
        $t_name = "content";
        $stmt = "INSERT INTO $t_name
            (content_text,article_id)
            VALUES
            ('" . $content . "', '" . $article_id . "');";

        if ($this->conn->exec($stmt) === false) {
            $msg = 'Error inserting the $t_name.';
            return false;
        } else {
            $msg = "The new row in $t_name created";
            return true;
        }
    }

    public function contentExists()
    {
        $content_id = $_REQUEST["dat"]["content_id"];
        $count = $this->getContent($content_id);
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateContent()
    {
        $content_id = $_REQUEST["dat"]["content_id"];
        $content = $_REQUEST["dat"]["content"];
        $msg = "";
        $t_name = "content";
        $stmt = " UPDATE $t_name
            SET content_text = '$content'
            WHERE content_id = $content_id;";
        if ($_REQUEST["dat"]["token"] == "i02I0phd2T0Z6UIfuvv417aL3jis5RoMKq81mBKe-julians") {
            if ($this->conn->exec($stmt) === false) {
                $msg = "Error updating the $t_name.";
                return false;
            } else {
                $msg = "update success";
                return true;
            }
        }
    }
}
