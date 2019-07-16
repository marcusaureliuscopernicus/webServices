<?php
require_once('cfg/Db.php');

class Section
{

    public function create()
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
            return json_encode($inserted);
        }
    }

    public function update($id)
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
            return json_encode($edited);
        }
    }

    public function delete($id)
    {
        $pdo = DB::getConnect();
        $sql = "DELETE FROM sections WHERE section_idx = :section_idx INNER JOIN links USING(section_idx)";
        $stmt = $pdo->prepare($sql);
        $deleted = $stmt->execute([
            ":id" => $id
        ]);

        if ($deleted != 0) {
            $deleted = array('success' => 1);
            return json_encode($deleted);
        }
    }

}