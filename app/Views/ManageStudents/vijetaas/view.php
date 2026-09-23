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

                <h4 class="card-title"><i class="mdi mdi-account-group menu-icon"></i> Vijetaas - Student Details</h4>
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
                      href="#family">
                      Family
                    </a>
                  </li>

                </ul>

                <div class="tab-content mt-3">

                  <!-- Personal Info -->
                  <div class="tab-pane fade show active"
                    id="personal">

                    <div class="row mb-4">

                      <!-- Student Photo -->
                      <div class="col-md-6">
                        <div class="card shadow-sm border-0">

                          <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0">
                              <i class="mdi mdi-account-circle"></i>
                              Student Photo
                            </h5>
                          </div>

                          <div class="card-body text-center">

                            <?php if (!empty($student['Photo_URL'])) : ?>

                              <a href="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                target="_blank">

                                <img src="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                  class="img-thumbnail shadow"
                                  style="width:250px;height:250px;object-fit:cover;border-radius:10px;"
                                  alt="Student Photo">

                              </a>

                            <?php else : ?>

                              <div class="text-muted py-5">
                                <i class="mdi mdi-image-off mdi-48px"></i>
                                <p class="mt-2 mb-0">No Student Photo Available</p>
                              </div>

                            <?php endif; ?>

                          </div>

                        </div>
                      </div>


                      <!-- Aadhaar Photo -->
                      <div class="col-md-6">
                        <div class="card shadow-sm border-0">

                          <div class="card-header bg-success text-white text-center">
                            <h5 class="mb-0">
                              <i class="mdi mdi-card-account-details"></i>
                              Aadhaar Photo
                            </h5>
                          </div>

                          <div class="card-body text-center">

                            <?php if (!empty($student['Aadhar_Photo_URL'])) : ?>

                              <a href="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                target="_blank">

                                <img src="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                  class="img-thumbnail shadow"
                                  style="width:250px;height:250px;object-fit:cover;border-radius:10px;"
                                  alt="Aadhaar Photo">

                              </a>

                            <?php else : ?>

                              <div class="text-muted py-5">
                                <i class="mdi mdi-image-off mdi-48px"></i>
                                <p class="mt-2 mb-0">No Aadhaar Photo Available</p>
                              </div>

                            <?php endif; ?>

                          </div>

                        </div>
                      </div>

                    </div>

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

                    <!-- Current Education -->
                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-school"></i>
                      Current Education
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width: 35%;">Education Level</th>
                        <td>
                          <?= esc($student['Current_Education_Level'] ?? '') ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Qualification / Class</th>
                        <td>
                          <?= esc($student['Current_Qualification'] ?? '') ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Education Status</th>
                        <td>
                          <?= esc($student['Current_Education_Status'] ?? '') ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Specialization / Subject</th>
                        <td>
                          <?= esc($student['Current_Specialization_Subject'] ?? '') ?>
                        </td>
                      </tr>

                    </table>


                    <!-- Highest Education -->
                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-school-outline"></i>
                      Highest Education Completed
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width: 35%;">Education Level</th>
                        <td>
                          <?= esc($student['Highest_Education_Level'] ?? '') ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Qualification / Class</th>
                        <td>
                          <?= esc($student['Highest_Qualification'] ?? '') ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Specialization / Subject</th>
                        <td>
                          <?= esc($student['Highest_Specialization_Subject'] ?? '') ?>
                        </td>
                      </tr>

                    </table>


                    <!-- Student Status -->
                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-account-check"></i>
                      Student Status
                    </h5>

                    <table class="table table-bordered">

                      <tr>
                        <th style="width: 35%;">Student Status</th>
                        <td>
                          <?= esc($student['Student_Status'] ?? '') ?>
                        </td>
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



                  <!-- Family -->
                  <div class="tab-pane fade"
                    id="family">

                    <table class="table table-bordered">

                      <tr>
                        <th>Guardian's Name</th>
                        <td>
                          <?= esc($student['Fathers_Name']) ?>
                        </td>
                      </tr>


                      <tr>
                        <th>Relation with Guardian</th>
                        <td>
                          <?= esc($student['Guardian_Relation'] ?? '') ?>
                        </td>
                      </tr>


                      <tr>
                        <th>Guardian's Contact</th>
                        <td>
                          <?= esc($student['Father_Contact_Number']) ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Guardian's Email</th>
                        <td>
                          <?= esc($student['Father_Email_ID']) ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Guardian's Occupation</th>
                        <td>
                          <?= esc($student['Father_Occupation']) ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Mother Name</th>
                        <td>
                          <?= esc($student['Mothers_Name']) ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Mother Contact</th>
                        <td>
                          <?= esc($student['Mother_Contact_Number']) ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Mother Email</th>
                        <td>
                          <?= esc($student['Mother_Email_ID']) ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Mother Occupation</th>
                        <td>
                          <?= esc($student['Mother_Occupation']) ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Family Income</th>
                        <td>
                          <?= esc($student['Family_Monthly_Income']) ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Siblings</th>
                        <td>
                          <?= esc($student['Sibling_Number']) ?>
                        </td>
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