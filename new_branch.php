<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-branch">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
          <div class="col-md-12">
            <div id="msg" class=""></div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Adresse</label>
                <textarea name="street" id="" cols="30" rows="2" class="form-control"><?php echo isset($street) ? $street : '' ?></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Ville</label>
                <textarea name="city" id="" cols="30" rows="2" class="form-control"><?php echo isset($city) ? $city : '' ?></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Region</label>
                <textarea name="state" id="" cols="30" rows="2" class="form-control"><?php echo isset($state) ? $state : '' ?></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Code Postal</label>
                <textarea name="zip_code" id="" cols="30" rows="2" class="form-control"><?php echo isset($zip_code) ? $zip_code : '' ?></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Pays</label>
                <textarea name="country" id="" cols="30" rows="2" class="form-control"><?php echo isset($country) ? $country : '' ?></textarea>
              </div>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Contact #</label>
                <textarea name="contact" id="" cols="30" rows="2" class="form-control"><?php echo isset($contact) ? $contact : '' ?></textarea>
              </div>
            </div>

          </div>
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-branch">Enregistrer</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=branch_list">Annuler</a>
  		</div>
  	</div>
	</div>
</div>
<script>
	$('#manage-branch').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_branch',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
              location.href = 'index.php?page=branch_list'
					},2000)
				}
			}
		})
	})
</script>