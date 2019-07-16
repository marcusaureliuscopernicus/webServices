<?php
require_once('cfg/Db.php');

class Client
{
    public function create()
    {
        $pdo = DB::getConnect();
        $sql = "INSERT INTO clients (client_name)
            VALUES(:name)";
        $stmt = $pdo->prepare($sql);
        $inserted = $stmt->execute([
            ":name" => $_POST["name"],
        ]);

        if ($inserted != 0) {
            $inserted = array('success' => 1);
            print json_encode($inserted);
        }
    }

    public function update($id)
    {
        $pdo = DB::getConnect();
        $sql = "UPDATE clients SET client_name = :client_name WHERE client_idx = :client_idx";
        $stmt = $pdo->prepare($sql);
        $edited = $stmt->execute([
            ":client_idx" => $id,
            ":client_name" => $_POST["name"],
        ]);

        if ($edited != 0 && $id) {
            $edited = array('success' => 1);
            print json_encode($edited);
        }
        else
            print "parameter id required";
    }

    public function delete($id)
    {
        $pdo = DB::getConnect();

        //check for related fields
        $section_check = "SELECT * FROM sections WHERE client_idx = :client_idx";
        $stmt = $pdo->prepare($section_check);
        $stmt->execute([":client_idx" => $id]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(count($result) > 0)
            $sql = "DELETE clients, sections FROM clients INNER JOIN sections ON clients.client_idx = sections.client_idx WHERE clients.client_idx = :client_idx";
        else
            $sql = "DELETE FROM clients WHERE client_idx = :client_idx";

        if ($id) {
            $stmt = $pdo->prepare($sql);
            $deleted = $stmt->execute([
                ":client_idx" => $id
            ]);
        }
        else
            print "parameter id is required";

        if ($deleted != 0) {
            $deleted = array('success' => 1);
            print json_encode($deleted);
        }
    }

}