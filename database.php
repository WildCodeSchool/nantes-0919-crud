<?php

    function getPDO(): PDO
    {
        require_once 'connect.php';
        return new PDO(DSN, USER, PASSWORD);
    }

    function deleteContact(int $id): void
    {
        $pdo = getPDO();
        $query = "DELETE FROM contact WHERE id = :id";
        $request = $pdo->prepare($query);
        $request->bindValue(":id", $id, PDO::PARAM_INT);
        $request->execute();
        header("location:index.php");
    }

    function getContacts(): array
    {
        $pdo = getPDO();
        $query = "SELECT * FROM contact";
        $request = $pdo->query($query);
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }