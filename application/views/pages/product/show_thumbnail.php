<div class="breadcrumbs">
	<div class="breadcrumbs-inner">
		<div class="row m-0">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1><?php echo $c_name ?></h1>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="page-header float-right">
					<div class="page-title">
						<ol class="breadcrumb text-right">
							<li><a href="#"><?php echo $c_name ?></a></li>
							<li><a href="#">Data</a></li>
							<li class="active">Thumbnail</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<?php if ($this->session->flashdata('alert_type') != null): ?>
					<div class="alert alert-<?php echo $this->session->flashdata('alert_type') ?>" role="alert">
						<?php echo $this->session->flashdata('alert_message') ?>
					</div>
				<?php endif ?>
			</div>
			<div class="col-md-12">
				<a href="<?php echo base_url($c_name.'/insert') ?>" class="btn btn-primary mb-3">Insert</a>
				<a href="<?php echo base_url($c_name.'/index') ?>" class="btn btn-info mb-3 float-right">View Table</a>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Data Table</strong>
					</div>
					<div class="card-body">
						<div class="row">
							<?php foreach ($product as $key => $value): ?>
						<div class="col-md-3 col-sm-4 col-6">
							<div class="card" style="width: 18rem;">
							<img src="<?php echo base_url('assets/images/product/'.$value->image) ?>" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title text-uppercase font-weight-bold text-center"><?php echo $value->name ?></h5>
								<p class="card-text">
									<table>
										<tr>
											<td>Price</td>
											<td>:</td>
											<td><?php echo $value->price ?></td>
										</tr>
										<tr>
											<td>Quantity</td>
											<td>:</td>
											<td><?php echo $value->quantity ?></td>
										</tr>
										<tr>
											<td>Type</td>
											<td>:</td>
											<td><?php echo ($value->type == 1 ? 'Storeable':'Consumable') ?></td>
										</tr>
										<tr>
											<td>Category</td>
											<td>:</td>
											<td><?php echo ($value->type == 1 ? 'Component':'Bill of Material') ?></td>
										</tr>
										<tr>
											<td>Created By</td>
											<td>:</td>
											<td><?php echo $value->created_name ?></td>
										</tr>
									</table>
								</p>
								<div class="float-right">
									<a href="<?php echo base_url('Product/update/'.$value->id_product) ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
								<a href="<?php echo base_url('Product/delete/'.$value->id_product) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</div>
							</div>
						</div>
						</div>
					<?php endforeach ?>
						</div>
				</div>
			</div>
		</div>


	</div>
</div><!-- .animated -->
</div><!-- .content -->