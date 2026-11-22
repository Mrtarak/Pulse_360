<?php $i = 1; ?>

<?php foreach ($students as $student): ?>

    <?php
    $studentId = $student['Student_Id'];
    $currentStatus = $student['Attendance_Status'] ?? '';
    ?>

    <tr>

        <td><?= $i++; ?></td>

        <td><?= esc($studentId); ?></td>

        <td>
            <?= esc($student['First_Name']); ?>
            <?= esc($student['Last_Name']); ?>
        </td>

        <!-- PRESENT -->
        <td class="text-center">

            <input
                type="radio"
                class="attendance-option"
                id="present_<?= esc($studentId); ?>"
                name="attendance[<?= esc($studentId); ?>]"
                value="Present"
                <?= $currentStatus == 'Present' ? 'checked' : '' ?>>

            <label
                for="present_<?= esc($studentId); ?>"
                class="attendance-label present-label">

                P

            </label>

        </td>

        <!-- ABSENT -->
        <td class="text-center">

            <input
                type="radio"
                class="attendance-option"
                id="absent_<?= esc($studentId); ?>"
                name="attendance[<?= esc($studentId); ?>]"
                value="Absent"
                <?= $currentStatus == 'Absent' ? 'checked' : '' ?>>

            <label
                for="absent_<?= esc($studentId); ?>"
                class="attendance-label absent-label">

                A

            </label>

        </td>

        <!-- LEAVE -->
        <td class="text-center">

            <input
                type="radio"
                class="attendance-option"
                id="leave_<?= esc($studentId); ?>"
                name="attendance[<?= esc($studentId); ?>]"
                value="Leave"
                <?= $currentStatus == 'Leave' ? 'checked' : '' ?>>

            <label
                for="leave_<?= esc($studentId); ?>"
                class="attendance-label leave-label">

                L

            </label>

        </td>

        <!-- REMARKS -->
        <td>

            <input
                type="text"
                class="form-control"
                name="remark[<?= esc($studentId); ?>]"
                value="<?= esc($student['Remarks'] ?? ''); ?>">

        </td>

    </tr>

<?php endforeach; ?>