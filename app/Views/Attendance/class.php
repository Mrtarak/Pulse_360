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
                <?= view('includes/breadcrumb'); ?>
                <form id="attendanceForm">
                  <input
                    type="hidden"
                    name="program_id"
                    id="hidden_program_id"
                    value="<?= esc($program_id); ?>">
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

                          <input
                            type="text"
                            class="form-control"
                            value="<?= esc($program['Program_Name']); ?>"
                            readonly>

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

                      <div class="row">

                        <div class="col-md-12 text-end">

                          <button
                            type="button"
                            id="fetchStudents"
                            class="btn btn-primary">

                            <i class="mdi mdi-account-search me-1"></i>
                            Fetch Students

                          </button>

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

        /*
        |--------------------------------------------------------------------------
        | FIXED PROGRAM
        |--------------------------------------------------------------------------
        */

        const programId = $('#hidden_program_id').val();


        /*
        |--------------------------------------------------------------------------
        | LOAD CENTERS AUTOMATICALLY
        |--------------------------------------------------------------------------
        */

        if (programId) {

          loadCenters(programId);

        }


        /*
        |--------------------------------------------------------------------------
        | LOAD CENTERS
        |--------------------------------------------------------------------------
        */

        function loadCenters(programId) {

          $.ajax({

            url: "<?= base_url('attendance/get-centers'); ?>",

            type: "POST",

            data: {
              program_id: programId
            },

            dataType: "json",

            success: function(data) {

              console.log("Centers Response:", data);


              let html =
                '<option value="">Select Center</option>';


              if (
                data.status &&
                data.centers
              ) {

                $.each(
                  data.centers,
                  function(i, row) {

                    html +=
                      '<option value="' +
                      row.Center_Id +
                      '">' +
                      row.Center_Name +
                      '</option>';

                  }
                );

              }


              $('#center_id').html(html);


              $('#batch_id').html(
                '<option value="">Select Batch</option>'
              );


              $('#studentTableBody').html(
                '<tr>' +
                '<td colspan="6" class="text-center">' +
                'Select Center → Batch' +
                '</td>' +
                '</tr>'
              );

            },

            error: function(xhr) {

              console.log(
                "CENTER ERROR:",
                xhr.responseText
              );

            }

          });

        }


        /*
        |--------------------------------------------------------------------------
        | CENTER -> BATCH
        |--------------------------------------------------------------------------
        */

        $('#center_id').change(function() {

          const centerId = $(this).val();


          /*
           * Reset batch.
           */
          $('#batch_id').html(
            '<option value="">Select Batch</option>'
          );


          $('#hidden_center_id').val(centerId);

          $('#hidden_batch_id').val('');


          $('#studentTableBody').html(
            '<tr>' +
            '<td colspan="6" class="text-center">' +
            'Select Batch' +
            '</td>' +
            '</tr>'
          );


          if (!centerId) {

            return;

          }


          $.ajax({

            url: "<?= base_url('attendance/get-batches'); ?>",

            type: "POST",

            data: {

              program_id: programId,

              center_id: centerId

            },

            dataType: "json",

            success: function(data) {

              console.log(
                "Batch Response:",
                data
              );


              let html =
                '<option value="">Select Batch</option>';


              $.each(
                data,
                function(i, row) {

                  html +=
                    '<option value="' +
                    row.Batch_Id +
                    '">' +
                    row.Batch_Name +
                    '</option>';

                }
              );


              $('#batch_id').html(html);

            },

            error: function(xhr) {

              console.log(
                "BATCH ERROR:",
                xhr.responseText
              );

            }

          });

        });


        /*
        |--------------------------------------------------------------------------
        | BATCH -> STUDENTS
        |--------------------------------------------------------------------------
        */

        $('#batch_id').change(function() {

          const batchId = $(this).val();

          $('#hidden_batch_id').val(batchId);

          if (!batchId) {

            $('#studentTableBody').html(
              '<tr>' +
              '<td colspan="6" class="text-center">' +
              'Select Batch' +
              '</td>' +
              '</tr>'
            );

            return;

          }

          /*
           * Load attendance dates.
           */
          $.ajax({

            url: "<?= base_url('attendance/get-attendance-dates'); ?>",

            type: "POST",

            data: {

              program_id: programId,

              batch_id: batchId

            },

            dataType: "json",

            success: function(response) {

              console.log(
                "Attendance Dates:",
                response
              );

              markedDates = [];

              response.forEach(function(item) {

                markedDates.push(
                  item.Attendance_Date
                );

              });

              if (attendanceCalendar) {

                attendanceCalendar.redraw();

              }

            },

            error: function(xhr) {

              console.log(
                xhr.responseText
              );

            }

          });

        });


        /*
        |--------------------------------------------------------------------------
        | DATE CHANGE -> STUDENTS
        |--------------------------------------------------------------------------
        */

        $('#attendance_date').change(function() {

          $('#studentTableBody').html(
            '<tr>' +
            '<td colspan="6" class="text-center">' +
            'Click "Fetch Students" to load students' +
            '</td>' +
            '</tr>'
          );

        });



        /*
|--------------------------------------------------------------------------
| FETCH STUDENTS BUTTON
|--------------------------------------------------------------------------
*/

        $('#fetchStudents').click(function() {

          const centerId =
            $('#center_id').val();

          const batchId =
            $('#batch_id').val();

          const attendanceDate =
            $('#attendance_date').val();


          /*
           * Validation
           */

          if (!programId) {

            alert('Program is not selected.');

            return;

          }

          if (!centerId) {

            alert('Please select a Center.');

            return;

          }

          if (!batchId) {

            alert('Please select a Batch.');

            return;

          }

          if (!attendanceDate) {

            alert('Please select Attendance Date.');

            return;

          }


          /*
           * Set hidden values
           */

          $('#hidden_program_id')
            .val(programId);

          $('#hidden_center_id')
            .val(centerId);

          $('#hidden_batch_id')
            .val(batchId);


          /*
           * Show loading
           */

          $('#studentTableBody').html(
            '<tr>' +
            '<td colspan="6" class="text-center">' +
            '<i class="mdi mdi-loading mdi-spin me-2"></i>' +
            'Loading students...' +
            '</td>' +
            '</tr>'
          );


          /*
           * Fetch Students
           */

          loadStudents();

        });


        /*
        |--------------------------------------------------------------------------
        | LOAD STUDENTS FUNCTION
        |--------------------------------------------------------------------------
        */

        function loadStudents() {

          const batchId =
            $('#batch_id').val();

          const date =
            $('#attendance_date').val();


          if (!batchId) {

            return;

          }


          $.ajax({

            url: "<?= base_url('attendance/get-students'); ?>",

            type: "POST",

            data: {

              program_id: programId,

              batch_id: batchId,

              attendance_date: date

            },

            success: function(response) {

              $('#studentTableBody')
                .html(response);

            },

            error: function(xhr) {

              console.log(
                xhr.responseText
              );


              $('#studentTableBody').html(
                '<tr>' +
                '<td colspan="6" class="text-center text-danger">' +
                'Unable to load students.' +
                '</td>' +
                '</tr>'
              );

            }

          });

        }


        /*
        |--------------------------------------------------------------------------
        | SAVE ATTENDANCE
        |--------------------------------------------------------------------------
        */

        $('#saveAttendance').click(function() {

          const centerId =
            $('#center_id').val();

          const batchId =
            $('#batch_id').val();


          /*
           * Front-end validation.
           */

          if (!programId) {

            alert(
              'Program is not selected.'
            );

            return;

          }


          if (!centerId) {

            alert(
              'Please select a Center.'
            );

            return;

          }


          if (!batchId) {

            alert(
              'Please select a Batch.'
            );

            return;

          }


          $('#hidden_program_id')
            .val(programId);

          $('#hidden_center_id')
            .val(centerId);

          $('#hidden_batch_id')
            .val(batchId);


          $.ajax({

            url: "<?= base_url('attendance/save'); ?>",

            type: "POST",

            data: $('#attendanceForm').serialize(),

            dataType: "json",

            success: function(response) {

              alert(
                response.message
              );

            },

            error: function(xhr) {

              console.log(
                xhr.responseText
              );

              alert(
                'Error Saving Attendance'
              );

            }

          });

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