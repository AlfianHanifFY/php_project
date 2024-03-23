<?php
require('dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $param = $data["param"];

    if ($param == "insert") {
        try { 
            $name = $data["name"];
            $price = $data["price"];

            $sql = "INSERT INTO t_menu(name,price) VALUES (:name, :price)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
    
            echo "New record created successfully";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    elseif ($param == 'read'){
        try {
            $sql = "SELECT * FROM t_menu";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                $data = array(); // Create an empty array to store menu data
                foreach ($result as $row) {
                  $data[] = $row; // Add each row (associative array) to the data array
                }
                
                // Encode the data array to JSON format
                $json_data = json_encode($data);
                
                // Print the JSON data
                echo $json_data;
              } else {
                echo json_encode(array("message" => "No records found")); // Send JSON with error message
              }
            } catch(PDOException $e) {
              echo json_encode(array("error" => $e->getMessage())); // Send JSON with error message
            }

            
        }
    }
    

