<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;
use App\Models\StudentGoalsModel;
use App\Models\GoalAssignmentModel;
use App\Models\StudentGoalAssignmentModel;

class VijetaasGoals extends BaseController
{
    public function index()
    {
        $model = new StudentGoalsModel();
        $programId = 'PROG_685153f441971';
        $data['goals'] = $model->getGoalsByProgram($programId);

        return view('ManageStudents/vijetaas/goals_list', $data);
    }


    public function assignGoalForm($id)
    {
        $db = \Config\Database::connect();

        // Fetch selected Vijetaas student
        $data['student'] = $db->table('vijetaas_stu vs')
            ->select('vs.Vijetaas_Stu_Id, vs.Student_Id, s.First_Name, s.Last_Name')
            ->join('student s', 's.Student_Id = vs.Student_Id', 'left')
            ->where('vs.Vijetaas_Stu_Id', $id)
            ->get()
            ->getRowArray();

        if (empty($data['student'])) {
            return redirect()->to('students/vijetaas/assign-goal')
                ->with('error', 'Vijetaas student not found.');
        }

        // Fetch available sessions
        $assignmentModel = new GoalAssignmentModel();
        $data['sessions'] = $assignmentModel->getGoalSessions();

        // Fetch goal types
        $data['goalTypes'] = $db->table('goaltype_m')
            ->orderBy('Goal_Type_Name', 'ASC')
            ->get()
            ->getResultArray();

        // Fetch mentors assigned to this Vijetaas student
        // Fetch active Vijetaas mentors (same source as enrollment form)
        $data['mentors'] = $db->table('user_m')
            ->select('User_Id, User_FirstName, User_LastName')
            ->where('Role_Id', 'ROLE005')
            ->where('User_Status', 'Active')
            ->orderBy('User_FirstName', 'ASC')
            ->get()
            ->getResultArray();

        return view('ManageStudents/vijetaas/assign_goal', $data);
    }


    public function addGoal()
    {
        return view('ManageStudents/vijetaas/add_goal');
    }

    public function storeGoal()
    {
        $goalModel = new StudentGoalsModel();
        $goalModel->insert($this->request->getPost());
        return redirect()->to('students/vijetaas/goals')->with('success', 'Goal added successfully');
    }

    public function viewGoal($id)
    {
        $goalModel = new StudentGoalsModel();
        $data['goal'] = $goalModel->find($id);
        return view('ManageStudents/vijetaas/view_goal', $data);
    }

    public function editGoal($id)
    {
        $goalModel = new StudentGoalsModel();
        $data['goal'] = $goalModel->find($id);
        return view('ManageStudents/vijetaas/edit_goal', $data);
    }

    public function updateGoal($id)
    {
        $goalModel = new StudentGoalsModel();
        $goalModel->update($id, $this->request->getPost());
        return redirect()->to('students/vijetaas/goals')->with('success', 'Goal updated successfully');
    }

    public function deleteGoal($id)
    {
        $goalModel = new StudentGoalsModel();
        $goalModel->delete($id);
        return redirect()->to('students/vijetaas/goals')->with('success', 'Goal deleted successfully');
    }

    public function assignGoalIndex()
    {
        $model = new GoalAssignmentModel();

        $data['students'] = $model->getVijetaasGoalManagementList();
        $data['sessions'] = $model->getGoalSessions();

        return view('ManageStudents/vijetaas/assign_goal_index', $data);
    }




    public function reviewGoals($id)
    {
        $db = \Config\Database::connect();

        // 1. Fetch student
        $data['student'] = $db->table('vijetaas_stu vs')
            ->select('vs.Vijetaas_Stu_Id, vs.Student_Id, s.First_Name, s.Last_Name')
            ->join('student s', 's.Student_Id = vs.Student_Id', 'left')
            ->where('vs.Vijetaas_Stu_Id', $id)
            ->get()
            ->getRowArray();

        if (empty($data['student'])) {
            return redirect()->to('students/vijetaas/assign-goal')
                ->with('error', 'Vijetaas student not found.');
        }

        // 2. Fetch all assignments/sessions belonging to this student
        $data['assignments'] = $db->table('goal_assignment_m ga')
            ->select('
            ga.Goal_Assignment_Id,
            ga.Goal_Session_Id,
            ga.Assignment_Status,
            gs.Session_Name,
            gs.Session_Start_Date,
            gs.Session_End_Date
        ')
            ->join('goal_session_m gs', 'gs.Goal_Session_Id = ga.Goal_Session_Id', 'left')
            ->where('ga.Vijetaas_Stu_Id', $id)
            ->orderBy('gs.Session_Start_Date', 'DESC')
            ->orderBy('ga.Rec_Added_On', 'DESC')
            ->get()
            ->getResultArray();

        $data['assignment'] = null;
        $data['goals'] = [];
        $data['latestReview'] = null;
        $data['reviewingMentorIds'] = [];
        $data['savedCategoryRemarks'] = [];

        // 3. Get selected assignment ID from URL
        $selectedAssignmentId = $this->request->getGet('assignment_id');

        // If no assignment ID is supplied, select the latest assignment
        if (empty($selectedAssignmentId) && !empty($data['assignments'])) {
            $selectedAssignmentId = $data['assignments'][0]['Goal_Assignment_Id'];
        }

        // 4. Find the selected assignment only from this student's assignments
        if (!empty($selectedAssignmentId)) {
            foreach ($data['assignments'] as $item) {
                if ($item['Goal_Assignment_Id'] === $selectedAssignmentId) {
                    $data['assignment'] = $item;
                    break;
                }
            }
        }

        // 5. Load goals only for the selected assignment
        if (!empty($data['assignment'])) {

            $assignmentId = $data['assignment']['Goal_Assignment_Id'];

            $data['goals'] = $db->table('student_goal sg')
                ->select('
                sg.Student_Goal_Id,
                sg.Goal_Assignment_Id,
                sg.Goal_Type_Id,
                gt.Goal_Type_Name,
                sg.Goal_Title,
                sg.Goal_Description,
                sg.Mentor_Id,
                sg.Goal_Start_On,
                sg.Expected_Completion_Date,
                sg.Actual_Completion_Date,
                sg.Target_Value,
                sg.Achieved_Value,
                sg.Self_Progress,
                sg.Mentor_Progress,
                u.User_FirstName AS Mentor_FirstName,
                u.User_LastName AS Mentor_LastName
            ')
                ->join('goaltype_m gt', 'gt.Goal_Type_Id = sg.Goal_Type_Id', 'left')
                ->join('user_m u', 'u.User_Id = sg.Mentor_Id', 'left')
                ->where('sg.Goal_Assignment_Id', $assignmentId)
                ->orderBy('gt.Goal_Type_Name', 'ASC')
                ->orderBy('sg.Goal_Start_On', 'ASC')
                ->get()
                ->getResultArray();

            // 6. Attach the latest saved review to each goal individually
            foreach ($data['goals'] as &$goal) {

                $savedReview = $db->table('goal_review_detail grd')
                    ->select('
                    grd.Goal_Review_Id,
                    grd.Self_Rating,
                    grd.Self_Remark,
                    grd.Mentor_Rating,
                    grd.Mentor_Remark,
                    grd.Goal_Status AS Review_Goal_Status,
                    grd.Next_Target_Date,
                    grm.Review_Date
                ')
                    ->join(
                        'goal_review_m grm',
                        'grm.Goal_Review_Id = grd.Goal_Review_Id',
                        'inner'
                    )
                    ->where('grd.Student_Goal_Id', $goal['Student_Goal_Id'])
                    ->where('grm.Goal_Assignment_Id', $assignmentId)
                    ->orderBy('grm.Review_Date', 'DESC')
                    ->orderBy('grm.Rec_Added_On', 'DESC')
                    ->orderBy('grm.Goal_Review_Id', 'DESC')
                    ->get()
                    ->getRowArray();

                $goal['Review_Self_Rating'] = $savedReview['Self_Rating'] ?? '';
                $goal['Review_Self_Remark'] = $savedReview['Self_Remark'] ?? '';
                $goal['Review_Mentor_Rating'] = $savedReview['Mentor_Rating'] ?? '';
                $goal['Review_Mentor_Remark'] = $savedReview['Mentor_Remark'] ?? '';
                $goal['Review_Goal_Status'] = $savedReview['Review_Goal_Status'] ?? '';
                $goal['Review_Next_Target_Date'] = $savedReview['Next_Target_Date'] ?? '';
            }

            unset($goal);

            // 7. Latest overall review for the selected assignment
            $data['latestReview'] = $db->table('goal_review_m')
                ->where('Goal_Assignment_Id', $assignmentId)
                ->orderBy('Review_Date', 'DESC')
                ->orderBy('Rec_Added_On', 'DESC')
                ->orderBy('Goal_Review_Id', 'DESC')
                ->get()
                ->getRowArray();

            $latestReviewId = $data['latestReview']['Goal_Review_Id'] ?? null;

            // 8. Reviewing mentors for the latest review
            if ($latestReviewId) {

                $mentorRows = $db->table('goal_review_mentor_map')
                    ->select('Mentor_User_Id')
                    ->where('Goal_Review_Id', $latestReviewId)
                    ->get()
                    ->getResultArray();

                $data['reviewingMentorIds'] = array_column(
                    $mentorRows,
                    'Mentor_User_Id'
                );

                // 9. Category remarks for the latest review
                $remarkRows = $db->table('goal_review_category_remark')
                    ->select('Goal_Category, Category_Mentor_Remark')
                    ->where('Goal_Review_Id', $latestReviewId)
                    ->get()
                    ->getResultArray();

                foreach ($remarkRows as $remark) {
                    $data['savedCategoryRemarks'][$remark['Goal_Category']] =
                        $remark['Category_Mentor_Remark'];
                }
            }
        }

        // 10. Active Vijetaas mentors
        $data['mentors'] = $db->table('user_m')
            ->select('User_Id, User_FirstName, User_LastName')
            ->where('Role_Id', 'ROLE005')
            ->where('User_Status', 'Active')
            ->orderBy('User_FirstName', 'ASC')
            ->get()
            ->getResultArray();

        return view('ManageStudents/vijetaas/review_goals', $data);
    }




    public function storeAssignment()
    {
        $db = \Config\Database::connect();

        $vijetaasStuId = $this->request->getPost('Vijetaas_Stu_Id');
        $sessionId      = $this->request->getPost('Goal_Session_Id');
        $notes          = $this->request->getPost('Assignment_Notes');
        $goals          = $this->request->getPost('goals');

        // Basic validation
        if (empty($vijetaasStuId) || empty($sessionId) || empty($goals) || !is_array($goals)) {
            return redirect()->back()->withInput()->with('error', 'Please complete all required details.');
        }

        // Fetch Vijetaas student
        $student = $db->table('vijetaas_stu')
            ->select('Vijetaas_Stu_Id, Student_Id')
            ->where('Vijetaas_Stu_Id', $vijetaasStuId)
            ->get()
            ->getRowArray();

        if (!$student) {
            return redirect()->back()->withInput()->with('error', 'Student not found.');
        }

        // Validate session
        $session = $db->table('goal_session_m')
            ->where('Goal_Session_Id', $sessionId)
            ->get()
            ->getRowArray();

        if (!$session) {
            return redirect()->back()->withInput()->with('error', 'Invalid goal session selected.');
        }

        // Validate individual goals
        foreach ($goals as $goal) {

            if (
                empty($goal['Goal_Type_Id']) ||
                empty($goal['Goal_Title']) ||
                empty($goal['Mentor_Id']) ||
                empty($goal['Goal_Start_On']) ||
                empty($goal['Expected_Completion_Date'])
            ) {
                return redirect()->back()->withInput()->with('error', 'Please complete all required fields for every goal.');
            }

            if (
                strtotime($goal['Expected_Completion_Date']) <
                strtotime($goal['Goal_Start_On'])
            ) {
                return redirect()->back()->withInput()->with('error', 'Expected completion date cannot be earlier than the goal start date.');
            }
        }

        // Create Assignment ID
        $assignmentId = 'GA-' . date('YmdHis') . '-' . mt_rand(100, 999);

        $addedBy = session()->get('User_Id') ?? 'ADMIN';
        $now     = date('Y-m-d H:i:s');

        // Transaction
        $db->transBegin();

        try {

            // Insert assignment record
            $db->table('goal_assignment_m')->insert([
                'Goal_Assignment_Id'     => $assignmentId,
                'Vijetaas_Stu_Id'        => $vijetaasStuId,
                'Goal_Session_Id'         => $sessionId,
                'Assignment_Notes'        => $notes,
                'Assignment_Status'        => 'Active',
                'Record_Added_By'         => $addedBy,
                'Rec_Added_On'            => $now,
                'Rec_Updated_By'           => $addedBy,
                'Rec_Last_Updated_On'     => $now
            ]);

            // Insert individual goals
            foreach ($goals as $goal) {

                $studentGoalId = 'SG-' . date('YmdHis') . '-' . mt_rand(1000, 9999);

                $db->table('student_goal')->insert([
                    'Student_Goal_Id'           => $studentGoalId,
                    'Goal_Assignment_Id'         => $assignmentId,
                    'Student_Id'                 => $student['Student_Id'],
                    'Goal_Type_Id'               => $goal['Goal_Type_Id'],
                    'Goal_Title'                 => trim($goal['Goal_Title']),
                    'Goal_Assigned_On'            => date('Y-m-d'),
                    'Goal_Description'            => $goal['Goal_Description'] ?? '',
                    'Mentor_Id'                   => $goal['Mentor_Id'],
                    'Goal_Start_On'                => $goal['Goal_Start_On'],
                    'Expected_Completion_Date'     => $goal['Expected_Completion_Date'],
                    'Target_Value'                 => $goal['Target_Value'] ?? null,
                    'Achieved_Value'               => 0,
                    'Self_Progress'                => 0,
                    'Mentor_Progress'              => 0,
                    'Goal_Status'                  => 'Active',
                    'Rec_Added_By'              => $addedBy,
                    'Rec_Added_On'                 => $now,
                    'Rec_Updated_By'               => $addedBy,
                    'Rec_Last_Updated_On'          => $now
                ]);
            }

            if ($db->transStatus() === false) {
                $db->transRollback();

                return redirect()->back()->withInput()->with('error', 'Failed to save goal assignment.');
            }

            $db->transCommit();

            return redirect()->to('students/vijetaas/assign-goal')
                ->with('success', 'Goals assigned successfully.');
        } catch (\Throwable $e) {

            $db->transRollback();

            log_message('error', 'Goal assignment error: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'An error occurred while saving the goal assignment.');
        }
    }


    public function viewStudentGoals($id)
    {
        $db = \Config\Database::connect();

        // 1. Fetch student details
        $data['student'] = $db->table('vijetaas_stu vs')
            ->select('vs.Vijetaas_Stu_Id, vs.Student_Id, s.First_Name, s.Last_Name')
            ->join('student s', 's.Student_Id = vs.Student_Id', 'left')
            ->where('vs.Vijetaas_Stu_Id', $id)
            ->get()
            ->getRowArray();

        if (empty($data['student'])) {
            return redirect()->to('students/vijetaas/assign-goal')
                ->with('error', 'Vijetaas student not found.');
        }

        // 2. Fetch all sessions assigned to this student
        $data['assignments'] = $db->table('goal_assignment_m ga')
            ->select('
            ga.Goal_Assignment_Id,
            ga.Goal_Session_Id,
            ga.Assignment_Status,
            ga.Assignment_Notes,
            gs.Session_Name,
            gs.Session_Start_Date,
            gs.Session_End_Date
        ')
            ->join(
                'goal_session_m gs',
                'gs.Goal_Session_Id = ga.Goal_Session_Id',
                'left'
            )
            ->where('ga.Vijetaas_Stu_Id', $id)
            ->orderBy('gs.Session_Start_Date', 'DESC')
            ->orderBy('ga.Rec_Added_On', 'DESC')
            ->get()
            ->getResultArray();

        $data['assignment'] = null;
        $data['latestReview'] = null;
        $data['goals'] = [];
        $data['reviewingMentors'] = [];
        $data['categoryRemarks'] = [];

        // 3. Select assignment from URL
        $selectedAssignmentId = $this->request->getGet('assignment_id');

        // Default to latest session
        if (empty($selectedAssignmentId) && !empty($data['assignments'])) {
            $selectedAssignmentId = $data['assignments'][0]['Goal_Assignment_Id'];
        }

        // Validate selected assignment belongs to this student
        foreach ($data['assignments'] as $assignment) {
            if ($assignment['Goal_Assignment_Id'] === $selectedAssignmentId) {
                $data['assignment'] = $assignment;
                break;
            }
        }

        // 4. Fetch data for selected assignment
        if (!empty($data['assignment'])) {

            $assignmentId = $data['assignment']['Goal_Assignment_Id'];

            // Get the latest review master record for this assignment
            $data['latestReview'] = $db->table('goal_review_m')
                ->where('Goal_Assignment_Id', $assignmentId)
                ->where('Vijetaas_Stu_Id', $id)
                ->orderBy('Review_Date', 'DESC')
                ->orderBy('Rec_Added_On', 'DESC')
                ->orderBy('Goal_Review_Id', 'DESC')
                ->get()
                ->getRowArray();

            $reviewId = $data['latestReview']['Goal_Review_Id'] ?? null;

            // 5. Fetch all goals belonging to this assignment
            $data['goals'] = $db->table('student_goal sg')
                ->select('
                sg.Student_Goal_Id,
                sg.Goal_Assignment_Id,
                sg.Goal_Type_Id,
                gt.Goal_Type_Name,
                sg.Goal_Title,
                sg.Goal_Description,
                sg.Goal_Assigned_On,
                sg.Mentor_Id,
                sg.Goal_Start_On,
                sg.Expected_Completion_Date,
                sg.Actual_Completion_Date,
                sg.Target_Value,
                sg.Achieved_Value,
                sg.Goal_Status AS Assignment_Goal_Status,
                u.User_FirstName AS Assigned_Mentor_FirstName,
                u.User_LastName AS Assigned_Mentor_LastName
            ')
                ->join('goaltype_m gt', 'gt.Goal_Type_Id = sg.Goal_Type_Id', 'left')
                ->join('user_m u', 'u.User_Id = sg.Mentor_Id', 'left')
                ->where('sg.Goal_Assignment_Id', $assignmentId)
                ->orderBy('gt.Goal_Type_Name', 'ASC')
                ->orderBy('sg.Goal_Start_On', 'ASC')
                ->get()
                ->getResultArray();


            // Set default review values, including when no review exists yet.
            foreach ($data['goals'] as &$goal) {
                $goal['Self_Rating'] = null;
                $goal['Self_Remark'] = '';
                $goal['Mentor_Rating'] = null;
                $goal['Mentor_Remark'] = '';
                $goal['Review_Goal_Status'] = '';
                $goal['Next_Target_Date'] = null;
            }
            unset($goal);

            // 6. Attach details from the SAME latest review to each goal
            if (!empty($reviewId) && !empty($data['goals'])) {

                $reviewDetails = $db->table('goal_review_detail')
                    ->where('Goal_Review_Id', $reviewId)
                    ->get()
                    ->getResultArray();

                $reviewDetailsByGoal = [];

                foreach ($reviewDetails as $detail) {
                    $reviewDetailsByGoal[$detail['Student_Goal_Id']] = $detail;
                }

                foreach ($data['goals'] as &$goal) {

                    $detail = $reviewDetailsByGoal[$goal['Student_Goal_Id']] ?? [];

                    $goal['Self_Rating'] = $detail['Self_Rating'] ?? null;
                    $goal['Self_Remark'] = $detail['Self_Remark'] ?? '';
                    $goal['Mentor_Rating'] = $detail['Mentor_Rating'] ?? null;
                    $goal['Mentor_Remark'] = $detail['Mentor_Remark'] ?? '';
                    $goal['Review_Goal_Status'] = $detail['Goal_Status'] ?? '';
                    $goal['Next_Target_Date'] = $detail['Next_Target_Date'] ?? null;
                }

                unset($goal);

                // 7. Fetch reviewing mentors for this review
                $data['reviewingMentors'] = $db->table('goal_review_mentor_map grm')
                    ->select('u.User_FirstName, u.User_LastName')
                    ->join(
                        'user_m u',
                        'u.User_Id = grm.Mentor_User_Id',
                        'inner'
                    )
                    ->where('grm.Goal_Review_Id', $reviewId)
                    ->orderBy('u.User_FirstName', 'ASC')
                    ->get()
                    ->getResultArray();

                // 8. Fetch category-wise mentor remarks
                $remarks = $db->table('goal_review_category_remark')
                    ->where('Goal_Review_Id', $reviewId)
                    ->get()
                    ->getResultArray();

                foreach ($remarks as $remark) {
                    $data['categoryRemarks'][$remark['Goal_Category']] =
                        $remark['Category_Mentor_Remark'];
                }
            }
        }

        return view('ManageStudents/vijetaas/view_student_goals', $data);
    }




    public function storeReview()
    {
        $db = \Config\Database::connect();

        $studentId       = $this->request->getPost('Vijetaas_Stu_Id');
        $assignmentId    = $this->request->getPost('Goal_Assignment_Id');
        $reviewDate      = $this->request->getPost('Review_Date');
        $mentors         = $this->request->getPost('reviewing_mentors') ?? [];
        $reviews         = $this->request->getPost('reviews') ?? [];
        $categoryRemarks = $this->request->getPost('category_remarks') ?? [];

        $redirectUrl = 'students/vijetaas/goals/review/' . $studentId;

        if (!empty($assignmentId)) {
            $redirectUrl .= '?assignment_id=' . urlencode($assignmentId);
        }

        // 1. Basic validation
        if (
            empty($studentId) ||
            empty($assignmentId) ||
            empty($reviewDate) ||
            !is_array($mentors) ||
            !is_array($reviews) ||
            !is_array($categoryRemarks)
        ) {
            return redirect()->to($redirectUrl)
                ->withInput()
                ->with('error', 'Please complete the required review details.');
        }

        // 2. Validate review date
        $date = \DateTime::createFromFormat('Y-m-d', $reviewDate);

        if (!$date || $date->format('Y-m-d') !== $reviewDate) {
            return redirect()->to($redirectUrl)
                ->withInput()
                ->with('error', 'Invalid review date.');
        }

        // 3. Verify assignment belongs to this student
        $assignment = $db->table('goal_assignment_m')
            ->where('Goal_Assignment_Id', $assignmentId)
            ->where('Vijetaas_Stu_Id', $studentId)
            ->get()
            ->getRowArray();

        if (!$assignment) {
            return redirect()->to($redirectUrl)
                ->with('error', 'Invalid student goal assignment.');
        }

        // 4. Fetch goals belonging to the selected assignment
        $assignedGoals = $db->table('student_goal sg')
            ->select('sg.Student_Goal_Id, sg.Goal_Type_Id, gt.Goal_Type_Name')
            ->join('goaltype_m gt', 'gt.Goal_Type_Id = sg.Goal_Type_Id', 'left')
            ->where('sg.Goal_Assignment_Id', $assignmentId)
            ->get()
            ->getResultArray();

        if (empty($assignedGoals)) {
            return redirect()->to($redirectUrl)
                ->with('error', 'No goals are assigned in this session.');
        }

        // 5. Verify submitted goal IDs belong to this assignment
        $assignedGoalIds = array_column($assignedGoals, 'Student_Goal_Id');

        foreach ($reviews as $goalId => $review) {
            if (!in_array($goalId, $assignedGoalIds, true)) {
                return redirect()->to($redirectUrl)
                    ->with('error', 'An invalid goal was submitted for review.');
            }
        }

        // 6. Identify goals that actually contain review data
        $goalsToSave = [];

        $allowedStatuses = [
            'Assigned',
            'Completed',
            'Hold',
            'Ready for Review',
            'Canceled'
        ];

        foreach ($assignedGoals as $goal) {

            $goalId = $goal['Student_Goal_Id'];
            $review = $reviews[$goalId] ?? [];

            if (!is_array($review)) {
                continue;
            }

            $selfRating   = trim((string) ($review['Self_Rating'] ?? ''));
            $selfRemark   = trim((string) ($review['Self_Remark'] ?? ''));
            $mentorRating = trim((string) ($review['Mentor_Rating'] ?? ''));
            $mentorRemark = trim((string) ($review['Mentor_Remark'] ?? ''));
            $status       = trim((string) ($review['Goal_Status'] ?? ''));
            $nextDate     = trim((string) ($review['Next_Target_Date'] ?? ''));

            // A goal is considered reviewed if at least one field has data
            $hasReviewData = (
                $selfRating !== '' ||
                $selfRemark !== '' ||
                $mentorRating !== '' ||
                $mentorRemark !== '' ||
                $status !== '' ||
                $nextDate !== ''
            );

            // Skip completely blank goals
            if (!$hasReviewData) {
                continue;
            }

            // A reviewed goal must have a selected status
            if ($status === '' || !in_array($status, $allowedStatuses, true)) {
                return redirect()->to($redirectUrl)
                    ->withInput()
                    ->with('error', 'Please select a valid status for every goal you review.');
            }

            // Validate ratings
            foreach (
                [
                    'Self Rating' => $selfRating,
                    'Mentor Rating' => $mentorRating
                ] as $label => $rating
            ) {

                if (
                    $rating !== '' &&
                    (!is_numeric($rating) || $rating < 0 || $rating > 10)
                ) {
                    return redirect()->to($redirectUrl)
                        ->withInput()
                        ->with('error', $label . ' must be between 0 and 10.');
                }
            }

            // Next target date is mandatory for Assigned goals
            if ($status === 'Assigned' && $nextDate === '') {
                return redirect()->to($redirectUrl)
                    ->withInput()
                    ->with('error', 'Please enter the next target date for assigned goals.');
            }

            // Validate next target date if supplied
            if ($nextDate !== '') {
                $nextDateObject = \DateTime::createFromFormat('Y-m-d', $nextDate);

                if (
                    !$nextDateObject ||
                    $nextDateObject->format('Y-m-d') !== $nextDate
                ) {
                    return redirect()->to($redirectUrl)
                        ->withInput()
                        ->with('error', 'Invalid next target date.');
                }
            }

            if ($status !== 'Assigned') {
                $nextDate = '';
            }

            $goalsToSave[$goalId] = [
                'Self_Rating'   => $selfRating,
                'Self_Remark'   => $selfRemark,
                'Mentor_Rating' => $mentorRating,
                'Mentor_Remark' => $mentorRemark,
                'Goal_Status'   => $status,
                'Next_Target_Date' => $nextDate
            ];
        }

        // Require at least one reviewed goal
        if (empty($goalsToSave)) {
            return redirect()->to($redirectUrl)
                ->withInput()
                ->with('error', 'Please enter review details for at least one goal.');
        }

        // 7. Require at least one reviewing mentor
        $mentors = array_values(array_unique(array_filter($mentors)));

        if (empty($mentors)) {
            return redirect()->to($redirectUrl)
                ->withInput()
                ->with('error', 'Please select at least one reviewing mentor.');
        }

        // Verify selected mentors are active Vijetaas mentors
        $validMentors = $db->table('user_m')
            ->select('User_Id')
            ->where('Role_Id', 'ROLE005')
            ->where('User_Status', 'Active')
            ->whereIn('User_Id', $mentors)
            ->get()
            ->getResultArray();

        if (count($validMentors) !== count($mentors)) {
            return redirect()->to($redirectUrl)
                ->withInput()
                ->with('error', 'One or more selected mentors are invalid or inactive.');
        }

        // 8. Generate IDs
        $generateId = function ($prefix) {
            return $prefix . date('ymdHis') . mt_rand(100, 999);
        };

        $reviewId = $generateId('GR');

        $addedBy = session()->get('User_Id') ?? 'ADMIN';
        $today   = date('Y-m-d');

        // 9. Save everything in one transaction
        $db->transBegin();

        try {

            // Main review record
            $db->table('goal_review_m')->insert([
                'Goal_Review_Id'      => $reviewId,
                'Goal_Assignment_Id'  => $assignmentId,
                'Vijetaas_Stu_Id'     => $studentId,
                'Review_Date'         => $reviewDate,
                'Review_Status'       => 'Active',
                'Rec_Added_By'        => $addedBy,
                'Rec_Added_On'        => $today,
                'Rec_Updated_By'      => $addedBy,
                'Rec_Last_Updated_On' => $today
            ]);

            // Reviewing mentor mappings
            foreach ($mentors as $mentorId) {
                $db->table('goal_review_mentor_map')->insert([
                    'Goal_Review_Mentor_Id' => $generateId('GM'),
                    'Goal_Review_Id'        => $reviewId,
                    'Mentor_User_Id'        => $mentorId,
                    'Rec_Added_By'          => $addedBy,
                    'Rec_Added_On'          => $today
                ]);
            }

            // Save only goals that have review data
            foreach ($goalsToSave as $goalId => $review) {

                $db->table('goal_review_detail')->insert([
                    'Goal_Review_Detail_Id' => $generateId('GD'),
                    'Goal_Review_Id'        => $reviewId,
                    'Student_Goal_Id'       => $goalId,

                    'Self_Rating' => $review['Self_Rating'] !== ''
                        ? $review['Self_Rating'] : null,

                    'Self_Remark' => $review['Self_Remark'] !== ''
                        ? $review['Self_Remark'] : null,

                    'Mentor_Rating' => $review['Mentor_Rating'] !== ''
                        ? $review['Mentor_Rating'] : null,

                    'Mentor_Remark' => $review['Mentor_Remark'] !== ''
                        ? $review['Mentor_Remark'] : null,

                    'Goal_Status'      => $review['Goal_Status'],
                    'Next_Target_Date' => $review['Next_Target_Date'] !== ''
                        ? $review['Next_Target_Date'] : null,

                    'Rec_Added_By'        => $addedBy,
                    'Rec_Added_On'        => $today,
                    'Rec_Updated_By'      => $addedBy,
                    'Rec_Last_Updated_On' => $today
                ]);
            }

            // Save non-empty category remarks
            $categoryNames = [];

            foreach ($assignedGoals as $goal) {
                $categoryNames[$goal['Goal_Type_Id']] = $goal['Goal_Type_Name'];
            }

            foreach ($categoryNames as $typeId => $typeName) {

                $remark = trim((string) ($categoryRemarks[$typeId] ?? ''));

                if ($remark === '') {
                    continue;
                }

                $db->table('goal_review_category_remark')->insert([
                    'Goal_Review_Category_Id' => $generateId('GC'),
                    'Goal_Review_Id'          => $reviewId,
                    'Goal_Category'           => $typeName,
                    'Category_Mentor_Remark'  => $remark,
                    'Rec_Added_By'            => $addedBy,
                    'Rec_Added_On'            => $today,
                    'Rec_Updated_By'          => $addedBy,
                    'Rec_Last_Updated_On'     => $today
                ]);
            }

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Database transaction failed.');
            }

            $db->transCommit();

            return redirect()->to('students/vijetaas/assign-goal')
                ->with('success', 'Goal review saved successfully.');
        } catch (\Throwable $e) {

            $db->transRollback();

            log_message('error', 'Goal review save error: ' . $e->getMessage());

            return redirect()->to($redirectUrl)
                ->withInput()
                ->with('error', 'Unable to save goal review. Please check the database structure and try again.');
        }
    }
}
