<?php

namespace App\Models;

use CodeIgniter\Model;

class GoalAssignmentModel extends Model
{
    protected $table            = 'goal_assignment_m';
    protected $primaryKey       = 'Goal_Assignment_Id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'Goal_Assignment_Id',
        'Vijetaas_Stu_Id',
        'Goal_Session_Id',
        'Assignment_Notes',
        'Assignment_Status',
        'Record_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    protected $useTimestamps = false;


    /**
     * Get Vijetaas students with their latest goal session
     * and goal assignment counts.
     */

    public function getVijetaasGoalManagementList()
    {
        return $this->db->table('vijetaas_stu vs')
            ->select("
            vs.Vijetaas_Stu_Id,
            vs.Student_Id,
            vs.Vijeta_Status,

            s.First_Name,
            s.Last_Name,

            p.Program_Name,

            latest_session.Session_Name,

            COALESCE(goal_counts.Total_Goals, 0) AS Total_Goals,
            COALESCE(goal_counts.Active_Goals, 0) AS Active_Goals,
            COALESCE(goal_counts.Completed_Goals, 0) AS Completed_Goals
        ")

            ->join(
                'student s',
                's.Student_Id = vs.Student_Id',
                'left'
            )

            ->join(
                'program_m p',
                'p.Program_Id = vs.Program_Id',
                'left'
            )

            // Latest goal session
            ->join(
                "(
                SELECT
                    ga.Vijetaas_Stu_Id,
                    gs.Session_Name
                FROM goal_assignment_m ga
                INNER JOIN goal_session_m gs
                    ON gs.Goal_Session_Id = ga.Goal_Session_Id
                INNER JOIN (
                    SELECT
                        Vijetaas_Stu_Id,
                        MAX(Rec_Added_On) AS Latest_Date
                    FROM goal_assignment_m
                    GROUP BY Vijetaas_Stu_Id
                ) latest
                    ON latest.Vijetaas_Stu_Id = ga.Vijetaas_Stu_Id
                    AND latest.Latest_Date = ga.Rec_Added_On
            ) latest_session",
                'latest_session.Vijetaas_Stu_Id = vs.Vijetaas_Stu_Id',
                'left',
                false
            )

            // Goal counts using the latest review status
            ->join(
                "(
                SELECT
                    goal_statuses.Vijetaas_Stu_Id,

                    COUNT(goal_statuses.Student_Goal_Id) AS Total_Goals,

                    SUM(
                        CASE
                            WHEN goal_statuses.Current_Goal_Status
                                IN ('Active', 'Assigned', 'Hold', 'Ready for Review')
                            THEN 1
                            ELSE 0
                        END
                    ) AS Active_Goals,

                    SUM(
                        CASE
                            WHEN goal_statuses.Current_Goal_Status = 'Completed'
                            THEN 1
                            ELSE 0
                        END
                    ) AS Completed_Goals

                FROM (
                    SELECT
                        ga.Vijetaas_Stu_Id,
                        sg.Student_Goal_Id,

                        COALESCE(
                            (
                                SELECT grd.Goal_Status
                                FROM goal_review_detail grd
                                INNER JOIN goal_review_m grm
                                    ON grm.Goal_Review_Id = grd.Goal_Review_Id
                                WHERE grd.Student_Goal_Id = sg.Student_Goal_Id
                                ORDER BY
                                    grm.Review_Date DESC,
                                    grm.Rec_Added_On DESC,
                                    grm.Goal_Review_Id DESC
                                LIMIT 1
                            ),
                            sg.Goal_Status
                        ) AS Current_Goal_Status

                    FROM goal_assignment_m ga

                    INNER JOIN student_goal sg
                        ON sg.Goal_Assignment_Id = ga.Goal_Assignment_Id

                ) goal_statuses

                GROUP BY goal_statuses.Vijetaas_Stu_Id

            ) goal_counts",
                'goal_counts.Vijetaas_Stu_Id = vs.Vijetaas_Stu_Id',
                'left',
                false
            )

            ->orderBy('s.First_Name', 'ASC')
            ->orderBy('s.Last_Name', 'ASC')
            ->get()
            ->getResultArray();
    }


    /**
     * Get all goal sessions for the session filter.
     */
    public function getGoalSessions()
    {
        return $this->db->table('goal_session_m')
            ->select('Goal_Session_Id, Session_Name')
            ->orderBy('Session_Start_Date', 'DESC')
            ->get()
            ->getResultArray();
    }
}
