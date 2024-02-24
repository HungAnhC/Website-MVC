<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
				$getLastestApple = $product->getLastestApple();
				if($getLastestApple){
					while($resultapple = $getLastestApple->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $resultapple["image"]; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $resultapple["productName"]; ?></h2>
						<p><?php echo $resultapple["product_desc"]; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultapple['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
				}
				}
			   
			   ?>		
							<?php
				$getLastestDell = $product->getLastestDell();
				if($getLastestDell){
					while($resultdell = $getLastestDell->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $resultdell["image"]; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $resultdell["productName"]; ?></h2>
						<p><?php echo $resultdell["product_desc"]; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
				}
				}
			   
			   ?>	
			</div>
			<div class="section group">
				<?php
				$getLastestOpple = $product->getLastestOpple();
				if($getLastestOpple){
					while($resultopple = $getLastestOpple->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $resultopple["image"]; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $resultopple["productName"]; ?></h2>
						<p><?php echo $resultopple["product_desc"]; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultopple['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
				}
				}
			   
			   ?>		
							<?php
				$getLastestSamsung = $product->getLastestSamsung();
				if($getLastestSamsung){
					while($resultss = $getLastestSamsung->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $resultss["image"]; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $resultss["productName"]; ?></h2>
						<p><?php echo $resultss["product_desc"]; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultss['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
				}
				}
			   
			   ?>	
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
						$get_slider=$product->show_slider();
						if($get_slider){
							while($result_slider=$get_slider->fetch_assoc()){

						?>
						<li><img src="admin/uploads/<?php echo $result_slider['slider_image']?>" alt="<?php echo $result_slider['sliderName'] ?>"/></li>
						<?php
														
							}
						}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	