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
                            <!-- ASSESSMENT FORM -->
                            <!-- ========================================= -->

                            <form
                                action="<?= site_url('assessment/doosra-mauka/save') ?>"
                                method="post"
                                id="assessmentForm">

                                <?= csrf_field(); ?>


                                <!-- ========================================= -->
                                <!-- HIDDEN DATA -->
                                <!-- ========================================= -->

                                <input
                                    type="hidden"
                                    name="student_id"
                                    value="<?= esc($student['Student_Id']) ?>">

                                <input
                                    type="hidden"
                                    name="program_id"
                                    value="<?= esc($programId) ?>">

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


                                <!-- ========================================= -->
                                <!-- HEADER -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-header d-flex justify-content-between align-items-center">

                                        <span>

                                            <i class="mdi mdi-school me-2"></i>

                                            Doosra Mauka Assessment Result

                                        </span>

                                        <span class="badge bg-light text-dark">

                                            <?= esc($assessmentType) ?>

                                        </span>

                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- PERSONAL DETAILS -->
                                <!-- SAME UI AS LEARNING ADDA -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">

                                        <div class="section-heading">

                                            <i class="mdi mdi-account me-2"></i>

                                            Personal Details

                                        </div>


                                        <div class="row align-items-center">


                                            <!-- ================================= -->
                                            <!-- STUDENT PHOTO -->
                                            <!-- ================================= -->

                                            <div class="col-md-3 text-center mb-3">

                                                <?php if (!empty($student['Photo_URL'])): ?>

                                                    <img
                                                        src="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                                        class="student-photo"
                                                        alt="Student Photo">

                                                <?php else: ?>

                                                    <div
                                                        class="student-photo d-flex align-items-center justify-content-center mx-auto">

                                                        <i class="mdi mdi-account fs-1 text-muted"></i>

                                                    </div>

                                                <?php endif; ?>

                                            </div>


                                            <!-- ================================= -->
                                            <!-- STUDENT INFORMATION -->
                                            <!-- ================================= -->

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
                                                            value="<?= esc(
                                                                        trim(
                                                                            $student['First_Name'] . ' ' .
                                                                                $student['Last_Name']
                                                                        )
                                                                    ) ?>"
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
                                                            value="<?= esc($student['Center_Name']) ?>"
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
                                                            value="<?= esc($student['Batch_Name']) ?>"
                                                            readonly>

                                                    </div>


                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- ASSESSMENT DETAILS -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">

                                        <div class="section-heading">

                                            <i class="mdi mdi-book-open-page-variant me-2"></i>

                                            Assessment Details

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
                                                    value="<?= esc(old('assessment_date', $today)) ?>"
                                                    max="<?= esc($today) ?>"
                                                    required>

                                            </div>


                                            <!-- ASSESSMENT TYPE -->

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">

                                                    Assessment Type

                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control readonly"
                                                    value="<?= esc($assessmentType) ?>"
                                                    readonly>

                                            </div>


                                        </div>

                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- SKILL ASSESSMENT -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">

                                        <div class="section-heading">

                                            <i class="mdi mdi-school-outline me-2"></i>

                                            Skill Assessment

                                        </div>


                                        <!-- ================================= -->
                                        <!-- TAILORING -->
                                        <!-- ================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                Tailoring

                                            </div>


                                            <div class="row">

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

                                                        <?php foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D'] as $grade): ?>

                                                            <option
                                                                value="<?= esc($grade) ?>"
                                                                <?= old('tailoring_grade') === $grade ? 'selected' : '' ?>>

                                                                <?= esc($grade) ?>

                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-9 mb-3">

                                                    <label class="form-label">

                                                        Tailoring Remark

                                                    </label>

                                                    <textarea
                                                        name="tailoring_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        maxlength="500"
                                                        placeholder="Enter Tailoring remark"><?= esc(old('tailoring_remark')) ?></textarea>

                                                </div>

                                            </div>

                                        </div>


                                        <!-- ================================= -->
                                        <!-- LITERACY -->
                                        <!-- ================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                Literacy

                                            </div>


                                            <div class="row">

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

                                                        <?php foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D'] as $grade): ?>

                                                            <option
                                                                value="<?= esc($grade) ?>"
                                                                <?= old('literacy_grade') === $grade ? 'selected' : '' ?>>

                                                                <?= esc($grade) ?>

                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-9 mb-3">

                                                    <label class="form-label">

                                                        Literacy Remark

                                                    </label>

                                                    <textarea
                                                        name="literacy_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        maxlength="500"
                                                        placeholder="Enter Literacy remark"><?= esc(old('literacy_remark')) ?></textarea>

                                                </div>

                                            </div>

                                        </div>


                                        <!-- ================================= -->
                                        <!-- NUMERACY -->
                                        <!-- ================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                Numeracy

                                            </div>


                                            <div class="row">

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

                                                        <?php foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D'] as $grade): ?>

                                                            <option
                                                                value="<?= esc($grade) ?>"
                                                                <?= old('numeracy_grade') === $grade ? 'selected' : '' ?>>

                                                                <?= esc($grade) ?>

                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-9 mb-3">

                                                    <label class="form-label">

                                                        Numeracy Remark

                                                    </label>

                                                    <textarea
                                                        name="numeracy_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        maxlength="500"
                                                        placeholder="Enter Numeracy remark"><?= esc(old('numeracy_remark')) ?></textarea>

                                                </div>

                                            </div>

                                        </div>


                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- SEL -->
                                <!-- EXACT SAME AS LEARNING ADDA -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">

                                        <div class="section-heading">

                                            <i class="mdi mdi-heart me-2"></i>

                                            SEL

                                        </div>


                                        <!-- ================================= -->
                                        <!-- RATING GUIDE -->
                                        <!-- ================================= -->

                                        <div class="alert alert-light border mb-4">

                                            <strong>

                                                <i class="mdi mdi-information-outline me-1"></i>

                                                Rating Guide:

                                            </strong>


                                            <span class="ms-2">

                                                <strong>1</strong> = Needs Improvement

                                            </span>


                                            <span class="ms-3">

                                                <strong>2</strong> = Average

                                            </span>


                                            <span class="ms-3">

                                                <strong>3</strong> = Good

                                            </span>


                                            <span class="ms-3">

                                                <strong>4</strong> = Outstanding

                                            </span>

                                        </div>


                                        <?php

                                        $selFields = [

                                            'ethics' => [

                                                'title' => 'Ethics',

                                                'question' =>
                                                'Does the child choose to do the right thing, even when no one is watching?'

                                            ],

                                            'empathy' => [

                                                'title' => 'Empathy',

                                                'question' =>
                                                'Does the child understand and care about how others feel?'

                                            ],

                                            'excellence' => [

                                                'title' => 'Excellence',

                                                'question' =>
                                                'Does the participant always try to do their best and improve?'

                                            ],

                                            'eagerness' => [

                                                'title' => 'Eagerness',

                                                'question' =>
                                                'Does the child show curiosity and enthusiasm to learn and participate?'

                                            ]

                                        ];

                                        ?>


                                        <!-- ================================= -->
                                        <!-- SEL RATINGS -->
                                        <!-- ================================= -->

                                        <div class="row">

                                            <?php foreach ($selFields as $field => $details): ?>

                                                <div class="col-md-6 mb-4">

                                                    <label class="form-label">

                                                        <?= esc($details['title']) ?>

                                                    </label>


                                                    <small class="d-block text-muted mb-2">

                                                        <?= esc($details['question']) ?>

                                                    </small>


                                                    <select
                                                        name="<?= esc($field) ?>"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Rating
                                                        </option>

                                                        <?php for ($rating = 1; $rating <= 4; $rating++): ?>

                                                            <option
                                                                value="<?= $rating ?>"
                                                                <?= old($field) == $rating ? 'selected' : '' ?>>

                                                                <?= $rating ?>

                                                            </option>

                                                        <?php endfor; ?>

                                                    </select>

                                                </div>

                                            <?php endforeach; ?>

                                        </div>


                                        <!-- ================================= -->
                                        <!-- SEL REMARKS -->
                                        <!-- ================================= -->

                                        <div class="mb-3">

                                            <label class="form-label">

                                                Remarks on SEL Assessments

                                            </label>

                                            <textarea
                                                name="sel_remarks"
                                                class="form-control"
                                                rows="4"
                                                maxlength="500"
                                                placeholder="Enter remarks on SEL assessments"><?= esc(old('sel_remarks')) ?></textarea>

                                        </div>


                                        <!-- ================================= -->
                                        <!-- ASSESSED BY -->
                                        <!-- ================================= -->

                                        <div class="mb-3">

                                            <label class="form-label">

                                                Assessed By

                                            </label>

                                            <input
                                                type="text"
                                                name="assessed_by"
                                                class="form-control"
                                                maxlength="100"
                                                placeholder="Enter assessor details"
                                                value="<?= esc(old('assessed_by')) ?>">

                                        </div>


                                    </div>

                                </div>


                                <!-- ========================================= -->
                                <!-- SAVE BUTTON -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm">

                                    <div class="card-footer bg-white d-flex justify-content-end">

                                        <a
                                            href="<?= site_url('assessment/doosra-mauka') ?>"
                                            class="btn btn-light me-2">

                                            <i class="mdi mdi-arrow-left me-2"></i>

                                            Back

                                        </a>


                                        <button
                                            type="submit"
                                            class="btn btn-success btn-save">

                                            <i class="mdi mdi-content-save me-2"></i>

                                            Save Assessment Result

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

    .student-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        background: #f8f9fa;
    }

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

    .info-badge {
        background: #eef2ff;
        color: #4B49AC;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-save {
        padding: 10px 35px;
    }

    textarea {
        resize: vertical;
    }
</style>