<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<style>
    .goal-view-page {
        color: #243b59;
    }

    .goal-view-page .view-heading {
        color: #123665;
        font-size: 24px;
        font-weight: 700;
    }

    .goal-view-page .view-description {
        color: #52647b;
        line-height: 1.6;
        margin-bottom: 22px;
    }

    .goal-view-page .info-card {
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        padding: 20px;
        background: #fff;
    }

    .goal-view-page .info-label {
        display: block;
        font-weight: 700;
        color: #344b68;
        margin-bottom: 8px;
    }

    .goal-view-page .readonly-value {
        background: #f1f5f9;
        border: 1px solid #c1ccda;
        border-radius: 6px;
        padding: 11px 12px;
        min-height: 42px;
        overflow-wrap: anywhere;
    }

    .goal-view-page .session-select {
        background: #f0f5fc;
        border: 1px solid #9aabc2;
        color: #173b69;
        font-weight: 600;
    }

    .goal-view-page .mentor-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .goal-view-page .mentor-list li {
        margin-bottom: 7px;
    }

    .goal-view-page .mentor-list i {
        color: #17653b;
        margin-right: 7px;
    }

    .goal-view-page .goal-category {
        margin-top: 30px;
    }

    .goal-view-page .category-heading {
        font-size: 20px;
        font-weight: 700;
        color: #123665;
        border-bottom: 3px solid #3978bd;
        padding-bottom: 10px;
        margin-bottom: 18px;
    }

    .goal-view-page .goal-item {
        border: 1px solid #b9cbe0;
        border-left: 5px solid #245b99;
        border-radius: 9px;
        padding: 20px;
        margin-bottom: 17px;
        background: #f7faff;
    }

    .goal-view-page .goal-title {
        color: #17477e;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .goal-view-page .detail-box {
        background: #eaf1fa;
        border: 1px solid #d4e0ef;
        border-radius: 6px;
        padding: 12px;
        height: 100%;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .goal-view-page .detail-box small {
        display: block;
        color: #526984;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .goal-view-page .rating-box {
        border-radius: 8px;
        padding: 16px;
        height: 100%;
    }

    .goal-view-page .self-box {
        background: #edf5ff;
        border: 1px solid #a9c8eb;
    }

    .goal-view-page .mentor-box {
        background: #edf8f2;
        border: 1px solid #a9d5ba;
    }

    .goal-view-page .self-box h6 {
        color: #17518e;
        font-weight: 700;
    }

    .goal-view-page .mentor-box h6 {
        color: #17653b;
        font-weight: 700;
    }

    .goal-view-page .rating-value {
        display: inline-block;
        background: #d5e7ff;
        color: #123f76;
        border: 1px solid #a9c8eb;
        padding: 7px 12px;
        border-radius: 5px;
        font-weight: 700;
        margin-bottom: 13px;
    }

    .goal-view-page .remark-label {
        display: block;
        color: #52647b;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .goal-view-page .remark-value {
        background: #fff;
        border: 1px solid #cbd6e3;
        border-radius: 6px;
        padding: 12px;
        line-height: 1.6;
        min-height: 48px;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    .goal-view-page .overall-remark {
        margin-top: 18px;
        padding: 17px;
        background: #fff8e8;
        border: 1px solid #e6cc8d;
        border-left: 5px solid #c28a19;
        border-radius: 8px;
    }

    .goal-view-page .overall-remark label {
        display: block;
        color: #79520b;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .goal-view-page .status-box {
        background: #eaf1fa;
        border: 1px solid #d4e0ef;
        border-radius: 6px;
        padding: 12px;
        height: 100%;
    }

    .goal-view-page .status-box small {
        display: block;
        color: #526984;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .goal-view-page .status-value {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 5px;
        background: #e4edf8;
        color: #1d477f;
        font-weight: 700;
    }

    .goal-view-page .bottom-actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #e0e6ed;
    }

    @media(max-width: 767px) {
        .goal-view-page .view-heading {
            font-size: 21px;
        }
    }
</style>

<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body goal-view-page">

                        <?= view(
                            'includes/breadcrumb',
                            [
                                'main' => 'Dashboard',
                                'sub' => 'Vijetaas',
                                'sub_url' => base_url('students/vijetaas'),
                                'third' => 'Goal Management',
                                'third_url' => base_url('students/vijetaas/assign-goal'),
                                'fourth' => 'View Goals'
                            ]
                        ); ?>

                        <?php
                        $studentName = trim(
                            ($student['First_Name'] ?? '') . ' ' .
                                ($student['Last_Name'] ?? '')
                        );

                        $assignmentId = $assignment['Goal_Assignment_Id'] ?? '';
                        $reviewId = $latestReview['Goal_Review_Id'] ?? '';
                        ?>

                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <h4 class="card-title mb-0 view-heading">
                                <i class="mdi mdi-eye me-2"></i>
                                View Goals
                            </h4>
                        </div>

                        <?= view('includes/messages'); ?>

                        <p class="view-description">
                            View assigned goals, student self-assessment,
                            mentor assessment and overall category reviews.
                        </p>

                        <?php if (empty($assignments)): ?>

                            <div class="alert alert-info">
                                No goal sessions have been assigned to this student yet.
                            </div>

                        <?php else: ?>

                            <div class="info-card">

                                <div class="row g-4">

                                    <div class="col-md-6">
                                        <label class="info-label">Vijetaas Student</label>
                                        <div class="readonly-value">
                                            <?= esc($studentName) ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="info-label" for="sessionSelect">
                                            Session
                                        </label>

                                        <select id="sessionSelect"
                                            class="form-select session-select"
                                            onchange="changeGoalSession(this.value)">

                                            <?php foreach ($assignments as $item): ?>

                                                <option
                                                    value="<?= esc($item['Goal_Assignment_Id']) ?>"
                                                    <?= $assignmentId === $item['Goal_Assignment_Id'] ? 'selected' : '' ?>>

                                                    <?= esc($item['Session_Name'] ?? 'Unnamed Session') ?>

                                                </option>

                                            <?php endforeach; ?>

                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="info-label">Reviewing Mentor(s)</label>

                                        <?php if (!empty($reviewingMentors)): ?>

                                            <ul class="mentor-list">
                                                <?php foreach ($reviewingMentors as $mentor): ?>
                                                    <li>
                                                        <i class="mdi mdi-account-check"></i>
                                                        <?= esc(trim(
                                                            ($mentor['User_FirstName'] ?? '') . ' ' .
                                                                ($mentor['User_LastName'] ?? '')
                                                        )) ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>

                                        <?php else: ?>

                                            <div class="readonly-value">
                                                No review recorded
                                            </div>

                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="info-label">Review Date</label>
                                        <div class="readonly-value">
                                            <?= !empty($latestReview['Review_Date'])
                                                ? date('d M Y', strtotime($latestReview['Review_Date']))
                                                : 'No review recorded' ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="info-label">Session Start Date</label>
                                        <div class="readonly-value">
                                            <?= !empty($assignment['Session_Start_Date'])
                                                ? date('d M Y', strtotime($assignment['Session_Start_Date']))
                                                : '—' ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="info-label">Session End Date</label>
                                        <div class="readonly-value">
                                            <?= !empty($assignment['Session_End_Date'])
                                                ? date('d M Y', strtotime($assignment['Session_End_Date']))
                                                : '—' ?>
                                        </div>
                                    </div>

                                </div>

                                <?php if (empty($goals)): ?>

                                    <div class="alert alert-warning mt-4 mb-0">
                                        No goals have been assigned in this session.
                                    </div>

                                <?php else: ?>

                                    <?php
                                    // Group goals by goal category
                                    $groupedGoals = [];

                                    foreach ($goals as $goal) {
                                        $typeId = $goal['Goal_Type_Id'];
                                        $groupedGoals[$typeId]['name'] =
                                            $goal['Goal_Type_Name'] ?? 'Uncategorized';
                                        $groupedGoals[$typeId]['goals'][] = $goal;
                                    }

                                    $categoryNumber = 1;
                                    ?>

                                    <?php foreach ($groupedGoals as $category): ?>

                                        <div class="goal-category">

                                            <h5 class="category-heading">
                                                <?= $categoryNumber++ ?>.
                                                <?= esc($category['name']) ?>
                                            </h5>

                                            <?php foreach ($category['goals'] as $goal): ?>

                                                <?php
                                                $assignedMentor = trim(
                                                    ($goal['Assigned_Mentor_FirstName'] ?? '') . ' ' .
                                                        ($goal['Assigned_Mentor_LastName'] ?? '')
                                                );

                                                $status = $goal['Review_Goal_Status'] ?: 'Not Reviewed';

                                                $startDate = $goal['Goal_Start_On'] ?? '';
                                                $endDate = $goal['Expected_Completion_Date'] ?? '';
                                                ?>

                                                <div class="goal-item">

                                                    <h6 class="goal-title">
                                                        <?= esc($goal['Goal_Title']) ?>
                                                    </h6>

                                                    <div class="row g-3">

                                                        <div class="col-md-6 col-lg-3">
                                                            <div class="detail-box">
                                                                <small>Description</small>
                                                                <?= !empty($goal['Goal_Description'])
                                                                    ? nl2br(esc($goal['Goal_Description']))
                                                                    : '—' ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-3">
                                                            <div class="detail-box">
                                                                <small>Target Period</small>
                                                                <?= !empty($startDate)
                                                                    ? date('d M Y', strtotime($startDate))
                                                                    : '—' ?>
                                                                –
                                                                <?= !empty($endDate)
                                                                    ? date('d M Y', strtotime($endDate))
                                                                    : '—' ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-3">
                                                            <div class="detail-box">
                                                                <small>Assigned By</small>
                                                                <?= esc($assignedMentor ?: '—') ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-3">
                                                            <div class="detail-box">
                                                                <small>Assignment Date</small>
                                                                <?= !empty($goal['Goal_Assigned_On'])
                                                                    ? date('d M Y', strtotime($goal['Goal_Assigned_On']))
                                                                    : '—' ?>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row g-3 mt-1">

                                                        <div class="col-md-6">
                                                            <div class="status-box">
                                                                <small>Goal Status</small>
                                                                <span class="status-value">
                                                                    <?= esc($status) ?>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <?php if ($status === 'Assigned'): ?>

                                                            <div class="col-md-6">
                                                                <div class="status-box">
                                                                    <small>Next Target Date</small>
                                                                    <?= !empty($goal['Next_Target_Date'])
                                                                        ? date('d M Y', strtotime($goal['Next_Target_Date']))
                                                                        : '—' ?>
                                                                </div>
                                                            </div>

                                                        <?php endif; ?>

                                                    </div>

                                                    <div class="row g-3 mt-2">

                                                        <div class="col-md-6">
                                                            <div class="rating-box self-box">

                                                                <h6>
                                                                    <i class="mdi mdi-account me-1"></i>
                                                                    Self Assessment
                                                                </h6>

                                                                <div class="rating-value">
                                                                    <?= $goal['Self_Rating'] !== null && $goal['Self_Rating'] !== ''
                                                                        ? esc($goal['Self_Rating']) . ' / 10'
                                                                        : 'Not Rated' ?>
                                                                </div>

                                                                <span class="remark-label">
                                                                    Self Remark
                                                                </span>

                                                                <div class="remark-value">
                                                                    <?= !empty($goal['Self_Remark'])
                                                                        ? esc($goal['Self_Remark'])
                                                                        : 'No self remark recorded.' ?>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="rating-box mentor-box">

                                                                <h6>
                                                                    <i class="mdi mdi-account-tie me-1"></i>
                                                                    Mentor Assessment
                                                                </h6>

                                                                <div class="rating-value">
                                                                    <?= $goal['Mentor_Rating'] !== null && $goal['Mentor_Rating'] !== ''
                                                                        ? esc($goal['Mentor_Rating']) . ' / 10'
                                                                        : 'Not Rated' ?>
                                                                </div>

                                                                <span class="remark-label">
                                                                    Mentor Remark
                                                                </span>

                                                                <div class="remark-value">
                                                                    <?= !empty($goal['Mentor_Remark'])
                                                                        ? esc($goal['Mentor_Remark'])
                                                                        : 'No mentor remark recorded.' ?>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            <?php endforeach; ?>

                                            <?php
                                            $categoryRemark =
                                                $categoryRemarks[$category['name']] ?? '';
                                            ?>

                                            <div class="overall-remark">

                                                <label>
                                                    <i class="mdi mdi-comment-text-outline me-1"></i>
                                                    Overall Mentor Review Remark –
                                                    <?= esc($category['name']) ?>
                                                </label>

                                                <div class="remark-value">
                                                    <?= $categoryRemark !== ''
                                                        ? esc($categoryRemark)
                                                        : 'No overall category remark recorded.' ?>
                                                </div>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                                <div class="bottom-actions">

                                    <a href="<?= base_url('students/vijetaas/assign-goal') ?>"
                                        class="btn btn-light">
                                        <i class="mdi mdi-arrow-left me-1"></i>
                                        Back to Vijetaas
                                    </a>

                                    <?php if (!empty($assignmentId)): ?>

                                        <a href="<?= base_url(
                                                        'students/vijetaas/goals/review/' .
                                                            $student['Vijetaas_Stu_Id']
                                                    ) . '?assignment_id=' . urlencode($assignmentId) ?>"
                                            class="btn btn-primary">
                                            <i class="mdi mdi-pencil me-1"></i>
                                            Edit Review
                                        </a>

                                    <?php endif; ?>

                                </div>

                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    function changeGoalSession(assignmentId) {
        const url = new URL(window.location.href);
        url.searchParams.set('assignment_id', assignmentId);
        window.location.href = url.toString();
    }
</script>

<?= view('includes/footer'); ?>