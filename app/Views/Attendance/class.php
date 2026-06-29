<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NGO-Pulse 360 </title>
  <!-- DataTables CSS (for sorting arrows, search box, pagination, etc.) -->
  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">-->
  <link rel="stylesheet" href="C:\HTML\assets\css\style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <style>
    .attendance-option {
      display: none;
    }

    .attendance-label {
      width: 40px;
      height: 40px;
      border: 2px solid;
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-weight: 700;
      transition: all 0.2s ease;
    }

    .present-label {
      border-color: #28a745;
      color: #28a745;
    }

    .absent-label {
      border-color: #dc3545;
      color: #dc3545;
    }

    .attendance-option:checked+.present-label {
      background: #28a745;
      color: #fff;
    }

    .attendance-option:checked+.absent-label {
      background: #dc3545;
      color: #fff;
    }

    .dataTables_filter input {
      height: 35px;
      font-size: 14px;
      padding: 5px 10px;
      background-color: #ffffff;
      border: 1px solid #ced4da;
      border-radius: 4px;
      width: 250px;
    }

    .dataTables_length select {
      height: 38px;
      font-size: 14px;
      padding: 6px 12px;
      background-color: #ffffff;
      border: 1px solid #ced4da;
      border-radius: 4px;
      width: auto;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 3px 8px !important;
      font-size: 10px;
      margin: 2px;
      border-radius: 3px;
      background-color: #f0f0f0 !important;
      border: 1px solid #ddd !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background-color: #005eff !important;
      color: white !important;
      border-color: #005eff !important;
    }

    table.dataTable thead th {
      font-size: 14px;
      background-color: #f9f9f9;
      padding: 10px;
    }

    table.dataTable td {
      padding: 8px 12px;
    }

    .card {
      border-radius: 12px;
    }

    .card-header {
      font-weight: 600;
    }

    .form-control,
    .form-select {
      height: 45px;
    }

    .table td,
    .table th {
      vertical-align: middle;
    }

    .marked-date {
      background: #28a745 !important;
      color: #fff !important;
      border-radius: 50%;
    }
  </style>



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
                <form id="attendanceForm">
                  <input type="hidden" name="program_id" id="hidden_program_id">
                  <input type="hidden" name="center_id" id="hidden_center_id">
                  <input type="hidden" name="batch_id" id="hidden_batch_id">

                  <div class="card shadow-sm mb-4">

                    <div class="card-header bg-primary text-white">
                      <h5 class="mb-0">
                        Mark Attendance
                      </h5>
                    </div>

                    <div class="card-body">

                      <div class="row">

                        <div class="col-md-3 mb-3">

                          <label class="fw-bold">
                            Program
                          </label>

                          <select class="form-select" id="program_id">

                            <option value="">
                              Select Program
                            </option>

                            <?php foreach ($programs as $program): ?>

                              <option value="<?= $program['Program_Id']; ?>">
                                <?= $program['Program_Name']; ?>
                              </option>

                            <?php endforeach; ?>

                          </select>

                        </div>

                        <div class="col-md-3 mb-3">

                          <label class="fw-bold">
                            Center
                          </label>

                          <select class="form-select" id="center_id">

                            <option value="">
                              Select Center
                            </option>

                          </select>

                        </div>

                        <div class="col-md-3 mb-3">

                          <label class="fw-bold">
                            Batch
                          </label>

                          <select class="form-select" id="batch_id">

                            <option value="">
                              Select Batch
                            </option>

                          </select>

                        </div>

                        <div class="col-md-3 mb-3">

                          <label class="fw-bold">
                            Attendance Date
                          </label>

                          <input
                            type="text"
                            name="attendance_date"
                            id="attendance_date"
                            class="form-control"
                            value="<?= date('Y-m-d') ?>">
                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="card shadow-sm">

                    <div class="card-header bg-light">
                      <h5 class="mb-0">
                        Student Attendance
                      </h5>
                    </div>

                    <div class="card-body">

                      <div class="table-responsive">

                        <table class="table table-bordered table-hover">
                          <thead>

                            <tr>

                              <th>#</th>
                              <th>Student ID</th>
                              <th>Student Name</th>
                              <th>Present</th>
                              <th>Absent</th>
                              <th>Remarks</th>

                            </tr>

                          </thead>

                          <tbody id="studentTableBody">

                            <tr>

                              <td colspan="6" class="text-center">

                                Select Program → Center → Batch

                              </td>

                            </tr>

                          </tbody>

                        </table>

                      </div>

                      <div class="text-end mt-4">

                        <button
                          type="button"
                          id="saveAttendance"
                          class="btn btn-success">

                          Save Attendance

                        </button>

                      </div>

                    </div>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#attendanceTable').DataTable({
          lengthChange: true, // Show "Show X entries"
          pageLength: 5, // Default rows per page
          ordering: true, // Sortable columns
          searching: true, // Search box
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search programs..."
          }
        });
      });
    </script>

    <script>
      $(document).ready(function() {

        // PROGRAM -> CENTER
        $('#program_id').change(function() {

          let programId = $(this).val();

          console.log("Selected Program:", programId);

          $.ajax({
            url: "<?= base_url('attendance/get-centers'); ?>",
            type: "POST",
            data: {
              program_id: programId
            },
            dataType: "json",

            success: function(data) {

              console.log("Centers Response:", data);

              let html = '<option value="">Select Center</option>';

              if (data.centers) {
                $.each(data.centers, function(i, row) {

                  html +=
                    '<option value="' +
                    row.Center_Id +
                    '">' +
                    row.Center_Name +
                    '</option>';

                });
              }

              $('#center_id').html(html);
              $('#batch_id').html('<option value="">Select Batch</option>');
              $('#studentTableBody').html('');

            },

            error: function(xhr) {
              console.log("CENTER ERROR:");
              console.log(xhr.responseText);
            }
          });

        });


        // CENTER -> BATCH
        $('#center_id').change(function() {

          $.ajax({
            url: "<?= base_url('attendance/get-batches'); ?>",
            type: "POST",
            data: {
              program_id: $('#program_id').val(),
              center_id: $('#center_id').val()
            },
            dataType: "json",

            success: function(data) {

              console.log("Batch Response:", data);

              let html = '<option value="">Select Batch</option>';

              $.each(data, function(i, row) {

                html +=
                  '<option value="' +
                  row.Batch_Id +
                  '">' +
                  row.Batch_Name +
                  '</option>';

              });

              $('#batch_id').html(html);

            },

            error: function(xhr) {
              console.log("BATCH ERROR:");
              console.log(xhr.responseText);
            }
          });

        });


        // BATCH -> STUDENTS
        $('#batch_id').change(function() {

          // Load students
          $.ajax({
            url: "<?= base_url('attendance/get-students'); ?>",
            type: "POST",
            data: {
              program_id: $('#program_id').val(),
              batch_id: $('#batch_id').val(),
              attendance_date: $('#attendance_date').val()
            },
            success: function(response) {
              $('#studentTableBody').html(response);
            }
          });

          // Load attendance dates
          $.ajax({
            url: "<?= base_url('attendance/get-attendance-dates'); ?>",
            type: "POST",
            data: {
              batch_id: $('#batch_id').val()
            },
            dataType: "json",

            success: function(response) {

              console.log("Attendance Dates:", response);

              markedDates = [];

              response.forEach(function(item) {
                markedDates.push(item.Attendance_Date);
              });

              console.log("Marked Dates:", markedDates);

              attendanceCalendar.redraw();
            },

            error: function(xhr) {
              console.log(xhr.responseText);
            }
          });

        });

        $('#attendance_date').change(function() {

          if ($('#batch_id').val() == '') {
            return;
          }

          $.ajax({
            url: "<?= base_url('attendance/get-students'); ?>",
            type: "POST",
            data: {
              program_id: $('#program_id').val(),
              batch_id: $('#batch_id').val(),
              attendance_date: $('#attendance_date').val()
            },

            success: function(response) {

              $('#studentTableBody').html(response);

            },

            error: function(xhr) {

              console.log(xhr.responseText);

            }
          });

        });

      });
    </script>
    <script>
      $('#saveAttendance').click(function() {

        $('#hidden_program_id').val($('#program_id').val());
        $('#hidden_center_id').val($('#center_id').val());
        $('#hidden_batch_id').val($('#batch_id').val());

        $.ajax({

          url: "<?= base_url('attendance/save'); ?>",

          type: "POST",

          data: $('#attendanceForm').serialize(),

          dataType: "json",

          success: function(response) {

            alert(response.message);

          },

          error: function(xhr) {

            console.log(xhr.responseText);

            alert('Error Saving Attendance');

          }

        });

      });
    </script>
    <script>
      let markedDates = [];

      let attendanceCalendar = flatpickr("#attendance_date", {

        dateFormat: "Y-m-d",
        defaultDate: "today",
        maxDate: "today",

        onDayCreate: function(dObj, dStr, fp, dayElem) {

          let date = fp.formatDate(dayElem.dateObj, "Y-m-d");

          if (markedDates.includes(date)) {
            dayElem.classList.add("marked-date");
          }

        }

      });
    </script>

    <!--Custom js for this page-- >
      !--End custom js for this page-- >
      <?= view('includes/footer'); ?>