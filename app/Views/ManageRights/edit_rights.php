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
               <p class="card-description">Edit Rights</p>

        <form method="post" action="<?= site_url('rights/save') ?>">
          <div class="row">
            <div class="col-md-6 form-group">
              <label>Right ID</label>
              <input type="text" name="Right_Id" class="form-control" value="<?= old('Right_Id', $right['Right_Id'] ?? '') ?>" required>
            </div>

            <div class="col-md-6 form-group">
      <label>Rights Title</label>
      <input type="text" name="Rights_Title" class="form-control" value="<?= old('Rights_Title', $right['Rights_Title'] ?? '') ?>" >
    </div>

             <div class="col-md-6 form-group">
                <label>Can View</label>
                <select name="Can_View" class="form-select">
                    <option value="Yes" <?= old('Can_View', $right['Can_View'] ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                    <option value="No" <?= old('Can_View', $right['Can_View'] ?? '') === 'No' ? 'selected' : '' ?>>No</option>
                </select>
            </div>
            
            <div class="col-md-6 form-group">
                <label>Can Add</label>
                <select name="Can_Add" class="form-select">
                    <option value="Yes" <?= old('Can_Add', $right['Can_Add'] ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                    <option value="No" <?= old('Can_Add', $right['Can_Add'] ?? '') === 'No' ? 'selected' : '' ?>>No</option>
                </select>
            </div>

            <div class="col-md-6 form-group">
                <label>Can Edit</label>
                <select name="Can_Edit" class="form-select">
                    <option value="Yes" <?= old('Can_Edit', $right['Can_Edit'] ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                    <option value="No" <?= old('Can_Edit', $right['Can_Edit'] ?? '') === 'No' ? 'selected' : '' ?>>No</option>
                </select>
            </div>
            
            <div class="col-md-6 form-group">
                <label>Can Delete</label>
                <select name="Can_Delete" class="form-select">
                    <option value="Yes" <?= old('Can_Delete', $right['Can_Delete'] ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                    <option value="No" <?= old('Can_Delete', $right['Can_Delete'] ?? '') === 'No' ? 'selected' : '' ?>>No</option>
                </select>
            </div>

            <div class="col-md-6 form-group">
      <label>Rights Summary</label>
      <input type="text" name="Rights_Summary" class="form-control" value="<?= old('Rights_Summary', $right['Rights_Summary'] ?? '') ?>"  >
    </div>

    <div class="col-md-6 form-group">
      <label>Updated By</label>
      <input type="text" name="Rec_Updated_By" class="form-control" value="<?= old('Rec_Updated_By') ?>" placeholder="Enter Who Updated Record" >
    </div>

    <div class="col-md-6 form-group">
      <label>Last Updated On</label>
      <input type="date" name="Rec_Last_Updated_On" class="form-control" value="<?= old('Rec_Last_Updated_On') ?>">
    </div>
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
