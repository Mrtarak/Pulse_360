<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

          <?= view('includes/breadcrumb'); ?>
               <h4 class="card-title">Rights</h4>
               <p class="card-description">Add New Right</p>

        <form method="post" action="<?= site_url('rights/save') ?>">
          <div class="row">
            <div class="col-md-6 form-group">
              <label>Right ID</label>
              <input type="text" name="Right_Id" class="form-control" id="Right_Id" placeholder="Enter Right ID" >
            </div>

            <div class="col-md-6 form-group">
      <label>Rights Title</label>
      <input type="text" name="Rights_Title" class="form-control" placeholder="Enter Title/Role for Right" >
    </div>

             <div class="col-md-6 form-group">
                <label>Can View</label>
                <select name="Can_View" class="form-select">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            
            <div class="col-md-6 form-group">
                <label>Can Add</label>
                <select name="Can_Add" class="form-select">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

             <div class="col-md-6 form-group">
                <label>Can Edit</label>
                <select name="Can_Edit" class="form-select">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            
            <div class="col-md-6 form-group">
                <label>Can Delete</label>
                <select name="Can_Delete" class="form-select">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-md-6 form-group">
      <label>Rights Summary</label>
      <input type="text" name="Rights_Summary" class="form-control" value="<?= old('Rights_Summary') ?>" placeholder="Enter Summary of Rights" >
    </div>

                <div class="col-md-6 form-group">
      <label>Recorded By</label>
      <input type="text" name="Record_Added_By" class="form-control" value="<?= old('Record_Added_By') ?>" placeholder="Enter Who Recorded Record" >
    </div>

    <div class="col-md-6 form-group">
      <label>Recorded On</label>
      <input type="date" name="Rec_Added_On" class="form-control" value="<?= old('Rec_Added_On') ?>">
    </div>

  <div class="mt-4">
    <a href="<?= site_url('rights') ?>" class="btn btn-light">Cancel</a>
    <button type="submit" class="btn btn-primary me-2">Save</button>
  </div>
                  </form>
      </div>
    </div>
  </div>
</div>

  <?= view('includes/footer'); ?>
