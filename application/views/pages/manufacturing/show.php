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
                        <table id="data-table" class="table table-striped table-bordered"></table>
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
        $('#data-table').DataTable( {
            "ajax": {
                'url': "<?= base_url($c_name.'/get') ?>",
            },
            "columns": [
            {
                "title" : "No",
                "width" : "15px",
                "data": null,
                "visible":true,
                "class": "text-center",
                render: (data, type, row, meta) => {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { 
                "title" : "Product",
                "data": "product_name" 
            },
            { 
                "title" : "Bill of Material",
                "data": "bom_name" 
            },
            { 
                "title" : "Quantity",
                "data": "quantity" 
            },
            { 
                "title" : "Status",
                "data": "status" 
            },
            {
                "title": "Actions",
                "data":'id_manufacturing',
                "visible":true,
                "class": "text-center",
                render: (data, type, row) => {
                    let ret = "";
                    ret += ' <a href="<?php echo base_url($c_name.'/detail/') ?>'+data+'" class="btn btn-xs btn-rounded btn-success"> <i class="fa fa-pencil"></i> Edit</a>';
                    ret += ' <a href="<?php echo base_url($c_name.'/delete/') ?>'+data+'" class="btn btn-xs btn-rounded btn-danger"> <i class="fa fa-trash"></i> Hapus</a>';
                    return ret;
                }
            }
            ]
        } );
    });

    var table_refresh = () => {
        $('#product-table').DataTable().ajax.reload(null,false);
    }

</script>