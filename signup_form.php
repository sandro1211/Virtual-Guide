			<form id="signup_user" class="form-signin" method="post">
			<h3 class="form-signin-heading"><i class="icon-lock"></i> დარეგისტრირდით როგორც ახალი მომხარებელი</h3>
			<input type="text" class="input-block-level" id="firstname" name="firstname" placeholder="სახელი" required>
			<input type="text" class="input-block-level" id="lastname" name="lastname" placeholder="გვარი" required>
			<input type="text" class="input-block-level" id="username"  value="" name="username" placeholder="ნიკნეიმი" required>
			<input type="password" class="input-block-level" id="password" value="" name="password" placeholder="პაროლი" required>
			<input type="password" class="input-block-level" id="cpassword" name="cpassword" placeholder="გაიმეორეთ პაროლი" required>
			<textarea class="input-block-level" id="about" name="about" placeholder="ცოტა რამ ჩემს შესახებ" required></textarea>
			<button id="signin" name="login" class="btn btn-info" type="submit"><i class="icon-check icon-large"></i> რეგისტრაცია</button>
			</form>
			
		
			
			<script>
			jQuery(document).ready(function(){
			jQuery("#signup_user").submit(function(e){
					e.preventDefault();
						
						var password = jQuery('#password').val();
						var cpassword = jQuery('#cpassword').val();
					
					
					if (password == cpassword){
					var formData = jQuery(this).serialize();
					$.ajax({
						type: "POST",
						url: "user_signup.php",
						data: formData,
						success: function(html){
						if(html=='true')
						{
						$.jGrowl("Welcome to Online Diary Management System", { header: 'Sign up Success' });
						var delay = 2000;
							setTimeout(function(){ window.location = 'index.php'  }, delay);  
						}else if(html=='false'){
							$.jGrowl("Error in page. ", { header: 'Sign Up Failed' });
						}
						}
					});
			
					}else
						{
						$.jGrowl("Password did not match", { header: 'Sign Up Failed' });
						}
				});
			});
			</script>

			
		
			<a onclick="window.location='index.php'" id="btn_login" name="login" class="btn" type="submit"><i class="icon-signin icon-large"></i> უკან დაბრუნება</a>
			
			
			
				
		
					