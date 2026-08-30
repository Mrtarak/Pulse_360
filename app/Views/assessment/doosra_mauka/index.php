```php
<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">

        <div class="content-wrapper">

            <div class="row">

                <div class="col-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <?= view('includes/breadcrumb'); ?>

                            <?= view('includes/messages'); ?>


                            <!-- ========================================= -->
                            <!-- HEADER -->
                            <!-- ========================================= -->

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <h4 class="card-title mb-0">

                                    <i class="mdi mdi-school me-2"></i>

                                    Doosra Mauka Assessment

                                </h4>

                            </div>


                            <!-- ========================================= -->
                            <!-- FILTER CARD -->
                            <!-- ========================================= -->

                            <div class="card shadow-sm mb-4">

                                <div class="card-body">

                                    <div class="row">


                                        <!-- ================= CENTER ================= -->

                                        <div class="col-md-4 mb-3">

                                            <label
                                                for="center_id"
                                                class="form-label fw-bold">

                                                <i class="mdi mdi-office-building me-1"></i>

                                                Center
                                                <span class="text-danger">*</span>

                                            </label>


                                            <select
                                                id="center_id"
                                                name="center_id"
                                                class="form-select">

                                                <option value="">
                                                    Select Center
                                                </option>


                                                <?php if (!empty($centers)): ?>

                                                    <?php foreach ($centers as $center): ?>

                                                        <option
                                                            value="<?= esc($center['Center_Id']) ?>">

                                                            <?= esc($center['Center_Name']) ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                <?php endif; ?>

                                            </select>

                                        </div>



                                        <!-- ================= BATCH ================= -->

                                        <div class="col-md-4 mb-3">

                                            <label
                                                for="batch_id"
                                                class="form-label fw-bold">

                                                <i class="mdi mdi-calendar-clock me-1"></i>

                                                Batch
                                                <span class="text-danger">*</span>

                                            </label>


                                            <select
                                                id="batch_id"
                                                name="batch_id"
                                                class="form-select"
                                                disabled>

                                                <option value="">
                                                    Select Batch
                                                </option>

                                            </select>

                                        </div>



                                        <!-- ============== ASSESSMENT TYPE ============== -->

                                        <div class="col-md-4 mb-3">

                                            <label
                                                for="assessment_type"
                                                class="form-label fw-bold">

                                                <i class="mdi mdi-clipboard-check-outline me-1"></i>

                                                Assessment Type
                                                <span class="text-danger">*</span>

                                            </label>


                                            <select
                                                id="assessment_type"
                                                name="assessment_type"
                                                class="form-select">

                                                <option value="">
                                                    Select Assessment Type
                                                </option>

                                                <option value="Baseline">
                                                    Baseline
                                                </option>

                                                <option value="Endline">
                                                    Endline
                                                </option>

                                            </select>

                                        </div>

                                    </div>



                                    <!-- ================= FETCH BUTTON ================= -->

                                    <div class="text-center mt-3">

                                        <button
                                            type="button"
                                            id="fetchStudents"
                                            class="btn btn-primary px-4">

                                            <i class="mdi mdi-magnify me-2"></i>

                                            Fetch Students

                                        </button>

                                    </div>

                                </div>

                            </div>



                            <!-- ========================================= -->
                            <!-- STUDENT RESULT SECTION -->
                            <!-- ========================================= -->

                            <div
                                id="studentResultCard"
                                class="card shadow-sm"
                                style="display:none;">


                                <!-- ================= CARD HEADER ================= -->

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h5 class="mb-0">

                                        <i class="mdi mdi-account-group me-2"></i>

                                        Student Result Entry

                                    </h5>


                                    <span
                                        id="totalStudents"
                                        class="badge bg-light text-dark">

                                        Total Students : 0

                                    </span>

                                </div>



                                <div class="card-body">


                                    <!-- ================= SUMMARY ================= -->

                                    <div class="summary-box mb-4">

                                        <div class="row">


                                            <!-- Program -->

                                            <div class="col-md-4">

                                                <strong>
                                                    Program :
                                                </strong>

                                                <br>

                                                Doosra Mauka

                                            </div>


                                            <!-- Center -->

                                            <div class="col-md-4">

                                                <strong>
                                                    Center :
                                                </strong>

                                                <br>

                                                <span id="summaryCenter">
                                                    -
                                                </span>

                                            </div>


                                            <!-- Batch -->

                                            <div class="col-md-4">

                                                <strong>
                                                    Batch :
                                                </strong>

                                                <br>

                                                <span id="summaryBatch">
                                                    -
                                                </span>

                                            </div>

                                        </div>

                                    </div>



                                    <!-- ================= TABLE ================= -->

                                    <div class="table-responsive">

                                        <table
                                            id="studentTable"
                                            class="table table-striped table-bordered table-hover">

                                            <thead>

                                                <tr>

                                                    <th width="70">
                                                        #
                                                    </th>

                                                    <th>
                                                        Student Name
                                                    </th>

                                                    <th>
                                                        Assessment Status
                                                    </th>

                                                    <th width="180">
                                                        Actions
                                                    </th>

                                                </tr>

                                            </thead>


                                            <tbody id="studentTableBody">

                                                <!-- Students will load here -->

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

</div>


<?= view('includes/footer'); ?>



<!-- ===================================================== -->
<!-- DOOSRA MAUKA ASSESSMENT JAVASCRIPT -->
<!-- ===================================================== -->

<script>
    $(document).ready(function() {


        /* =====================================================
           CENTER CHANGE
        ===================================================== */

        $('#center_id').on('change', function() {

            let centerId = $(this).val();


            // Reset batch

            $('#batch_id')
                .html('<option value="">Loading batches...</option>')
                .prop('disabled', true);


            // Hide students

            $('#studentResultCard').hide();

            $('#studentTableBody').empty();


            if (!centerId) {

                $('#batch_id')
                    .html('<option value="">Select Batch</option>');

                return;

            }



            $.ajax({

                url: '<?= site_url('assessment/doosra-mauka/get-batches') ?>',

                type: 'POST',

                data: {

                    center_id: centerId

                },

                dataType: 'json',


                success: function(response) {


                    $('#batch_id')
                        .html('<option value="">Select Batch</option>');


                    if (
                        response.status === true &&
                        response.data &&
                        response.data.length > 0
                    ) {


                        $.each(response.data, function(index, batch) {


                            $('#batch_id').append(

                                $('<option>', {

                                    value: batch.Batch_Id,

                                    text: batch.Batch_Name

                                })

                            );

                        });


                        $('#batch_id').prop('disabled', false);


                    } else {


                        $('#batch_id').html(

                            '<option value="">No batches found</option>'

                        );

                    }

                },


                error: function(xhr) {

                    console.log(xhr.responseText);


                    $('#batch_id').html(

                        '<option value="">Unable to load batches</option>'

                    );

                }

            });

        });



        /* =====================================================
           FETCH STUDENTS
        ===================================================== */

        $('#fetchStudents').on('click', function() {


            let centerId =
                $('#center_id').val();


            let batchId =
                $('#batch_id').val();


            let assessmentType =
                $('#assessment_type').val();



            /* ================= VALIDATION ================= */


            if (!centerId) {

                alert('Please select Center.');

                $('#center_id').focus();

                return;

            }


            if (!batchId) {

                alert('Please select Batch.');

                $('#batch_id').focus();

                return;

            }


            if (!assessmentType) {

                alert('Please select Assessment Type.');

                $('#assessment_type').focus();

                return;

            }



            let button = $(this);



            /* ================= LOADING ================= */


            button
                .prop('disabled', true)
                .html(
                    '<i class="mdi mdi-loading mdi-spin me-2"></i>Loading...'
                );



            $.ajax({

                url: '<?= site_url('assessment/doosra-mauka/get-students') ?>',

                type: 'POST',

                data: {

                    center_id: centerId,

                    batch_id: batchId,

                    assessment_type: assessmentType

                },

                dataType: 'json',



                success: function(response) {


                    /* ================= RESET BUTTON ================= */

                    button
                        .prop('disabled', false)
                        .html(
                            '<i class="mdi mdi-magnify me-2"></i>Fetch Students'
                        );



                    if (!response.status) {

                        alert(
                            response.message ||
                            'Unable to fetch students.'
                        );

                        return;

                    }



                    let students =
                        response.data || [];



                    /* ================= SHOW CARD ================= */

                    $('#studentResultCard').show();



                    /* ================= TOTAL ================= */

                    $('#totalStudents').text(

                        'Total Students : ' +
                        students.length

                    );



                    /* ================= SUMMARY ================= */

                    $('#summaryCenter').text(

                        $('#center_id option:selected').text()

                    );


                    $('#summaryBatch').text(

                        $('#batch_id option:selected').text()

                    );



                    /* ================= CLEAR TABLE ================= */

                    $('#studentTableBody').empty();



                    /* ================= NO STUDENTS ================= */

                    if (students.length === 0) {

                        $('#studentTableBody').html(

                            '<tr>' +

                            '<td colspan="4" class="text-center py-4 text-muted">' +

                            '<i class="mdi mdi-account-off-outline fs-4 d-block mb-2"></i>' +

                            'No students found for the selected Center and Batch.' +

                            '</td>' +

                            '</tr>'

                        );

                        return;

                    }



                    /* =================================================
                       CREATE STUDENT ROWS
                    ================================================= */

                    $.each(students, function(index, student) {


                        let actionHtml = '';

                        let statusHtml = '';



                        /* =================================================
                           NOT ASSESSED
                        ================================================= */

                        if (student.action === 'add') {


                            statusHtml =

                                '<span class="badge bg-warning text-dark">' +

                                'Pending' +

                                '</span>';



                            actionHtml =

                                '<a href="<?= site_url('assessment/doosra-mauka/add') ?>' +

                                '?student_id=' +
                                encodeURIComponent(student.Student_Id) +

                                '&center_id=' +
                                encodeURIComponent(student.Center_Id) +

                                '&batch_id=' +
                                encodeURIComponent(student.Batch_Id) +

                                '&assessment_type=' +
                                encodeURIComponent(assessmentType) +

                                '" ' +

                                'class="btn btn-success btn-sm" ' +

                                'title="Add Assessment">' +

                                '<i class="mdi mdi-plus"></i>' +

                                '</a>';

                        }



                        /* =================================================
                           ALREADY ASSESSED
                        ================================================= */
                        else {


                            statusHtml =

                                '<span class="badge bg-success">' +

                                'Completed' +

                                '</span>';



                            actionHtml =

                                '<a href="<?= site_url('assessment/doosra-mauka/view') ?>/' +

                                encodeURIComponent(
                                    student.Student_Assessment_Id
                                ) +

                                '" ' +

                                'class="btn btn-info btn-sm me-1" ' +

                                'title="View Assessment">' +

                                '<i class="mdi mdi-eye"></i>' +

                                '</a>' +


                                '<a href="<?= site_url('assessment/doosra-mauka/edit') ?>/' +

                                encodeURIComponent(
                                    student.Student_Assessment_Id
                                ) +

                                '/' +

                                encodeURIComponent(
                                    assessmentType
                                ) +

                                '" ' +

                                'class="btn btn-warning btn-sm" ' +

                                'title="Edit Assessment">' +

                                '<i class="mdi mdi-pencil"></i>' +

                                '</a>';

                        }



                        /* =================================================
                           STUDENT NAME
                        ================================================= */

                        let studentName =

                            $('<div>')
                            .text(student.Student_Name)
                            .html();



                        /* =================================================
                           ROW
                        ================================================= */

                        let row =

                            '<tr>' +

                            '<td>' +

                            (index + 1) +

                            '</td>' +


                            '<td>' +

                            '<strong>' +

                            studentName +

                            '</strong>' +

                            '</td>' +


                            '<td>' +

                            statusHtml +

                            '</td>' +


                            '<td>' +

                            actionHtml +

                            '</td>' +

                            '</tr>';



                        $('#studentTableBody').append(row);

                    });

                },



                error: function(xhr) {


                    button
                        .prop('disabled', false)
                        .html(
                            '<i class="mdi mdi-magnify me-2"></i>Fetch Students'
                        );


                    console.log(xhr.responseText);


                    alert(
                        'Something went wrong while fetching students.'
                    );

                }

            });

        });

    });
</script>



<!-- ===================================================== -->
<!-- PAGE CSS -->
<!-- ===================================================== -->

<style>
    .card {
        border: 0;
        border-radius: 10px;
    }


    .card-header {
        background: #4B49AC;
        color: #fff;
        font-size: 18px;
        font-weight: 600;
    }


    .summary-box {
        background: #f8f9fa;
        border-left: 4px solid #4B49AC;
        border-radius: 8px;
        padding: 15px;
    }


    .table thead {
        background: #eef2ff;
    }


    .table td,
    .table th {
        vertical-align: middle;
    }


    #studentTable .btn {
        margin-right: 3px;
    }


    #studentTable .btn:last-child {
        margin-right: 0;
    }
</style>
```