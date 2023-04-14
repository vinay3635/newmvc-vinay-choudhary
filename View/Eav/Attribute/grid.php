<?php
$eavAttributes = $this->getEavAttributes(); 
?>
<div class="container">
	<div class="row mb-3">
		<div class="col-md-6">
			<h2>Manage Attributes</h2>
		</div>
		<div class="col-md-6 text-end">
			<a href="<?php echo $this->getUrl('add', null , [], true); ?>" class="btn btn-primary">Add Eav Attribute</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col table-responsive">
		<?php if (!$eavAttributes): ?>
			<div class="alert alert-warning" role="alert">
				No data found.
			</div>
		<?php else: ?>
			<table class="table table-striped table-hover text-center">
				<thead>
					<tr class="dd">
						<th>Attribute Id</th>
						<th>Entity Type Id</th>
						<th>Code</th>
						<th>Backend Type</th>
						<th>Name</th>
						<th>Status</th>
						<th>Backend Model</th>
						<th>Input Type</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($eavAttributes as $eavAttribute) : ?>
						<tr>
							<td><?php echo $eavAttribute->attribute_id; ?></td>
							<td><?php echo $eavAttribute->entity_type_id ; ?></td>
							<td><?php echo $eavAttribute->code; ?></td>
							<td><?php echo $eavAttribute->backend_type; ?></td>
							<td><?php echo $eavAttribute->name; ?></td>
							<td><?php echo $eavAttribute->getStatusText(); ?></td>
							<td><?php echo $eavAttribute->backend_model; ?></td>
							<td><?php echo $eavAttribute->input_type; ?></td>
							<td><a href="<?php echo $this->getUrl('edit', null, ['id'=> $eavAttribute->attribute_id], true);?>" class="btn btn-sm btn-primary">Edit</a></td>
							<td><a href="<?php echo $this->getUrl('delete', null, ['id'=> $eavAttribute->attribute_id], true);?>" class="btn btn-sm btn-danger">Delete</a></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>