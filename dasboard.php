<?php include('header_dashboard.php'); ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('calendar_sidebar.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
                       
                        <div id="block_bg" class="block">
                
								<div class="block-content collapse in">
										<div class="span12">
							
										<div class="navbar navbar-inner block-header">
											<div class="muted pull-left">კალენდარი</div>
										</div>
										<div id='calendar'></div>		
							
									</div>
										
							
							
						
										</div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
		<?php include('class_calendar_script.php'); ?>
    </body>
</html>