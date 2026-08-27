<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>


<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>


    <div class="main-panel">

        <div class="content-wrapper">

            <div class="row">

                <div class="col-12">

                    <?= view('includes/breadcrumb'); ?>

                    <?= view('includes/messages'); ?>


                    <?php

                    /* =====================================================
                       STUDENT INFORMATION
                    ===================================================== */

                    $studentName = $student['Student_Name'] ?? 'N/A';

                    $programName =
                        $student['Program_Name'] ??
                        'Learning Adda';

                    $centerName =
                        $student['Center_Name'] ??
                        'N/A';

                    $batchName =
                        $student['Batch_Name'] ??
                        'N/A';

                    $studentClass = !empty($student['Student_Class'])
                        ? 'Class ' . $student['Student_Class']
                        : 'N/A';


                    /* =====================================================
                       STUDENT PHOTO
                    ===================================================== */

                    $photoUrl = '';

                    if (!empty($student['Photo_URL'])) {

                        $photoUrl = base_url(
                            'uploads/students/photos/' .
                                $student['Photo_URL']
                        );
                    }

                    ?>


                    <!-- =========================================
                         HEADER
                    ========================================== -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">

                            <i class="mdi mdi-account-school me-2"></i>

                            Learning Adda - Student Assessment View

                        </div>

                    </div>



                    <!-- =========================================
                         PERSONAL DETAILS
                    ========================================== -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-body">


                            <div class="title">

                                Personal Details

                            </div>


                            <div class="row align-items-center">


                                <!-- PHOTO -->

                                <div class="col-md-2 text-center mb-3 mb-md-0">

                                    <?php if (!empty($photoUrl)): ?>

                                        <img
                                            src="<?= esc($photoUrl) ?>"
                                            class="photo"
                                            alt="<?= esc($studentName) ?>">

                                    <?php else: ?>

                                        <div
                                            class="photo-placeholder">

                                            <i class="mdi mdi-account fs-1"></i>

                                        </div>

                                    <?php endif; ?>

                                </div>



                                <!-- STUDENT DETAILS -->

                                <div class="col-md-10">


                                    <div class="student-name">

                                        <?= esc($studentName) ?>

                                    </div>


                                    <div class="row mt-3 g-3">


                                        <!-- PROGRAM -->

                                        <div class="col-md-3">

                                            <small>
                                                PROGRAM
                                            </small>

                                            <br>

                                            <b>

                                                <?= esc($programName) ?>

                                            </b>

                                        </div>



                                        <!-- CENTER -->

                                        <div class="col-md-3">

                                            <small>
                                                CENTER
                                            </small>

                                            <br>

                                            <b>

                                                <?= esc($centerName) ?>

                                            </b>

                                        </div>



                                        <!-- BATCH -->

                                        <div class="col-md-3">

                                            <small>
                                                BATCH
                                            </small>

                                            <br>

                                            <b>

                                                <?= esc($batchName) ?>

                                            </b>

                                        </div>



                                        <!-- CLASS -->

                                        <div class="col-md-3">

                                            <small>
                                                CLASS
                                            </small>

                                            <br>

                                            <b>

                                                <?= esc($studentClass) ?>

                                            </b>

                                        </div>


                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =========================================
                         COLOUR CODE
                    ========================================== -->

                    <div class="card shadow-sm mb-3">

                        <div class="card-body legend">


                            <b>
                                Colour Code:
                            </b>


                            <span>

                                <i
                                    class="dot dot-below">
                                </i>

                                Below class level

                            </span>


                            <span>

                                <i
                                    class="dot dot-same">
                                </i>

                                Same level

                            </span>


                            <span>

                                <i
                                    class="dot dot-above">
                                </i>

                                Above class level

                            </span>


                        </div>

                    </div>



                    <!-- =========================================
                         ASSESSMENT TABS
                    ========================================== -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-body">


                            <!-- =========================
                                 TAB NAVIGATION
                            ========================== -->

                            <ul class="nav nav-tabs">


                                <?php

                                $assessmentTypes = [

                                    'Baseline',

                                    'Midline',

                                    'Endline'

                                ];

                                ?>


                                <?php foreach ($assessmentTypes as $type): ?>

                                    <?php
                                    $tabAssessment = $assessments[$type] ?? null;

                                    $tabAssessmentId = $tabAssessment['Student_Assessment_Id'] ?? '';
                                    ?>

                                    <li class="nav-item">

                                        <button
                                            class="nav-link <?= $activeAssessmentType === $type ? 'active' : '' ?>"
                                            data-bs-toggle="tab"
                                            data-bs-target="#<?= strtolower($type) ?>"
                                            data-assessment-id="<?= esc($tabAssessmentId) ?>"
                                            type="button">

                                            <?= esc($type) ?>

                                        </button>

                                    </li>

                                <?php endforeach; ?>


                            </ul>



                            <!-- =========================
                                 TAB CONTENT
                            ========================== -->

                            <div class="tab-content">


                                <?php foreach (
                                    $assessmentTypes as $type
                                ): ?>


                                    <?php

                                    $assessment =
                                        $assessments[$type] ?? null;

                                    $tabId =
                                        strtolower($type);

                                    ?>


                                    <div
                                        class="tab-pane fade <?= $activeAssessmentType === $type ? 'show active' : '' ?> p-3"
                                        id="<?= $tabId ?>">


                                        <?php if ($assessment): ?>


                                            <!-- =========================================
                                                 COMPLETED HEADER
                                            ========================================== -->

                                            <div
                                                class="d-flex justify-content-between align-items-center mb-3">


                                                <h5 class="mb-0">

                                                    <?= esc($type) ?>

                                                    Assessment

                                                </h5>


                                                <span class="badge bg-success">

                                                    Completed

                                                </span>


                                            </div>



                                            <!-- =========================================
                                                 DATE + CLASS
                                            ========================================== -->

                                            <p class="mb-4">


                                                <b>
                                                    Date:
                                                </b>

                                                <?= !empty($assessment['Assessment_Date'])
                                                    ? date(
                                                        'd/m/Y',
                                                        strtotime(
                                                            $assessment['Assessment_Date']
                                                        )
                                                    )
                                                    : 'N/A'
                                                ?>


                                                <span class="ms-3">

                                                    <b>
                                                        Class:
                                                    </b>

                                                    <?= esc($studentClass) ?>

                                                </span>


                                            </p>



                                            <!-- =========================================
                                                 EDUCATION RESULT
                                            ========================================== -->

                                            <div class="title">
                                                <i class="mdi mdi-book-open-page-variant me-2"></i>
                                                Education Result
                                            </div>



                                            <?php

                                            $subjects = [

                                                [
                                                    'name' => 'English',
                                                    'level' => 'English_Level',
                                                    'grade' => 'English_Grade',
                                                    'remark' => 'English_Remark'
                                                ],

                                                [
                                                    'name' => 'Math',
                                                    'level' => 'Math_Level',
                                                    'grade' => 'Math_Grade',
                                                    'remark' => 'Math_Remark'
                                                ],

                                                [
                                                    'name' => 'Hindi',
                                                    'level' => 'Hindi_Level',
                                                    'grade' => 'Hindi_Grade',
                                                    'remark' => 'Hindi_Remark'
                                                ],

                                                [
                                                    'name' => 'Marathi',
                                                    'level' => 'Marathi_Level',
                                                    'grade' => 'Marathi_Grade',
                                                    'remark' => 'Marathi_Remark'
                                                ]

                                            ];

                                            ?>


                                            <!-- =========================================
                                                 SUBJECTS
                                            ========================================== -->

                                            <?php foreach (
                                                $subjects as $subject
                                            ): ?>


                                                <?php

                                                $level =
                                                    $assessment[$subject['level']] ?? '';

                                                $grade =
                                                    $assessment[$subject['grade']] ?? '';

                                                $remark =
                                                    $assessment[$subject['remark']] ?? '';


                                                /*
                                                 * Determine level colour.
                                                 */

                                                $levelClass =
                                                    getAssessmentLevelClass(
                                                        $level,
                                                        $studentClass
                                                    );

                                                ?>


                                                <div class="subject-row">


                                                    <b>

                                                        <?= esc(
                                                            $subject['name']
                                                        ) ?>

                                                    </b>


                                                    <div class="row mt-2">


                                                        <!-- LEVEL -->

                                                        <div class="col-md-4 mb-3 mb-md-0">


                                                            <small>

                                                                <?= esc(
                                                                    $subject['name']
                                                                ) ?>

                                                                Level

                                                            </small>

                                                            <br>


                                                            <?php if (
                                                                !empty($level)
                                                            ): ?>


                                                                <span
                                                                    class="level <?= esc($levelClass) ?>">

                                                                    <?= esc($level) ?>

                                                                </span>


                                                            <?php else: ?>

                                                                <span class="na">

                                                                    N/A

                                                                </span>

                                                            <?php endif; ?>


                                                        </div>



                                                        <!-- GRADE -->

                                                        <div class="col-md-3 mb-3 mb-md-0">


                                                            <small>

                                                                <?= esc(
                                                                    $subject['name']
                                                                ) ?>

                                                                Grade

                                                            </small>

                                                            <br>


                                                            <?php if (
                                                                !empty($grade)
                                                            ): ?>


                                                                <span class="grade-badge">

                                                                    <?= esc($grade) ?>

                                                                </span>


                                                            <?php else: ?>

                                                                <span class="na">

                                                                    N/A

                                                                </span>

                                                            <?php endif; ?>


                                                        </div>



                                                        <!-- REMARK -->

                                                        <div class="col-md-5">


                                                            <small>

                                                                <?= esc(
                                                                    $subject['name']
                                                                ) ?>

                                                                Remark

                                                            </small>


                                                            <div
                                                                class="remark <?= empty($remark) ? 'na' : '' ?>">


                                                                <?= !empty($remark)
                                                                    ? esc($remark)
                                                                    : 'N/A'
                                                                ?>


                                                            </div>


                                                        </div>


                                                    </div>


                                                </div>


                                            <?php endforeach; ?>



                                            <!-- =========================================
                                                 DIGITAL SHAKTI
                                            ========================================== -->

                                            <div class="subject-row">


                                                <div class="subject-title">
                                                    <i class="mdi mdi-laptop me-2"></i>
                                                    Digital Shakti

                                                    <span class="info-badge ms-2">
                                                        Computer
                                                    </span>
                                                </div>


                                                <div class="row mt-2">


                                                    <!-- GRADE -->

                                                    <div class="col-md-3 mb-3 mb-md-0">


                                                        <small>

                                                            Grade

                                                        </small>

                                                        <br>


                                                        <?php if (!empty($assessment['Digital_Shakti_Grade'])): ?>


                                                            <span
                                                                class="grade-badge">


                                                                <?= esc(
                                                                    $assessment['Digital_Shakti_Grade']
                                                                ) ?>


                                                            </span>


                                                        <?php else: ?>

                                                            <span class="na">

                                                                N/A

                                                            </span>

                                                        <?php endif; ?>


                                                    </div>



                                                    <!-- REMARK -->

                                                    <div class="col-md-9">


                                                        <small>

                                                            Remarks on Digital Shakti
                                                            Assessments

                                                        </small>


                                                        <div
                                                            class="remark <?= empty($assessment['Digital_Shakti_Remark']) ? 'na' : '' ?>">


                                                            <?= !empty($assessment['Digital_Shakti_Remark'])
                                                                ? esc(
                                                                    $assessment['Digital_Shakti_Remark']
                                                                )
                                                                : 'N/A'
                                                            ?>


                                                        </div>


                                                    </div>


                                                </div>


                                            </div>



                                            <!-- =========================================
                                                 SEL
                                            ========================================== -->

                                            <div class="title mt-4">
                                                <i class="mdi mdi-heart me-2"></i>
                                                SEL
                                            </div>


                                            <div class="row g-3">


                                                <?php

                                                $selItems = [

                                                    [
                                                        'field' => 'Ethics',
                                                        'title' => 'Ethics',
                                                        'question' =>
                                                        'Does the child choose to do the right thing, even when no one is watching?'
                                                    ],

                                                    [
                                                        'field' => 'Empathy',
                                                        'title' => 'Empathy',
                                                        'question' =>
                                                        'Does the child understand and care about how others feel?'
                                                    ],

                                                    [
                                                        'field' => 'Excellence',
                                                        'title' => 'Excellence',
                                                        'question' =>
                                                        'Does the participant always try to do their best and improve?'
                                                    ],

                                                    [
                                                        'field' => 'Eagerness',
                                                        'title' => 'Eagerness',
                                                        'question' =>
                                                        'Does the child show curiosity and enthusiasm to learn and participate?'
                                                    ]

                                                ];

                                                ?>


                                                <?php foreach (
                                                    $selItems as $item
                                                ): ?>


                                                    <?php

                                                    $rating =
                                                        $assessment[$item['field']] ?? '';

                                                    ?>


                                                    <div class="col-md-6">


                                                        <div class="sel">


                                                            <b>

                                                                <?= esc(
                                                                    $item['title']
                                                                ) ?>

                                                            </b>


                                                            <div
                                                                class="rating <?= empty($rating) ? 'na' : '' ?>">


                                                                <?php

                                                                $selRatingLabels = [
                                                                    '1' => 'Need Improvement',
                                                                    '2' => 'Good',
                                                                    '3' => 'Excellent',
                                                                    '4' => 'Outstanding'
                                                                ];

                                                                ?>

                                                                <?php if (!empty($rating)): ?>

                                                                    <?= esc($rating) ?>
                                                                    →
                                                                    <?= esc($selRatingLabels[(string) $rating] ?? 'N/A') ?>

                                                                <?php else: ?>

                                                                    N/A

                                                                <?php endif; ?>


                                                            </div>


                                                            <small>

                                                                <?= esc(
                                                                    $item['question']
                                                                ) ?>

                                                            </small>


                                                        </div>


                                                    </div>


                                                <?php endforeach; ?>


                                            </div>



                                            <!-- =========================================
                                                 SEL REMARK
                                            ========================================== -->

                                            <div class="mt-3">


                                                <small>

                                                    Remarks on SEL Assessments

                                                </small>


                                                <div
                                                    class="remark <?= empty($assessment['SEL_Remarks']) ? 'na' : '' ?>">


                                                    <?= !empty($assessment['SEL_Remarks'])
                                                        ? esc(
                                                            $assessment['SEL_Remarks']
                                                        )
                                                        : 'N/A'
                                                    ?>


                                                </div>


                                            </div>



                                            <!-- =========================================
                                                 ASSESSED BY
                                            ========================================== -->

                                            <div class="mt-3">


                                                <small>

                                                    Assessed By

                                                </small>

                                                <br>


                                                <b>

                                                    <?= !empty($assessment['Assessed_By'])
                                                        ? esc(
                                                            $assessment['Assessed_By']
                                                        )
                                                        : 'N/A'
                                                    ?>

                                                </b>


                                            </div>


                                        <?php else: ?>


                                            <!-- =========================================
                                                 NOT COMPLETED
                                            ========================================== -->

                                            <div
                                                class="d-flex justify-content-between align-items-center mb-3">


                                                <h5 class="mb-0">

                                                    <?= esc($type) ?>

                                                    Assessment

                                                </h5>


                                                <span
                                                    class="badge bg-secondary">

                                                    Not Completed

                                                </span>


                                            </div>



                                            <div class="text-center py-5">


                                                <i
                                                    class="mdi mdi-clipboard-text-outline empty-icon">
                                                </i>


                                                <h5 class="mt-3">

                                                    <?= esc($type) ?>

                                                    Assessment Not Completed

                                                </h5>


                                                <p class="text-muted mb-0">

                                                    No assessment result has been
                                                    entered for this student yet.

                                                </p>


                                            </div>


                                        <?php endif; ?>


                                    </div>


                                <?php endforeach; ?>


                            </div>


                        </div>

                    </div>



                    <!-- =========================================
                         ACTION BUTTONS
                    ========================================== -->

                    <div class="card shadow-sm">

                        <div class="card-body text-end">


                            <a
                                href="<?= site_url(
                                            'assessment/learning-adda'
                                        ) ?>"
                                class="btn btn-secondary me-2">


                                <i class="mdi mdi-arrow-left me-2"></i>

                                Back


                            </a>


                            <a
                                href="#"
                                id="editAssessmentBtn"
                                class="btn btn-primary">

                                <i class="mdi mdi-pencil me-2"></i>

                                Edit Assessment

                            </a>


                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>



<!-- =====================================================
     LEVEL COMPARISON FUNCTION
====================================================== -->

<?php

/**
 * Compare assessment level with student's actual class.
 *
 * Returns:
 * level-below
 * level-same
 * level-above
 */
function getAssessmentLevelClass(
    $assessmentLevel,
    $studentClass
) {

    if (
        empty($assessmentLevel) ||
        empty($studentClass) ||
        $assessmentLevel === 'N/A'
    ) {

        return '';
    }


    /*
     * Extract number from values such as:
     *
     * Class 5 -> 5
     * Class 10 -> 10
     */

    preg_match(
        '/\d+/',
        $assessmentLevel,
        $assessmentMatch
    );

    preg_match(
        '/\d+/',
        $studentClass,
        $studentMatch
    );


    /*
     * Handle KG separately.
     */

    $assessmentValue = null;

    $studentValue = null;


    if (
        strtolower(trim($assessmentLevel)) === 'kg'
    ) {

        $assessmentValue = 0;
    } elseif (!empty($assessmentMatch[0])) {

        $assessmentValue =
            (int) $assessmentMatch[0];
    }


    if (
        strtolower(trim($studentClass)) === 'kg'
    ) {

        $studentValue = 0;
    } elseif (!empty($studentMatch[0])) {

        $studentValue =
            (int) $studentMatch[0];
    }


    /*
     * Unable to compare.
     */

    if (
        $assessmentValue === null ||
        $studentValue === null
    ) {

        return '';
    }


    /*
     * Compare.
     */

    if ($assessmentValue < $studentValue) {

        return 'level-below';
    }


    if ($assessmentValue == $studentValue) {

        return 'level-same';
    }


    return 'level-above';
}

?>



<!-- =====================================================
     PAGE CSS
====================================================== -->

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


    /* ================= PHOTO ================= */

    .photo {
        width: 120px;
        height: 150px;
        object-fit: cover;
        border: 1px solid #adb5bd;
        padding: 3px;
        border-radius: 6px;
        background: #fff;
    }


    .photo-placeholder {
        width: 120px;
        height: 150px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #adb5bd;
        border-radius: 6px;
        background: #f8f9fa;
        color: #6c757d;
    }


    /* ================= NAME ================= */

    .student-name {
        font-size: 23px;
        font-weight: 700;
    }


    /* ================= TITLE ================= */

    .title {
        color: #4B49AC;
        font-size: 17px;
        font-weight: 600;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 18px;
    }


    /* ================= TABS ================= */

    .nav-link {
        color: #4B49AC;
        font-weight: 600;
    }


    .nav-link.active {
        background: #4B49AC !important;
        color: #fff !important;
    }


    /* ================= SUBJECT ================= */

    .subject-row {
        border: 1px solid #e1e5ea;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 12px;
        background: #fff;
    }


    .subject-row small,
    .sel small {
        color: #6c757d;
        font-weight: 500;
    }


    /* ================= LEVEL ================= */

    .level {
        padding: 6px 11px;
        border-radius: 5px;
        font-weight: 700;
        display: inline-block;
    }


    .level-below {
        background: #f8d7da;
        color: #842029;
    }


    .level-same {
        background: #cfe2ff;
        color: #084298;
    }


    .level-above {
        background: #d1e7dd;
        color: #0f5132;
    }


    /* ================= GRADE ================= */

    .grade-badge {
        padding: 6px 11px;
        border-radius: 5px;
        background: #eef2ff;
        color: #4B49AC;
        font-weight: 700;
        display: inline-block;
    }


    /* ================= REMARK ================= */

    .remark {
        background: #f8f9fa;
        border: 1px solid #e6e8ec;
        border-radius: 6px;
        padding: 9px;
        margin-top: 4px;
        min-height: 40px;
        white-space: pre-line;
    }


    /* ================= N/A ================= */

    .na {
        color: #777;
        font-style: italic;
    }


    /* ================= SEL ================= */

    .sel {
        border: 1px solid #e1e5ea;
        border-radius: 8px;
        padding: 15px;
        height: 100%;
    }


    .rating {
        font-size: 18px;
        color: #4B49AC;
        font-weight: 700;
        margin: 7px 0;
    }


    /* ================= LEGEND ================= */

    .legend span {
        display: inline-block;
        margin-right: 15px;
        font-size: 13px;
    }


    .dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin-right: 5px;
        border-radius: 2px;
    }


    .dot-below {
        background: #dc3545;
    }


    .dot-same {
        background: #0d6efd;
    }


    .dot-above {
        background: #198754;
    }


    /* ================= EMPTY ASSESSMENT ================= */

    .empty-icon {
        font-size: 55px;
        color: #adb5bd;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const editButton =
            document.getElementById('editAssessmentBtn');


        if (!editButton) {
            return;
        }


        editButton.addEventListener('click', function(event) {

            event.preventDefault();


            /*
             * Get currently active tab.
             */

            const activeTab =
                document.querySelector(
                    '.nav-tabs .nav-link.active'
                );


            if (!activeTab) {

                alert('Please select an assessment type.');

                return;
            }


            /*
             * Get the Assessment ID
             * stored in the active tab.
             */

            const assessmentId =
                activeTab.getAttribute(
                    'data-assessment-id'
                );


            /*
             * Get the assessment type
             * from the tab target.
             */

            const target =
                activeTab.getAttribute(
                    'data-bs-target'
                );


            let assessmentType =
                target.replace('#', '');


            assessmentType =
                assessmentType.charAt(0).toUpperCase() +
                assessmentType.slice(1);


            /*
             * If this assessment does not exist,
             * do not open the edit page.
             */

            if (!assessmentId) {

                alert(
                    assessmentType +
                    ' assessment has not been completed yet.'
                );

                return;
            }


            /*
             * Open the correct assessment.
             */

            window.location.href =
                "<?= site_url('assessment/learning-adda/edit') ?>/" +
                encodeURIComponent(assessmentId) +
                "/" +
                encodeURIComponent(assessmentType);

        });

    });
</script>

<?= view('includes/footer'); ?>