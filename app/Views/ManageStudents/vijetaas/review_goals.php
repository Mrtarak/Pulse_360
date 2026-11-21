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

                            <h4 class="card-title" style="color:#1B4482;">
                                Review Student Goals
                            </h4>

                            <p class="card-description">
                                Review the student's progress and update goal performance.
                            </p>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= esc(session()->getFlashdata('error')) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= esc(session()->getFlashdata('success')) ?>
                                </div>
                            <?php endif; ?>

                            <!-- STUDENT DETAILS -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Student Name</label>
                                    <input type="text"
                                        class="form-control"
                                        value="<?= esc(trim(($student['First_Name'] ?? '') . ' ' . ($student['Last_Name'] ?? ''))) ?>"
                                        readonly>
                                </div>
                            </div>

                            <!-- SESSION SELECTOR -->
                            <form method="get"
                                action="<?= site_url('students/vijetaas/goals/review/' . $student['Vijetaas_Stu_Id']) ?>"
                                class="mb-4">

                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Select Goal Session <span class="text-danger">*</span>
                                        </label>

                                        <select name="assignment_id"
                                            class="form-control"
                                            onchange="this.form.submit()"
                                            required>

                                            <option value="">Select Session</option>

                                            <?php foreach (($assignments ?? []) as $item): ?>
                                                <option value="<?= esc($item['Goal_Assignment_Id']) ?>"
                                                    <?= ($assignment['Goal_Assignment_Id'] ?? '') === $item['Goal_Assignment_Id'] ? 'selected' : '' ?>>
                                                    <?= esc($item['Session_Name']) ?>
                                                    (<?= esc($item['Session_Start_Date'] ?? '') ?>
                                                    to
                                                    <?= esc($item['Session_End_Date'] ?? '') ?>)
                                                </option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
                            </form>

                            <?php if (empty($assignments)): ?>

                                <div class="alert alert-warning">
                                    No goal sessions have been assigned to this student yet.
                                </div>

                            <?php elseif (empty($assignment)): ?>

                                <div class="alert alert-info">
                                    Please select a goal session to view its assigned goals and reviews.
                                </div>

                            <?php else: ?>

                                <?php
                                $groupedGoals = [];

                                foreach (($goals ?? []) as $goal) {
                                    $typeId = $goal['Goal_Type_Id'] ?? 'uncategorized';

                                    if (!isset($groupedGoals[$typeId])) {
                                        $groupedGoals[$typeId] = [
                                            'name' => $goal['Goal_Type_Name'] ?? 'Uncategorized',
                                            'goals' => []
                                        ];
                                    }

                                    $groupedGoals[$typeId]['goals'][] = $goal;
                                }
                                ?>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Selected Session</label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= esc($assignment['Session_Name'] ?? '') ?>"
                                            readonly>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Session Start</label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= esc($assignment['Session_Start_Date'] ?? '') ?>"
                                            readonly>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Session End</label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= esc($assignment['Session_End_Date'] ?? '') ?>"
                                            readonly>
                                    </div>
                                </div>

                                <hr>

                                <?php if (empty($goals)): ?>

                                    <div class="alert alert-warning">
                                        No goals have been assigned to this student in the selected session.
                                    </div>

                                <?php else: ?>

                                    <form action="<?= site_url('students/vijetaas/goals/review/store') ?>"
                                        method="post">

                                        <?= csrf_field() ?>

                                        <input type="hidden"
                                            name="Vijetaas_Stu_Id"
                                            value="<?= esc($student['Vijetaas_Stu_Id']) ?>">

                                        <input type="hidden"
                                            name="Goal_Assignment_Id"
                                            value="<?= esc($assignment['Goal_Assignment_Id']) ?>">

                                        <!-- REVIEWING MENTORS -->
                                        <div class="mb-4">
                                            <h5 style="color:#1B4482;" class="mb-3">
                                                Reviewing Mentor(s)
                                            </h5>

                                            <div class="row g-3">

                                                <?php if (!empty($mentors)): ?>

                                                    <?php foreach ($mentors as $mentor): ?>
                                                        <div class="col-lg-4 col-md-6">
                                                            <div class="form-check mentor-checkbox-item">

                                                                <input class="form-check-input"
                                                                    type="checkbox"
                                                                    name="reviewing_mentors[]"
                                                                    value="<?= esc($mentor['User_Id']) ?>"
                                                                    id="mentor_<?= esc($mentor['User_Id']) ?>"
                                                                    <?= in_array($mentor['User_Id'], $reviewingMentorIds ?? [], true) ? 'checked' : '' ?>>

                                                                <label class="form-check-label"
                                                                    for="mentor_<?= esc($mentor['User_Id']) ?>">
                                                                    <?= esc(trim($mentor['User_FirstName'] . ' ' . $mentor['User_LastName'])) ?>
                                                                </label>

                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                <?php else: ?>

                                                    <div class="col-12">
                                                        <div class="alert alert-warning">
                                                            No active Vijetaas mentors found.
                                                        </div>
                                                    </div>

                                                <?php endif; ?>

                                            </div>
                                        </div>

                                        <!-- REVIEW DATE -->
                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <label class="form-label">
                                                    Review Date <span class="text-danger">*</span>
                                                </label>

                                                <input type="date"
                                                    name="Review_Date"
                                                    class="form-control"
                                                    value="<?= esc($latestReview['Review_Date'] ?? date('Y-m-d')) ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <hr>

                                        <h5 class="mb-4" style="color:#1B4482;">
                                            Goal Performance Review
                                        </h5>

                                        <?php foreach ($groupedGoals as $typeId => $category): ?>

                                            <div class="category-section mb-5">

                                                <div class="p-3 mb-3"
                                                    style="background:#eaf0f8; border-left:4px solid #1B4482;">
                                                    <h5 class="mb-0" style="color:#1B4482;">
                                                        <?= esc($category['name']) ?>
                                                    </h5>
                                                </div>

                                                <?php foreach ($category['goals'] as $index => $goal): ?>

                                                    <div class="card mb-4"
                                                        style="border:1px solid #dee2e6;">

                                                        <div class="card-body">

                                                            <h6 class="mb-3">
                                                                Goal <?= $index + 1 ?>:
                                                                <?= esc($goal['Goal_Title']) ?>
                                                            </h6>

                                                            <p class="text-muted mb-3">
                                                                <?= esc($goal['Goal_Description'] ?? 'No description available.') ?>
                                                            </p>

                                                            <div class="row mb-3">

                                                                <div class="col-md-4">
                                                                    <label class="form-label">Target Period</label>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        value="<?= esc($goal['Goal_Start_On']) ?> to <?= esc($goal['Expected_Completion_Date']) ?>"
                                                                        readonly>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="form-label">Assigned Mentor</label>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        value="<?= esc(trim(($goal['Mentor_FirstName'] ?? '') . ' ' . ($goal['Mentor_LastName'] ?? ''))) ?>"
                                                                        readonly>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="form-label">Target Value</label>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        value="<?= esc($goal['Target_Value'] ?? '') ?>"
                                                                        readonly>
                                                                </div>

                                                            </div>

                                                            <hr>

                                                            <input type="hidden"
                                                                name="reviews[<?= esc($goal['Student_Goal_Id']) ?>][Student_Goal_Id]"
                                                                value="<?= esc($goal['Student_Goal_Id']) ?>">

                                                            <div class="row">

                                                                <!-- SELF RATING -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Self Rating (Out of 10)</label>

                                                                    <input type="number"
                                                                        name="reviews[<?= esc($goal['Student_Goal_Id']) ?>][Self_Rating]"
                                                                        class="form-control"
                                                                        min="0"
                                                                        max="10"
                                                                        step="0.5"
                                                                        value="<?= esc($goal['Review_Self_Rating'] ?? '') ?>"
                                                                        placeholder="Enter rating">
                                                                </div>

                                                                <!-- MENTOR RATING -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Mentor Rating (Out of 10)</label>

                                                                    <input type="number"
                                                                        name="reviews[<?= esc($goal['Student_Goal_Id']) ?>][Mentor_Rating]"
                                                                        class="form-control"
                                                                        min="0"
                                                                        max="10"
                                                                        step="0.5"
                                                                        value="<?= esc($goal['Review_Mentor_Rating'] ?? '') ?>"
                                                                        placeholder="Enter rating">
                                                                </div>

                                                                <!-- STUDENT REMARK -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Student Remark</label>

                                                                    <textarea name="reviews[<?= esc($goal['Student_Goal_Id']) ?>][Self_Remark]"
                                                                        class="form-control"
                                                                        rows="3"
                                                                        placeholder="Enter student's feedback"><?= esc($goal['Review_Self_Remark'] ?? '') ?></textarea>
                                                                </div>

                                                                <!-- MENTOR REMARK -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Mentor Remark</label>

                                                                    <textarea name="reviews[<?= esc($goal['Student_Goal_Id']) ?>][Mentor_Remark]"
                                                                        class="form-control"
                                                                        rows="3"
                                                                        placeholder="Enter mentor's feedback"><?= esc($goal['Review_Mentor_Remark'] ?? '') ?></textarea>
                                                                </div>

                                                                <!-- GOAL STATUS -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Goal Status</label>

                                                                    <select name="reviews[<?= esc($goal['Student_Goal_Id']) ?>][Goal_Status]"
                                                                        class="form-control goal-status"
                                                                        data-goal="<?= esc($goal['Student_Goal_Id']) ?>">

                                                                        <option value=""
                                                                            <?= empty($goal['Review_Goal_Status']) ? 'selected' : '' ?>>
                                                                            Select Status
                                                                        </option>

                                                                        <?php
                                                                        $statuses = [
                                                                            'Assigned',
                                                                            'Completed',
                                                                            'Hold',
                                                                            'Ready for Review',
                                                                            'Canceled'
                                                                        ];
                                                                        ?>

                                                                        <?php foreach ($statuses as $status): ?>
                                                                            <option value="<?= esc($status) ?>"
                                                                                <?= ($goal['Review_Goal_Status'] ?? '') === $status ? 'selected' : '' ?>>
                                                                                <?= esc($status) ?>
                                                                            </option>
                                                                        <?php endforeach; ?>

                                                                    </select>
                                                                </div>

                                                                <!-- NEXT TARGET DATE -->
                                                                <div class="col-md-6 mb-3 next-target-wrapper"
                                                                    id="next_target_wrapper_<?= esc($goal['Student_Goal_Id']) ?>"
                                                                    style="<?= ($goal['Review_Goal_Status'] ?? '') === 'Assigned' ? '' : 'display:none;' ?>">

                                                                    <label class="form-label">Next Target Date</label>

                                                                    <input type="date"
                                                                        name="reviews[<?= esc($goal['Student_Goal_Id']) ?>][Next_Target_Date]"
                                                                        class="form-control next-target-date"
                                                                        value="<?= esc($goal['Review_Next_Target_Date'] ?? '') ?>">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php endforeach; ?>

                                                <!-- CATEGORY REMARK -->
                                                <div class="mb-4">
                                                    <label class="form-label fw-bold">
                                                        Overall Mentor Remark - <?= esc($category['name']) ?>
                                                    </label>

                                                    <textarea name="category_remarks[<?= esc($typeId) ?>]"
                                                        class="form-control"
                                                        rows="3"
                                                        placeholder="Enter overall mentor feedback for <?= esc($category['name']) ?>"><?= esc($savedCategoryRemarks[$category['name']] ?? '') ?></textarea>
                                                </div>

                                            </div>

                                        <?php endforeach; ?>

                                        <div class="text-center mt-4">
                                            <a href="<?= site_url('students/vijetaas/assign-goal') ?>"
                                                class="btn btn-light btn-sm me-2">
                                                Cancel
                                            </a>

                                            <button type="submit"
                                                class="btn btn-primary btn-sm">
                                                Save Review
                                            </button>
                                        </div>

                                    </form>

                                <?php endif; ?>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?= view('includes/footer'); ?>
    </div>
</div>

<style>
    .category-section {
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 600;
    }

    .goal-status {
        cursor: pointer;
    }

    .mentor-checkbox-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 15px 12px 38px;
        margin-left: 10px;
        border: 1px solid #e5e9f2;
        border-radius: 6px;
        background: #f8faff;
        min-height: 48px;
    }

    .mentor-checkbox-item .form-check-input {
        margin-left: -23px;
        margin-top: 0;
        cursor: pointer;
    }

    .mentor-checkbox-item .form-check-label {
        cursor: pointer;
        margin-bottom: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function toggleNextTargetDate(select) {
            const goalId = select.dataset.goal;
            const wrapper = document.getElementById('next_target_wrapper_' + goalId);

            if (!wrapper) return;

            const dateInput = wrapper.querySelector('.next-target-date');

            if (select.value === 'Assigned') {
                wrapper.style.display = 'block';
            } else {
                wrapper.style.display = 'none';
                if (dateInput) dateInput.value = '';
            }
        }

        document.querySelectorAll('.goal-status').forEach(function(select) {
            toggleNextTargetDate(select);

            select.addEventListener('change', function() {
                toggleNextTargetDate(this);
            });
        });

    });
</script>