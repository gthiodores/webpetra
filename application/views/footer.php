

	<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.slim.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/jquery-slim.min.js"><\/script>')</script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
  	$(document).ready(function() {
		    $('.datatable').DataTable();
		} );
  </script>
	<script type="text/javascript">
		$(".datepicker").datepicker({
			startView: 2,
			minViewMode: 2,
			maxViewMode: 3
		});
	</script>
</body>
</html>
