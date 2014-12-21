<script>
        $(function() {
           
            var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
     
            droppable: true, 
            drop: function(date, allDay) { 
            
                
                var originalEventObject = $(this).data('eventObject');
                
                
                var copiedEventObject = $.extend({}, originalEventObject);
                
                
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                
              
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                
               
                if ($('#drop-remove').is(':checked')) {
                    
                    $(this).remove();
                }
                
            },
			editable: true,
			
				 events:
		[
		<?php $event_query = mysql_query("select * from event where user_id = '$get_id' or user_id = '' ")or die(mysql_error());
			  while($event_row = mysql_fetch_array($event_query)){
		?>
        {
            title  : '<?php echo $event_row['event_title']; ?> ',
            start  : '<?php echo $event_row['date_start']; ?>',
            end  : '<?php echo $event_row['date_end']; ?>'
        },
		<?php } ?>
		]
			
			});
        });


        </script>
				