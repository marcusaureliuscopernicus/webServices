<?php
require_once('cfg/Db.php');

class Section
{

    public function create()
    {
        $pdo = DB::getConnect();
        $sql = "INSERT INTO sections (section_name, client_idx)
            VALUES(:section_name, :client_idx)";
        $stmt = $pdo->prepare($sql);
        $inserted = $stmt->execute([
            ":section_name" => $_POST["name"],
            ":client_idx" => $_POST["client_id"]
        ]);

        if ($inserted != 0) {
            $inserted = array('success' => 1);
            print json_encode($inserted);
        }
    }

    public function update($id)
    {
        $pdo = DB::getConnect();
        $sql = "UPDATE sections SET section_name = :section_name, client_idx = :client_idx WHERE section_idx = :section_idx";
        $stmt = $pdo->prepare($sql);

        if ($id) {
            $edited = $stmt->execute([
                ":section_idx" => $id,
                ":client_idx" => $_POST["client_id"],
                ":section_name" => $_POST["name"],
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

        //check for related fields
        $link_check = "SELECT * FROM links WHERE section_idx = :section_idx";
        $stmt = $pdo->prepare($link_check);
        $stmt->execute([":section_idx" => $id]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(count($result) > 0)
            $sql = "DELETE sections, links FROM sections INNER JOIN links ON sections.section_idx = links.section_idx WHERE sections.section_idx = :section_idx";
        else
            $sql = "DELETE FROM sections WHERE section_idx = :section_idx";

        if ($id) {
            $stmt = $pdo->prepare($sql);
            $deleted = $stmt->execute([
                ":section_idx" => $id
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