<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <?= view('includes/breadcrumb'); ?>

            <h4 class="card-title mb-4">
              <i class="mdi mdi-book-open-page-variant me-2"></i> Event Type Details
            </h4>

            <div class="row view-details">
              <div class="col-md-12 mb-2 d-flex">
                <div style="min-width: 200px;"><strong>Event Type Name</strong> :</div>
                <div class="ms-3"><?= esc($eventtype['Event_Type_Name']) ?></div>
              </div>

              <div class="col-md-12 mb-2 d-flex">
                <div style="min-width: 200px;"><strong>About</strong> :</div>
                <div class="ms-3"><?= esc($eventtype['Event_Type_About']) ?></div>
              </div>
            </div>

            <!-- Actions -->
            <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
              <a href="<?= base_url('eventtype/edit/' . $eventtype['EventType_Id']) ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="<?= base_url('eventtype/delete/' . $eventtype['EventType_Id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('includes/footer'); ?>

<script>
  function confirmDelete() {
    if (confirm("Are you sure you want to delete this eventtype?")) {
      // Placeholder for delete functionality
    }
  }
</script>
