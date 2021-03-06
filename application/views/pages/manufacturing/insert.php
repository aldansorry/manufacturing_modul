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
                            <li class="active">Insert</li>
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
                            <label for="input-fk_bom" class="col-sm-2 col-form-label text-right">Bill of Material</label>
                            <div class="col-sm-8 col-md-4">
                                <select name="fk_bom" class="form-control">
                                    <?php foreach ($bom as $key => $value): ?>
                                        <option value="<?php echo $value->id_bom ?>"><?php echo $value->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-quantity" class="col-sm-2 col-form-label text-right">Quantity</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="quantity" class="form-control" id="input-quantity" value="<?php echo set_value('quantity') ?>">
                                <?php echo form_error('quantity') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-date_start" class="col-sm-2 col-form-label text-right">Date Start</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="date" name="date_start" class="form-control" id="input-date_start" value="<?php echo (set_value('date_start') != "" ? set_value('date_start') : date('Y-m-d')) ?>">
                                <?php echo form_error('date_start') ?>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="input-submit" class="col-sm-2 col-form-label text-right"></label>
                            <div class="col-sm-8 col-md-4">
                                <input type="submit" name="submit" value="Check Availibility" class="btn btn-primary">
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