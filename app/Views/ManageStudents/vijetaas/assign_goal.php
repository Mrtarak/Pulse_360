<?= view('includes/header'); ?>

<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">

        <div class="content-wrapper">

            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <?= view(
                            'includes/breadcrumb',
                            [
                                'main' => 'Dashboard',
                                'sub'  => 'Vijetaas',
                                'sub_url' => base_url('students/vijetaas'),
                                'third' => 'Assign Goals'
                            ]
                        ); ?>

                        <?= view('includes/messages'); ?>

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h4 class="card-title mb-0">

                                <i class="mdi mdi-target me-2"></i>

                                Assign Goals

                            </h4>

                            <a href="<?= base_url('students/vijetaas/assign-goal') ?>"
                                class="btn btn-secondary btn-sm">

                                <i class="mdi mdi-arrow-left me-1"></i>

                                Back

                            </a>

                        </div>

                        <p class="card-description">

                            Assign individual goals to the selected Vijetaas student for a six-month session.

                        </p>

                        <!-- Student Information -->

                        <div class="card border mb-4">

                            <div class="card-body">

                                <h5 class="mb-3">

                                    <i class="mdi mdi-account me-2"></i>

                                    Student Information

                                </h5>

                                <div class="row">

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Student Name
                                        </label>

                                        <input type="text"
                                            class="form-control"
                                            value="<?= esc(trim(($student['First_Name'] ?? '') . ' ' . ($student['Last_Name'] ?? ''))) ?>"
                                            readonly>

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Vijetaas Student ID
                                        </label>

                                        <input type="text"
                                            class="form-control"
                                            value="<?= esc($student['Vijetaas_Stu_Id'] ?? '') ?>"
                                            readonly>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- Assignment Form -->

                        <form id="assignGoalsForm"
                            action="<?= base_url('students/vijetaas/goals/assignment/store') ?>"
                            method="post">

                            <?= csrf_field() ?>

                            <input type="hidden"
                                name="Vijetaas_Stu_Id"
                                value="<?= esc($student['Vijetaas_Stu_Id']) ?>">

                            <input type="hidden"
                                name="Student_Id"
                                value="<?= esc($student['Student_Id']) ?>">

                            <!-- Session -->

                            <div class="mb-4">

                                <label class="form-label fw-bold">

                                    Six-Month Session
                                    <span class="text-danger">*</span>

                                </label>

                                <select name="Goal_Session_Id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Select Session
                                    </option>

                                    <?php if (!empty($sessions)): ?>

                                        <?php foreach ($sessions as $session): ?>

                                            <option value="<?= esc($session['Goal_Session_Id']) ?>">

                                                <?= esc($session['Session_Name']) ?>

                                            </option>

                                        <?php endforeach; ?>

                                    <?php endif; ?>

                                </select>

                            </div>


                            <!-- Goals Container -->

                            <div id="goalsContainer">

                            </div>


                            <!-- Add Goal Button -->

                            <div class="mt-3 mb-4">

                                <button type="button"
                                    id="addGoalBtn"
                                    class="btn btn-success btn-sm">

                                    <i class="mdi mdi-plus-circle-outline me-1"></i>

                                    Add Another Goal

                                </button>

                            </div>


                            <!-- Submit -->

                            <div class="text-center mt-4">

                                <button type="submit"
                                    class="btn btn-primary">

                                    <i class="mdi mdi-content-save me-1"></i>

                                    Save Goals

                                </button>

                                <a href="<?= base_url('students/vijetaas/assign-goal') ?>"
                                    class="btn btn-light">

                                    Cancel

                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= view('includes/footer'); ?>


<!-- Goal Template -->

<template id="goalTemplate">

    <div class="card border mb-4 goal-card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="goal-heading mb-0">

                    Goal

                </h5>

                <button type="button"
                    class="btn btn-danger btn-sm removeGoalBtn">

                    <i class="mdi mdi-delete me-1"></i>

                    Remove

                </button>

            </div>

            <div class="row">

                <!-- Goal Type -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Goal Category
                        <span class="text-danger">*</span>

                    </label>

                    <select class="form-select goal-type"
                        required>

                        <option value="">
                            Select Goal Category
                        </option>

                        <?php if (!empty($goalTypes)): ?>

                            <?php foreach ($goalTypes as $type): ?>

                                <option value="<?= esc($type['Goal_Type_Id']) ?>">

                                    <?= esc($type['Goal_Type_Name']) ?>

                                </option>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </select>

                </div>


                <!-- Goal Title -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Goal Title
                        <span class="text-danger">*</span>

                    </label>

                    <input type="text"
                        class="form-control goal-title"
                        placeholder="Enter goal title"
                        required>

                </div>


                <!-- Goal Description -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Goal Description

                    </label>

                    <textarea class="form-control goal-description"
                        rows="3"
                        placeholder="Describe the goal"></textarea>

                </div>


                <!-- Mentor -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Assigned Mentor
                        <span class="text-danger">*</span>

                    </label>

                    <select class="form-select goal-mentor"
                        required>

                        <option value="">
                            Select Mentor
                        </option>

                        <?php if (!empty($mentors)): ?>

                            <?php foreach ($mentors as $mentor): ?>

                                <option value="<?= esc($mentor['User_Id']) ?>">

                                    <?= esc(trim(($mentor['User_FirstName'] ?? '') . ' ' . ($mentor['User_LastName'] ?? ''))) ?>

                                </option>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </select>

                </div>


                <!-- Start Date -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Goal Start Date
                        <span class="text-danger">*</span>

                    </label>

                    <input type="date"
                        class="form-control goal-start"
                        required>

                </div>


                <!-- Expected Completion -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Expected Completion Date
                        <span class="text-danger">*</span>

                    </label>

                    <input type="date"
                        class="form-control goal-end"
                        required>

                </div>


                <!-- Target Value -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Target Value

                    </label>

                    <input type="number"
                        class="form-control goal-target"
                        step="0.01"
                        min="0"
                        placeholder="Optional">

                </div>

            </div>

        </div>

    </div>

</template>


<script>
    $(document).ready(function() {

        let goalIndex = 0;

        function addGoal() {

            const template = document.getElementById('goalTemplate');

            const clone = template.content.cloneNode(true);

            const goalCard = clone.querySelector('.goal-card');

            goalCard.querySelector('.goal-heading').textContent =
                'Goal ' + (goalIndex + 1);

            // Assign indexed names to fields
            goalCard.querySelector('.goal-type').name =
                'goals[' + goalIndex + '][Goal_Type_Id]';

            goalCard.querySelector('.goal-title').name =
                'goals[' + goalIndex + '][Goal_Title]';

            goalCard.querySelector('.goal-description').name =
                'goals[' + goalIndex + '][Goal_Description]';

            goalCard.querySelector('.goal-mentor').name =
                'goals[' + goalIndex + '][Mentor_Id]';

            goalCard.querySelector('.goal-start').name =
                'goals[' + goalIndex + '][Goal_Start_On]';

            goalCard.querySelector('.goal-end').name =
                'goals[' + goalIndex + '][Expected_Completion_Date]';

            goalCard.querySelector('.goal-target').name =
                'goals[' + goalIndex + '][Target_Value]';

            document.getElementById('goalsContainer').appendChild(clone);

            goalIndex++;

        }


        // Add first goal automatically
        addGoal();


        // Add another goal
        $('#addGoalBtn').on('click', function() {

            addGoal();

        });


        // Remove goal
        $(document).on('click', '.removeGoalBtn', function() {

            if ($('.goal-card').length > 1) {

                $(this).closest('.goal-card').remove();

                // Renumber goal headings
                $('.goal-card').each(function(index) {

                    $(this).find('.goal-heading').text('Goal ' + (index + 1));

                });

            } else {

                alert('At least one goal is required.');

            }

        });


        // Validate date range
        $(document).on('change', '.goal-start, .goal-end', function() {

            const card = $(this).closest('.goal-card');

            const startDate = card.find('.goal-start').val();

            const endDate = card.find('.goal-end').val();

            if (startDate && endDate && endDate < startDate) {

                alert('Expected Completion Date cannot be earlier than Goal Start Date.');

                card.find('.goal-end').val('');

            }

        });

    });
</script>