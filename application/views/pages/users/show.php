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
                "title" : "Name",
                "data": "name" 
            },
            { 
                "title" : "Username",
                "data": "username" 
            },
            { 
                "title" : "Role",
                render: (data,type,row) => {
                    var role = "";
                    switch(row.role){
                        case '1':
                        role = 'admin';
                        break;
                        case '2':
                        role = 'manager';
                        break;
                    }
                    return role;
                } 
            },
            { 
                "title" : "Status",
                render: (data,type,row) => {
                    var is_active = "";
                    switch(row.is_active){
                        case '1':
                        is_active = '<span class="badge badge-primary">active</span>';
                        break;
                        case '0':
                        is_active = '<span class="badge badge-warning">suspend</span>';
                        break;
                    }
                    return is_active;
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
                    ret += ' <a href="<?php echo base_url($c_name.'/update/') ?>'+row.id_users+'" class="btn btn-xs btn-rounded btn-success"> <i class="fa fa-pencil"></i> Edit</a>';
                    
                    let user_id = '<?php echo $this->session->userdata('id_users') ?>';
                    var condition = (row.id_users === user_id);
                    if(condition){
                       
                    }else{
                        if(row.is_active == 1){
                            ret += ' <a href="<?php echo base_url($c_name.'/change_active/') ?>'+row.id_users+'/0" class="btn btn-xs btn-rounded btn-warning"> <i class="fa fa-warning"></i> Suspend</a>';
                        }else{
                            ret += ' <a href="<?php echo base_url($c_name.'/change_active/') ?>'+row.id_users+'/1" class="btn btn-xs btn-rounded btn-info"> <i class="fa fa-info-circle"></i> Active</a>';
                        }
                        ret += ' <a href="<?php echo base_url($c_name.'/delete/') ?>'+row.id_users+'" class="btn btn-xs btn-rounded btn-danger"> <i class="fa fa-trash"></i> Hapus</a>';
                    }
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