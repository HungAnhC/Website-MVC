<?php
include  "inc/header.php";
// include  "inc/slider.php";

?>

<?php
$customer_id=Session::get('customer_id');
if($customer_id==false){
	header("location:login.php");
}
$ct = new cart();
if(isset($_GET['confirmid']) ){
    $id = $_GET['confirmid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
	$shifted_confirm = $ct->shifted_confirm($id,$time,$price);

}

?>

<?php 
if(isset($_GET['cartid'])){
    $cartid=$_GET['cartid'];
	$delorder= $ct->delete_order($cartid);
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your details ordered</h2>
						<table class="tblone">
							<tr>
								<th width="10%">ID</th>

								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="10%">Date</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>

							</tr>
							<?php
							$customer_id=Session::get('customer_id');
							$get_cart_ordered = $ct->get_cart_ordered($customer_id);
							if($get_cart_ordered){	
                                $i=0;
								$qty=0;							
								while($result = $get_cart_ordered->fetch_assoc()){
                                    $i++;
							?>
							<tr>
                                <td><?php echo $i ?></td>
								
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image']; ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price']).' VND'; ?></td>							
								<td><?php echo $result['quantity']; ?></td>		
                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                                <td><?php
                                if($result['status']=='0'){
                                    echo 'Pending';
                                }elseif($result['status']==1){
								?>
                                    <a href="?confirmid=<?php echo $customer_id?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order'] ?>">Shifting</a>
								<?php
                                }else{
									echo "Confirmed";
								}
                                 ?>
								 </td>
                                 <?php
                                 if($result['status']==0){                             
                                 ?>
                                 <td><?php echo 'N/A' ?></td>
                                 <?php
                                 }else{
                                    ?>
                                 <td><a href="?cartid=<?php echo $result['id']; ?>">Xóa</a></td>	
                                 <?php
                                 }
                                 ?>
							</tr>
							<?php

							}
							}
							
							?>
							
					   </table>					   
					   
					 
					</div>

    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
include  "inc/footer.php";
?>
