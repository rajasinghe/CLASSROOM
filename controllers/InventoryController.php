<?php

require_once('./controllers/Controller.php');
require_once('./traits/models/InventoryModel.php');

class InventoryController extends Controller{
    use InventoryModel;

    public function getReports(Request $request){

        $data = $request->getRequestBody();

        if(!isset($data['type']) || empty($data['type'])){
            echo json_encode(["condition" => 'failed', "errorType" => "data",
                "message" => "Missing arguments for type or context"], JSON_PRETTY_PRINT);
            return;
        }

        if($data['type'] == 'get') // Handle GET requests
        {
            switch($data['context']){
                case 'ITEM':
                    $response = $this->getItems();
                    break;
    
                case 'INVENTORY':
                    $response = $this->getInventoryItems();
                    break;
                
                case 'STORE':
                    $response = $this->getStoreItems();
                    break;
            }
        }
        else // Handle INSERT,UPDATE AND DELETE requests
        {
            /*switch($data['context']){
                case 'ITEM':
                    $response = $this->getInventoryItems();
                    break;
    
                case 'INVENTORY':
                    $response = $this->getInventoryItems();
                    break;
                
                case 'STORE':
                    $response = $this->getInventoryItems();
                    break;
            }*/
        }

        echo json_encode(["condition" => 'success',"data" => $response],JSON_PRETTY_PRINT);
    }
    
}