<?php
require_once('cfg/Db.php');

class Links
{

    public function create()
    {
        $pdo = DB::getConnect();
        $sql = "INSERT INTO links (link_name)
            VALUES(:name)";
        $stmt = $pdo->prepare($sql);
        $inserted = $stmt->execute([
            ":client_name" => $_POST["client_name"],
        ]);

        if ($inserted != 0) {
            $inserted = array('success' => 1);
            return json_encode($inserted);
        }
    }

    public function update($id)
    {
        $pdo = DB::getConnect();
        $sql = "UPDATE links SET link_name = :link_name WHERE link_idx = :link_idx";
        $stmt = $pdo->prepare($sql);
        $edited = $stmt->execute([
            ":client_idx" => $id,
            ":client_name" => $_POST["name"],
        ]);


        if ($edited != 0) {
            $edited = array('success' => 1);
            return json_encode($edited);
        }
    }

    public function delete($id)
    {
        $pdo = DB::getConnect();
        $sql = "DELETE FROM links WHERE link_idx = :link_idx";
        $stmt = $pdo->prepare($sql);
        $deleted = $stmt->execute([
            ":link_idx" => $id
        ]);

        if ($deleted != 0) {
            $deleted = array('success' => 1);
            return json_encode($deleted);
        }
    }

}