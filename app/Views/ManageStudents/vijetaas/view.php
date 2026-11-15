<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<?php
$student = $student ?? [];

$photoPath = !empty($student['Photo_URL'])
  ? base_url('uploads/students/photos/' . $student['Photo_URL'])
  : null;

$aadharPath = !empty($student['Aadhar_Photo_URL'])
  ? base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL'])
  : null;

$declarationPath = !empty($student['Declaration_Certificate_URL'])
  ? base_url('uploads/students/declaration/' . $student['Declaration_Certificate_URL'])
  : null;

$showValue = static function ($value) {
  return !empty($value) ? esc($value) : '<span class="text-muted">Not provided</span>';
};
?>

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

                <h4 class="card-title">
                  <i class="mdi mdi-account-group menu-icon"></i>
                  Vijetaas - Student Details
                </h4>

                <!-- Tabs -->
                <ul class="nav nav-tabs">

                  <li class="nav-item">
                    <a class="nav-link active"
                      data-bs-toggle="tab"
                      href="#personal">
                      Personal Information
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#family">
                      Family Information
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
                      Program Information
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#mentors">
                      Mentor Selection
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#declaration">
                      Declaration & Documents
                    </a>
                  </li>

                </ul>

                <div class="tab-content mt-3">

                  <!-- ===================================== -->
                  <!-- PERSONAL INFORMATION -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade show active" id="personal">

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

                            <?php if ($photoPath): ?>

                              <a href="<?= esc($photoPath) ?>" target="_blank">
                                <img src="<?= esc($photoPath) ?>"
                                  class="img-thumbnail shadow"
                                  style="width:250px;height:250px;object-fit:cover;border-radius:10px;"
                                  alt="Student Photo">
                              </a>

                            <?php else: ?>

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
                              Aadhaar Document
                            </h5>
                          </div>

                          <div class="card-body text-center">

                            <?php if ($aadharPath): ?>

                              <a href="<?= esc($aadharPath) ?>" target="_blank">
                                <img src="<?= esc($aadharPath) ?>"
                                  class="img-thumbnail shadow"
                                  style="width:250px;height:250px;object-fit:cover;border-radius:10px;"
                                  alt="Aadhaar Document">
                              </a>

                            <?php else: ?>

                              <div class="text-muted py-5">
                                <i class="mdi mdi-image-off mdi-48px"></i>
                                <p class="mt-2 mb-0">No Aadhaar Document Available</p>
                              </div>

                            <?php endif; ?>

                          </div>
                        </div>
                      </div>

                    </div>

                    <!-- Basic Information -->
                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-account"></i>
                      Basic Information
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width:35%;">First Name</th>
                        <td><?= $showValue($student['First_Name'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Last Name</th>
                        <td><?= $showValue($student['Last_Name'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Gender</th>
                        <td><?= $showValue($student['Gender'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Date of Birth</th>
                        <td><?= $showValue($student['DOB'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Caste</th>
                        <td><?= $showValue($student['Student_Caste'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Aadhaar Number</th>
                        <td><?= $showValue($student['Aadhar_No'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Phone Number</th>
                        <td><?= $showValue($student['Phone_No'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Email ID</th>
                        <td><?= $showValue($student['Email_Id'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Nationality</th>
                        <td><?= $showValue($student['Nationality'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Student Status</th>
                        <td><?= $showValue($student['Student_Status'] ?? '') ?></td>
                      </tr>

                    </table>

                    <!-- Current Address -->
                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-home-map-marker"></i>
                      Current Address
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width:35%;">Address</th>
                        <td><?= $showValue($student['Address'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Village / City</th>
                        <td><?= $showValue($student['Village_City'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>District</th>
                        <td><?= $showValue($student['District'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>State</th>
                        <td><?= $showValue($student['State'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Pincode</th>
                        <td><?= $showValue($student['Pincode'] ?? '') ?></td>
                      </tr>

                    </table>

                    <!-- Permanent Address -->
                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-map-marker-check"></i>
                      Permanent Address
                    </h5>

                    <table class="table table-bordered">

                      <tr>
                        <th style="width:35%;">Address</th>
                        <td><?= $showValue($student['Permanent_Address'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Village / City</th>
                        <td><?= $showValue($student['Permanent_Village_City'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>District</th>
                        <td><?= $showValue($student['Permanent_District'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>State</th>
                        <td><?= $showValue($student['Permanent_State'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Pincode</th>
                        <td><?= $showValue($student['Permanent_Pincode'] ?? '') ?></td>
                      </tr>

                    </table>

                  </div>


                  <!-- ===================================== -->
                  <!-- FAMILY INFORMATION -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade" id="family">

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-account-supervisor"></i>
                      Guardian Information
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width:35%;">Guardian Name</th>
                        <td><?= $showValue($student['Fathers_Name'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Relation with Guardian</th>
                        <td><?= $showValue($student['Guardian_Relation'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Guardian Contact</th>
                        <td><?= $showValue($student['Father_Contact_Number'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Guardian Email</th>
                        <td><?= $showValue($student['Father_Email_ID'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Guardian Occupation</th>
                        <td><?= $showValue($student['Father_Occupation'] ?? '') ?></td>
                      </tr>

                    </table>

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-account-heart"></i>
                      Mother Information
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width:35%;">Mother's Name</th>
                        <td><?= $showValue($student['Mothers_Name'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Mother's Contact</th>
                        <td><?= $showValue($student['Mother_Contact_Number'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Mother's Email</th>
                        <td><?= $showValue($student['Mother_Email_ID'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Mother's Occupation</th>
                        <td><?= $showValue($student['Mother_Occupation'] ?? '') ?></td>
                      </tr>

                    </table>

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-home-group"></i>
                      Family Details
                    </h5>

                    <table class="table table-bordered">

                      <tr>
                        <th style="width:35%;">Family Monthly Income</th>
                        <td><?= $showValue($student['Family_Monthly_Income'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Number of Siblings</th>
                        <td><?= $showValue($student['Sibling_Number'] ?? '') ?></td>
                      </tr>

                    </table>

                  </div>


                  <!-- ===================================== -->
                  <!-- EDUCATION -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade" id="education">

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-school"></i>
                      Current Education
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width:35%;">Education Level</th>
                        <td><?= $showValue($student['Current_Education_Level'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Qualification / Class</th>
                        <td><?= $showValue($student['Current_Qualification'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>College / Institution Name</th>
                        <td><?= $showValue($student['College_Institution_Name'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>University Name</th>
                        <td><?= $showValue($student['University_Name'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Specialization / Subject</th>
                        <td><?= $showValue($student['Current_Specialization_Subject'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Education Status</th>
                        <td><?= $showValue($student['Current_Education_Status'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Course Type</th>
                        <td><?= $showValue($student['Course_Type'] ?? '') ?></td>
                      </tr>

                      <?php if (($student['Course_Type'] ?? '') === 'Semester'): ?>
                        <tr>
                          <th>Number of Semesters</th>
                          <td><?= $showValue($student['Number_of_Semesters'] ?? '') ?></td>
                        </tr>
                      <?php elseif (($student['Course_Type'] ?? '') === 'Year'): ?>
                        <tr>
                          <th>Number of Years</th>
                          <td><?= $showValue($student['Number_of_Years'] ?? '') ?></td>
                        </tr>
                      <?php endif; ?>

                      <tr>
                        <th>Expected Course Completion Date</th>
                        <td><?= $showValue($student['Expected_Course_Completion_Date'] ?? '') ?></td>
                      </tr>

                    </table>

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-school-outline"></i>
                      Highest Education Completed
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width:35%;">Education Level</th>
                        <td><?= $showValue($student['Highest_Education_Level'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Qualification / Class</th>
                        <td><?= $showValue($student['Highest_Qualification'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Specialization / Subject</th>
                        <td><?= $showValue($student['Highest_Specialization_Subject'] ?? '') ?></td>
                      </tr>

                    </table>

                  </div>


                  <!-- ===================================== -->
                  <!-- PROGRAM INFORMATION -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade" id="program">

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-book-open-variant"></i>
                      Vijetaas Program Details
                    </h5>

                    <table class="table table-bordered">

                      <tr>
                        <th style="width:35%;">Program</th>
                        <td>Vijetaas</td>
                      </tr>

                      <tr>
                        <th>Enrollment Date</th>
                        <td><?= $showValue($student['Enrollment_Date'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Completion Date</th>
                        <td><?= $showValue($student['Completion_Date'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Program Status</th>
                        <td><?= $showValue($student['Vijeta_Status'] ?? '') ?></td>
                      </tr>

                    </table>

                  </div>


                  <!-- ===================================== -->
                  <!-- MENTOR SELECTION -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade" id="mentors">

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-account-tie"></i>
                      Assigned Mentors
                    </h5>

                    <?php if (!empty($assignedMentors) && is_array($assignedMentors)): ?>

                      <table class="table table-bordered">

                        <thead>
                          <tr>
                            <th style="width:10%;">Sl. No.</th>
                            <th>Mentor Name</th>
                          </tr>
                        </thead>

                        <tbody>

                          <?php foreach ($assignedMentors as $index => $mentor): ?>

                            <tr>
                              <td><?= $index + 1 ?></td>
                              <td>
                                <?= esc(trim(
                                  ($mentor['User_FirstName'] ?? '') . ' ' .
                                    ($mentor['User_LastName'] ?? '')
                                )) ?>
                              </td>
                            </tr>

                          <?php endforeach; ?>

                        </tbody>

                      </table>

                    <?php else: ?>

                      <div class="text-center text-muted py-5">
                        <i class="mdi mdi-account-off mdi-48px"></i>
                        <p class="mt-2 mb-0">No Mentor Assigned</p>
                      </div>

                    <?php endif; ?>

                  </div>


                  <!-- ===================================== -->
                  <!-- DECLARATION & DOCUMENTS -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade" id="declaration">

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-file-document-check"></i>
                      Referral Information
                    </h5>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width:35%;">Referral Source</th>
                        <td><?= $showValue($student['Referral_Source'] ?? '') ?></td>
                      </tr>

                      <tr>
                        <th>Referring Person / Organisation</th>
                        <td><?= $showValue($student['Referral_Person_Organisation'] ?? '') ?></td>
                      </tr>

                    </table>

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-clipboard-check"></i>
                      Declaration
                    </h5>

                    <div class="border rounded p-3 mb-3">

                      <p class="mb-0">
                        I confirm that the information provided is accurate to the best
                        of my knowledge. I understand that submitting this form does
                        not guarantee selection or financial assistance.
                      </p>

                    </div>

                    <table class="table table-bordered mb-4">

                      <tr>
                        <th style="width:35%;">Declaration Accepted</th>
                        <td>
                          <?php if (($student['Declaration_Accepted'] ?? 0) == 1): ?>
                            <span class="badge badge-success">Accepted</span>
                          <?php else: ?>
                            <span class="badge badge-danger">Not Accepted</span>
                          <?php endif; ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Accepted On</th>
                        <td><?= $showValue($student['Declaration_Accepted_On'] ?? '') ?></td>
                      </tr>

                    </table>

                    <h5 class="text-primary mb-3">
                      <i class="mdi mdi-file-pdf-box"></i>
                      Declaration Certificate
                    </h5>

                    <?php if ($declarationPath): ?>

                      <div class="border rounded p-3">

                        <i class="mdi mdi-file-document mdi-24px text-primary"></i>

                        Declaration Certificate

                        <a href="<?= esc($declarationPath) ?>"
                          target="_blank"
                          class="btn btn-outline-primary btn-sm ms-2">

                          <i class="mdi mdi-eye"></i>
                          View Document

                        </a>

                      </div>

                    <?php else: ?>

                      <div class="text-muted py-4">
                        <i class="mdi mdi-file-hidden mdi-36px"></i>
                        <p class="mt-2 mb-0">No Declaration Certificate Uploaded</p>
                      </div>

                    <?php endif; ?>

                  </div>

                </div>


                <!-- ACTION BUTTONS -->
                <div class="mt-4 text-center">

                  <a href="<?= site_url(
                              'students/vijetaas/edit/' . $student['Vijetaas_Stu_Id']
                            ) ?>"
                    class="btn btn-warning btn-sm">

                    <i class="mdi mdi-pencil"></i>
                    Edit

                  </a>

                  <a href="<?= site_url(
                              'students/vijetaas/delete/' . $student['Vijetaas_Stu_Id']
                            ) ?>"
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