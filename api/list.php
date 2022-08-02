<?php 
    header("Content-Type: application/json");    
    try {
        include('../connection.php'); 
        
        /* Create a prepared statement */
        $stmt = $db->prepare("SELECT * from doc");

        var_dump($stmt);
        
        /* execute the query */
        $stmt->execute();        
        
        /* fetch all results */
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
        $json_resp = json_encode(['response' => $res]);
        echo $json_resp;
                
        /* close connection */
        $db = null;
    }
    catch (PDOExecption $e){
        echo ['error' => $e];
    }    
?>