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
                            <li class="active">Update</li>
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
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Update Data</strong>
                    </div>
                    <div class="card-body">
                        <?php echo form_open(); ?>
                        <div class="form-group row">
                            <label for="input-name" class="col-sm-2 col-form-label text-right">Name</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="name" class="form-control" id="input-name" value="<?php echo $bom->name ?>">
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-quantity" class="col-sm-2 col-form-label text-right">Quantity</label>
                            <div class="col-sm-8 col-md-4">
                            <input type="text" name="quantity" class="form-control" id="input-quantity" value="<?php echo $bom->quantity ?>">
                                <?php echo form_error('quantity') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-fk_product" class="col-sm-2 col-form-label text-right">Product</label>
                            <div class="col-sm-8 col-md-4">
                                <select name="fk_product" class="form-control">
                                    <?php foreach ($product as $key => $value): ?>
                                        <option value="<?php echo $value->id_product ?>"><?php echo $value->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-component" class="col-sm-2 col-form-label text-right">Component</label>
                            <div class="col-sm-8 col-md-4">
                                <div id="component-container" class="mb-2">
                                    <?php foreach ($component as $key => $value): ?>
                                        <?php $id = ++$key ?>
                                        <div class="input-group mt-2 component-title" id="component-<?php echo $id ?>-title">
                                            <select name="component_product[]" class="form-control" id="select-<?php echo $id ?>">
                                                <?php foreach ($product as $k => $v): ?>
                                                    <option value="<?php echo $v->id_product ?>"><?php echo $v->name ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <input type="number" min="1" value="<?php echo $value->quantity ?>" name="component_quantity[]" class="form-control">
                                            <div class="input-group-append">
                                                <a class="btn btn-outline-danger component-button" onclick="remove_component(this.id)" id="component-<?php echo $id ?>"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <script>
                                            $('#select-<?php echo $id ?>').val('<?php echo $value->fk_product ?>')
                                        </script>
                                    <?php endforeach ?>
                                </div>
                                <a href="#" class="btn btn-outline-primary" onclick="add_component()"><i class="fa fa-plus"></i> Add Component</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-submit" class="col-sm-2 col-form-label text-right"></label>
                            <div class="col-sm-8 col-md-4">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                <a href="<?php echo base_url($c_name) ?>" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<div style="display: none" id="component-sample">
    <div class="input-group mt-2 component-title" id="">
        <select name="component_product[]" class="form-control">
            <?php foreach ($product as $key => $value): ?>
                <option value="<?php echo $value->id_product ?>"><?php echo $value->name ?></option>
            <?php endforeach ?>
        </select>
        <input type="number" min="1" value="1" name="component_quantity[]" class="form-control">
        <div class="input-group-append">
            <a class="btn btn-outline-danger component-button" onclick="remove_component(this.id)" id="component-1"><i class="fa fa-trash"></i></a>
        </div>
    </div>
</div>
<script>
    var index = <?php echo count($component)+1 ?>;
    var add_component = () =>{
        $('#component-sample').find('.component-title').attr('id','component-'+index+'-title');
        $('#component-sample').find('.component-button').attr('id','component-'+index);
        var html = $('#component-sample').html();
        $('#component-container').append(html);
        index++;
    }

    var remove_component = (id) => {
        id = id+'-title';
        $('#'+id).remove();
    }

</script>