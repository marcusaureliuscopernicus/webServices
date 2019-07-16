<?php
require_once('cfg/Db.php');

class Clients
{

    public function create()
    {
        $pdo = DB::getConnect();
        $sql = "INSERT INTO clients (client_name)
            VALUES(:name)";
        $stmt = $pdo->prepare($sql);
        $inserted = $stmt->execute([
            ":client_name" => $_POST["name"],
        ]);

        if ($inserted != 0) {
            $inserted = array('success' => 1);
            return json_encode($inserted);
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


        if ($edited != 0) {
            $edited = array('success' => 1);
            return json_encode($edited);
        }
    }

    public function delete($id)
    {
        $pdo = DB::getConnect();
        $sql = "DELETE FROM clients WHERE client_idx = :client_idx INNER JOIN sections USING(client_idx)";
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