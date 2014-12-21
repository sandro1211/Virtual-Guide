<?php include('header_dashboard.php'); ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('calendar_sidebar.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					   
					     <ul class="breadcrumb">
								<li><a href="#"><b>მომხმარებელი</b></a><span class="divider">/</span></li>
								<li><a href="#"><b>ივენთები</b></a><span class="divider">/</span></li>
								<li><a href="#">მენეჯერი: </a></li>
						</ul>
						
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  								<div class="alert alert-info"><i class="icon-info"></i> ივენთების მართვის გვერდი </div>
								<?php
								$query = mysql_query("select * from contact where user_id = '$session_id'")or die(mysql_error());
									while($row = mysql_fetch_array($query)){
								?>
									<div id="del<?php echo $row['id'];?>" class="alert"><i class="icon-list"></i> <?php echo strtoupper($row['name']); ?> : <?php echo strtoupper($row['mobile']); ?> : <i class="icon-list"><?php echo strtoupper($row['number']); ?></i> 
									<i class="alert alert-info">
										<span class="icon-edit icon-small" > <a id="edit_event" href="edit-contact.php?id=<?php echo $session_id;?>&event=<?php echo $row['id'];?>">EDIT</a></span> | 
										<span class="icon-remove icon-small"> <a class="delete_event" id="<?php echo $row['id'];?>" href="<?php echo $row['id'];?>">DELETE</a></span> | 
										<span> <a onClick="return false;"id="cancel_event" href="<?php echo $row['id'];?>">CANCEL</a></span>
									</i></div>
								<?php } ?>
                                </div>
                            </div>
                        </div>
<script type="text/javascript">
	$(document).ready( function() {
		$('.delete_event').click( function() {
		var id = $(this).attr("id");
			$.ajax({
			type: "POST",
			url: "remove_event.php",
			data: ({id: id}),
			cache: false,
			success: function(html){
			alert(html);
			$("#del"+id).fadeOut('slow', function(){ $(this).remove();}); 
			$('#'+id).modal('hide');
			$.jGrowl("ივენთი წარმატებით წაიშალა", { header: 'ინფორმაცია წაშლილია' });	
			}
			}); 		
			return false;
		});				
	});
</script>
                        
                    </div>

                </div>
	
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
		
    </body>
</html>
