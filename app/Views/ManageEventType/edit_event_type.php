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

                    <h4 class="card-title"> EventTypes</h4>
                    <p class="card-description">Add New EventType </p>
<?php if (isset($eventtype)) : ?>
   <form class="forms-sample" action="<?= base_url('eventtype/update/' . $eventtype['EventType_Id']) ?>" method="post">
<?php endif; ?>
  <div class="row">
                         <div class="col-md-6 form-group">
                      <label>EventType Name <span class="text-danger">*</span></label>
                      <input type="text" name="Event_Type_Name" class="form-control" required />
                    </div>

                    <div class="col-md-12 form-group">
                      <label>About <span class="text-danger">*</span></label>
                      <textarea name="Event_Type_About" class="form-control" rows="3" placeholder="Brief about eventtype"></textarea>
                    </div>
  <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
    <a href="<?= site_url('eventtype') ?>" class="btn btn-light">Cancel</a>
    <button type="submit" class="btn btn-primary me-2">Save</button>
  </div>
</form>

      </div>
    </div>
  </div>
</div>

<?= view('includes/footer'); ?>
