
<?php require_once('constent.php'); ?>
 <!-- jQuery 2.0.2 -->
		
		<script src="Assets/js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        
		<script src="Assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        
		<!-- Bootstrap -->
        <script src="Assets/js/bootstrap.min.js" type="text/javascript"></script>
        
		<!-- datepicker -->
        <script src="Assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
		
		<!-- daterangepicker -->
        <script src="Assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		
		<!-- bootstrap time picker -->
        <script src="Assets/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		
        <!-- Bootstrap WYSIHTML5 -->
        
		<script src="Assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
		

        <!-- DATA TABES SCRIPT -->
        <script src="Assets/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
       
		<script src="Assets/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		
		<!-- AdminLTE App -->
		<script src="Assets/js/AdminLTE/app.js" type="text/javascript"></script> 
	
		<!-- page script -->
		
		
		
        <script type="text/javascript">
            $(function() {
				
				$('.datetimepicker').datepicker({
                    format: "dd-mm-yyyy"
                });  
				 
				$('#reservation').daterangepicker({
					minDate: new Date()  
				});
				 
				$('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false,
					"aaSorting": []
                });
				$('.paging_bootstrap').addClass('pull-right');
            });
        </script>
    </body>
</html>