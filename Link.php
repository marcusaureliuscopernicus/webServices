<?php
require_once('cfg/Db.php');

class Link
{

    public function create()
    {
        $pdo = DB::getConnect();
        $sql = "INSERT INTO links (link_name, section_idx)
            VALUES(:link_name, :section_idx)";
        $stmt = $pdo->prepare($sql);
        $inserted = $stmt->execute([
            ":link_name" => $_POST["name"],
            ":section_idx" => $_POST["section_id"]
        ]);

        if ($inserted != 0) {
            $inserted = array('success' => 1);
            print json_encode($inserted);
        }
    }

    public function update($id)
    {
        $pdo = DB::getConnect();
        $sql = "UPDATE links SET link_name = :link_name, section_idx = :section_id WHERE link_idx = :link_idx";
        $stmt = $pdo->prepare($sql);
        if ($id) {
            $edited = $stmt->execute([
                ":link_idx" => $id,
                ":link_name" => $_POST["name"],
                ":section_id" => $_POST["section_id"]
            ]);
        }
        else
            print "parameter id required";

        if ($edited != 0) {
            $edited = array('success' => 1);
            print json_encode($edited);
        }
    }

    public function delete($id)
    {
        $pdo = DB::getConnect();
        $sql = "DELETE FROM links WHERE link_idx = :link_idx";
        $stmt = $pdo->prepare($sql);
        if ($id) {
            $deleted = $stmt->execute([
                ":link_idx" => $id
            ]);
        }
        else
            print "parameter id required";

        if ($deleted != 0) {
            $deleted = array('success' => 1);
            print json_encode($deleted);
        }
    }

}