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
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <button id="btn-confirm" onclick="if (confirm('Confirm?')) window.location.href='<?php echo base_url('Manufacturing/confirm/'.$manufacturing->id_manufacturing) ?>'" class="btn <?php echo ($manufacturing->status == 1 ? 'btn-primary' : 'btn-outline-secondary') ?>" disabled>Confirm</button>
                                <button id="btn-progress" onclick="if (confirm('progress?')) window.location.href='<?php echo base_url('Manufacturing/progress/'.$manufacturing->id_manufacturing) ?>'" class="btn <?php echo ($manufacturing->status == 2 ? 'btn-primary' : 'btn-outline-secondary') ?>" disabled>Progress</button>
                                <button id="btn-done" onclick="if (confirm('Done?')) window.location.href='<?php echo base_url('Manufacturing/done/'.$manufacturing->id_manufacturing) ?>'" class="btn <?php echo ($manufacturing->status == 3 ? 'btn-primary' : 'btn-outline-secondary') ?>" disabled>Done</button>
                                <?php if ($manufacturing->status == 1): ?>
                                    <button id="btn-cancel" onclick="if (confirm('Do you want to Cancel this Manufacturing?')) window.location.href='<?php echo base_url('Manufacturing/cancel/'.$manufacturing->id_manufacturing) ?>'" class="btn <?php echo ($manufacturing->status == 3 ? 'btn-primary' : 'btn-outline-secondary') ?> float-right">Cancel</button>
                                <?php endif ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-bom" class="col-sm-2 col-form-label text-right">Bill Of Material</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" readonly="" class="form-control" id="input-bom" value="<?php echo $manufacturing->bom_name ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-quantity" class="col-sm-2 col-form-label text-right">Quantity</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" readonly="" class="form-control" id="input-quantity" value="<?php echo $manufacturing->quantity ?>">
                            </div>
                        </div>
                        <?php if ($manufacturing->status == 1): ?>
                            <div class="row">
                                <table class="table table-border table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Component</th>
                                            <th>Needed</th>
                                            <th>Stock</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $is_ready = true; ?>
                                        <?php foreach ($component as $key => $value): ?>
                                            <tr>
                                                <td><?php echo $key+1 ?></td>
                                                <td><?php echo $value->product_name ?></td>
                                                <td><?php echo $value->quantity_need ?></td>
                                                <td><?php echo $value->quantity_stock ?></td>
                                                <td>
                                                    <?php if ($value->quantity_need <= $value->quantity_stock): ?>
                                                        <span class="badge badge-primary">ready</span>
                                                        <?php else: ?>
                                                            <?php echo $is_ready = false; ?>
                                                            <span class="badge badge-danger">not ready</span>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <?php if ($is_ready): ?>
                                        <script>
                                            $('#btn-confirm').attr('disabled',false);
                                        </script>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($manufacturing->status == 2): ?>
        <script>
            $('#btn-progress').attr('disabled',false);
        </script>
    <?php endif ?>
    <?php if ($manufacturing->status == 3): ?>
        <script>
            $('#btn-done').attr('disabled',false);
        </script>
    <?php endif ?>
