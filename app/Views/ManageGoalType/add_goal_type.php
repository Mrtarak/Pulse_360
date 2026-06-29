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

              <h4 class="card-title">Add Goal Type</h4>

              <form class="forms-sample"
                method="post"
                action="<?= site_url('goals/types/save') ?>">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label>Goal Type Name <span class="text-danger">*</span></label>
                    <input type="text" name="Goal_Type_Name" class="form-control" required />
                  </div>

                  <div class="col-md-12 form-group">
                    <label>Description</label>
                    <textarea name="Goal_Type_Description" class="form-control" rows="3" placeholder="Brief description of the goal type"></textarea>
                  </div>
                </div>

                <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
                  <a href="<?= site_url('goals/types') ?>" class="btn btn-light">Cancel</a>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('includes/footer'); ?>