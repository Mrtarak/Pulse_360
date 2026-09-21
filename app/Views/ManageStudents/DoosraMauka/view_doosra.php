<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<!-- Page Body -->
<div class="container-fluid page-body-wrapper">

  <?= view('includes/sidebar'); ?>

  <!-- Main Panel -->
  <div class="main-panel">

    <div class="content-wrapper">

      <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">

          <div class="card">

            <div class="card-body">

              <?= view('includes/breadcrumb'); ?>


              <!-- ===================================================== -->
              <!-- PAGE HEADER -->
              <!-- ===================================================== -->

              <h4 class="card-title mb-4">

                <i class="mdi mdi-account-convert-outline menu-icon"></i>

                Doosra Mauka Student Details

              </h4>


              <!-- ===================================================== -->
              <!-- TABS -->
              <!-- ===================================================== -->

              <ul
                class="nav nav-tabs"
                id="viewStudentTabs"
                role="tablist">


                <!-- PERSONAL -->

                <li class="nav-item">

                  <a
                    class="nav-link active"
                    data-bs-toggle="tab"
                    href="#vpersonal"
                    role="tab">

                    <i class="mdi mdi-account me-1"></i>

                    Personal Info

                  </a>

                </li>


                <!-- EDUCATION -->

                <li class="nav-item">

                  <a
                    class="nav-link"
                    data-bs-toggle="tab"
                    href="#veducation"
                    role="tab">

                    <i class="mdi mdi-school me-1"></i>

                    Education

                  </a>

                </li>


                <!-- PROGRAM -->

                <li class="nav-item">

                  <a
                    class="nav-link"
                    data-bs-toggle="tab"
                    href="#vprogram"
                    role="tab">

                    <i class="mdi mdi-book-open-page-variant me-1"></i>

                    Program

                  </a>

                </li>


                <!-- FAMILY -->

                <li class="nav-item">

                  <a
                    class="nav-link"
                    data-bs-toggle="tab"
                    href="#vfamily"
                    role="tab">

                    <i class="mdi mdi-account-group me-1"></i>

                    Family Details

                  </a>

                </li>

              </ul>


              <!-- ===================================================== -->
              <!-- TAB CONTENT -->
              <!-- ===================================================== -->

              <div class="tab-content mt-3">


                <!-- ===================================================== -->
                <!-- PERSONAL INFO -->
                <!-- ===================================================== -->

                <div
                  class="tab-pane fade show active"
                  id="vpersonal"
                  role="tabpanel">


                  <div class="row view-details">


                    <!-- ================================================= -->
                    <!-- PHOTOS -->
                    <!-- ================================================= -->

                    <div class="row mb-4 mt-3">


                      <!-- STUDENT PHOTO -->

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

                              <a
                                href="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                target="_blank">

                                <img
                                  src="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                  class="img-thumbnail shadow"
                                  style="width:250px;height:250px;object-fit:cover;border-radius:10px;"
                                  alt="Student Photo">

                              </a>

                            <?php else : ?>

                              <div class="text-muted py-5">

                                <i class="mdi mdi-image-off mdi-48px"></i>

                                <p class="mt-2 mb-0">
                                  No Student Photo Available
                                </p>

                              </div>

                            <?php endif; ?>


                          </div>

                        </div>

                      </div>


                      <!-- AADHAAR PHOTO -->

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

                              <a
                                href="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                target="_blank">

                                <img
                                  src="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                  class="img-thumbnail shadow"
                                  style="width:250px;height:250px;object-fit:cover;border-radius:10px;"
                                  alt="Aadhaar Photo">

                              </a>

                            <?php else : ?>

                              <div class="text-muted py-5">

                                <i class="mdi mdi-image-off mdi-48px"></i>

                                <p class="mt-2 mb-0">
                                  No Aadhaar Photo Available
                                </p>

                              </div>

                            <?php endif; ?>


                          </div>

                        </div>

                      </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- PERSONAL DETAILS -->
                    <!-- ================================================= -->


                    <!-- FULL NAME -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Full Name:
                      </strong>

                      <?= esc(
                        trim(
                          ($student['First_Name'] ?? '') .
                            ' ' .
                            ($student['Last_Name'] ?? '')
                        )
                      ) ?: '-' ?>

                    </div>


                    <!-- GENDER -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Gender:
                      </strong>

                      <?= esc($student['Gender'] ?? '-') ?>

                    </div>


                    <!-- DOB -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Date Of Birth:
                      </strong>

                      <?= esc($student['DOB'] ?? '-') ?>

                    </div>


                    <!-- AADHAR -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Aadhar No:
                      </strong>

                      <?= esc($student['Aadhar_No'] ?? '-') ?>

                    </div>


                    <!-- PHONE -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Phone:
                      </strong>

                      <?= esc($student['Phone_No'] ?? '-') ?>

                    </div>


                    <!-- EMAIL -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Email:
                      </strong>

                      <?= esc($student['Email_Id'] ?? '-') ?>

                    </div>


                    <!-- MARITAL STATUS -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Marital Status:
                      </strong>

                      <?= esc($student['Marital_Status'] ?? '-') ?>

                    </div>


                    <!-- CASTE -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Caste:
                      </strong>

                      <?= esc($student['Student_Caste'] ?? '-') ?>

                    </div>


                    <!-- VILLAGE / CITY -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Village / City:
                      </strong>

                      <?= esc($student['Village_City'] ?? '-') ?>

                    </div>


                    <!-- DISTRICT -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        District:
                      </strong>

                      <?= esc($student['District'] ?? '-') ?>

                    </div>


                    <!-- STATE -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        State:
                      </strong>

                      <?= esc($student['State'] ?? '-') ?>

                    </div>


                    <!-- PINCODE -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Pincode:
                      </strong>

                      <?= esc($student['Pincode'] ?? '-') ?>

                    </div>


                    <!-- NATIONALITY -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Nationality:
                      </strong>

                      <?= esc($student['Nationality'] ?? '-') ?>

                    </div>


                    <!-- ADDRESS -->

                    <div class="col-md-12 mb-3">

                      <strong>
                        Address:
                      </strong>

                      <?= esc($student['Address'] ?? '-') ?>

                    </div>


                    <!-- REMARKS -->

                    <div class="col-md-12 mb-3">

                      <strong>
                        Remarks:
                      </strong>

                      <?= esc($student['Remarks'] ?? '-') ?>

                    </div>


                  </div>

                </div>


                <!-- ===================================================== -->
                <!-- EDUCATION -->
                <!-- ===================================================== -->

                <div
                  class="tab-pane fade"
                  id="veducation"
                  role="tabpanel">


                  <div class="row view-details">


                    <!-- CURRENT EDUCATION -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Current Education Level:
                      </strong>

                      <?= esc(
                        $student['Current_Education_level'] ?? '-'
                      ) ?>

                    </div>


                    <!-- HIGHEST EDUCATION -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Highest Education Completed:
                      </strong>

                      <?= esc(
                        $student['Highest_Education_Completed'] ?? '-'
                      ) ?>

                    </div>


                    <!-- STUDENT STATUS -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Student Status:
                      </strong>

                      <?= esc(
                        $student['Student_Status'] ?? '-'
                      ) ?>

                    </div>


                  </div>

                </div>


                <!-- ===================================================== -->
                <!-- PROGRAM -->
                <!-- ===================================================== -->

                <div
                  class="tab-pane fade"
                  id="vprogram"
                  role="tabpanel">


                  <div class="row view-details">


                    <!-- ENROLLMENT DATE -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Enrollment Date:
                      </strong>

                      <?= esc(
                        $student['Enrollment_Date'] ?? '-'
                      ) ?>

                    </div>


                    <!-- PROGRAM -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Program:
                      </strong>

                      <?= esc(
                        $student['Program_Name'] ?? 'Doosra Mauka'
                      ) ?>

                    </div>


                    <!-- CENTER -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Center:
                      </strong>

                      <?= esc(
                        $student['Center_Name'] ?? '-'
                      ) ?>

                    </div>


                    <!-- BATCH -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Batch:
                      </strong>

                      <?= esc(
                        $student['Batch_Name'] ?? '-'
                      ) ?>

                    </div>


                    <!-- PROGRAM STATUS -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Program Status:
                      </strong>

                      <?= esc(
                        $student['DM_Status'] ?? '-'
                      ) ?>

                    </div>


                    <!-- COMPLETION DATE -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Completion Date:
                      </strong>

                      <?= esc(
                        $student['Completion_Date'] ?? '-'
                      ) ?>

                    </div>


                  </div>

                </div>


                <!-- ===================================================== -->
                <!-- FAMILY DETAILS -->
                <!-- ===================================================== -->

                <div
                  class="tab-pane fade"
                  id="vfamily"
                  role="tabpanel">


                  <div class="row view-details">


                    <!-- GUARDIAN NAME -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Guardian Name:
                      </strong>

                      <?= esc(
                        $student['Fathers_Name'] ?? '-'
                      ) ?>

                    </div>


                    <!-- GUARDIAN RELATION -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Guardian Relation:
                      </strong>

                      <?= esc(
                        $student['Guardian_Relation'] ?? '-'
                      ) ?>

                    </div>


                    <!-- GUARDIAN CONTACT -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Guardian Contact:
                      </strong>

                      <?= esc(
                        $student['Father_Contact_Number'] ?? '-'
                      ) ?>

                    </div>


                    <!-- GUARDIAN EMAIL -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Guardian Email:
                      </strong>

                      <?= esc(
                        $student['Father_Email_ID'] ?? '-'
                      ) ?>

                    </div>


                    <!-- GUARDIAN OCCUPATION -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Guardian Occupation:
                      </strong>

                      <?= esc(
                        $student['Father_Occupation'] ?? '-'
                      ) ?>

                    </div>


                    <!-- MOTHER NAME -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Mother's Name:
                      </strong>

                      <?= esc(
                        $student['Mothers_Name'] ?? '-'
                      ) ?>

                    </div>


                    <!-- MOTHER CONTACT -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Mother's Contact:
                      </strong>

                      <?= esc(
                        $student['Mother_Contact_Number'] ?? '-'
                      ) ?>

                    </div>


                    <!-- MOTHER EMAIL -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Mother's Email:
                      </strong>

                      <?= esc(
                        $student['Mother_Email_ID'] ?? '-'
                      ) ?>

                    </div>


                    <!-- MOTHER OCCUPATION -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Mother's Occupation:
                      </strong>

                      <?= esc(
                        $student['Mother_Occupation'] ?? '-'
                      ) ?>

                    </div>


                    <!-- FAMILY INCOME -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Family Monthly Income:
                      </strong>

                      <?= esc(
                        $student['Family_Monthly_Income'] ?? '-'
                      ) ?>

                    </div>


                    <!-- SIBLINGS -->

                    <div class="col-md-6 mb-3">

                      <strong>
                        Number Of Siblings:
                      </strong>

                      <?= esc(
                        $student['Sibling_Number'] ?? '-'
                      ) ?>

                    </div>


                  </div>

                </div>


                <!-- ===================================================== -->
                <!-- ACTION BUTTONS -->
                <!-- ===================================================== -->

                <div class="mt-4 text-center">


                  <!-- EDIT -->

                  <a
                    href="<?= base_url('ManageStudents/DoosraMauka/edit/' . $student['DM_Stu_Id']) ?>"
                    class="btn btn-warning btn-sm">

                    <i class="mdi mdi-pencil"></i>

                    Edit

                  </a>


                  <!-- DELETE -->

                  <a
                    href="<?= base_url('ManageStudents/DoosraMauka/delete/' . $student['DM_Stu_Id']) ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this student?')">

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