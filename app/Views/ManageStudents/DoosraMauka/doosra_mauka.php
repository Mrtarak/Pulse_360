<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
      <div class="content-wrapper">

        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">
              <div class="card-body">

                <?= view('includes/breadcrumb'); ?>

                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="card-title mb-0">
                    Doosra Mauka Participants
                  </h4>

                  <a href="<?= base_url('ManageStudents/DoosraMauka/add'); ?>"
                    class="btn btn-primary btn-sm">

                    <i class="mdi mdi-plus-circle-outline me-1"></i>
                    Add New Student
                  </a>
                </div>

                <p class="card-description">
                  Manage Doosra Mauka Students
                </p>

                <?php if (session()->getFlashdata('success')) : ?>
                  <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                  </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                  <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                  </div>
                <?php endif; ?>

                <div class="table-responsive">

                  <table class="table table-bordered table-hover">

                    <thead class="table-light">
                      <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Center</th>
                        <th>Batch</th>
                        <th>Marital Status</th>
                        <th>Status</th>
                        <th width="170">Actions</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php if (!empty($students)) : ?>

                        <?php $i = 1; ?>

                        <?php foreach ($students as $stu) : ?>
                          <tr>

                            <td><?= $i++; ?></td>

                            <td>
                              <?= esc($stu['First_Name'] . ' ' . $stu['Last_Name']); ?>
                            </td>

                            <td>
                              <?= esc($stu['Gender']); ?>
                            </td>

                            <td>
                              <?= esc($stu['Email_Id']); ?>
                            </td>

                            <td>
                              <?= esc($stu['Phone_No']); ?>
                            </td>

                            <td>
                              <?= esc($stu['Center_Name'] ?? 'N/A'); ?>
                            </td>

                            <td>
                              <?= esc($stu['Batch_Name'] ?? 'N/A'); ?>
                            </td>

                            <td>
                              <?= esc($stu['Marital_Status'] ?? 'N/A'); ?>
                            </td>

                            <td>

                              <?php if (($stu['DM_Status'] ?? '') == 'Active') : ?>

                                <span class="badge badge-success">
                                  Active
                                </span>

                              <?php elseif (($stu['DM_Status'] ?? '') == 'Completed') : ?>

                                <span class="badge badge-info">
                                  Completed
                                </span>

                              <?php else : ?>

                                <span class="badge badge-danger">
                                  Inactive
                                </span>

                              <?php endif; ?>

                            </td>

                            <td>

                              <a href="<?= base_url('ManageStudents/DoosraMauka/view/' . $stu['DM_Stu_Id']); ?>"
                                class="btn btn-info btn-sm"
                                title="View">

                                <i class="mdi mdi-eye"></i>
                              </a>

                              <a href="<?= base_url('ManageStudents/DoosraMauka/edit/' . $stu['DM_Stu_Id']); ?>"
                                class="btn btn-warning btn-sm"
                                title="Edit">

                                <i class="mdi mdi-pencil"></i>
                              </a>

                            

                            </td>

                          </tr>

                        <?php endforeach; ?>

                      <?php else : ?>

                        <tr>
                          <td colspan="10" class="text-center">
                            No Doosra Mauka Students Found
                          </td>
                        </tr>

                      <?php endif; ?>
                    </tbody>

                  </table>

                </div>

              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<?= view('includes/footer'); ?>