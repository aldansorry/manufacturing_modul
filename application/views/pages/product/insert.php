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
                            <li><a href="#">Table</a></li>
                            <li class="active">Data table</li>
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
                        <strong class="card-title">Insert Data</strong>
                    </div>
                    <div class="card-body">
                        <?php echo form_open(); ?>
                        <div class="form-group row">
                            <label for="input-name" class="col-sm-2 col-form-label text-right">name</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="name" class="form-control" id="input-name" value="<?php echo set_value('name') ?>">
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-price" class="col-sm-2 col-form-label text-right">price</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="price" class="form-control" id="input-price" value="<?php echo set_value('price') ?>">
                                <?php echo form_error('price') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-quantity" class="col-sm-2 col-form-label text-right">quantity</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="quantity" class="form-control" id="input-quantity" value="<?php echo set_value('quantity') ?>">
                                <?php echo form_error('quantity') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-image" class="col-sm-2 col-form-label text-right">image</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="image" class="form-control" id="input-image" value="<?php echo set_value('image') ?>">
                                <?php echo form_error('image') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-type" class="col-sm-2 col-form-label text-right">type</label>
                            <div class="col-sm-8 col-md-4">
                                <select name="type" class="form-control">
                                    <option value="1">Storeable</option>
                                    <option value="2">Consumable</option>
                                    <option value="3">Services</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-submit" class="col-sm-2 col-form-label text-right"></label>
                            <div class="col-sm-8 col-md-4">
                                <input type="submit" name="submit" value="Submit another Data" class="btn btn-primary">
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