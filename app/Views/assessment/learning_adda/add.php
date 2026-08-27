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
                                action="<?= site_url('assessment/learning-adda/save') ?>"
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


                                <!-- ========================================= -->
                                <!-- HEADER -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-header d-flex justify-content-between align-items-center">

                                        <span>

                                            <i class="mdi mdi-school me-2"></i>

                                            Learning Adda Assessment Result

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

                                            <!-- STUDENT PHOTO -->

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



                                            <!-- STUDENT INFORMATION -->

                                            <div class="col-md-9">

                                                <div class="row">


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
                                <!-- EDUCATION RESULT -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">

                                        <div class="section-heading">

                                            <i class="mdi mdi-book-open-page-variant me-2"></i>

                                            Education Result

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
                                                    value="<?= esc($today) ?>"
                                                    max="<?= esc($today) ?>"
                                                    required>

                                            </div>



                                            <!-- STUDENT CLASS -->

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">

                                                    Grade (Class)

                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control readonly"
                                                    value="<?= !empty($student['Student_Class'])
                                                                ? 'Class ' . esc($student['Student_Class'])
                                                                : '' ?>"
                                                    readonly>

                                            </div>

                                        </div>



                                        <!-- ========================================= -->
                                        <!-- ENGLISH -->
                                        <!-- ========================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                English

                                            </div>


                                            <div class="row">


                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">

                                                        English Level

                                                    </label>

                                                    <select
                                                        name="english_level"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Level
                                                        </option>

                                                        <?php
                                                        $levels = [
                                                            'KG',
                                                            'Class 1',
                                                            'Class 2',
                                                            'Class 3',
                                                            'Class 4',
                                                            'Class 5',
                                                            'Class 6',
                                                            'Class 7',
                                                            'Class 8',
                                                            'Class 9',
                                                            'Class 10',
                                                            'Class 11',
                                                            'Class 12',
                                                            'N/A'
                                                        ];
                                                        ?>

                                                        <?php foreach ($levels as $level): ?>

                                                            <option
                                                                value="<?= esc($level) ?>">

                                                                <?= esc($level) ?>

                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>



                                                <div class="col-md-3 mb-3">

                                                    <label class="form-label">

                                                        English Grade

                                                    </label>

                                                    <select
                                                        name="english_grade"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Grade
                                                        </option>

                                                        <?php foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D'] as $grade): ?>

                                                            <option
                                                                value="<?= esc($grade) ?>">

                                                                <?= esc($grade) ?>

                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>



                                                <div class="col-md-5 mb-3">

                                                    <label class="form-label">

                                                        English Remark

                                                    </label>

                                                    <textarea
                                                        name="english_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter English remark"></textarea>

                                                </div>

                                            </div>

                                        </div>



                                        <!-- ========================================= -->
                                        <!-- MATH -->
                                        <!-- ========================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                Math

                                            </div>


                                            <div class="row">


                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">
                                                        Math Level
                                                    </label>

                                                    <select
                                                        name="math_level"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Level
                                                        </option>

                                                        <?php foreach ($levels as $level): ?>

                                                            <option value="<?= esc($level) ?>">
                                                                <?= esc($level) ?>
                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-3 mb-3">

                                                    <label class="form-label">
                                                        Math Grade
                                                    </label>

                                                    <select
                                                        name="math_grade"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Grade
                                                        </option>

                                                        <?php foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D'] as $grade): ?>

                                                            <option value="<?= esc($grade) ?>">
                                                                <?= esc($grade) ?>
                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-5 mb-3">

                                                    <label class="form-label">
                                                        Math Remark
                                                    </label>

                                                    <textarea
                                                        name="math_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter Math remark"></textarea>

                                                </div>

                                            </div>

                                        </div>



                                        <!-- ========================================= -->
                                        <!-- HINDI -->
                                        <!-- ========================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">
                                                Hindi
                                            </div>

                                            <div class="row">

                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">
                                                        Hindi Level
                                                    </label>

                                                    <select
                                                        name="hindi_level"
                                                        class="form-select">

                                                        <option value="">Select Level</option>

                                                        <?php foreach ($levels as $level): ?>

                                                            <option value="<?= esc($level) ?>">
                                                                <?= esc($level) ?>
                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-3 mb-3">

                                                    <label class="form-label">
                                                        Hindi Grade
                                                    </label>

                                                    <select
                                                        name="hindi_grade"
                                                        class="form-select">

                                                        <option value="">Select Grade</option>

                                                        <?php foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D'] as $grade): ?>

                                                            <option value="<?= esc($grade) ?>">
                                                                <?= esc($grade) ?>
                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-5 mb-3">

                                                    <label class="form-label">
                                                        Hindi Remark
                                                    </label>

                                                    <textarea
                                                        name="hindi_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter Hindi remark"></textarea>

                                                </div>

                                            </div>

                                        </div>



                                        <!-- ========================================= -->
                                        <!-- MARATHI -->
                                        <!-- ========================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">
                                                Marathi
                                            </div>

                                            <div class="row">

                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">
                                                        Marathi Level
                                                    </label>

                                                    <select
                                                        name="marathi_level"
                                                        class="form-select">

                                                        <option value="">Select Level</option>

                                                        <?php foreach ($levels as $level): ?>

                                                            <option value="<?= esc($level) ?>">
                                                                <?= esc($level) ?>
                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-3 mb-3">

                                                    <label class="form-label">
                                                        Marathi Grade
                                                    </label>

                                                    <select
                                                        name="marathi_grade"
                                                        class="form-select">

                                                        <option value="">Select Grade</option>

                                                        <?php foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D'] as $grade): ?>

                                                            <option value="<?= esc($grade) ?>">
                                                                <?= esc($grade) ?>
                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-5 mb-3">

                                                    <label class="form-label">
                                                        Marathi Remark
                                                    </label>

                                                    <textarea
                                                        name="marathi_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter Marathi remark"></textarea>

                                                </div>

                                            </div>

                                        </div>



                                        <!-- ========================================= -->
                                        <!-- DIGITAL SHAKTI -->
                                        <!-- ========================================= -->

                                        <div class="subject-row">

                                            <div class="subject-title">

                                                Digital Shakti

                                                <span class="info-badge ms-2">
                                                    Computer
                                                </span>

                                            </div>


                                            <div class="row">

                                                <div class="col-md-3 mb-3">

                                                    <label class="form-label">
                                                        Digital Shakti Grade
                                                    </label>

                                                    <select
                                                        name="digital_shakti_grade"
                                                        class="form-select">

                                                        <option value="">
                                                            Select Grade
                                                        </option>

                                                        <?php foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D'] as $grade): ?>

                                                            <option value="<?= esc($grade) ?>">
                                                                <?= esc($grade) ?>
                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>


                                                <div class="col-md-9 mb-3">

                                                    <label class="form-label">

                                                        Remarks on Digital Shakti Assessments

                                                    </label>

                                                    <textarea
                                                        name="digital_shakti_remark"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter Digital Shakti assessment remarks"></textarea>

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

                                        <div class="alert alert-light border mb-4">

                                            <strong>
                                                <i class="mdi mdi-information-outline me-1"></i>
                                                Rating Guide:
                                            </strong>

                                            <span class="ms-2">
                                                <strong>1</strong> = Need Improvement
                                            </span>

                                            <span class="ms-3">
                                                <strong>2</strong> = Good
                                            </span>

                                            <span class="ms-3">
                                                <strong>3</strong> = Excellent
                                            </span>

                                            <span class="ms-3">
                                                <strong>4</strong> = Outstanding
                                            </span>

                                        </div>


                                        <div class="row">

                                            <?php
                                            $selFields = [
                                                'ethics' => [
                                                    'title' => 'Ethics',
                                                    'question' => 'Does the child choose to do the right thing, even when no one is watching?'
                                                ],
                                                'empathy' => [
                                                    'title' => 'Empathy',
                                                    'question' => 'Does the child understand and care about how others feel?'
                                                ],
                                                'excellence' => [
                                                    'title' => 'Excellence',
                                                    'question' => 'Does the participant always try to do their best and improve?'
                                                ],
                                                'eagerness' => [
                                                    'title' => 'Eagerness',
                                                    'question' => 'Does the child show curiosity and enthusiasm to learn and participate?'
                                                ]
                                            ];
                                            ?>


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

                                                        <option value="1">
                                                            1
                                                        </option>

                                                        <option value="2">
                                                            2
                                                        </option>

                                                        <option value="3">
                                                            3
                                                        </option>

                                                        <option value="4">
                                                            4
                                                        </option>

                                                    </select>

                                                </div>

                                            <?php endforeach; ?>

                                        </div>



                                        <!-- SEL REMARKS -->

                                        <div class="mb-3">

                                            <label class="form-label">

                                                Remarks on SEL Assessments

                                            </label>

                                            <textarea
                                                name="sel_remarks"
                                                class="form-control"
                                                rows="4"
                                                placeholder="Enter remarks on SEL assessments"></textarea>

                                        </div>



                                        <!-- ASSESSED BY -->

                                        <div class="mb-3">

                                            <label class="form-label">

                                                Assessed By

                                            </label>

                                            <input
                                                type="text"
                                                name="assessed_by"
                                                class="form-control"
                                                placeholder="Enter assessor details">

                                        </div>

                                    </div>

                                </div>



                                <!-- ========================================= -->
                                <!-- SAVE BUTTON -->
                                <!-- ========================================= -->

                                <div class="card shadow-sm">

                                    <div class="card-footer bg-white d-flex justify-content-end">

                                        <a
                                            href="<?= site_url('assessment/learning-adda') ?>"
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