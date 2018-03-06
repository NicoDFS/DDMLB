<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <strong>Version</strong> 1.0.0
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://epicapptechnology.com">EpicApp Technology</a>.</strong> All rights
    reserved.
  </footer>
<!-- model for warning popup -->
  
<div class="modal fade" id="popUpinfo" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-danger" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Alert !</h4>
      </div>
      <div class="modal-body">
      	<p>Are you sure want to delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="SureGo">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function(){
	setTimeout(function() {$(".alert").hide('blind', {}, 500)}, 5000);
});
</script>