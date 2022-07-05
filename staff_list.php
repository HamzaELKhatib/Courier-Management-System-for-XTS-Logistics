<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_staff"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
                        <th>Action</th>
						<th>Nom</th>
						<th>Email</th>
						<th>Branche</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT u.*,concat(u.firstname,' ',u.lastname) as name,concat(b.street,', ',b.city,', ',b.state,', ',b.zip_code,', ',b.country) as baddress FROM users u inner join branches b on b.id = u.branch_id order by concat(u.firstname,' ',u.lastname) asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="index.php?page=Controller/edit_staff&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat ">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-flat delete_user" data-id="<?php echo $row['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo ($row['email']) ?></b></td>
						<td><b><?php echo ucwords($row['baddress']) ?></b></td>

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
		$('#list').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
		$('.view_staff').click(function(){
			uni_modal("staff's Details","view_staff.php?id="+$(this).attr('data-id'),"large")
		})
	$('.delete_user').click(function(){
	_conf("Are you sure to delete this staff?","delete_user",[$(this).attr('data-id')])
	})
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>