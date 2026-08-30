<?= view('includes/header'); ?>

<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

    ```
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
                        'Doosra Mauka';

                    $centerName =
                        $student['Center_Name'] ??
                        'N/A';

                    $batchName =
                        $student['Batch_Name'] ??
                        'N/A';


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


                /* =====================================================
                   GRADE COLOUR FUNCTION
                ===================================================== */

                    /**
                     * Return CSS class according to assessment grade.
                     *
                     * A / A+ = Green
                     * B / B+ = Blue
                     * C / C+ = Yellow
                     * D      = Red
                     */
                    function getAssessmentGradeClass($grade)
                    {
                        if (empty($grade)) {
                            return '';
                        }

                        $grade = strtoupper(trim($grade));

                        switch ($grade) {

                            case 'A':
                            case 'A+':
                                return 'grade-excellent';

                            case 'B':
                            case 'B+':
                                return 'grade-good';

                            case 'C':
                            case 'C+':
                                return 'grade-needs-improvement';

                            case 'D':
                                return 'grade-bad';

                            default:
                                return '';
                        }
                    }

                    ?>


                    <!-- =========================================
                     HEADER
                ========================================== -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">

                            <i class="mdi mdi-account-school me-2"></i>

                            Doosra Mauka - Student Assessment View

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

                                        <div class="col-md-4">

                                            <small>
                                                PROGRAM
                                            </small>

                                            <br>

                                            <b>

                                                <?= esc($programName) ?>

                                            </b>

                                        </div>



                                        <!-- CENTER -->

                                        <div class="col-md-4">

                                            <small>
                                                CENTER
                                            </small>

                                            <br>

                                            <b>

                                                <?= esc($centerName) ?>

                                            </b>

                                        </div>



                                        <!-- BATCH -->

                                        <div class="col-md-4">

                                            <small>
                                                BATCH
                                            </small>

                                            <br>

                                            <b>

                                                <?= esc($batchName) ?>

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


                            <b class="me-2">
                                Colour Code:
                            </b>


                            <!-- RED -->

                            <span>

                                <i class="dot dot-bad"></i>

                                BAD

                            </span>


                            <!-- YELLOW -->

                            <span>

                                <i class="dot dot-needs-improvement"></i>

                                Needs Improvement

                            </span>


                            <!-- BLUE -->

                            <span>

                                <i class="dot dot-good"></i>

                                GOOD

                            </span>


                            <!-- GREEN -->

                            <span>

                                <i class="dot dot-excellent"></i>

                                EXCELENT

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

                                    'Endline'

                                ];

                                ?>


                                <?php foreach ($assessmentTypes as $type): ?>

                                    <?php

                                    $tabAssessment =
                                        $assessments[$type] ?? null;

                                    $tabAssessmentId =
                                        $tabAssessment['Student_Assessment_Id'] ?? '';

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
                                             DATE
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

                                            </p>



                                            <!-- =========================================
                                             DOOSRA MAUKA RESULT
                                        ========================================== -->

                                            <div class="title">

                                                <i class="mdi mdi-book-open-page-variant me-2"></i>

                                                Doosra Mauka Result

                                            </div>



                                            <!-- =========================================
                                             TAILORING
                                        ========================================== -->

                                            <div class="subject-row">


                                                <div class="subject-title">

                                                    <i class="mdi mdi-content-cut me-2"></i>

                                                    Tailoring

                                                </div>


                                                <div class="row mt-2">


                                                    <!-- GRADE -->

                                                    <div class="col-md-3 mb-3 mb-md-0">

                                                        <small>

                                                            Grade

                                                        </small>

                                                        <br>


                                                        <?php if (
                                                            !empty($assessment['Tailoring_Grade'])
                                                        ): ?>

                                                            <span
                                                                class="grade-badge <?= esc(
                                                                                        getAssessmentGradeClass(
                                                                                            $assessment['Tailoring_Grade']
                                                                                        )
                                                                                    ) ?>">

                                                                <?= esc(
                                                                    $assessment['Tailoring_Grade']
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

                                                            Tailoring Remark

                                                        </small>


                                                        <div
                                                            class="remark <?= empty($assessment['Tailoring_Remark']) ? 'na' : '' ?>">


                                                            <?= !empty($assessment['Tailoring_Remark'])
                                                                ? esc(
                                                                    $assessment['Tailoring_Remark']
                                                                )
                                                                : 'N/A'
                                                            ?>


                                                        </div>

                                                    </div>


                                                </div>

                                            </div>



                                            <!-- =========================================
                                             LITERACY
                                        ========================================== -->

                                            <div class="subject-row">


                                                <div class="subject-title">

                                                    <i class="mdi mdi-book-open-variant me-2"></i>

                                                    Literacy

                                                </div>


                                                <div class="row mt-2">


                                                    <!-- GRADE -->

                                                    <div class="col-md-3 mb-3 mb-md-0">

                                                        <small>

                                                            Grade

                                                        </small>

                                                        <br>


                                                        <?php if (
                                                            !empty($assessment['Literacy_Grade'])
                                                        ): ?>

                                                            <span
                                                                class="grade-badge <?= esc(
                                                                                        getAssessmentGradeClass(
                                                                                            $assessment['Literacy_Grade']
                                                                                        )
                                                                                    ) ?>">

                                                                <?= esc(
                                                                    $assessment['Literacy_Grade']
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

                                                            Literacy Remark

                                                        </small>


                                                        <div
                                                            class="remark <?= empty($assessment['Literacy_Remark']) ? 'na' : '' ?>">


                                                            <?= !empty($assessment['Literacy_Remark'])
                                                                ? esc(
                                                                    $assessment['Literacy_Remark']
                                                                )
                                                                : 'N/A'
                                                            ?>


                                                        </div>

                                                    </div>


                                                </div>

                                            </div>



                                            <!-- =========================================
                                             NUMERACY
                                        ========================================== -->

                                            <div class="subject-row">


                                                <div class="subject-title">

                                                    <i class="mdi mdi-numeric me-2"></i>

                                                    Numeracy

                                                </div>


                                                <div class="row mt-2">


                                                    <!-- GRADE -->

                                                    <div class="col-md-3 mb-3 mb-md-0">

                                                        <small>

                                                            Grade

                                                        </small>

                                                        <br>


                                                        <?php if (
                                                            !empty($assessment['Numeracy_Grade'])
                                                        ): ?>

                                                            <span
                                                                class="grade-badge <?= esc(
                                                                                        getAssessmentGradeClass(
                                                                                            $assessment['Numeracy_Grade']
                                                                                        )
                                                                                    ) ?>">

                                                                <?= esc(
                                                                    $assessment['Numeracy_Grade']
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

                                                            Numeracy Remark

                                                        </small>


                                                        <div
                                                            class="remark <?= empty($assessment['Numeracy_Remark']) ? 'na' : '' ?>">


                                                            <?= !empty($assessment['Numeracy_Remark'])
                                                                ? esc(
                                                                    $assessment['Numeracy_Remark']
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

                                                                    '1' =>
                                                                    'Needs Improvement',

                                                                    '2' =>
                                                                    'Average',

                                                                    '3' =>
                                                                    'Good',

                                                                    '4' =>
                                                                    'Outstanding'

                                                                ];

                                                                ?>


                                                                <?php if (
                                                                    $rating !== '' &&
                                                                    $rating !== null
                                                                ): ?>


                                                                    <?= esc(
                                                                        $rating
                                                                    ) ?>

                                                                    →

                                                                    <?= esc(
                                                                        $selRatingLabels[(string) $rating] ?? 'N/A'
                                                                    ) ?>


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
                                            'assessment/doosra-mauka'
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
    ```

</div>

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


    .subject-title {
        font-weight: 700;
        font-size: 16px;
        color: #343a40;
    }


    .subject-row small,
    .sel small {
        color: #6c757d;
        font-weight: 500;
    }


    /* ================= GRADE ================= */

    .grade-badge {
        padding: 6px 11px;
        border-radius: 5px;
        font-weight: 700;
        display: inline-block;
    }


    /* A / A+ */

    .grade-excellent {
        background: #d1e7dd;
        color: #0f5132;
    }


    /* B / B+ */

    .grade-good {
        background: #cfe2ff;
        color: #084298;
    }


    /* C / C+ */

    .grade-needs-improvement {
        background: #fff3cd;
        color: #664d03;
    }


    /* D */

    .grade-bad {
        background: #f8d7da;
        color: #842029;
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
        display: inline-flex;
        align-items: center;
        margin-right: 18px;
        font-size: 13px;
    }


    .legend b {
        font-size: 13px;
    }


    .dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin-right: 6px;
        border-radius: 2px;
        flex-shrink: 0;
    }


    /* RED */

    .dot-bad {
        background: #dc3545;
    }


    /* YELLOW */

    .dot-needs-improvement {
        background: #ffc107;
    }


    /* BLUE */

    .dot-good {
        background: #0d6efd;
    }


    /* GREEN */

    .dot-excellent {
        background: #198754;
    }


    /* ================= EMPTY ASSESSMENT ================= */

    .empty-icon {
        font-size: 55px;
        color: #adb5bd;
    }
</style>

<!-- =====================================================
     EDIT BUTTON LOGIC
====================================================== -->

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

                alert(
                    'Please select an assessment type.'
                );

                return;
            }


            /*
             * Get Assessment ID
             * from active tab.
             */

            const assessmentId =
                activeTab.getAttribute(
                    'data-assessment-id'
                );


            /*
             * Get assessment type.
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
             * If assessment does not exist,
             * don't open edit page.
             */

            if (!assessmentId) {

                alert(
                    assessmentType +
                    ' assessment has not been completed yet.'
                );

                return;
            }


            /*
             * Open Doosra Mauka Edit page.
             */

            window.location.href =
                "<?= site_url('assessment/doosra-mauka/edit') ?>/" +
                encodeURIComponent(assessmentId) +
                "/" +
                encodeURIComponent(assessmentType);

        });

    });
</script>

<?= view('includes/footer'); ?>