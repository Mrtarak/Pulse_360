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



                                    <!-- ================================================= -->
                                    <!-- ASSESSMENT FORM -->
                                    <!-- ================================================= -->

                                    <form
                                        id="assessmentForm"
                                        method="post"
                                        action="<?= site_url('assessment/digital-shakti/save') ?>">


                                        <?= csrf_field() ?>


                                        <!-- ================= HIDDEN FILTER VALUES ================= -->

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

                                                        <th width="160">
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
    ```

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
                             * Today
                             */

                            let today =
                                new Date()
                                .toISOString()
                                .split('T')[0];



                            /* =================================================
                               ASSESSMENT DATE
                            ================================================= */

                            let dateClass = assessmentId ?
                                'form-control assessment-date locked-field' :
                                'form-control assessment-date';


                            let dateInput =

                                '<input ' +

                                'type="date" ' +

                                'name="assessment_date[]" ' +

                                'class="' +
                                dateClass +
                                '" ' +

                                'max="' +
                                today +
                                '" ' +

                                (assessmentId ?
                                    'readonly ' :
                                    '') +

                                'value="' +

                                $('<div>')
                                .text(assessmentDate)
                                .html() +

                                '">';



                            /* =================================================
                               GRADE
                            ================================================= */

                            let gradeClass = assessmentId ?
                                'form-select digital-grade locked-field' :
                                'form-select digital-grade';


                            let gradeInput =

                                '<select ' +

                                'name="digital_shakti_grade[]" ' +

                                'class="' +
                                gradeClass +
                                '">' +

                                '<option value="">Select Grade</option>' +

                                '<option value="A" ' +
                                (grade === 'A' ?
                                    'selected' :
                                    '') +
                                '>A</option>' +

                                '<option value="A+" ' +
                                (grade === 'A+' ?
                                    'selected' :
                                    '') +
                                '>A+</option>' +

                                '<option value="B" ' +
                                (grade === 'B' ?
                                    'selected' :
                                    '') +
                                '>B</option>' +

                                '<option value="B+" ' +
                                (grade === 'B+' ?
                                    'selected' :
                                    '') +
                                '>B+</option>' +

                                '<option value="C" ' +
                                (grade === 'C' ?
                                    'selected' :
                                    '') +
                                '>C</option>' +

                                '<option value="C+" ' +
                                (grade === 'C+' ?
                                    'selected' :
                                    '') +
                                '>C+</option>' +

                                '<option value="D" ' +
                                (grade === 'D' ?
                                    'selected' :
                                    '') +
                                '>D</option>' +

                                '</select>';



                            /* =================================================
                               REMARK
                            ================================================= */

                            let remarkClass = assessmentId ?
                                'form-control digital-remark locked-field' :
                                'form-control digital-remark';


                            let remarkInput =

                                '<textarea ' +

                                'name="digital_shakti_remark[]" ' +

                                'class="' +
                                remarkClass +
                                '" ' +

                                'rows="1" ' +

                                (assessmentId ?
                                    'readonly ' :
                                    '') +

                                'placeholder="Enter remarks">' +

                                $('<div>')
                                .text(remark)
                                .html() +

                                '</textarea>'
                            /* =================================================
                               STUDENT ID
                            ================================================= */

                            let hiddenStudentId =

                                '<input ' +

                                'type="hidden" ' +

                                'name="student_id[]" ' +

                                'value="' +

                                $('<div>')
                                .text(
                                    student.Student_Id
                                )
                                .html() +

                                '">';



                            /* =================================================
                               EXISTING ASSESSMENT ID
                            ================================================= */

                            let hiddenAssessmentId =

                                '<input ' +

                                'type="hidden" ' +

                                'name="student_assessment_id[]" ' +

                                'value="' +

                                $('<div>')
                                .text(assessmentId)
                                .html() +

                                '">';



                            /* =================================================
                               STATUS
                            ================================================= */

                            let statusHtml = '';


                            if (assessmentId) {

                                statusHtml =

                                    '<div class="student-status">' +

                                    '<button ' +
                                    'type="button" ' +
                                    'class="btn btn-success btn-sm assessment-action-btn" ' +
                                    'title="Assessment Completed">' +

                                    '<i class="mdi mdi-check"></i>' +

                                    '</button>' +

                                    '<button ' +
                                    'type="button" ' +
                                    'class="btn btn-primary btn-sm edit-student-btn assessment-action-btn" ' +
                                    'title="Edit Assessment">' +

                                    '<i class="mdi mdi-pencil"></i>' +

                                    '</button>' +

                                    '</div>';

                            } else {

                                statusHtml =

                                    '<span class="badge bg-warning text-dark">' +

                                    '<i class="mdi mdi-clock-outline me-1"></i>' +

                                    'Pending' +

                                    '</span>';

                            }


                            /* =================================================
                               ROW CLASS
                            ================================================= */

                            let rowClass = assessmentId ?
                                'assessment-completed assessment-locked' :
                                '';



                            /* =================================================
                               BUILD ROW
                            ================================================= */

                            let row =

                                '<tr ' +

                                'class="' +
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


                                '<td class="text-center">' +

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
           EDIT INDIVIDUAL STUDENT
        ===================================================== */

        $(document).on(
            'click',
            '.edit-student-btn',
            function() {


                let button =
                    $(this);


                let row =
                    button.closest('tr');



                /* ================= UNLOCK DATE ================= */

                row.find('.assessment-date')
                    .prop('readonly', false)
                    .removeClass('locked-field');



                /* ================= UNLOCK GRADE ================= */

                row.find('.digital-grade')
                    .removeClass('locked-field');



                /* ================= UNLOCK REMARK ================= */

                row.find('.digital-remark')
                    .prop('readonly', false)
                    .removeClass('locked-field');



                /* ================= ROW APPEARANCE ================= */

                row.removeClass(
                    'assessment-locked'
                );



                /* ================= CHANGE BUTTON ================= */

                button
                    .html('<i class="mdi mdi-pencil-off"></i>')
                    .prop('disabled', true)
                    .attr('title', 'Editing');

            }
        );



        /* =====================================================
           SAVE FORM
        ===================================================== */

        $('#assessmentForm').on(
            'submit',
            function(e) {


                /*
                 * Prevent accidental double submission
                 */

                let button =
                    $('#saveAssessment');


                button
                    .prop(
                        'disabled',
                        true
                    )
                    .html(
                        '<i class="mdi mdi-loading mdi-spin me-2"></i>Saving...'
                    );


                /*
                 * Allow normal form submission.
                 */

            }
        );


    });
</script>

<!-- ===================================================== -->

<!-- PAGE CSS -->

<!-- ===================================================== -->

<style>
    /* =====================================================
       GENERAL CARD
    ===================================================== */

    .card {
        border: 0;
        border-radius: 10px;
    }


    .card-header {
        background: #1B4482;
        color: #fff;
        font-size: 18px;
        font-weight: 600;
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .summary-box {
        background: #f8f9fa;
        border-left: 4px solid #1B4482;
        border-radius: 8px;
        padding: 15px;
    }


    /* =====================================================
       TABLE
    ===================================================== */

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


    /* =====================================================
       COMPLETED ROW
    ===================================================== */

    .assessment-completed {
        background-color: rgba(25, 135, 84, 0.04);
    }


    /* =====================================================
       LOCKED EXISTING FIELDS
    ===================================================== */

    .assessment-locked {
        background-color: rgba(0, 0, 0, 0.015);
    }


    .locked-field {
        background-color: #e9ecef !important;
        cursor: not-allowed;
    }


    /*
     * Grade select behaves like readonly
     */

    .digital-grade.locked-field {
        pointer-events: none;
        background-color: #e9ecef !important;
    }


    /* =====================================================
       INPUT WIDTHS
    ===================================================== */

    .assessment-date {
        min-width: 150px !important;
    }


    .digital-grade {
        min-width: 140px !important;
    }


    .digital-remark {
        min-width: 220px !important;
    }


    /* =====================================================
       EDIT BUTTON
    ===================================================== */


    .student-status {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .assessment-action-btn {
        width: 34px !important;
        height: 34px !important;

        min-width: 34px !important;
        min-height: 34px !important;

        padding: 0 !important;
        margin: 0 !important;

        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;

        border-radius: 50% !important;
    }

    /* Completed button - GREEN */
    .assessment-action-btn.btn-success {
        background-color: #198754 !important;
        border-color: #198754 !important;
        color: #ffffff !important;
    }

    /* Edit button - BLUE */
    .assessment-action-btn.btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #ffffff !important;
    }

    .assessment-action-btn i {
        font-size: 16px !important;
        line-height: 1;
    }

    /* =====================================================
       SAVE BUTTON
    ===================================================== */

    #saveAssessment {
        min-width: 220px;
    }
</style>