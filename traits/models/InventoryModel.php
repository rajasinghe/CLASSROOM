<?php

trait InventoryModel{
    function getStockDetails($data){

        $results = [];
        
        $query = "SELECT `item_code`, `item_model`, `quantity`, `received_date`, `orderBill_no`,
         `receivedBill_no`, `book_num`,`item_name`, `balance` FROM `received_item` , `item` WHERE 
         `received_item`.item_code=`item`.item_code and `book_num`='SB'";

        $results = DB::select($query);

        return $results;
    }

    /**
     * Retrieves a the list of all items in the inventory (Both store items and inventory items)
     * 
     */
    function getItems() : array
    {
        $query = "SELECT * FROM item";
        $results = DB::select($query);

        return $results;
    }

    /**
     * Retrieves a the list of inventory book items
     * 
     */
    function getInventoryItems() : array
    {
        $query = "SELECT item.id,item.item_code,item.item_name,item.balance, inventory_item.inventory_code, inventory_item.description, 
        inventory_item.received_date, inventory_item.status FROM item, inventory_item WHERE item.item_code = inventory_item.inventory_code";
        $results = DB::select($query);

        return $results;
    }

    /**
     * Retrieves a the list of inventory book items
     * 
     */
    function getStoreItems() : array
    {
        $query = "SELECT item.id,item.item_code,item.item_name,item.balance, item_model, quantity, received_date, orderBill_no, 
        receivedBill_no, book_num FROM item, store_item, received_item WHERE item.item_code = store_item.item_code 
        AND received_item.item_code = item.item_code;";
        $results = DB::select($query);

        return $results;
    }
}