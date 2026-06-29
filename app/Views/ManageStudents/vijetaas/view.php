<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>


<div class="container-scroller">
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <?= view('includes/breadcrumb'); ?>

                <h4 class="card-title">Vijetaas - Student Details</h4>
                <ul class="nav nav-tabs">

                  <li class="nav-item">
                    <a class="nav-link active"
                      data-bs-toggle="tab"
                      href="#personal">
                      Personal Info
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#education">
                      Education
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#program">
                      Program
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#goal">
                      Goal
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#mentor">
                      Mentor
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#family">
                      Family
                    </a>
                  </li>

                </ul>

                <div class="tab-content mt-3">

                  <!-- Personal Info -->
                  <div class="tab-pane fade show active"
                    id="personal">

                    <table class="table table-bordered">

                      <tr>
                        <th>First Name</th>
                        <td><?= esc($student['First_Name']) ?></td>
                      </tr>

                      <tr>
                        <th>Last Name</th>
                        <td><?= esc($student['Last_Name']) ?></td>
                      </tr>

                      <tr>
                        <th>Gender</th>
                        <td><?= esc($student['Gender']) ?></td>
                      </tr>

                      <tr>
                        <th>DOB</th>
                        <td><?= esc($student['DOB']) ?></td>
                      </tr>

                      <tr>
                        <th>Aadhar</th>
                        <td><?= esc($student['Aadhar_No']) ?></td>
                      </tr>

                      <tr>
                        <th>Phone</th>
                        <td><?= esc($student['Phone_No']) ?></td>
                      </tr>

                      <tr>
                        <th>Email</th>
                        <td><?= esc($student['Email_Id']) ?></td>
                      </tr>

                      <tr>
                        <th>Village / City</th>
                        <td><?= esc($student['Village_City']) ?></td>
                      </tr>

                      <tr>
                        <th>District</th>
                        <td><?= esc($student['District']) ?></td>
                      </tr>

                      <tr>
                        <th>State</th>
                        <td><?= esc($student['State']) ?></td>
                      </tr>

                      <tr>
                        <th>Pincode</th>
                        <td><?= esc($student['Pincode']) ?></td>
                      </tr>

                      <tr>
                        <th>Nationality</th>
                        <td><?= esc($student['Nationality']) ?></td>
                      </tr>

                      <tr>
                        <th>Address</th>
                        <td><?= esc($student['Address']) ?></td>
                      </tr>

                    </table>

                  </div>

                  <!-- Education -->
                  <div class="tab-pane fade"
                    id="education">

                    <table class="table table-bordered">

                      <tr>
                        <th>Current Education</th>
                        <td><?= esc($student['Current_Education_level']) ?></td>
                      </tr>

                      <tr>
                        <th>Highest Education</th>
                        <td><?= esc($student['Highest_Education_Completed']) ?></td>
                      </tr>

                      <tr>
                        <th>Status</th>
                        <td><?= esc($student['Student_Status']) ?></td>
                      </tr>

                    </table>

                  </div>

                  <!-- Program -->
                  <div class="tab-pane fade"
                    id="program">

                    <table class="table table-bordered">

                      <tr>
                        <th>Program</th>
                        <td>Vijetaas</td>
                      </tr>

                      <tr>
                        <th>Enrollment Date</th>
                        <td><?= esc($student['Enrollment_Date']) ?></td>
                      </tr>

                      <tr>
                        <th>Completion Date</th>
                        <td><?= esc($student['Completion_Date']) ?></td>
                      </tr>

                      <tr>
                        <th>Vijeta Status</th>
                        <td><?= esc($student['Vijeta_Status']) ?></td>
                      </tr>

                    </table>

                  </div>

                  <!-- Goal-->
                  <div class="tab-pane fade"
                    id="goal">

                    <table class="table table-bordered">

                      <tr>
                        <th>Goal Title</th>
                        <td><?= esc($student['Goal_Title']) ?></td>
                      </tr>

                      <tr>
                        <th>Goal Description</th>
                        <td><?= esc($student['Goal_Description']) ?></td>
                      </tr>

                      <tr>
                        <th>Goal Status</th>
                        <td><?= esc($student['Goal_Status']) ?></td>
                      </tr>

                    </table>

                  </div>

                  <!-- Mentor -->
                  <div class="tab-pane fade"
                    id="mentor">

                    <table class="table table-bordered">

                      <tr>
                        <th>Mentor Name</th>

                        <td>
                          <?= esc(
                            $student['Mentor_FirstName']
                              . ' ' .
                              $student['Mentor_LastName']
                          ) ?>
                        </td>

                      </tr>

                    </table>

                  </div>

                  <!-- Family -->
                  <div class="tab-pane fade"
                    id="family">

                    <table class="table table-bordered">

                      <tr>
                        <th>Father Name</th>
                        <td><?= esc($student['Fathers_Name']) ?></td>
                      </tr>

                      <tr>
                        <th>Father Contact</th>
                        <td><?= esc($student['Father_Contact_Number']) ?></td>
                      </tr>

                      <tr>
                        <th>Father Email</th>
                        <td><?= esc($student['Father_Email_ID']) ?></td>
                      </tr>

                      <tr>
                        <th>Father Occupation</th>
                        <td><?= esc($student['Father_Occupation']) ?></td>
                      </tr>

                      <tr>
                        <th>Mother Name</th>
                        <td><?= esc($student['Mothers_Name']) ?></td>
                      </tr>

                      <tr>
                        <th>Mother Contact</th>
                        <td><?= esc($student['Mother_Contact_Number']) ?></td>
                      </tr>

                      <tr>
                        <th>Mother Email</th>
                        <td><?= esc($student['Mother_Email_ID']) ?></td>
                      </tr>

                      <tr>
                        <th>Mother Occupation</th>
                        <td><?= esc($student['Mother_Occupation']) ?></td>
                      </tr>

                      <tr>
                        <th>Family Income</th>
                        <td><?= esc($student['Family_Monthly_Income']) ?></td>
                      </tr>

                      <tr>
                        <th>Siblings</th>
                        <td><?= esc($student['Sibling_Number']) ?></td>
                      </tr>

                    </table>

                  </div>

                </div>

                <div class="mt-4 text-center">

                  <a href="<?= site_url(
                              'students/vijetaas/edit/' .
                                $student['Vijetaas_Stu_Id']
                            ) ?>"
                    class="btn btn-warning btn-sm">
                    <i class="mdi mdi-pencil"></i>

                    Edit

                  </a>

                  <a href="<?= site_url(
                              'students/vijetaas/delete/' .
                                $student['Vijetaas_Stu_Id']
                            ) ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure?')">
                    <i class="mdi mdi-delete"></i>

                    Delete

                  </a>



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