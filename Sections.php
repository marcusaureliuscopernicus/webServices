<?php
require_once('cfg/Db.php');

class Sections
{

    public function createSection()
    {
        $pdo = DB::getConnect();
        $sql = "INSERT INTO sections (section_name)
            VALUES(:name)";
        $stmt = $pdo->prepare($sql);
        $inserted = $stmt->execute([
            ":section_name" => $_POST["name"],
        ]);

        if ($inserted != 0) {
            $inserted = array('success' => 1);
            return $inserted;
        }
    }

    public function updateSection($id)
    {
        $pdo = DB::getConnect();
        $sql = "UPDATE sections SET section_name = :section_name WHERE client_idx = :client_idx";
        $stmt = $pdo->prepare($sql);
        $edited = $stmt->execute([
            ":client_idx" => $id,
            ":section_name" => $_POST["name"],
        ]);


        if ($edited != 0) {
            $edited = array('success' => 1);
            return $edited;
        }
    }

    public function deleteSection($id, $client_id="")
    {
        $pdo = DB::getConnect();
        $sql = "DELETE FROM sections WHERE client_idx = :client_idx";
        $stmt = $pdo->prepare($sql);
        $deleted = $stmt->execute([
            ":id" => $id
        ]);

        if ($deleted != 0) {
            $deleted = array('success' => 1);
            return $deleted;
        }
    }

}