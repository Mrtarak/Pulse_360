ss<?= view('includes/header'); ?>
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
                            <!-- EDIT ASSESSMENT FORM -->
                            <!-- ========================================= -->

                            <form
                                action="<?= site_url('assessment/doosra-mauka/update') ?>"
                                method="post"
                                id="assessmentForm">

                                <?= csrf_field(); ?>


                                <!-- ========================================= -->
                                <!-- HIDDEN DATA -->
                                <!-- ========================================= -->

                                <input
                                    type="hidden"
                                    name="assessment_id"
                                    value="<?= esc($assessment['Student_Assessment_Id']) ?>">

                                <input
                                    type="hidden"
                                    name="student_id"
                                    value="<?= esc($student['Student_Id']) ?>">

                                <input
                                    type="hidden"
                                    name="program_id"
                                    value="<?= esc($student['Program_Id']) ?>">

                                <input
                                    type="hidden"
                                    name="center_id"
                                    value="<?= esc($student['Center_Id']) ?>">

                                <input
                                    type="hidden"
                                    name="batch_id"
                                    value="<?= esc($student['Batch_Id']) ?>">

                                <input
                                    type="hidden"
                                    name="assessment_type"
                                    value="<?= esc($assessmentType) ?>">

                                <input
                                    type="hidden"
                                    name="student_assessment_id"
                                    value="<?= esc($assessment['Student_Assessment_Id']) ?>">


                                <!-- ========================================= -->
                                <!-- HEADER -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-header d-flex justify-content-between align-items-center">

                                        <span>

                                            <i class="mdi mdi-school me-2"></i>

                                            Edit Doosra Mauka Assessment Result

                                        </span>

                                        <span class="badge bg-light text-dark">

                                            <?= esc($assessmentType) ?>

                                        </span>

                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- PERSONAL DETAILS -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">

                                        <div class="section-heading">

                                            <i class="mdi mdi-account me-2"></i>

                                            Personal Details

                                        </div>


                                        <div class="row align-items-center">


                                            <!-- STUDENT PHOTO -->

                                            <div class="col-md-3 text-center mb-3">

                                                <?php if (!empty($student['Photo_URL'])): ?>

                                                    <img
                                                        src="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                                        class="student-photo"
                                                        alt="Student Photo">

                                                <?php else: ?>

                                                    <div class="student-photo d-flex align-items-center justify-content-center mx-auto">

                                                        <i class="mdi mdi-account fs-1 text-muted"></i>

                                                    </div>

                                                <?php endif; ?>

                                            </div>


                                            <!-- STUDENT INFORMATION -->

                                            <div class="col-md-9">

                                                <div class="row">


                                                    <!-- STUDENT NAME -->

                                                    <div class="col-md-6 mb-3">

                                                        <label class="form-label">
                                                            Student Name
                                                        </label>

                                                        <input
                                                            type="text"
                                                            class="form-control readonly"
                                                            value="<?= esc(trim(
                                                                ($student['First_Name'] ?? '') .
                                                                ' ' .
                                                                ($student['Last_Name'] ?? '')
                                                            )) ?>"
                                                            readonly>

                                                    </div>


                                                    <!-- STUDENT ID -->

                                                    <div class="col-md-6 mb-3">

                                                        <label class="form-label">
                                                            Student ID
                                                        </label>

                                                        <input
                                                            type="text"
                                                            class="form-control readonly"
                                                            value="<?= esc($student['Student_Id']) ?>"
                                                            readonly>

                                                    </div>


                                                    <!-- CENTER -->

                                                    <div class="col-md-6 mb-3">

                                                        <label class="form-label">
                                                            Center
                                                        </label>

                                                        <input
                                                            type="text"
                                                            class="form-control readonly"
                                                            value="<?= esc($student['Center_Name'] ?? 'N/A') ?>"
                                                            readonly>

                                                    </div>


                                                    <!-- BATCH -->

                                                    <div class="col-md-6 mb-3">

                                                        <label class="form-label">
                                                            Batch
                                                        </label>

                                                        <input
                                                            type="text"
                                                            class="form-control readonly"
                                                            value="<?= esc($student['Batch_Name'] ?? 'N/A') ?>"
                                                            readonly>

                                                    </div>


                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- DOOSRA MAUKA RESULT -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">

                                        <div class="section-heading">

                                            <i class="mdi mdi-book-open-page-variant me-2"></i>

                                            Doosra Mauka Result

                                        </div>


                                        <div class="row">


                                            <!-- ASSESSMENT DATE -->

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">

                                                    Date of Assessment

                                                    <span class="required">*</span>

                                                </label>

                                                <input
                                                    type="date"
                                                    name="assessment_date"
                                                    class="form-control"
                                                    value="<?= esc($assessment['Assessment_Date'] ?? '') ?>"
                                                    max="<?= esc($today) ?>"
                                                    required>

                                            </div>


                                        </div>


                                        <?php

                                        $grades = [
                                            'A+',
                                            'A',
                                            'B+',
                                            'B',
                                            'C+',
                                            'C',
                                            'D'
                                        ];

                                        ?>


                                        <!-- ========================================= -->
                                        <!-- TAILORING -->
                                        <!-- ========================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                <i class="mdi mdi-content-cut me-2"></i>

                                                Tailoring

                                            </div>


                                            <div class="row">


                                                <!-- GRADE -->

                                                <div class="col-md-3 mb-3">

                                                    <label class="form-label">

                                                        Tailoring Grade

                                                    </label>


                                                    <select
                                                        name="tailoring_grade"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Grade
                                                        </option>


                                                        <?php foreach ($grades as $grade): ?>

                                                            <option
                                                                value="<?= esc($grade) ?>"
                                                                <?= (($assessment['Tailoring_Grade'] ?? '') === $grade)
                                                                    ? 'selected'
                                                                    : '' ?>>

                                                                <?= esc($grade) ?>

                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <!-- REMARK -->

                                                <div class="col-md-9 mb-3">

                                                    <label class="form-label">

                                                        Tailoring Remark

                                                    </label>


                                                    <textarea
                                                        name="tailoring_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter Tailoring remark"><?= esc(
                                                            $assessment['Tailoring_Remark'] ?? ''
                                                        ) ?></textarea>

                                                </div>


                                            </div>

                                        </div>


                                        <!-- ========================================= -->
                                        <!-- LITERACY -->
                                        <!-- ========================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                <i class="mdi mdi-book-open-variant me-2"></i>

                                                Literacy

                                            </div>


                                            <div class="row">


                                                <!-- GRADE -->

                                                <div class="col-md-3 mb-3">

                                                    <label class="form-label">

                                                        Literacy Grade

                                                    </label>


                                                    <select
                                                        name="literacy_grade"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Grade
                                                        </option>


                                                        <?php foreach ($grades as $grade): ?>

                                                            <option
                                                                value="<?= esc($grade) ?>"
                                                                <?= (($assessment['Literacy_Grade'] ?? '') === $grade)
                                                                    ? 'selected'
                                                                    : '' ?>>

                                                                <?= esc($grade) ?>

                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <!-- REMARK -->

                                                <div class="col-md-9 mb-3">

                                                    <label class="form-label">

                                                        Literacy Remark

                                                    </label>


                                                    <textarea
                                                        name="literacy_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter Literacy remark"><?= esc(
                                                            $assessment['Literacy_Remark'] ?? ''
                                                        ) ?></textarea>

                                                </div>


                                            </div>

                                        </div>


                                        <!-- ========================================= -->
                                        <!-- NUMERACY -->
                                        <!-- ========================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                <i class="mdi mdi-numeric me-2"></i>

                                                Numeracy

                                            </div>


                                            <div class="row">


                                                <!-- GRADE -->

                                                <div class="col-md-3 mb-3">

                                                    <label class="form-label">

                                                        Numeracy Grade

                                                    </label>


                                                    <select
                                                        name="numeracy_grade"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Grade
                                                        </option>


                                                        <?php foreach ($grades as $grade): ?>

                                                            <option
                                                                value="<?= esc($grade) ?>"
                                                                <?= (($assessment['Numeracy_Grade'] ?? '') === $grade)
                                                                    ? 'selected'
                                                                    : '' ?>>

                                                                <?= esc($grade) ?>

                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <!-- REMARK -->

                                                <div class="col-md-9 mb-3">

                                                    <label class="form-label">

                                                        Numeracy Remark

                                                    </label>


                                                    <textarea
                                                        name="numeracy_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter Numeracy remark"><?= esc(
                                                            $assessment['Numeracy_Remark'] ?? ''
                                                        ) ?></textarea>

                                                </div>


                                            </div>

                                        </div>


                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- SEL -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">

                                        <div class="section-heading">

                                            <i class="mdi mdi-heart me-2"></i>

                                            SEL

                                        </div>


                                        <!-- ========================================= -->
                                        <!-- RATING GUIDE -->
                                        <!-- ========================================= -->

                                        <div class="alert alert-light border mb-4">

                                            <strong>

                                                <i class="mdi mdi-information-outline me-1"></i>

                                                Rating Guide:

                                            </strong>


                                            <span class="ms-2">

                                                <strong>1</strong>
                                                = Needs Improvement

                                            </span>


                                            <span class="ms-3">

                                                <strong>2</strong>
                                                = Average

                                            </span>


                                            <span class="ms-3">

                                                <strong>3</strong>
                                                = Good

                                            </span>


                                            <span class="ms-3">

                                                <strong>4</strong>
                                                = Outstanding

                                            </span>

                                        </div>


                                        <?php

                                        $selFields = [

                                            'ethics' => [

                                                'title' =>
                                                    'Ethics',

                                                'question' =>
                                                    'Does the child choose to do the right thing, even when no one is watching?',

                                                'dbField' =>
                                                    'Ethics'

                                            ],

                                            'empathy' => [

                                                'title' =>
                                                    'Empathy',

                                                'question' =>
                                                    'Does the child understand and care about how others feel?',

                                                'dbField' =>
                                                    'Empathy'

                                            ],

                                            'excellence' => [

                                                'title' =>
                                                    'Excellence',

                                                'question' =>
                                                    'Does the participant always try to do their best and improve?',

                                                'dbField' =>
                                                    'Excellence'

                                            ],

                                            'eagerness' => [

                                                'title' =>
                                                    'Eagerness',

                                                'question' =>
                                                    'Does the child show curiosity and enthusiasm to learn and participate?',

                                                'dbField' =>
                                                    'Eagerness'

                                            ]

                                        ];

                                        ?>


                                        <div class="row">


                                            <?php foreach (
                                                $selFields as $field => $details
                                            ): ?>


                                                <?php

                                                $currentRating =
                                                    $assessment[
                                                        $details['dbField']
                                                    ] ?? '';

                                                ?>


                                                <div class="col-md-6 mb-4">


                                                    <label class="form-label">

                                                        <?= esc(
                                                            $details['title']
                                                        ) ?>

                                                    </label>


                                                    <small
                                                        class="d-block text-muted mb-2">

                                                        <?= esc(
                                                            $details['question']
                                                        ) ?>

                                                    </small>


                                                    <select
                                                        name="<?= esc($field) ?>"
                                                        class="form-select">

                                                        <option value="">

                                                            Select Rating

                                                        </option>


                                                        <?php for (
                                                            $i = 1;
                                                            $i <= 4;
                                                            $i++
                                                        ): ?>

                                                            <option
                                                                value="<?= $i ?>"
                                                                <?= (
                                                                    (string) $currentRating ===
                                                                    (string) $i
                                                                )
                                                                    ? 'selected'
                                                                    : '' ?>>

                                                                <?= $i ?>

                                                            </option>

                                                        <?php endfor; ?>

                                                    </select>

                                                </div>


                                            <?php endforeach; ?>


                                        </div>


                                        <!-- ========================================= -->
                                        <!-- SEL REMARKS -->
                                        <!-- ========================================= -->

                                        <div class="mb-3">

                                            <label class="form-label">

                                                Remarks on SEL Assessments

                                            </label>


                                            <textarea
                                                name="sel_remarks"
                                                class="form-control"
                                                rows="4"
                                                placeholder="Enter remarks on SEL assessments"><?= esc(
                                                    $assessment['SEL_Remarks'] ?? ''
                                                ) ?></textarea>

                                        </div>


                                        <!-- ========================================= -->
                                        <!-- ASSESSED BY -->
                                        <!-- ========================================= -->

                                        <div class="mb-3">

                                            <label class="form-label">

                                                Assessed By

                                            </label>


                                            <input
                                                type="text"
                                                name="assessed_by"
                                                class="form-control"
                                                value="<?= esc(
                                                    $assessment['Assessed_By'] ?? ''
                                                ) ?>"
                                                placeholder="Enter assessor details">

                                        </div>


                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- UPDATE BUTTON -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm">

                                    <div class="card-footer bg-white d-flex justify-content-end">


                                        <!-- CANCEL -->

                                        <a
                                            href="<?= site_url(
                                                'assessment/doosra-mauka/view/' .
                                                $assessment['Student_Assessment_Id']
                                            ) ?>"
                                            class="btn btn-light me-2">

                                            <i class="mdi mdi-arrow-left me-2"></i>

                                            Cancel

                                        </a>


                                        <!-- UPDATE -->

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-save">

                                            <i class="mdi mdi-content-save-edit me-2"></i>

                                            Update Assessment Result

                                        </button>


                                    </div>

                                </div>


                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<?= view('includes/footer'); ?>


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


    .section-heading {
        color: #4B49AC;
        font-size: 17px;
        font-weight: 600;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }


    .form-label {
        font-weight: 500;
    }


    .required {
        color: #dc3545;
    }


    .readonly {
        background: #f8f9fa !important;
    }


    /* ================= PHOTO ================= */

    .student-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        background: #f8f9fa;
    }


    /* ================= SUBJECT ================= */

    .subject-row {
        background: #f8f9fa;
        border: 1px solid #e6e8ec;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 14px;
    }


    .subject-title {
        color: #4B49AC;
        font-weight: 600;
        margin-bottom: 12px;
    }


    /* ================= INFO BADGE ================= */

    .info-badge {
        background: #eef2ff;
        color: #4B49AC;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }


    /* ================= BUTTON ================= */

    .btn-save {
        padding: 10px 35px;
    }


    /* ================= TEXTAREA ================= */

    textarea {
        resize: vertical;
    }

</style>
