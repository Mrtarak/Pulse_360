<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-10 mx-auto grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

          <?= view('includes/breadcrumb'); ?>


            <h4 class="card-title">Add New Event</h4>
            <form method="post" action="<?= site_url('events/save') ?>">

              <div class="form-group">
                <label>Event ID</label>
                <input type="text" name="Event_Id" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Event Type</label>
                <select name="EventType_Id" class="form-select" required>
                  <option value="">-- Select --</option>
                  <?php foreach ($types as $type): ?>
                    <option value="<?= $type['EventType_Id'] ?>"><?= $type['Event_TypeName'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Date</label>
                <input type="date" name="Event_Date" class="form-control" required>
              </div>

                            <div class="form-group">
                <label>Description</label>
                <textarea name="Event_Description" class="form-control" rows="3"></textarea>
              </div>


              <div class="form-group">
                <label>Start Time</label>
                <input type="time" name="Event_Start_At" class="form-control">
              </div>

              <div class="form-group">
                <label>End Time</label>
                <input type="time" name="Event_End_At" class="form-control">
              </div>

              <div class="form-group">
                <label>Place</label>
                <input type="text" name="Event_Place" class="form-control">
              </div>

              <div class="form-group">
                <label>Chief Guest</label>
                <input type="text" name="Event_ChiefGuest" class="form-control">
              </div>

              <div class="form-group">
                <label>Mode</label>
                <select name="Event_Mode" class="form-select">
                  <option value="Online">Online</option>
                  <option value="Offline">Offline</option>
                </select>
              </div>

              <div class="form-group">
                <label>Status</label>
                <select name="Event_Status" class="form-select">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>

                  <div class="col-md-6 form-group">
      <label>Recorded By</label>
      <input type="text" name="Rec_Added_By" class="form-control" value="<?= old('Rec_Added_By') ?>" placeholder="Enter Who Recorded Record" >
    </div>

    <div class="col-md-6 form-group">
      <label>Recorded On</label>
      <input type="date" name="Rec_Added_On" class="form-control" value="<?= old('Rec_Added_On') ?>">
    </div>

    <div class="col-md-6 form-group">
      <label>Updated By</label>
      <input type="text" name="Rec_Updated_By" class="form-control" value="<?= old('Rec_Updated_By') ?>" placeholder="Enter Who Updated Record" >
    </div>

    <div class="col-md-6 form-group">
      <label>Updated On</label>
      <input type="date" name="Rec_Updated_On" class="form-control" value="<?= old('Rec_Updated_On') ?>">
    </div>
  </div>
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?= site_url('events/list') ?>" class="btn btn-light">Cancel</a>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('includes/footer'); ?>

