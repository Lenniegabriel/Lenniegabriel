<?php
    global $conn;
    // session_start();

    include "connection.php";
    if($conn){
//         echo "Connected";
    }

    
    function selectData($tableName, $columns = "*", $conditions = array(), $conditionType = "AND", $limit = null, $orderByColumn = null, $orderByDirection = "ASC") {
        global $conn;
    
        $query = "SELECT $columns FROM $tableName";
    
        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionsArray = array();
            foreach ($conditions as $key => $value) {
                $conditionsArray[] = "$key = :$key";
            }
            $query .= implode(" $conditionType ", $conditionsArray);
        }
    
        if ($orderByColumn !== null) {
            $query .= " ORDER BY $orderByColumn $orderByDirection";
        }
    
        if ($limit !== null) {
            $query .= " LIMIT $limit";
        }
    
        try {
            $statement = $conn->prepare($query);
            foreach ($conditions as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    } 

    
    function countRows($tableName, $conditions = array(), $conditionType = "AND") {
        global $conn;
    
        $query = "SELECT COUNT(*) AS count FROM $tableName";
    
        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionsArray = array();
            foreach ($conditions as $key => $value) {
                $conditionsArray[] = "$key = :$key";
            }
            $query .= implode(" $conditionType ", $conditionsArray);
        }
    
        try {
            $statement = $conn->prepare($query);
            foreach ($conditions as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();
            $countResult = $statement->fetch(PDO::FETCH_ASSOC);
    
            return $countResult['count'];
        } catch (PDOException $e) {
            return false;
        }
    }
    

    function updateData($tableName, $updateData, $conditions = array()): bool
    {
        global $conn;

        $query = "UPDATE $tableName SET ";
        $updateArray = array();

        foreach ($updateData as $key => $value) {
            $updateArray[] = "$key = :$key";
        }
        $query .= implode(", ", $updateArray);

        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionsArray = array();
            foreach ($conditions as $key => $value) {
                $conditionsArray[] = "$key = :cond_$key";
            }
            $query .= implode(" AND ", $conditionsArray);
        }

        try {
            $statement = $conn->prepare($query);

            foreach ($updateData as $key => $value) {
                $statement->bindValue(":$key", $value);
            }

            foreach ($conditions as $key => $value) {
                $statement->bindValue(":cond_$key", $value);
            }

            return $statement->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    function insertData($tableName, $columns, $values) {
        global $conn;
        // Prepare the query dynamically
        $query = "INSERT INTO $tableName (" . implode(', ', $columns) . ") VALUES (" . implode(', ', array_fill(0, count($values), '?')) . ")";
        $statement = $conn->prepare($query);

        // Bind the values to the prepared statement
        foreach ($values as $index => $value) {
            $statement->bindValue($index + 1, $value);
        }

        // Execute the query
        $statement->execute();

        // Optionally, you can check if the query was successful
        return true;
    }


    function insertDataLastId($tableName, $columns, $values) {
        global $conn;
        // Prepare the query dynamically
        $query = "INSERT INTO $tableName (" . implode(', ', $columns) . ") VALUES (" . implode(', ', array_fill(0, count($values), '?')) . ")";
        $statement = $conn->prepare($query);

        // Bind the values to the prepared statement
        foreach ($values as $index => $value) {
            $statement->bindValue($index + 1, $value);
        }

        // Execute the query
        $statement->execute();

        // Get the last inserted ID
        $lastId = $conn->lastInsertId();

        // Optionally, you can check if the query was successful
        return $lastId;
    }


    function deleteData($tableName, $conditions = array()) {
        global $conn;
    
        $query = "DELETE FROM $tableName";
    
        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionsArray = array();
            foreach ($conditions as $key => $value) {
                $conditionsArray[] = "$key = :$key";
            }
            $query .= implode(" AND ", $conditionsArray);
        }
    
        try {
            $statement = $conn->prepare($query);
            
            foreach ($conditions as $key => $value) {
                $statement->bindValue(":$key", $value);
            }

            return $statement->execute();
        } catch (PDOException $e) {
            return false;
        }
    }



    function selectData1($tableName, $columns = "*", $conditions = array(), $conditionType = "AND", $limit = null, $orderByColumn = null, $orderByDirection = "ASC") {
        global $conn;
    
        $query = "SELECT $columns FROM $tableName";
    
        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionsArray = array();
            foreach ($conditions as $key => $value) {
                $conditionsArray[] = "$key = :$key";
            }
            $query .= implode(" $conditionType ", $conditionsArray);
        }
    
        if ($orderByColumn !== null) {
            $query .= " ORDER BY $orderByColumn $orderByDirection";
        }
    
        if ($limit !== null) {
            $query .= " LIMIT $limit";
        }
    
        try {
            $statement = $conn->prepare($query);
            foreach ($conditions as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }


    
    

