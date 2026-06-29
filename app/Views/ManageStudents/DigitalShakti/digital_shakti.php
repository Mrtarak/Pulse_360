<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>


<div class="container-scroller">
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <?= view('includes/sidebar'); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <?= view('includes/breadcrumb'); ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Digital Shakti Participants</h4>
                    <?= view('includes/messages'); ?>
                    <a href="<?= site_url('digitalshakti/add') ?>" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus-circle-outline me-1"></i> Add New Student
                    </a>
                    </div>
                    <p class="card-description"> Manage Digital Shakti Students </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Mail Id</th>
                           <th>Status</th>
                           <th>Actions</th>
                          </tr>
                        </thead>
                       <tbody>

                        <?php if (!empty($students)): ?>

                            <?php foreach ($students as $stu): ?>

                                <tr>

                                    <td>
                                        <?= esc($stu['First_Name'] . ' ' . $stu['Last_Name']) ?>
                                    </td>

                                    <td>
                                        <?= esc($stu['Gender']) ?>
                                    </td>

                                    <td>
                                        <?= esc($stu['DOB']) ?>
                                    </td>

                                    <td>
                                        <?= esc($stu['Email_Id']) ?>
                                    </td>

                                    <td>

                                        <?php if ($stu['DS_Status'] == 'Active'): ?>

                                            <label class="badge badge-success">
                                                Active
                                            </label>

                                        <?php else: ?>

                                            <label class="badge badge-danger">
                                                Inactive
                                            </label>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <a href="<?= site_url('digitalshakti/view/' . $stu['DS_Stu_Id']) ?>"
                                          class="btn btn-info btn-sm">
                                            <i class="mdi mdi-eye"></i>
                                        </a>

                                        <a href="<?= site_url('digitalshakti/edit/' . $stu['DS_Stu_Id']) ?>"
                                          class="btn btn-warning btn-sm">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="6" class="text-center">
                                    No students found
                                </td>
                            </tr>

                        <?php endif; ?>

                        </tbody>

                      </table>
                    </div>
                  </div>
                </div>
              </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <?= view('includes/footer'); ?>