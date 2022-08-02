<?php 
if ($_POST) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    $title = $_POST['title'];
    $content = $_POST['message'];
    try {        
        include('connection.php');         
        /* Create a prepared statement */
        $stmt = $db->prepare("INSERT INTO doc (id, title, message) VALUES (:id, :title, :message)");
        
        /* bind params */
        if (isset($_POST['id'])) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }        
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':message', $content, PDO::PARAM_STR);
        
        /* execute the query */
        if ( $stmt->execute() ) {
            echo "Row Inserted - <a href='list.php'>Read Here</a>";
        }
        
        /* close connection */
        $db = null;
    }
    catch (PDOExecption $e){
        echo $e->getMessage();
    }
}    
?>
<?php include 'views/header.php'; ?>
    <div class="container">
        <form action="" method="POST">                
            <div class="form-group mb-3">
                <label>Title: </label>
                <input class="form-control" type="text" name="title" required />
            </div>

            <div class="form-group mb-3">
                <label>Message</label>
                <textarea class="form-control" name="message" id="content" cols="30" rows="10" required></textarea>
            </div>
            <br>
            <input type="submit" class="btn btn-secondary text-light"/>
        </form>
    </div>
<?php include 'views/footer.php'; ?>