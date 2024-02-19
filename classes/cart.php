<?php

$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');


?>
<?php
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }
    public function add_to_cart($quantity,$id){
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link,$quantity);
        $id = mysqli_real_escape_string($this->db->link,$id);
        $sId = session_id(); 

        $query = "SELECT * FROM tbl_product WHERE productId='$id'";
        $result = $this->db->select($query)->fetch_assoc();
        $image  =$result['image'];
        $price  =$result['price'];
        $productName  =$result['productName'];

        $check_cart = "SELECT * FROM tbl_cart WHERE productId='$id' AND sId='$sId'";
        $check_cart_result = $this->db->select($check_cart);
        if($check_cart && $check_cart_result->num_rows > 0){
            $msg="Product already added";
            return $msg;
        }else{
        $query_insert = "INSERT INTO tbl_cart(productId, quantity, sId, image, price, productName) VALUES ('$id', '$quantity', '$sId','$image','$price','$productName')";
        $insert_cart = $this->db->insert($query_insert);
        if($result){
            header("location:cart.php");
        }else{
            header("location:404.php");
        }
    }

    }
    public function get_product_cart(){
        $sId = session_id(); 
        $query ="SELECT * FROM tbl_cart WHERE sId='$sId'";
        $result = $this->db->select($query);
        return $result;
        if ($result === false) {
            // In hoặc ghi lỗi
            echo $this->db->error;
        }
    
        return $result;

    }
   public function update_quantity_cart($quantity,$cartId){
    $quantity = mysqli_real_escape_string($this->db->link,$quantity);
    $cartId = mysqli_real_escape_string($this->db->link,$cartId);
    $query ="UPDATE tbl_cart SET
    quantity='$quantity'

    WHERE cartId ='$cartId'";
    $result = $this->db->update("$query");


   }
   public function delete_cart($cartid){
    $cartid = mysqli_real_escape_string($this->db->link,$cartid);
    $query ="DELETE  FROM tbl_cart WHERE cartId='$cartid'";
    $result = $this->db->delete($query);
    return $result;
   }
   public function delete_order($cartid){
    $cartid = mysqli_real_escape_string($this->db->link,$cartid);
    $query ="DELETE  FROM tbl_order WHERE id='$cartid'";
    $result = $this->db->delete($query);
    return $result;
   }
   public function check_cart(){
    $sId = session_id(); 
    $query ="SELECT * FROM tbl_cart WHERE sId='$sId'";
    $result = $this->db->select($query);
    return $result;
   }
   public function check_order($customer_id){
    $sId = session_id(); 
    $query ="SELECT * FROM tbl_order WHERE customer_id='$customer_id'";
    $result = $this->db->select($query);
    return $result;
   }
   public function del_all_data_cart(){
    $sId = session_id(); 
    $query ="DELETE  FROM tbl_cart WHERE sId='$sId'";
    $result = $this->db->select($query);
    return $result;
   }
   public function delCompare($customer_id){
    $sId = session_id(); 
    $query ="DELETE  FROM tbl_compare WHERE customer_id='$customer_id'";
    $result = $this->db->delete($query);
    return $result;
   }
   public function insertOrder($customer_id){
    $sId = session_id(); 
    $query ="SELECT * FROM tbl_cart WHERE sId='$sId'";
    $get_product = $this->db->select($query);
    if($get_product){
        while($result=$get_product->fetch_assoc()){
            $productid = $result['productId'];
            $productName = $result['productName'];
            $quantity = $result['quantity'];
            $price = $result['price']*$quantity;
            $image = $result['image'];
            $customer_id = $customer_id;
            $query_order = "INSERT INTO tbl_order(productId, productName, quantity, price, image, customer_id) VALUES ('$productid', '$productName', '$quantity','$price','$image','$customer_id')";
            $insert_order = $this->db->insert($query_order);


        }
    }
   }
   public function getAmountPrice($customer_id){
    $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' ORDER BY date_order DESC LIMIT 1";
    $get_price = $this->db->select($query);
    return $get_price;
   }
   public function get_cart_ordered($customer_id){
    $query ="SELECT * FROM tbl_order WHERE customer_id='$customer_id' ";
    $get_cart_ordered = $this->db->select($query);
    return $get_cart_ordered;
   }
   public function get_inbox_cart(){
    $query ="SELECT * FROM tbl_order ORDER BY date_order ";
    $get_inbox_cart = $this->db->select($query);
    return $get_inbox_cart;
   }
   public function shifted($id,$time,$price){
    $id = mysqli_real_escape_string($this->db->link,$id);
    $time = mysqli_real_escape_string($this->db->link,$time);
    $price = mysqli_real_escape_string($this->db->link,$price);
    $query ="UPDATE tbl_order SET
    status='1'

    WHERE id ='$id' AND date_order='$time' AND price='$price'";
    $result = $this->db->update($query);
    if($result){
        $msg = "<span class ='success'>Update order successful </span>";
        return $msg;
    }else{
        $msg = "<span class ='error'>Update order not successful </span>";
        return $msg;
    }
   }
   public function del_shifted($id,$time,$price){
    $id = mysqli_real_escape_string($this->db->link,$id);
    $time = mysqli_real_escape_string($this->db->link,$time);
    $price = mysqli_real_escape_string($this->db->link,$price);
    $query ="DELETE FROM tbl_order 
    WHERE id ='$id' AND date_order='$time' AND price='$price'";
    $result = $this->db->update($query);
    if($result){
        $msg = "<span class ='success'>Delete order successful </span>";
        return $msg;
    }else{
        $msg = "<span class ='error'>Delete order not successful </span>";
        return $msg;
    }
   }
   public function shifted_confirm($id,$time,$price){
    $id = mysqli_real_escape_string($this->db->link,$id);
    $time = mysqli_real_escape_string($this->db->link,$time);
    $price = mysqli_real_escape_string($this->db->link,$price);
    $query = "UPDATE tbl_order SET status='2' WHERE customer_id ='$id' AND date_order='$time' AND price='$price'";
    $result = $this->db->update($query);
    return $result;
   }

}
?>