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
                "title" : "Date Start",
                "data": "date_start" 
            },
            { 
                "title" : "Date Finish",
                "data": "date_finish" 
            },
            { 
                "title" : "Status",
                render: (data,type,row) => {
                    var status = "";
                    switch(row.status){
                        case '1':
                        status = '<span class="badge badge-secondary">check</span>';
                        break;
                        case '2':
                        status = '<span class="badge badge-primary">confirmed</span>';
                        break;
                        case '3':
                        status = '<span class="badge badge-info">progress</span>';
                        break;
                        case '4':
                        status = '<span class="badge badge-success">done</span>';
                        break;
                        case '0':
                        status = '<span class="badge badge-dark">canceled</span>';
                        break;
                    }
                    return status;
                }
            },
            { 
                "title" : "Created By",
                "data": "created_name" 
            },
            {
                "title": "Actions",
                "visible":true,
                "class": "text-center",
                render: (data, type, row) => {
                    let ret = "";
                    if (!(row.status == 0 || row.status == 4)) {
                        ret += ' <a href="<?php echo base_url($c_name.'/detail/') ?>'+row.id_manufacturing+'" class="btn btn-xs btn-rounded btn-info"> <i class="fa fa-info-circle"></i> Detail</a>';
                    }
                    ret += ' <a href="<?php echo base_url($c_name.'/delete/') ?>'+row.id_manufacturing+'" class="btn btn-xs btn-rounded btn-danger"> <i class="fa fa-trash"></i> Hapus</a>';
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