<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
            <div class="btn-group dropright">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Status
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="./index.php?page=parcel_list">Tout</a>
                    <?php
                    $status_arr = array("Enregistré","Envoyé","Livré en gars","Livré à domicile");
                    foreach ($status_arr as $k => $v):?>
                        <a class="dropdown-item"
                           href="./index.php?page=parcel_list<?php if ($k != '') echo "&s=" . $k ?>">
                            <p><?php echo $v ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary "
                   href="./index.php?page=new_parcel"><i class="fa fa-plus"></i> Ajouter Nouveau</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped" id="list">

				<thead>
					<tr>
                        <th>Action</th>
						<th>Numéro de suivi</th>
						<th>Nom de l'expéditeur</th>
						<th>Nom du destinataire</th>
						<th>Status</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;

					$where = "";

					if(isset($_GET['s'])){
						$where = " where status = {$_GET['s']} ";
					}
					if($_SESSION['login_type'] != 1 ){

						if(empty($where)) {
                            $where = " where ";
                        }
						else {
                            $where .= " and ";
                        }
						$where .= " (from_branch_id = {$_SESSION['login_branch_id']} or to_branch_id = {$_SESSION['login_branch_id']}) ";
					}


					$qry = $conn->query("SELECT * from parcels $where order by  unix_timestamp(date_created) desc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
                        <td class="text-center">
                            <div class="btn-group">
                                <?php if($row['status']==0): ?>
                                <button type="button" class="btn btn-danger btn-flat send_parcel" data-id="<?php echo $row['id'] ?>">
                                    <i class="fas fa-location-arrow"></i>
                                </button>
                                <?php endif; ?>

                                <a href="./index.php?page=track" class="btn btn-primary btn-flat ">
                                    <i class="fas fa-search"></i>
                                </a>
                                <button type="button" class="btn btn-outline-primary btn-flat view_parcel" data-id="<?php echo $row['id'] ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="index.php?page=edit_parcel&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat ">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" class="btn btn-danger btn-flat delete_parcel" data-id="<?php echo $row['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </div>
                        </td>
						<td><b><?php echo ($row['br_dec']) ?></b></td>
						<td><b><?php echo ucwords($row['sender_name']) ?></b></td>
						<td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
						<td class="text-center">
							<?php
                            $status_arr = array("Enregistré","Envoyé","Livré en gars","Livré à domicile");
							switch ($row['status']) {
                                case '1':
                                    echo "<span class='badge badge-pill badge-info'> Envoyé</span>";
                                    break;
                                case '2':
                                    echo "<span class='badge badge-pill badge-info'> Livré en gars</span>";
                                    break;
                                case '3':
                                    echo "<span class='badge badge-pill badge-primary'> Livré à domicile</span>";
                                    break;
                                default:
                                    echo "<span class='badge badge-pill badge-info'> Enregistré</span>";
									
									break;
							}

							?>
						</td>

					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table td{
		vertical-align: middle !important;
	}
</style>
<script>
	$(document).ready(function(){

		$('.view_parcel').click(function(){
			uni_modal("Détails du colis","view_parcel.php?id="+$(this).attr('data-id'),"large")
		})
	$('.delete_parcel').click(function(){
	_conf("Êtes-vous sûr de supprimer ce colis?","delete_parcel",[$(this).attr('data-id')])
	})
        $('.send_parcel').click(function(){
            _conf("Voulez-vous envoyer ce colis?","send_parcel",[$(this).attr('data-id')])
        })
	})
	function delete_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_parcel',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Colis supprimer",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
    function send_parcel($id){
        start_load()
        $.ajax({
            url:'ajax.php?action=update_parcel_send',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Colis mis-à envoyer",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }
            }
        })
    }
    $('#update_status').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=update_parcel',
            method:'POST',
            data:$(this).serialize(),
            error:(err)=>{
                console.log(err)
                alert_toast('Erreur.',"error")
                end_load()
            },
            success:function(resp){
                if(resp==1){
                    alert_toast("Status du Colis est mis-à-jour.",'succés');
                    setTimeout(function(){
                        location.reload()
                    },750)
                }
            }
        })
    })
</script>