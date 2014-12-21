<?php include('header_dashboard.php'); ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('calendar_sidebar.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					    
					     <ul class="breadcrumb">
								<li><a href="#"><b>მომხარებელი</b></a><span class="divider">/</span></li>
								<li><a href="#">ჩემი ივენთები: </a></li>
						</ul>
						 
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  								<div class="alert alert-info"><i class="icon-info"></i> ივენთების სია </div>
								<?php
								$query = mysql_query("select * from event where user_id = '$session_id'")or die(mysql_error());
									while($row = mysql_fetch_array($query)){
								?>
									<a href="read.php?id=<?php echo  $row["event_id"] ?>"><div class="alert"><i class="icon-list"></i> <?php echo $row['event_title']; ?> <i  class="alert alert-info"><?php echo $row['date_start']; ?></i></div></a>
								<?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
	
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>
</html>