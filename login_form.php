			<form id="login_form1" class="form-signin" method="post">
						<h3 class="form-signin-heading" style="color:white;"><i class="icon-lock"></i> გთხოვთ შეხვიდეთ სისტემაში</h3>
						<input type="text" class="input-block-level" id="username" name="username" placeholder="სახელი" required>
						<input type="password" class="input-block-level" id="password" name="password" placeholder="პაროლი" required>
						<button data-placement="right" title="დაკლიკე შესასვლელად" id="signin" name="login" class="btn btn-info" type="submit"><i class="icon-signin icon-large"></i> შესვლა</button>
														<script type="text/javascript">
														$(document).ready(function(){
															$('#signin').tooltip('show');
															$('#signin').tooltip('hide');
														});
														</script>		
			</form>
						<script>
						jQuery(document).ready(function(){
						jQuery("#login_form1").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
									$.jGrowl("მიმდინარეობს ინფორმაციის შემოწმება,გთხოვთ დაიცადოთ რამდენიმე წამი......", { sticky: false });
								$.ajax({
									type: "POST",
									url: "login.php",
									data: formData,
									success: function(html){
									if(html=='true')
									{
									$.jGrowl("ინფორმაცია სწორია", { header: 'მოგესალმებით QR GUIDE სისტემაში' });
									var delay = 1000;
										setTimeout(function(){ window.location = 'dasboard.php'  }, delay);  
									}else
									{
									$.jGrowl("გთხოვთ დარწმუნდეთ თქვენი სახელის ან/და პაროლის სისწორეში", { header: 'მსგავსი ჩანაწერი ბაზაში ვერ მოიძებნა' });
									}
									}
								});
								return false;
							});
						});
						</script>
			<div id="button_form" class="form-signin" >
			
				<h3 class="form-signin-heading" style="color:white;"><i class="icon-edit"></i>რეგისტრაცია</h3>
				<button data-placement="top" title="Sign Up for Membership" id="sign_up_m" onclick="window.location='signup.php'" id="btn_student" name="login" class="btn btn-info" type="submit">რეგისტრაცია</button>
			</div>
														<script type="text/javascript">
														$(document).ready(function(){
															$('#sign_up_m').tooltip('show'); $('#sign_up_m').tooltip('hide');
														});
														</script>	
