<?php $i = 1; ?>

<?php foreach ($students as $student): ?>

    <tr>

        <td><?= $i++; ?></td>

        <td><?= $student['Student_Id']; ?></td>

        <td>

            <?= $student['First_Name']; ?>

            <?= $student['Last_Name']; ?>

        </td>

        <td class="text-center">

            <input
                type="radio"
                class="attendance-option"
                id="present_<?= $student['Student_Id']; ?>"
                name="attendance[<?= $student['Student_Id']; ?>]"
                value="Present"
                <?= (($student['Attendance_Status'] ?? '') == 'Present')
                    ? 'checked'
                    : '' ?>>

            <label
                for="present_<?= $student['Student_Id']; ?>"
                class="attendance-label present-label">

                P

            </label>

        </td>

        <td class="text-center">

            <input
                type="radio"
                class="attendance-option"
                id="absent_<?= $student['Student_Id']; ?>"
                name="attendance[<?= $student['Student_Id']; ?>]"
                value="Absent"
                <?= (($student['Attendance_Status'] ?? '') == 'Absent')
                    ? 'checked'
                    : '' ?>>

            <label
                for="absent_<?= $student['Student_Id']; ?>"
                class="attendance-label absent-label">

                A

            </label>

        </td>

        <td>

            <input
                type="text"
                class="form-control"
                name="remark[<?= $student['Student_Id']; ?>]"
                value="<?= $student['Remarks'] ?? '' ?>">
        </td>

    </tr>

<?php endforeach; ?>