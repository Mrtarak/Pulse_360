<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

      <!-- partial -->
<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>
    <!-- Main Panel Start -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                   <?= view('includes/breadcrumb'); ?>
                  <!-- Page Header -->
                  <h4 class="card-title mb-4">
                    <i class="mdi mdi-book-open-page-variant me-2"></i> Digital Shakti Student Details
                  </h4>

                  <!-- Tabs -->
                   <ul class="nav nav-tabs" id="viewStudentTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#vpersonal">
                            Personal Info
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#veducation">
                            Education
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#vprogram">
                            Program
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#vfamily">
                            Family
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-3">

                    <!-- Personal Info -->
                    <div class="tab-pane fade show active" id="vpersonal">
                        <div class="row view-details">

                            <div class="col-md-6 mb-2">
                                <strong>Full Name:</strong>
                                <?= esc($student['First_Name'].' '.$student['Last_Name']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Gender:</strong>
                                <?= esc($student['Gender']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Date of Birth:</strong>
                                <?= esc($student['DOB']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Phone:</strong>
                                <?= esc($student['Phone_No']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Email:</strong>
                                <?= esc($student['Email_Id']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Aadhar No:</strong>
                                <?= esc($student['Aadhar_No']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Village/City:</strong>
                                <?= esc($student['Village_City']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>District:</strong>
                                <?= esc($student['District']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>State:</strong>
                                <?= esc($student['State']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Pincode:</strong>
                                <?= esc($student['Pincode']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Nationality:</strong>
                                <?= esc($student['Nationality']) ?>
                            </div>

                            <div class="col-md-12 mb-2">
                                <strong>Address:</strong>
                                <?= esc($student['Address']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Photo:</strong><br>

                                <?php if(!empty($student['Photo_URL'])) : ?>
                                    <img src="<?= base_url($student['Photo_URL']) ?>" height="80">
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Aadhar Photo:</strong><br>

                                <?php if(!empty($student['Aadhar_Photo_URL'])) : ?>
                                    <img src="<?= base_url($student['Aadhar_Photo_URL']) ?>" height="80">
                                <?php endif; ?>
                            </div>

                            <div class="col-md-12 mb-2">
                                <strong>Remarks:</strong>
                                <?= esc($student['Remarks']) ?>
                            </div>

                        </div>
                    </div>

                    <!-- Education -->
                    <div class="tab-pane fade" id="veducation">
                        <div class="row view-details">

                            <div class="col-md-6 mb-2">
                                <strong>Current Education Level:</strong>
                                <?= esc($student['Current_Education_level']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Highest Education Completed:</strong>
                                <?= esc($student['Highest_Education_Completed']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Caste:</strong>
                                <?= esc($student['Student_Caste']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Status:</strong>
                                <?= esc($student['Student_Status']) ?>
                            </div>

                        </div>
                    </div>

                    <!-- Program -->
                    <div class="tab-pane fade" id="vprogram">
                        <div class="row view-details">

                            <div class="col-md-6 mb-2">
                                <strong>Enrollment Date:</strong>
                                <?= esc($student['Enrollment_Date']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Program:</strong>
                                <?= esc($student['Program_Name']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Center:</strong>
                                <?= esc($student['Center_Name']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Batch:</strong>
                                <?= esc($student['Batch_Name']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Skill Level:</strong>
                                <?= esc($student['Skill_level']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Program Status:</strong>
                                <?= esc($student['DS_Status']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Completion Date:</strong>
                                <?= esc($student['Completion_Date']) ?>
                            </div>

                        </div>
                    </div>

                    <!-- Family -->
                    <div class="tab-pane fade" id="vfamily">
                        <div class="row view-details">

                            <div class="col-md-6 mb-2">
                                <strong>Father's Name:</strong>
                                <?= esc($student['Fathers_Name']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Father Contact:</strong>
                                <?= esc($student['Father_Contact_Number']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Father Email:</strong>
                                <?= esc($student['Father_Email_ID']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Father Occupation:</strong>
                                <?= esc($student['Father_Occupation']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Mother's Name:</strong>
                                <?= esc($student['Mothers_Name']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Mother Contact:</strong>
                                <?= esc($student['Mother_Contact_Number']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Mother Email:</strong>
                                <?= esc($student['Mother_Email_ID']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Mother Occupation:</strong>
                                <?= esc($student['Mother_Occupation']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Family Monthly Income:</strong>
                                ₹<?= esc($student['Family_Monthly_Income']) ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Number of Siblings:</strong>
                                <?= esc($student['Sibling_Number']) ?>
                            </div>

                        </div>
                    </div>

                </div>

            <!-- Actions -->
            <div class="mt-4 text-center">
              <a href="<?= base_url('digitalshakti/edit/'.$student['DS_Stu_Id']) ?>"
                class="btn btn-warning btn-sm">
                <i class="mdi mdi-pencil"></i> Edit
              </a>
              <a href="<?= base_url('digitalshakti/delete/'.$student['DS_Stu_Id']) ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure?')">
                <i class="mdi mdi-delete"></i> Delete
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
   <?= view('includes/footer'); ?>     