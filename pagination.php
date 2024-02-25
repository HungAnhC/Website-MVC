<?php
include  "inc/header.php";
include  "inc/slider.php";

?>


 <div class="main">
	<?php
	?>

        <div class="content_top">
    		<div class="heading">
    		<h3>Product</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
				$product_new= $product->getproduct_new();
				if($product_new){
					while($result_new = $product_new->fetch_assoc()){
			
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result_new['image']; ?>" alt="" /></a>
					 <h2><?php echo $result_new["productName"]; ?> </h2>
					 <p><?php echo $fm->textShorten($result_new["product_desc"],30); ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result_new["price"])." "."VND"; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php
				}
			}

				?>
			</div>
			<div class ="pagination">
				<?php
				$product_all= $product->get_all_product();
				$product_count =mysqli_num_rows($product_all);
				$product_button = ceil($product_count/4);

				for ($i=1;$i<=$product_button;$i++){                 
					echo '<a href="pagination.php?trang='.$i.'">'.$i.'</a>';
				}
				?>
			</div>
    </div>
 </div>

 <?php
include  "inc/footer.php";


?>
