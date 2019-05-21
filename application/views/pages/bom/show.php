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
                            <li class="active">Table</li>
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
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    <div class="card-body">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Created By</th>
                                <th>Component</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php foreach ($bom as $key => $value): ?>
                                    <?php 
                                    $this->db->select('bom_component.*,product.name as product_name');
                                    $this->db->join('product',"bom_component.fk_product = product.id_product");
                                    $component = $this->db->where('fk_bom',$value->id_bom)->get('bom_component')->result(); ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $value->name ?></td>
                                        <td><?php echo $value->product_name ?></td>
                                        <td><?php echo $value->quantity ?></td>
                                        <td><?php echo $value->created_name ?></td>
                                        <td>
                                            <?php foreach ($component as $k => $v): ?>
                                                <?php echo $v->product_name." (".$v->quantity.")"; ?><br>
                                            <?php endforeach ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url($c_name.'/update/'.$value->id_bom) ?>" class="btn btn-xs btn-rounded btn-success"> <i class="fa fa-pencil"></i> Edit</a>
                                            <a href="<?php echo base_url($c_name.'/delete/'.$value->id_bom) ?>" class="btn btn-xs btn-rounded btn-danger"> <i class="fa fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg" id="modal-content">

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table').DataTable();
    });

    var table_refresh = () => {
        $('#product-table').DataTable().ajax.reload(null,false);
    }

</script>