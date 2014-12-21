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
								<li><a href="#"><b>ივენთი</b></a><span class="divider">/</span></li>
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
								$query = mysql_query("select * from event where user_id = '$session_id'")or die(mysql_error());
									while($row = mysql_fetch_array($query)){
								?>
									<div id="del<?php echo $row['event_id'];?>" class="alert"><i class="icon-list"></i> <?php echo strtoupper(substr($row['event_title'], 0, 30-2) . '&#133'); ?> 
									<i class="alert alert-info">
										<span class="icon-edit icon-small" > <a id="edit_event" href="edit-event.php?id=<?php echo $session_id;?>&event=<?php echo $row['event_id'];?>">რედაქტირება</a></span> | 
										<span class="icon-remove icon-small"> <a class="delete_event" id="<?php echo $row['event_id'];?>" href="<?php echo $row['event_id'];?>">წაშლა</a></span> | 
										<span> <a onClick="return false;"id="cancel_event" href="<?php echo $row['event_id'];?>">CANCEL</a></span>
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
			$.jGrowl("Your Event is Successfully Deleted", { header: 'Data Delete' });	
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
