<?php 
namespace App\Controller;
use App\Model\DocModel;

    class DocController
    {
        public static function list()
        {
            header("Content-Type: application/json");    
            try {
                $doc_instance = new DocModel;
                $res = $doc_instance->all();
                        
                $json_resp = json_encode(['response' => $res]);
                echo $json_resp;
            }
            catch (PDOExecption $e){
                echo ['error' => $e];
            }
        }

        public static function store()
        {
            header("Content-Type: application/json");
            $data = json_decode(file_get_contents('php://input'), true);            
            $post_data = [
                'title' => $data['title'], 
                'message' => $data['message']
            ];
            $doc_instance = new DocModel();
            $doc_instance->insert($post_data);
            $json_resp = json_encode(['response' => $post_data]);
            echo $json_resp;  
        }        
    }    
?>