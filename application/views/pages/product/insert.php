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
                        <?php echo form_open_multipart(); ?>
                        <div class="form-group row">
                            <label for="input-image" class="col-sm-2 col-form-label text-right">Image</label>
                            <div class="col-sm-8 col-md-4">
                                <img src="<?php echo base_url('assets/images/') ?>imageholder.png" alt="" id="image-preview" class="w-50">
                                <input type="file" name="image" class="form-control" id="input-image">
                                <?php echo form_error('image') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-name" class="col-sm-2 col-form-label text-right">Name</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="name" class="form-control" id="input-name" value="<?php echo set_value('name') ?>">
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-price" class="col-sm-2 col-form-label text-right">Price</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="number" min="0" name="price" class="form-control" id="input-price" value="<?php echo set_value('price') ?>">
                                <?php echo form_error('price') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-tax" class="col-sm-2 col-form-label text-right">Tax</label>
                            <div class="col-sm-8 col-md-4">
                                <input type="text" name="tax" list="tax-list" class="form-control" id="input-tax" value="<?php echo set_value('tax') ?>">
                                <?php echo form_error('tax') ?>
                                <datalist id="tax-list">
                                    <?php foreach ($tax as $key => $value): ?>
                                        <option value="<?php echo $value->tax ?>"></option>
                                    <?php endforeach ?>
                              </datalist>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="input-quantity" class="col-sm-2 col-form-label text-right">Quantity</label>
                        <div class="col-sm-8 col-md-4">
                            <input type="number" min="0" name="quantity" class="form-control" id="input-quantity" value="<?php echo set_value('quantity') ?>">
                            <?php echo form_error('quantity') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-type" class="col-sm-2 col-form-label text-right">Type</label>
                        <div class="col-sm-8 col-md-4">
                            <select name="type" class="form-control">
                                <option value="1">Storeable</option>
                                <option value="2">Consumable</option>
                                <option value="3">Services</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-category" class="col-sm-2 col-form-label text-right">Category</label>
                        <div class="col-sm-8 col-md-4">
                            <select name="category" class="form-control">
                                <option value="1">Component</option>
                                <option value="2">Bill of Material</option>
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
<script>
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#image-preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}

$("#input-image").change(function() {
  readURL(this);
});
</script>