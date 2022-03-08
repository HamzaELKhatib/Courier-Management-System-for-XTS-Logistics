<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$type_arr = array('',"Admin","User");
	$qry = $conn->query("SELECT *,concat(lastname,', ',firstname) as name FROM users where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<div class="card card-widget widget-user shadow">
      <div class="widget-user-header bg-dark">
        <h3 class="widget-user-username"><?php echo ucwords($name) ?></h3>
        <h5 class="widget-user-desc"><?php echo $email ?></h5>
      </div>
      
      <div class="card-footer">
        <div class="container-fluid">
        	<dl>
        		<dt>Address</dt>
        		<dd><?php echo $address ?></dd>
        	</dl>
        	<dl>
        		<dt>User Type</dt>
        		<dd><?php echo $type_arr[$type] ?></dd>
        	</dl>
        </div>
    </div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>