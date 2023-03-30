<?php

class database
{
    //==================================================================
    public function EXE_QUERY($query, $parameters = null, $debug = true, $close_connection = true)
    {

        // -----------------------------------------------
        // EXECUTES A QUERY THE THE DATABASE (SELECT)
        // -----------------------------------------------

        $results = null;

        // -----------------------------------------------
        // CONNECTION
        // -----------------------------------------------
        $connection = new PDO(
            'mysql:host=' . DB_SERVER .
                ';dbname=' . DB_NAME .
                ';charset=' . DB_CHARSET,
            DB_USERNAME,
            DB_PASSWORD,
            array(PDO::ATTR_PERSISTENT => true)
        );

        if ($debug) {
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        // -----------------------------------------------
        // EXECUTION
        // -----------------------------------------------
        try {
            if ($parameters != null) {
                $gestor = $connection->prepare($query);
                $gestor->execute($parameters);
                $results = $gestor->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $gestor = $connection->prepare($query);
                $gestor->execute();
                $results = $gestor->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            return false;
        }

        // -----------------------------------------------
        // CLOSE CONNECTION
        // -----------------------------------------------
        if ($close_connection) {
            $connection = null;
        }

        // -----------------------------------------------
        // RETURNS RESULTS
        // -----------------------------------------------
        return $results;
    }

    //==================================================================
    public function EXE_NON_QUERY($query, $parameters = null, $debug = true, $close_connection = true)
    {

        // -----------------------------------------------
        // EXECUTES A QUERY TO THE DATABASE (INSERT, UPDATE, DELETE)
        // CONNECTION
        // -----------------------------------------------
        $connection = new PDO(
            'mysql:host=' . DB_SERVER .
                ';dbname=' . DB_NAME .
                ';charset=' . DB_CHARSET,
            DB_USERNAME,
            DB_PASSWORD,
            array(PDO::ATTR_PERSISTENT => true)
        );

        if ($debug) {
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        // -----------------------------------------------
        // EXECUTION
        // -----------------------------------------------
        $connection->beginTransaction();
        try {
            if ($parameters != null) {
                $gestor = $connection->prepare($query);
                $gestor->execute($parameters);
            } else {
                $gestor = $connection->prepare($query);
                $gestor->execute();
            }
            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
            return false;
        }

        // -----------------------------------------------
        // CLOSE CONNECTION
        // -----------------------------------------------
        if ($close_connection) {
            $connection = null;
        }

        return true;
    }
}
?>