<?= view('includes/header'); ?>

<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

  <?= view('includes/sidebar'); ?>

  <div class="main-panel">

    <div class="content-wrapper">

      <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">

          <div class="card-body">

            <?= view(
              'includes/breadcrumb',
              [
                'main' => 'Dashboard',
                'sub'  => 'Doosra Mauka Students',
                'sub_url' => base_url('ManageStudents/DoosraMauka')
              ]
            ); ?>

            <div class="d-flex justify-content-between align-items-center mb-3">

              <h4 class="card-title mb-0">

                <i class="mdi mdi-account-convert-outline me-2"></i>

                Doosra Mauka Students

              </h4>

              <?= view('includes/messages'); ?>

              <a href="<?= base_url('ManageStudents/DoosraMauka/add') ?>"
                class="btn btn-primary btn-sm">

                <i class="mdi mdi-plus-circle-outline me-1"></i>

                Add New Student

              </a>

            </div>


            <p class="card-description">

              Manage Doosra Mauka Students

            </p>


            <div class="table-responsive">

              <table
                id="studentTable"
                class="table table-striped">

                <thead>

                  <tr>

                    <th>#</th>

                    <th>Student ID</th>

                    <th>Name</th>

                    <th>Gender</th>

                    <th>Phone</th>

                    <th>Email</th>

                    <th>Center</th>

                    <th>Batch</th>

                    <th>Marital Status</th>

                    <th>Status</th>

                    <th width="160">Actions</th>

                  </tr>

                </thead>


                <tbody>

                  <?php if (!empty($students)): ?>

                    <?php $i = 1; ?>

                    <?php foreach ($students as $student): ?>

                      <tr>

                        <!-- # -->
                        <td>
                          <?= $i++ ?>
                        </td>


                        <!-- Student ID -->
                        <td>

                          <?= esc(
                            $student['DM_Stu_Id'] ?? ''
                          ) ?>

                        </td>


                        <!-- Name -->
                        <td>

                          <?= esc(
                            trim(
                              ($student['First_Name'] ?? '') .
                                ' ' .
                                ($student['Last_Name'] ?? '')
                            )
                          ) ?>

                        </td>


                        <!-- Gender -->
                        <td>

                          <?= esc(
                            $student['Gender'] ?? ''
                          ) ?>

                        </td>


                        <!-- Phone -->
                        <td>

                          <?= esc(
                            $student['Phone_No'] ?? ''
                          ) ?>

                        </td>


                        <!-- Email -->
                        <td>

                          <?= esc(
                            $student['Email_Id'] ?? ''
                          ) ?>

                        </td>


                        <!-- Center -->
                        <td>

                          <?= esc(
                            $student['Center_Name'] ?? ''
                          ) ?>

                        </td>


                        <!-- Batch -->
                        <td>

                          <?= esc(
                            $student['Batch_Name'] ?? ''
                          ) ?>

                        </td>


                        <!-- Marital Status -->
                        <td>

                          <?= esc(
                            $student['Marital_Status'] ?? ''
                          ) ?>

                        </td>


                        <!-- Status -->
                        <td>

                          <?php if (
                            ($student['DM_Status'] ?? '') == 'Active'
                          ): ?>

                            <span class="badge badge-success">
                              Active
                            </span>

                          <?php elseif (
                            ($student['DM_Status'] ?? '') == 'Completed'
                          ): ?>

                            <span class="badge badge-info">
                              Completed
                            </span>

                          <?php else: ?>

                            <span class="badge badge-danger">
                              Inactive
                            </span>

                          <?php endif; ?>

                        </td>


                        <!-- Actions -->
                        <td>

                          <a href="<?= base_url(
                                      'ManageStudents/DoosraMauka/view/' .
                                        $student['DM_Stu_Id']
                                    ) ?>"
                            class="btn btn-info btn-sm"
                            title="View">

                            <i class="mdi mdi-eye"></i>

                          </a>


                          <a href="<?= base_url(
                                      'ManageStudents/DoosraMauka/edit/' .
                                        $student['DM_Stu_Id']
                                    ) ?>"
                            class="btn btn-warning btn-sm"
                            title="Edit">

                            <i class="mdi mdi-pencil"></i>

                          </a>

                        </td>

                      </tr>

                    <?php endforeach; ?>


                  <?php else: ?>

                    <tr>

                      <td
                        colspan="11"
                        class="text-center">

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


<?= view('includes/footer'); ?>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
  $(document).ready(function() {

    $('#studentTable').DataTable({

      paging: true,

      searching: true,

      ordering: true,

      info: true,

      language: {

        search: "_INPUT_",

        searchPlaceholder: "Search student..."

      }

    });

  });
</script>