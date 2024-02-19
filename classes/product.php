<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');


?>
<?php
class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }
    public function insert_product($data,$files)
    {
        
        $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
        $brand = mysqli_real_escape_string($this->db->link,$data['brand']);
        $category = mysqli_real_escape_string($this->db->link,$data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link,$data['price']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);
        // Kiểm tra hình ảnh và cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        
        if($productName==""||$brand==""||$category==""||$product_desc==""||$price==""||$type==""||$file_name==""){
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catId,brandId,product_desc,price,type,image) VALUES('$productName','$category','$brand','$product_desc','$price','$type','$unique_image')";
            $result = $this->db->insert($query);
            if($result){
                $alert="<span class='success'> Insert brand successfully</span>";
                return $alert;
            }else{
                $alert="<span class='error'> Insert brand not success</span>";
                return $alert;
            }
        }


    }
    public function show_product(){
        $query=
        "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
         FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
         INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
         ORDER BY tbl_product.productId desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_product($data,$files,$id){
      
        $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
        $brand = mysqli_real_escape_string($this->db->link,$data['brand']);
        $category = mysqli_real_escape_string($this->db->link,$data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link,$data['price']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);
        // Kiểm tra hình ảnh và cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;
        if($productName==""||$brand==""||$category==""||$product_desc==""||$price==""||$type==""||$file_name==""){
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //Nếu người dùng chọn ảnh
                if($file_size > 20144){
                    $alert= "<span class='error'>Image should be less then 20MB</span>";
                    return $alert;
                }
                elseif(in_array($file_ext,$permited)==false){
                    $alert= "<span class='success'>You can upload only:-".implode(', ',$permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query ="UPDATE tbl_product SET
                productName='$productName',
                brandId='$brand',
                catId='$category',
                product_desc='$product_desc',
                price='$price',
                type='$type',
                image='$unique_image'
                WHERE productId ='$id'
                ";
            }
            else{
                // Nếu người dùng không chọn ảnh
                $query ="UPDATE tbl_product SET
                productName='$productName',
                brandId='$brand',
                catId='$category',
                product_desc='$product_desc',
                price='$price',
                type='$type'
                WHERE productId ='$id'
                ";
            }
            $result = $this->db->update($query);
            if($result){
                $alert="<span class='success'> Product updated successfully</span>";
                return $alert;
            }else{
                $alert="<span class='error'> Product updated not success</span>";
                return $alert;
            }

        }
    }
    public function delete_product($id){
        $query = "DELETE FROM tbl_product WHERE productId='$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert="<span class='success'> Product deleted successfully</span>";
            return $alert;
        }else{
            $alert="<span class='error'> Product deleted not success</span>";
            return $alert;
        }
    }
    public function getproductbyId($id){
        $query = "SELECT * FROM tbl_product WHERE productId='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    //End Backend
    public function getproduct_feathered(){
        $query = "SELECT * FROM tbl_product WHERE type='1'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_new(){
        $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details($id){
        $query=
        "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
         FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
         INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
         WHERE tbl_product.productId ='$id'
         ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestDell(){
        $query = "SELECT * FROM tbl_product WHERE brandId='6' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestOpple(){
        $query = "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestApple(){
        $query = "SELECT * FROM tbl_product WHERE brandId='5' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestSamsung(){
        $query = "SELECT * FROM tbl_product WHERE brandId='7' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_compare($customer_id){
        $query = "SELECT * FROM tbl_compare WHERE customer_id='$customer_id' ORDER BY id desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function insertCompare($productid,$customer_id){
        $productid = mysqli_real_escape_string($this->db->link,$productid);
        $customer_id = mysqli_real_escape_string($this->db->link,$customer_id);
        $check_compare = "SELECT * FROM tbl_compare WHERE productId='$productid' AND customer_id='$customer_id'";
        $check_compare_result = $this->db->select($check_compare);
        if($check_compare_result){
            $msg="<span class='error'>Product already added to compare</span>";
            return $msg;
        }else{
        $query = "SELECT * FROM tbl_product WHERE productId='$productid'";
        $result = $this->db->select($query)->fetch_assoc();

        $image  =$result['image'];
        $price  =$result['price'];
        $productName  =$result['productName'];


        $query_insert = "INSERT INTO tbl_compare(productId, price, image, customer_id, productName) VALUES ('$productid', '$price', '$image','$customer_id','$productName')";
        $insert_compare = $this->db->insert($query_insert);
        if($insert_compare){
            $alert="<span class='success'> Added compare successfully</span>";
            return $alert;
        }else{
            $alert="<span class='error'> Added compare not success</span>";
            return $alert;
        }
        }
        }

    }

?>