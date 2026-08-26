<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>NGO-Pulse 360 - Fees</title>

    <style>
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

        .student-fee-input {
            min-width: 110px;
        }

        .pending-amount {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .student-table th {
            white-space: nowrap;
        }

        .date-display {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        #studentFeeSection {
            display: none;
        }

        .required-star {
            color: red;
        }

        .remark-input {
            min-width: 220px;
            min-height: 80px;
            resize: vertical;
        }

        .paid-date {
            min-width: 150px;
        }

        /*
        ==========================================
        HIGHLIGHT PENDING AMOUNTS
        ==========================================
        */

        .pending-highlight.has-pending {
            color: #ff0000 !important;
            font-weight: 700 !important;
            background-color: #fff3e0 !important;
            border: 2px solid #ff0400 !important;
        }
    </style>

</head>


<body>

    <div class="container-fluid page-body-wrapper">

        <?= view('includes/sidebar'); ?>

        <div class="main-panel">

            <div class="content-wrapper">

                <div class="row">

                    <div class="col-lg-12 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body">


                                <!-- ================================= -->
                                <!-- FEE SELECTION -->
                                <!-- ================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-header bg-primary text-white">

                                        <h5 class="mb-0">
                                            Manage Student Fees
                                        </h5>

                                    </div>


                                    <div class="card-body">

                                        <div class="row">


                                            <!-- PROGRAM -->

                                            <div class="col-md-3 mb-3">

                                                <label class="fw-bold">

                                                    Program
                                                    <span class="required-star">*</span>

                                                </label>

                                                <select
                                                    class="form-select"
                                                    id="program_id">

                                                    <option value="">
                                                        Select Program
                                                    </option>

                                                    <?php foreach ($programs as $program): ?>

                                                        <option
                                                            value="<?= esc($program['Program_Id']); ?>">

                                                            <?= esc($program['Program_Name']); ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>

                                            </div>


                                            <!-- CENTER -->

                                            <div class="col-md-3 mb-3">

                                                <label class="fw-bold">

                                                    Center
                                                    <span class="required-star">*</span>

                                                </label>

                                                <select
                                                    class="form-select"
                                                    id="center_id">

                                                    <option value="">
                                                        Select Center
                                                    </option>

                                                </select>

                                            </div>


                                            <!-- BATCH -->

                                            <div class="col-md-3 mb-3">

                                                <label class="fw-bold">

                                                    Batch
                                                    <span class="required-star">*</span>

                                                </label>

                                                <select
                                                    class="form-select"
                                                    id="batch_id">

                                                    <option value="">
                                                        Select Batch
                                                    </option>

                                                </select>

                                            </div>


                                            <!-- FREQUENCY -->

                                            <div class="col-md-3 mb-3">

                                                <label class="fw-bold">

                                                    Frequency
                                                    <span class="required-star">*</span>

                                                </label>

                                                <select id="frequencyMonths" name="frequency_months" class="form-select">
                                                    <option value="">Select Frequency</option>
                                                    <option value="1">1 Month</option>
                                                    <option value="3">3 Months</option>
                                                    <option value="6">6 Months</option>
                                                    <option value="12">1 Year</option>
                                                    <option value="0">Full Course</option>
                                                </select>

                                            </div>


                                            <!-- FROM DATE -->

                                            <div class="col-md-3 mb-3">

                                                <label class="fw-bold">

                                                    From Date
                                                    <span class="required-star">*</span>

                                                </label>

                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="from_date"
                                                    value="<?= date('Y-m-d'); ?>">

                                            </div>


                                            <!-- TO DATE -->

                                            <div class="col-md-3 mb-3">

                                                <label class="fw-bold">

                                                    To Date

                                                </label>

                                                <input
                                                    type="date"
                                                    class="form-control date-display"
                                                    id="to_date"
                                                    readonly>

                                            </div>


                                        </div>


                                        <div class="alert alert-info mb-0">

                                            <strong>Note:</strong>

                                            Select Program, Center, Batch,
                                            Frequency and From Date.

                                            The student list will appear
                                            automatically after all selections
                                            are completed.

                                        </div>

                                    </div>

                                </div>


                                <!-- ================================= -->
                                <!-- STUDENT FEE SECTION -->
                                <!-- ================================= -->

                                <div
                                    class="card shadow-sm"
                                    id="studentFeeSection">


                                    <div class="card-header bg-light">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <h5 class="mb-0">
                                                Student Fee Entry
                                            </h5>

                                            <span
                                                class="badge bg-primary"
                                                id="studentCount">

                                                0 Students

                                            </span>

                                        </div>

                                    </div>


                                    <div class="card-body">


                                        <form id="feesForm">


                                            <input
                                                type="hidden"
                                                name="program_id"
                                                id="hidden_program_id">


                                            <input
                                                type="hidden"
                                                name="center_id"
                                                id="hidden_center_id">


                                            <input
                                                type="hidden"
                                                name="batch_id"
                                                id="hidden_batch_id">


                                            <input
                                                type="hidden"
                                                name="frequency_months"
                                                id="hidden_frequency_months">


                                            <input
                                                type="hidden"
                                                name="from_date"
                                                id="hidden_from_date">

                                            <input
                                                type="hidden"
                                                name="to_date"
                                                id="hidden_to_date">


                                            <div class="table-responsive">


                                                <table
                                                    class="table table-bordered table-hover student-table">


                                                    <thead class="table-light">

                                                        <tr>

                                                            <th>
                                                                #
                                                            </th>


                                                            <th>
                                                                Student Name
                                                            </th>


                                                            <th>
                                                                Fees Paid on
                                                            </th>

                                                            <th>
                                                                Previous Pending
                                                            </th>

                                                            <th>
                                                                Due Amount
                                                            </th>

                                                            <th>Late Fine</th>

                                                            <th>
                                                                Total Due
                                                            </th>

                                                            <th>
                                                                Paid Amount
                                                            </th>

                                                            <th>
                                                                Pending Amount
                                                            </th>

                                                            <th>
                                                                Remark
                                                            </th>

                                                        </tr>

                                                    </thead>


                                                    <tbody id="studentTableBody">

                                                        <tr>

                                                            <td
                                                                colspan="10"
                                                                class="text-center text-muted">

                                                                Select all required
                                                                fields above.

                                                            </td>

                                                        </tr>

                                                    </tbody>


                                                </table>

                                            </div>


                                            <div class="text-end mt-4">

                                                <button
                                                    type="button"
                                                    class="btn btn-success"
                                                    id="saveFees">

                                                    <i class="mdi mdi-content-save"></i>

                                                    Save Fees

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


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script>
        $(document).ready(function() {


            /*
            ==========================================
            PROGRAM -> CENTER
            ==========================================
            */

            $('#program_id').on('change', function() {

                let programId = $(this).val();

                console.log('Selected Program:', programId);

                $('#center_id').html(
                    '<option value="">Loading Centers...</option>'
                );

                $('#batch_id').html(
                    '<option value="">Select Batch</option>'
                );

                if (programId === '') {

                    $('#center_id').html(
                        '<option value="">Select Center</option>'
                    );

                    return;
                }

                $.ajax({

                    url: "<?= site_url('finance/fees/get-centers'); ?>",

                    type: "POST",

                    data: {
                        program_id: programId
                    },

                    dataType: "json",

                    success: function(response) {

                        console.log('CENTER RESPONSE:', response);

                        let html =
                            '<option value="">Select Center</option>';

                        if (
                            response.status === true &&
                            response.data &&
                            response.data.length > 0
                        ) {

                            $.each(response.data, function(index, center) {

                                html +=
                                    '<option value="' +
                                    center.Center_Id +
                                    '">' +
                                    center.Center_Name +
                                    '</option>';

                            });

                        } else {

                            html =
                                '<option value="">No Center Available</option>';
                        }

                        $('#center_id').html(html);
                    },

                    error: function(xhr, status, error) {

                        console.log('CENTER AJAX ERROR');
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response:', xhr.responseText);

                        $('#center_id').html(
                            '<option value="">Error Loading Center</option>'
                        );
                    }

                });

            });


            /*
            ==========================================
            CENTER -> BATCH
            ==========================================
            */

            $('#center_id').on('change', function() {

                let programId = $('#program_id').val();
                let centerId = $(this).val();

                $('#batch_id').html(
                    '<option value="">Loading Batches...</option>'
                );

                if (programId === '' || centerId === '') {

                    $('#batch_id').html(
                        '<option value="">Select Batch</option>'
                    );

                    return;
                }

                $.ajax({

                    url: "<?= site_url('finance/fees/get-batches'); ?>",

                    type: "POST",

                    data: {
                        program_id: programId,
                        center_id: centerId
                    },

                    dataType: "json",

                    success: function(response) {

                        console.log('BATCH RESPONSE:', response);

                        let html =
                            '<option value="">Select Batch</option>';

                        if (
                            response.status === true &&
                            response.data &&
                            response.data.length > 0
                        ) {

                            $.each(response.data, function(index, batch) {

                                html +=
                                    '<option value="' +
                                    batch.Batch_Id +
                                    '">' +
                                    batch.Batch_Name +
                                    '</option>';

                            });

                        } else {

                            html =
                                '<option value="">No Batch Available</option>';
                        }

                        $('#batch_id').html(html);
                    },

                    error: function(xhr, status, error) {

                        console.log('BATCH AJAX ERROR');
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response:', xhr.responseText);

                        $('#batch_id').html(
                            '<option value="">Error Loading Batch</option>'
                        );
                    }

                });

            });


            /*
            ==========================================
            BATCH CHANGE
            ==========================================
            */

            $('#batch_id').on('change', function() {

                hideStudentSection();

                checkFeeSelection();

            });


            /*
            ==========================================
            FREQUENCY CHANGE
            ==========================================
            */

            $('#frequencyMonths').on('change', function() {

                let frequency = $(this).val();

                /*
                 * FULL COURSE
                 * To Date should be manually selectable
                 */
                if (frequency === '0') {

                    $('#to_date')
                        .prop('readonly', false)
                        .removeClass('date-display')
                        .val('');

                } else {

                    /*
                     * NORMAL FREQUENCY
                     * To Date should be automatic and readonly
                     */
                    $('#to_date')
                        .prop('readonly', true)
                        .addClass('date-display');

                    calculateToDate();
                }

                hideStudentSection();

                checkFeeSelection();

            });


            /*
            ==========================================
            FROM DATE CHANGE
            ==========================================
            */

            $('#from_date').on('change', function() {

                let frequency = $('#frequencyMonths').val();


                /*
                 * For normal frequencies,
                 * recalculate To Date automatically
                 */
                if (frequency !== '0') {

                    calculateToDate();

                }


                /*
                 * For Full Course, clear the manually selected
                 * To Date when From Date changes
                 */
                if (frequency === '0') {

                    $('#to_date').val('');

                }


                hideStudentSection();

                checkFeeSelection();

            });


            /*
            ==========================================
            TO DATE CHANGE
            FULL COURSE ONLY
            ==========================================
            */

            $('#to_date').on('change', function() {

                let frequency = $('#frequencyMonths').val();


                /*
                 * Only manually selected for Full Course
                 */
                if (frequency === '0') {

                    hideStudentSection();

                    checkFeeSelection();
                }

            });


            /*
            ==========================================
            CALCULATE TO DATE
            ==========================================
            */

            function calculateToDate() {

                let frequency = $('#frequencyMonths').val();

                let fromDateValue = $('#from_date').val();


                /*
                 * FULL COURSE
                 * Do not calculate To Date automatically
                 */
                if (frequency === '0') {

                    return;
                }


                /*
                 * Normal frequency validation
                 */
                frequency = parseInt(frequency);


                if (!frequency || !fromDateValue) {

                    $('#to_date').val('');

                    return;
                }


                let fromDate = new Date(
                    fromDateValue + 'T00:00:00'
                );


                /*
                 * Add frequency months
                 */
                let toDate = new Date(fromDate);

                toDate.setMonth(
                    toDate.getMonth() + frequency
                );


                /*
                 * Subtract one day
                 */
                toDate.setDate(
                    toDate.getDate() - 1
                );


                let year = toDate.getFullYear();

                let month = String(
                    toDate.getMonth() + 1
                ).padStart(2, '0');

                let day = String(
                    toDate.getDate()
                ).padStart(2, '0');


                $('#to_date').val(
                    year + '-' + month + '-' + day
                );


                /*
                 * Keep automatic date readonly
                 */
                $('#to_date').prop('readonly', true);
            }


            /*
            ==========================================
            CHECK ALL REQUIRED FIELDS
            ==========================================
            */

            function checkFeeSelection() {

                let programId = $('#program_id').val();

                let centerId = $('#center_id').val();

                let batchId = $('#batch_id').val();

                let frequency = $('#frequencyMonths').val();

                let fromDate = $('#from_date').val();

                let toDate = $('#to_date').val();


                /*
                 * All fields including To Date are required
                 *
                 * Normal frequency:
                 * To Date is calculated automatically
                 *
                 * Full Course:
                 * To Date is selected manually
                 */
                if (
                    programId &&
                    centerId &&
                    batchId &&
                    frequency !== '' &&
                    fromDate &&
                    toDate
                ) {

                    loadStudents();

                } else {

                    hideStudentSection();

                }

            }


            /*
            ==========================================
            LOAD STUDENTS
            ==========================================
            */

            function loadStudents() {

                let programId = $('#program_id').val();

                let centerId = $('#center_id').val();

                let batchId = $('#batch_id').val();

                let frequency = $('#frequencyMonths').val();

                let fromDate = $('#from_date').val();

                let toDate = $('#to_date').val();


                if (
                    !programId ||
                    !centerId ||
                    !batchId ||
                    frequency === '' ||
                    !fromDate ||
                    !toDate
                ) {

                    return;

                }


                $('#studentFeeSection').show();


                $('#studentTableBody').html(

                    '<tr>' +

                    '<td colspan="10" class="text-center">' +

                    '<div class="spinner-border text-primary"></div>' +

                    '<div class="mt-2">' +

                    'Loading students...' +

                    '</div>' +

                    '</td>' +

                    '</tr>'

                );


                $.ajax({

                    url: "<?= site_url('finance/fees/get-students'); ?>",

                    type: "POST",

                    data: {

                        program_id: programId,

                        center_id: centerId,

                        batch_id: batchId,

                        from_date: fromDate,

                        to_date: toDate

                    },

                    dataType: "json",


                    success: function(response) {

                        console.log("STUDENT RESPONSE:", response);


                        if (
                            response.status !== true ||
                            !response.data ||
                            response.data.length === 0
                        ) {

                            $('#studentTableBody').html(

                                '<tr>' +

                                '<td colspan="10" class="text-center text-danger">' +

                                'No active students found for this batch.' +

                                '</td>' +

                                '</tr>'

                            );

                            $('#studentCount').text('0 Students');

                            return;

                        }


                        let html = '';

                        let counter = 1;


                        $.each(response.data, function(index, student) {

                            let dueAmount =
                                parseFloat(student.due_amount) || 0;

                            let previousPending =
                                parseFloat(student.previous_pending_amount) || 0;

                            let paidAmount =
                                parseFloat(student.paid_amount) || 0;

                            let lateFine = parseFloat(student.late_fine) || 0;

                            let totalDue =
                                dueAmount + previousPending + lateFine;

                            let pendingAmount =
                                parseFloat(student.pending_amount);

                            if (isNaN(pendingAmount)) {

                                pendingAmount =
                                    totalDue - paidAmount;
                            }

                            let paidDate =
                                student.paid_date || '';

                            let remarks =
                                student.remarks || '';

                            let existingFee =
                                student.existing_fee === true;


                            html += '<tr>';


                            /*
                             * Number
                             */

                            html += '<td>';

                            html += counter++;

                            html += '</td>';



                            /*
                             * Student Name
                             */

                            html += '<td>';

                            html += escapeHtml(
                                student.First_Name
                            );

                            html += ' ';

                            html += escapeHtml(
                                student.Last_Name || ''
                            );

                            html += '</td>';



                            /*
                             * Paid Date
                             */

                            html += '<td>';

                            html +=

                                '<input ' +

                                'type="date" ' +

                                'class="form-control paid-date" ' +

                                'name="students[' +
                                index +
                                '][paid_date]" ' +

                                'value="' +
                                paidDate +
                                '" ' +

                                'max="<?= date('Y-m-d'); ?>">';

                            html += '</td>';


                            /*
                             * Previous Pending Amount
                             */

                            html += '<td>';

                            html +=

                                '<input ' +

                                'type="text" ' +

                                'class="form-control previous-pending-amount pending-highlight" ' +

                                'name="students[' +
                                index +
                                '][previous_pending_amount]" ' +

                                'value="' +
                                previousPending.toFixed(2) +
                                '" ' +

                                'readonly>';

                            html += '</td>';

                            /*
                             * Due Amount
                             */

                            html += '<td>';

                            html +=

                                '<input ' +

                                'type="number" ' +

                                'step="0.01" ' +

                                'min="0" ' +

                                'class="form-control student-fee-input due-amount current-due-amount editable-amount" ' +

                                'name="students[' +
                                index +
                                '][due_amount]" ' +

                                'data-index="' +
                                index +
                                '" ' +

                                'value="' +
                                dueAmount.toFixed(2) +
                                '">';

                            html +=

                                '<input ' +

                                'type="hidden" ' +

                                nameAttr(
                                    'students[' +
                                    index +
                                    '][student_id]'
                                ) +

                                'value="' +
                                escapeAttribute(
                                    student.Student_Id
                                ) +
                                '">';

                            html += '</td>';


                            /*
                             * Late Fine
                             */



                            html += '<td>';
                            html += '<input type="number" ';
                            html += 'class="form-control student-fee-input late-fine editable-amount" ';
                            html += 'name="students[' + index + '][late_fine]" ';
                            html += 'value="' + lateFine.toFixed(2) + '" ';
                            html += 'min="0" step="0.01">';
                            html += '</td>';


                            /*
                             * Total Due Amount
                             */

                            html += '<td>';

                            html +=

                                '<input ' +

                                'type="text" ' +

                                'class="form-control total-due-amount" ' +

                                'value="' +
                                totalDue.toFixed(2) +
                                '" ' +

                                'readonly>';

                            html += '</td>';


                            /*
                             * Paid Amount
                             */

                            html += '<td>';

                            html +=

                                '<input ' +

                                'type="number" ' +

                                'step="0.01" ' +

                                'min="0" ' +

                                'class="form-control student-fee-input paid-amount editable-amount" ' +

                                'name="students[' +
                                index +
                                '][paid_amount]" ' +

                                'data-index="' +
                                index +
                                '" ' +

                                'value="' +
                                paidAmount.toFixed(2) +
                                '">';

                            html += '</td>';


                            /*
                             * Pending Amount
                             */

                            html += '<td>';

                            html +=

                                '<input ' +

                                'type="text" ' +

                                'class="form-control pending-amount pending-highlight" ' +

                                'value="' +
                                pendingAmount.toFixed(2) +
                                '" ' +

                                'readonly>';

                            html += '</td>';


                            /*
                             * Remark
                             */

                            html += '<td>';

                            html +=

                                '<textarea ' +

                                'class="form-control remark-input" ' +

                                'name="students[' +
                                index +
                                '][remark]" ' +

                                'rows="3" ' +

                                'placeholder="Enter remark...">' +
                                escapeHtml(remarks) +
                                '</textarea>';

                            html += '</td>';
                        });


                        $('#studentTableBody').html(html);

                        $('#studentTableBody tr').each(function() {

                            updatePendingHighlight($(this));

                        });


                        $('#studentCount').text(
                            response.data.length +
                            ' Students'
                        );


                        /*
                         * Set hidden values
                         */

                        $('#hidden_program_id').val(programId);

                        $('#hidden_center_id').val(centerId);

                        $('#hidden_batch_id').val(batchId);

                        $('#hidden_frequency_months').val(frequency);

                        $('#hidden_from_date').val(fromDate);

                        $('#hidden_to_date').val(toDate);


                        /*
                         * Calculate pending
                         */

                        calculateAllPending();

                    },


                    error: function(xhr) {

                        console.log(
                            "STUDENT AJAX ERROR:",
                            xhr.responseText
                        );


                        $('#studentTableBody').html(

                            '<tr>' +

                            '<td colspan="10" class="text-center text-danger">' +

                            'Error loading students.' +

                            '</td>' +

                            '</tr>'

                        );

                    }

                });

            }


            /*
            ==========================================
            DUE / PAID -> PENDING
            ==========================================
            */

            $(document).on(
                'input',
                '.due-amount, .late-fine, .paid-amount',
                function() {

                    let row = $(this).closest('tr');

                    calculatePending(row);

                }
            );


            /*
            ==========================================
            CLEAR ZERO AMOUNT WHEN FIELD IS CLICKED
            ==========================================
            */

            $(document).on(
                'focus',
                '.editable-amount',
                function() {

                    let value = parseFloat($(this).val()) || 0;

                    /*
                     * If value is 0, clear it
                     */

                    if (value === 0) {

                        $(this).val('');

                    } else {

                        /*
                         * If amount already exists,
                         * select it so user can directly replace it
                         */

                        $(this).select();
                    }

                }
            );


            /*
            ==========================================
            IF USER LEAVES FIELD EMPTY, PUT 0.00 BACK
            ==========================================
            */

            $(document).on(
                'blur',
                '.editable-amount',
                function() {

                    let value = $(this).val().trim();

                    if (value === '') {

                        $(this).val('0.00');
                    }

                    let row = $(this).closest('tr');

                    calculatePending(row);

                }
            );

            /*
            ==========================================
            UPDATE PENDING COLOR
            ==========================================
            */

            function updatePendingHighlight(row) {

                let previousPending = parseFloat(
                    row.find('.previous-pending-amount').val()
                ) || 0;


                let pendingAmount = parseFloat(
                    row.find('.pending-amount').val()
                ) || 0;


                /*
                 * Previous Pending
                 */

                if (previousPending > 0) {

                    row.find('.previous-pending-amount')
                        .addClass('has-pending');

                } else {

                    row.find('.previous-pending-amount')
                        .removeClass('has-pending');
                }


                /*
                 * Pending Amount
                 */

                if (pendingAmount > 0) {

                    row.find('.pending-amount')
                        .addClass('has-pending');

                } else {

                    row.find('.pending-amount')
                        .removeClass('has-pending');
                }
            }


            function calculatePending(row) {

                let previousPending = parseFloat(
                    row.find('.previous-pending-amount').val()
                ) || 0;

                let dueAmount = parseFloat(
                    row.find('.due-amount').val()
                ) || 0;

                let lateFine = parseFloat(
                    row.find('.late-fine').val()
                ) || 0;

                let paidAmount = parseFloat(
                    row.find('.paid-amount').val()
                ) || 0;


                /*
                 * ======================================
                 * TOTAL DUE
                 *
                 * Previous Pending
                 * + Due Amount
                 * + Late Fine
                 * ======================================
                 */

                let totalDue =
                    previousPending +
                    dueAmount +
                    lateFine;


                /*
                 * Prevent Paid Amount from being
                 * greater than Total Due
                 */

                if (paidAmount > totalDue) {

                    paidAmount = totalDue;

                    row.find('.paid-amount').val(
                        paidAmount.toFixed(2)
                    );
                }


                /*
                 * PENDING AMOUNT
                 */

                let pendingAmount =
                    totalDue - paidAmount;

                if (pendingAmount < 0) {

                    pendingAmount = 0;
                }


                /*
                 * UPDATE TOTAL DUE BOX
                 */

                row.find('.total-due-amount').val(
                    totalDue.toFixed(2)
                );


                /*
                 * UPDATE PENDING AMOUNT BOX
                 */

                row.find('.pending-amount').val(
                    pendingAmount.toFixed(2)
                );


                /*
                 * UPDATE ORANGE HIGHLIGHT
                 */

                updatePendingHighlight(row);
            }


            function calculateAllPending() {

                $('#studentTableBody tr').each(function() {

                    calculatePending(
                        $(this)
                    );

                });

            }


            /*
            ==========================================
            SAVE FEES
            ==========================================
            */

            $('#saveFees').on('click', function() {


                let programId = $('#hidden_program_id').val();

                let centerId = $('#hidden_center_id').val();

                let batchId = $('#hidden_batch_id').val();

                let frequency = $('#hidden_frequency_months').val();

                let fromDate = $('#hidden_from_date').val();

                let toDate = $('#hidden_to_date').val();


                if (
                    !programId ||
                    !centerId ||
                    !batchId ||
                    frequency === '' ||
                    !fromDate ||
                    !toDate
                ) {

                    alert(
                        'Please select Program, Center, Batch, Frequency and From Date.'
                    );

                    return;

                }


                let hasInvalidAmount = false;


                $('#studentTableBody tr').each(function() {

                    let due = parseFloat(
                        $(this).find('.due-amount').val()
                    ) || 0;

                    let paid = parseFloat(
                        $(this).find('.paid-amount').val()
                    ) || 0;

                    let lateFine = parseFloat(
                        $(this).find('.late-fine').val()
                    ) || 0;

                    let paidDate = $(this)
                        .find('.paid-date')
                        .val();

                    let today = new Date()
                        .toISOString()
                        .split('T')[0];


                    /*
                    ==========================================
                    VALIDATE DUE AMOUNT
                    ==========================================
                    */

                    if (due <= 0) {

                        hasInvalidAmount = true;

                        $(this)
                            .find('.due-amount')
                            .addClass('is-invalid');

                    } else {

                        $(this)
                            .find('.due-amount')
                            .removeClass('is-invalid');

                    }


                    /*
                    ==========================================
                    VALIDATE PAID AMOUNT
                    ==========================================
                    */

                    let previousPending = parseFloat(
                        $(this)
                        .find('.previous-pending-amount')
                        .val()
                    ) || 0;


                    let totalDue =
                        due +
                        previousPending +
                        lateFine;

                    if (paid < 0 || paid > totalDue) {

                        hasInvalidAmount = true;

                        $(this)
                            .find('.paid-amount')
                            .addClass('is-invalid');

                    } else {

                        $(this)
                            .find('.paid-amount')
                            .removeClass('is-invalid');

                    }


                    /*
                    ==========================================
                    VALIDATE PAID DATE
                    ==========================================
                    */

                    if (paidDate && paidDate > today) {

                        hasInvalidAmount = true;

                        $(this)
                            .find('.paid-date')
                            .addClass('is-invalid');

                    } else {

                        $(this)
                            .find('.paid-date')
                            .removeClass('is-invalid');

                    }

                });


                if (hasInvalidAmount) {

                    alert(
                        'Please check Due Amount and Paid Amount and Fees Paid on for all students.'
                    );

                    return;

                }


                /*
                 * Make sure pending values are updated
                 */

                calculateAllPending();


                let button = $(this);


                button.prop(
                    'disabled',
                    true
                );


                button.html(
                    'Saving...'
                );


                $.ajax({

                    url: "<?= site_url('finance/fees/save'); ?>",

                    type: "POST",

                    data: $('#feesForm').serialize(),

                    dataType: "json",


                    success: function(response) {

                        console.log(
                            "SAVE RESPONSE:",
                            response
                        );


                        if (response.status === true) {

                            alert(
                                response.message +
                                "\n\nStudents Saved: " +
                                response.saved_count
                            );


                            /*
                             * Clear student table
                             */

                            $('#studentTableBody').html(

                                '<tr>' +

                                '<td colspan="10" class="text-center text-success">' +

                                'Fee records saved successfully.' +

                                '</td>' +

                                '</tr>'

                            );


                            $('#studentCount').text(
                                '0 Students'
                            );

                        } else {

                            alert(
                                response.message
                            );

                        }

                    },


                    error: function(xhr) {

                        console.log(
                            "SAVE ERROR:",
                            xhr.responseText
                        );


                        alert(
                            'Error saving fee records.'
                        );

                    },


                    complete: function() {

                        button.prop(
                            'disabled',
                            false
                        );


                        button.html(
                            '<i class="mdi mdi-content-save"></i> Save Fees'
                        );

                    }

                });

            });


            /*
            ==========================================
            FREQUENCY TEXT
            ==========================================
            */

            function getFrequencyText(months) {

                months = parseInt(months);


                switch (months) {

                    case 1:
                        return 'Monthly';

                    case 2:
                        return 'Every 2 Months';

                    case 3:
                        return 'Every 3 Months';

                    case 6:
                        return 'Every 6 Months';

                    case 12:
                        return 'Yearly';

                    default:
                        return months + ' Months';

                }

            }


            /*
            ==========================================
            ESCAPE HTML
            ==========================================
            */

            function escapeHtml(value) {

                if (value === null || value === undefined) {
                    return '';
                }

                return $('<div>')
                    .text(value)
                    .html();

            }


            function escapeAttribute(value) {

                if (value === null || value === undefined) {
                    return '';
                }

                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');

            }


            function nameAttr(value) {

                return 'name="' +
                    escapeAttribute(value) +
                    '"';

            }


            /*
            ==========================================
            HIDE STUDENT SECTION
            ==========================================
            */

            function hideStudentSection() {

                $('#studentFeeSection').hide();

                $('#studentTableBody').html(

                    '<tr>' +

                    '<td colspan="10" class="text-center text-muted">' +

                    'Select Program, Center, Batch, Frequency and From Date.'

                    +

                    '</td>' +

                    '</tr>'

                );

                $('#studentCount').text(
                    '0 Students'
                );

            }


        });
    </script>


    <?= view('includes/footer'); ?>