
<?php
include  "inc/header.php";
?>
<?php
$login_check = Session::get('customer_login');
if($login_check){
	header('location:order.php');
}
?>
<?php

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])){
	
	$insertCustomer =$cs->insert_customer($_POST);
}
?>
<?php

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['login'])){
	
	$login_Customer =$cs->login_customer($_POST);
}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>

        	<form action="" method="post" >
                	<input type="text" name="email" class="field" placeholder ="Enter email">
                    <input type="password" name="password" class="field" placeholder ="Enter password">
					<?php
					if(isset($login_Customer)){
					echo $login_Customer;
					}
					?>
                
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Sign in"></div></div>
			</form>
					
        </div>
					
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
			if(isset($insertCustomer)){
				echo $insertCustomer;
			}
			?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder = "Name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder = "City">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder = "Zipcode">
							</div>
							<div>
								<input type="text" name="email" placeholder = "Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder = "Address">
						</div>
		    		<div>
						<select id="country" name="country" placeholder = "Country">
							<option value="null">Select a Country</option>         
							<option value="HCM">TP.HCM</option>
							<option value="DN">Đà Nẵng</option>
							<option value="HN">Hà Nội</option>


							

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder = "Phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder = "Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Create Account"></input></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
include  "inc/footer.php";
?>
