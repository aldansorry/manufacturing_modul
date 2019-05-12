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
                        <?php echo form_open(''); ?>
                        <div class="form-group row">
                            <label for="input-name" class="col-sm-2 col-form-label text-right">Name</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="name" class="form-control" id="input-name" value="<?php echo $users->name ?>">
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-username" class="col-sm-2 col-form-label text-right">Username</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="username" class="form-control" id="input-username" value="<?php echo $users->username ?>">
                                <?php echo form_error('username') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-role" class="col-sm-2 col-form-label text-right">Role</label>
                            <div class="col-sm-8 col-md-4">
                                <select name="role" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2">Manager</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="input-password" class="col-sm-2 col-form-label text-right">Password (optional)</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="password" name="password" class="form-control" id="input-password">
                                <?php echo form_error('password') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-cpassword" class="col-sm-2 col-form-label text-right">Confirm Password</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="password" name="cpassword" class="form-control" id="input-cpassword">
                                <?php echo form_error('cpassword') ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="input-submit" class="col-sm-2 col-form-label text-right"></label>
                            <div class="col-sm-8 col-md-4">
                                <input type="submit" name="submit" value="Submit" class="btn btn-success">
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