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

                                    <i class="mdi mdi-desktop-classic me-2"></i>

                                    Digital Shakti Assessment

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
                            <!-- STUDENT RESULT CARD -->
                            <!-- ========================================= -->

                            <div
                                id="studentResultCard"
                                class="card shadow-sm"
                                style="display:none;">


                                <!-- ================= CARD HEADER ================= -->

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h5 class="mb-0">

                                        <i class="mdi mdi-account-group me-2"></i>

                                        Digital Shakti Student Assessment

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

                                                Digital Shakti

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



                                    <!-- ================================================= -->
                                    <!-- ASSESSMENT FORM -->
                                    <!-- ================================================= -->

                                    <form
                                        id="assessmentForm"
                                        method="post"
                                        action="<?= site_url('assessment/digital-shakti/save') ?>">


                                        <?= csrf_field() ?>


                                        <!-- Hidden filter values -->

                                        <input
                                            type="hidden"
                                            name="center_id"
                                            id="form_center_id">

                                        <input
                                            type="hidden"
                                            name="batch_id"
                                            id="form_batch_id">

                                        <input
                                            type="hidden"
                                            name="assessment_type"
                                            id="form_assessment_type">



                                        <!-- ================= TABLE ================= -->

                                        <div class="table-responsive">

                                            <table
                                                id="studentTable"
                                                class="table table-striped table-bordered table-hover">

                                                <thead>

                                                    <tr>

                                                        <th width="60">
                                                            #
                                                        </th>

                                                        <th>
                                                            Student Name
                                                        </th>

                                                        <th width="180">
                                                            Assessment Date
                                                        </th>

                                                        <th width="180">
                                                            Final Grade
                                                        </th>

                                                        <th>
                                                            Remarks / Notes
                                                        </th>

                                                        <th width="130">
                                                            Status
                                                        </th>

                                                    </tr>

                                                </thead>


                                                <tbody id="studentTableBody">

                                                    <!-- Students will load here -->

                                                </tbody>

                                            </table>

                                        </div>



                                        <!-- ================= SAVE BUTTON ================= -->

                                        <div
                                            id="saveSection"
                                            class="text-center mt-4"
                                            style="display:none;">

                                            <button
                                                type="submit"
                                                id="saveAssessment"
                                                class="btn btn-success px-5">

                                                <i class="mdi mdi-content-save me-2"></i>

                                                Save Student Results

                                            </button>

                                        </div>

                                    </form>

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
<!-- DIGITAL SHAKTI JAVASCRIPT -->
<!-- ===================================================== -->

<script>
    $(document).ready(function() {


        /* =====================================================
           CENTER CHANGE
        ===================================================== */

        $('#center_id').on('change', function() {

            let centerId = $(this).val();


            /*
             * Reset batch
             */

            $('#batch_id')
                .html('<option value="">Loading batches...</option>')
                .prop('disabled', true);


            /*
             * Hide student result
             */

            $('#studentResultCard').hide();

            $('#studentTableBody').empty();

            $('#saveSection').hide();


            if (!centerId) {

                $('#batch_id')
                    .html('<option value="">Select Batch</option>');

                return;

            }


            /*
             * Load batches
             */

            $.ajax({

                url: '<?= site_url('assessment/digital-shakti/get-batches') ?>',

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


                        $.each(
                            response.data,
                            function(index, batch) {


                                $('#batch_id').append(

                                    $('<option>', {

                                        value: batch.Batch_Id,

                                        text: batch.Batch_Name

                                    })

                                );

                            }
                        );


                        $('#batch_id')
                            .prop('disabled', false);


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
           BATCH CHANGE
        ===================================================== */

        $('#batch_id').on('change', function() {

            $('#studentResultCard').hide();

            $('#studentTableBody').empty();

            $('#saveSection').hide();

        });



        /* =====================================================
           ASSESSMENT TYPE CHANGE
        ===================================================== */

        $('#assessment_type').on('change', function() {

            $('#studentResultCard').hide();

            $('#studentTableBody').empty();

            $('#saveSection').hide();

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

                url: '<?= site_url('assessment/digital-shakti/get-students') ?>',

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



                    /* =================================================
                       SET FORM VALUES
                    ================================================= */

                    $('#form_center_id')
                        .val(centerId);

                    $('#form_batch_id')
                        .val(batchId);

                    $('#form_assessment_type')
                        .val(assessmentType);



                    /* ================= CLEAR TABLE ================= */

                    $('#studentTableBody').empty();



                    /* ================= NO STUDENTS ================= */

                    if (students.length === 0) {

                        $('#studentTableBody').html(

                            '<tr>' +

                            '<td colspan="6" class="text-center py-4 text-muted">' +

                            '<i class="mdi mdi-account-off-outline fs-4 d-block mb-2"></i>' +

                            'No Digital Shakti students found for the selected Center and Batch.' +

                            '</td>' +

                            '</tr>'

                        );


                        $('#saveSection').hide();

                        return;

                    }



                    /* =================================================
                       CREATE STUDENT ROWS
                    ================================================= */

                    $.each(
                        students,
                        function(index, student) {


                            /*
                             * Escape student name
                             */

                            let studentName =

                                $('<div>')
                                .text(
                                    student.Student_Name || ''
                                )
                                .html();



                            /*
                             * Existing assessment
                             */

                            let assessmentId =
                                student.Student_Assessment_Id || '';


                            /*
                             * Existing date
                             */

                            let assessmentDate =
                                student.Assessment_Date || '';



                            /*
                             * Existing grade
                             */

                            let grade =
                                student.Digital_Shakti_Grade || '';



                            /*
                             * Existing remark
                             */

                            let remark =
                                student.Digital_Shakti_Remark || '';



                            /*
                             * Status
                             */

                            let statusHtml = '';


                            if (assessmentId) {

                                statusHtml =

                                    '<span class="badge bg-success">' +

                                    'Completed' +

                                    '</span>';

                            } else {

                                statusHtml =

                                    '<span class="badge bg-warning text-dark">' +

                                    'Pending' +

                                    '</span>';

                            }



                            /*
                             * Hidden existing assessment ID
                             *
                             * Not required by current controller,
                             * but kept available for future use.
                             */

                            let hiddenAssessmentId =

                                '<input ' +

                                'type="hidden" ' +

                                'name="student_assessment_id[]" ' +

                                'value="' +

                                $('<div>')
                                .text(assessmentId)
                                .html() +

                                '">';



                            /*
                             * Student ID
                             */

                            let hiddenStudentId =

                                '<input ' +

                                'type="hidden" ' +

                                'name="student_id[]" ' +

                                'value="' +

                                $('<div>')
                                .text(student.Student_Id)
                                .html() +

                                '">';



                            /*
                             * Assessment Date
                             */

                            let today = new Date().toISOString().split('T')[0];

                            let dateInput =

                                '<input ' +

                                'type="date" ' +

                                'name="assessment_date[]" ' +

                                'class="form-control assessment-date" ' +

                                'max="' + today + '" ' +

                                'value="' +

                                $('<div>')
                                .text(assessmentDate)
                                .html() +

                                '">';


                            /*
                             * Grade
                             */

                            let gradeInput =

                                '<select ' +

                                'name="digital_shakti_grade[]" ' +

                                'class="form-select digital-grade">' +

                                '<option value="">Select Grade</option>' +

                                '<option value="A" ' +
                                (grade === 'A' ? 'selected' : '') +
                                '>A</option>' +

                                '<option value="A+" ' +
                                (grade === 'A+' ? 'selected' : '') +
                                '>A+</option>' +

                                '<option value="B" ' +
                                (grade === 'B' ? 'selected' : '') +
                                '>B</option>' +

                                '<option value="B+" ' +
                                (grade === 'B+' ? 'selected' : '') +
                                '>B+</option>' +

                                '<option value="C" ' +
                                (grade === 'C' ? 'selected' : '') +
                                '>C</option>' +

                                '<option value="C+" ' +
                                (grade === 'C+' ? 'selected' : '') +
                                '>C+</option>' +

                                '<option value="D" ' +
                                (grade === 'D' ? 'selected' : '') +
                                '>D</option>' +

                                '</select>';



                            /*
                             * Remark
                             */

                            let remarkInput =

                                '<textarea ' +

                                'name="digital_shakti_remark[]" ' +

                                'class="form-control digital-remark" ' +

                                'rows="1" ' +

                                'placeholder="Enter remarks">' +

                                $('<div>')
                                .text(remark)
                                .html() +

                                '</textarea>';



                            /*
                             * Existing assessment indicator
                             */

                            let rowClass = assessmentId ?
                                'assessment-completed' :
                                '';



                            /*
                             * Build row
                             */

                            let row =

                                '<tr class="' +
                                rowClass +
                                '">' +


                                '<td>' +

                                (index + 1) +

                                '</td>' +


                                '<td>' +

                                hiddenStudentId +

                                hiddenAssessmentId +

                                '<strong>' +

                                studentName +

                                '</strong>' +

                                '</td>' +


                                '<td>' +

                                dateInput +

                                '</td>' +


                                '<td>' +

                                gradeInput +

                                '</td>' +


                                '<td>' +

                                remarkInput +

                                '</td>' +


                                '<td>' +

                                statusHtml +

                                '</td>' +


                                '</tr>';



                            $('#studentTableBody')
                                .append(row);

                        }
                    );



                    /*
                     * Show save button
                     */

                    $('#saveSection').show();

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



        /* =====================================================
           SAVE FORM
        ===================================================== */

        $('#assessmentForm').on('submit', function(e) {


            /*
             * Prevent accidental double submission
             */

            let button =
                $('#saveAssessment');


            button
                .prop('disabled', true)
                .html(
                    '<i class="mdi mdi-loading mdi-spin me-2"></i>Saving...'
                );


            /*
             * Allow normal form submission.
             */

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


    #studentTable input,
    #studentTable textarea {
        min-width: 120px;
    }


    #studentTable textarea {
        resize: vertical;
    }


    .assessment-completed {
        background-color: rgba(25, 135, 84, 0.04);
    }


    .assessment-date {
        min-width: 150px !important;
    }


    .digital-grade {
        min-width: 140px !important;
    }


    .digital-remark {
        min-width: 220px !important;
    }
</style>