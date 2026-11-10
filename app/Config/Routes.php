
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Helper for applying permission filters.
$permission = static function (string $rightKey): array {
    return ['filter' => 'permission:' . $rightKey];
};

// No matching right currently exists for these modules.
// The PermissionFilter allows only Super Admin to pass this check.
$superAdminOnly = $permission('__super_admin_only__');


// ======================================
// AUTHENTICATION ROUTES
// ======================================

$routes->get('login', 'Auth::login');
$routes->post('login/authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');


// ======================================
// DASHBOARD
// ======================================

$routes->get('/', 'Dashboard::index');


// ======================================
// MANAGE PROGRAMS
// ======================================

$routes->get('programs', 'Programs::index', $permission('manage_programs_page'));
$routes->get('forms/add_programs', 'Programs::add', $permission('manage_programs_page'));
$routes->post('programs/store', 'Programs::store', $permission('manage_programs_page'));
$routes->get('programs/view/(:segment)', 'Programs::view/$1', $permission('manage_programs_page'));
$routes->get('programs/edit/(:segment)', 'Programs::edit/$1', $permission('manage_programs_page'));
$routes->post('programs/update/(:segment)', 'Programs::update/$1', $permission('manage_programs_page'));
$routes->get('programs/delete/(:segment)', 'Programs::delete/$1', $permission('manage_programs_page'));


// ======================================
// PROGRAM THEMES
// ======================================

$routes->get('program_theme', 'ProgramThemeController::index', $permission('program_themes'));
$routes->get('program_theme/add', 'ProgramThemeController::add', $permission('program_themes'));
$routes->post('program_theme/store', 'ProgramThemeController::store', $permission('program_themes'));
$routes->get('program_theme/view/(:any)', 'ProgramThemeController::view/$1', $permission('program_themes'));
$routes->get('program_theme/edit/(:any)', 'ProgramThemeController::edit/$1', $permission('program_themes'));
$routes->post('program_theme/update/(:any)', 'ProgramThemeController::update/$1', $permission('program_themes'));
$routes->get('program_theme/delete/(:any)', 'ProgramThemeController::delete/$1', $permission('program_themes'));


// ======================================
// MANAGE USERS
// ======================================

$routes->get('users', 'Users::index', $permission('manage_users'));
$routes->get('users/add', 'Users::add', $permission('manage_users'));
$routes->post('users/store', 'Users::store', $permission('manage_users'));
$routes->get('users/view/(:any)', 'Users::view/$1', $permission('manage_users'));
$routes->get('users/edit/(:any)', 'Users::edit/$1', $permission('manage_users'));
$routes->post('users/update/(:any)', 'Users::update/$1', $permission('manage_users'));
$routes->get('users/delete/(:segment)', 'Users::delete/$1', $permission('manage_users'));


// ======================================
// MANAGE ROLES
// ======================================

$routes->get('roles', 'Role::index', $permission('roles'));
$routes->get('roles/add', 'Role::add', $permission('roles'));
$routes->post('roles/store', 'Role::store', $permission('roles'));
$routes->get('roles/view/(:any)', 'Role::view/$1', $permission('roles'));
$routes->get('roles/edit/(:any)', 'Role::edit/$1', $permission('roles'));
$routes->post('roles/update/(:any)', 'Role::update/$1', $permission('roles'));
$routes->get('roles/delete/(:any)', 'Role::delete/$1', $permission('roles'));


// ======================================
// ASSIGN RIGHTS
// ======================================

$routes->get(
    'roles/assign-rights',
    'Role::assignRightsIndex',
    $permission('assign_rights')
);

$routes->get(
    'roles/assign-rights/view/(:any)',
    'Role::viewRights/$1',
    $permission('assign_rights')
);

$routes->get(
    'roles/assign-rights/edit/(:any)',
    'Role::assignRights/$1',
    $permission('assign_rights')
);

$routes->post(
    'roles/assign-rights/save/(:any)',
    'Role::saveRights/$1',
    $permission('assign_rights')
);


// ======================================
// RIGHTS MANAGEMENT
// No dedicated permission key exists yet.
// Super Admin only.
// ======================================

$routes->get('rights', 'Rights::index', $superAdminOnly);
$routes->get('rights/manage', 'Rights::index', $superAdminOnly);
$routes->get('rights/add', 'Rights::add', $superAdminOnly);
$routes->post('rights/store', 'Rights::store', $superAdminOnly);
$routes->post('rights/save', 'Rights::save', $superAdminOnly);
$routes->get('rights/edit/(:any)', 'Rights::edit/$1', $superAdminOnly);
$routes->post('rights/update/(:any)', 'Rights::update/$1', $superAdminOnly);
$routes->get('rights/delete/(:any)', 'Rights::delete/$1', $superAdminOnly);


// ======================================
// EVENT TYPES
// No dedicated permission key exists yet.
// Super Admin only.
// ======================================

$routes->get('eventtype', 'EventType::index', $superAdminOnly);
$routes->get('eventtype/add', 'EventType::add', $superAdminOnly);
$routes->post('eventtype/store', 'EventType::store', $superAdminOnly);
$routes->get('eventtype/view/(:any)', 'EventType::view/$1', $superAdminOnly);
$routes->get('eventtype/edit/(:any)', 'EventType::edit/$1', $superAdminOnly);
$routes->post('eventtype/update/(:any)', 'EventType::update/$1', $superAdminOnly);
$routes->get('eventtype/delete/(:any)', 'EventType::delete/$1', $superAdminOnly);


// ======================================
// EVENT DETAILS
// No dedicated permission key exists yet.
// Super Admin only.
// ======================================

$routes->get('events/list', 'Event::eventList', $superAdminOnly);
$routes->get('events/add', 'Event::addEvent', $superAdminOnly);
$routes->post('events/save', 'Event::saveEvent', $superAdminOnly);
$routes->get('events/edit/(:any)', 'Event::editEvent/$1', $superAdminOnly);
$routes->post('events/update/(:any)', 'Event::updateEvent/$1', $superAdminOnly);
$routes->get('events/delete/(:any)', 'Event::deleteEvent/$1', $superAdminOnly);


// ======================================
// GOAL TYPES
// ======================================

$routes->get('goals/types', 'GoalType::goalTypes', $permission('goal_types'));
$routes->get('goals/types/add', 'GoalType::addGoalType', $permission('goal_types'));
$routes->post('goals/types/save', 'GoalType::saveGoalType', $permission('goal_types'));
$routes->get('goals/types/edit/(:any)', 'GoalType::editGoalType/$1', $permission('goal_types'));
$routes->post('goals/types/update/(:any)', 'GoalType::updateGoalType/$1', $permission('goal_types'));
$routes->get('goals/types/delete/(:any)', 'GoalType::deleteGoalType/$1', $permission('goal_types'));
$routes->get('goals/types/view/(:any)', 'GoalType::view/$1', $permission('goal_types'));


// ======================================
// GOALS
// ======================================

$routes->get('goals', 'Goal::index', $permission('goals'));
$routes->get('goals/add', 'Goal::add', $permission('goals'));
$routes->post('goals/save', 'Goal::save', $permission('goals'));
$routes->get('goals/view/(:any)', 'Goal::view/$1', $permission('goals'));
$routes->get('goals/edit/(:any)', 'Goal::edit/$1', $permission('goals'));
$routes->post('goals/update/(:any)', 'Goal::update/$1', $permission('goals'));
$routes->get('goals/delete/(:any)', 'Goal::delete/$1', $permission('goals'));


// ======================================
// MANAGE CENTERS
// ======================================

$routes->get('center', 'Center::index', $permission('manage_centers'));
$routes->get('center/add', 'Center::add', $permission('manage_centers'));
$routes->post('center/store', 'Center::store', $permission('manage_centers'));
$routes->get('center/view/(:any)', 'Center::view/$1', $permission('manage_centers'));
$routes->get('center/edit/(:any)', 'Center::edit/$1', $permission('manage_centers'));
$routes->post('center/update/(:any)', 'Center::update/$1', $permission('manage_centers'));
$routes->get('center/delete/(:any)', 'Center::delete/$1', $permission('manage_centers'));


// ======================================
// MANAGE BATCHES
// ======================================

$routes->get('batches', 'Batch::index', $permission('manage_batches'));
$routes->get('batches/add', 'Batch::add', $permission('manage_batches'));
$routes->post('batches/store', 'Batch::store', $permission('manage_batches'));
$routes->get('batches/view/(:any)', 'Batch::view/$1', $permission('manage_batches'));
$routes->get('batches/edit/(:any)', 'Batch::edit/$1', $permission('manage_batches'));
$routes->post('batches/update/(:any)', 'Batch::update/$1', $permission('manage_batches'));
$routes->get('batches/delete/(:any)', 'Batch::delete/$1', $permission('manage_batches'));


// ======================================
// PROJECT VIJETAAS STUDENTS
// ======================================

$routes->group('students/vijetaas', [
    'filter' => 'permission:vijetaas_students'
], function ($routes) {

    $routes->get('/', 'ManageStudents\Vijetaas::index');
    $routes->get('add', 'ManageStudents\Vijetaas::add');
    $routes->post('store', 'ManageStudents\Vijetaas::store');
    $routes->get('view/(:any)', 'ManageStudents\Vijetaas::view/$1');
    $routes->get('edit/(:any)', 'ManageStudents\Vijetaas::edit/$1');
    $routes->post('update/(:any)', 'ManageStudents\Vijetaas::update/$1');
    $routes->get('delete/(:any)', 'ManageStudents\Vijetaas::delete/$1');

    // Vijetaas Goals
    $routes->get('goals', 'ManageStudents\VijetaasGoals::index');
    $routes->get('goals/add', 'ManageStudents\VijetaasGoals::addGoal');
    $routes->post('goals/store', 'ManageStudents\VijetaasGoals::storeGoal');
    $routes->get('goals/view/(:any)', 'ManageStudents\VijetaasGoals::viewGoal/$1');
    $routes->get('goals/edit/(:any)', 'ManageStudents\VijetaasGoals::editGoal/$1');
    $routes->post('goals/update/(:any)', 'ManageStudents\VijetaasGoals::updateGoal/$1');
    $routes->get('goals/delete/(:any)', 'ManageStudents\VijetaasGoals::deleteGoal/$1');
});


// Vijetaas Education Qualifications AJAX
$routes->get(
    'students/vijetaas/getQualifications/(:num)',
    'ManageStudents\Vijetaas::getQualifications/$1',
    $permission('vijetaas_students')
);


// ======================================
// LEARNING ADDA STUDENTS
// ======================================

$routes->group('students/learning_adda', [
    'filter' => 'permission:learning_adda_students'
], function ($routes) {

    $routes->get('/', 'ManageStudents\LearningAdda::index');

    $routes->get('add', 'ManageStudents\LearningAdda::add');
    $routes->post('store', 'ManageStudents\LearningAdda::store');

    $routes->get('view/(:segment)', 'ManageStudents\LearningAdda::view/$1');

    $routes->get('edit/(:segment)', 'ManageStudents\LearningAdda::edit/$1');
    $routes->post('update/(:segment)', 'ManageStudents\LearningAdda::update/$1');

    $routes->get('delete/(:segment)', 'ManageStudents\LearningAdda::delete/$1');
});


// ======================================
// DIGITAL SHAKTI STUDENTS
// ======================================

$routes->get('digitalshakti', 'ManageStudents\DigitalShakti::index', $permission('digital_shakti_students'));
$routes->get('digitalshakti/add', 'ManageStudents\DigitalShakti::add', $permission('digital_shakti_students'));
$routes->post('digitalshakti/save', 'ManageStudents\DigitalShakti::save', $permission('digital_shakti_students'));

$routes->get(
    'digitalshakti/view/(:segment)',
    'ManageStudents\DigitalShakti::view/$1',
    $permission('digital_shakti_students')
);

$routes->get(
    'digitalshakti/edit/(:segment)',
    'ManageStudents\DigitalShakti::edit/$1',
    $permission('digital_shakti_students')
);

$routes->post(
    'digitalshakti/update/(:segment)',
    'ManageStudents\DigitalShakti::update/$1',
    $permission('digital_shakti_students')
);

$routes->get(
    'digitalshakti/delete/(:segment)',
    'ManageStudents\DigitalShakti::delete/$1',
    $permission('digital_shakti_students')
);


// ======================================
// DOOSRA MAUKA STUDENTS
// ======================================

$routes->group('ManageStudents', [
    'filter' => 'permission:doosra_mauka_students'
], function ($routes) {

    $routes->get('DoosraMauka', 'ManageStudents\DoosraMauka::index');

    $routes->get(
        'DoosraMauka/view/(:segment)',
        'ManageStudents\DoosraMauka::view/$1'
    );

    $routes->get(
        'DoosraMauka/add',
        'ManageStudents\DoosraMauka::add'
    );

    $routes->post(
        'DoosraMauka/store',
        'ManageStudents\DoosraMauka::store'
    );

    $routes->get(
        'DoosraMauka/edit/(:segment)',
        'ManageStudents\DoosraMauka::edit/$1'
    );

    $routes->post(
        'DoosraMauka/update/(:segment)',
        'ManageStudents\DoosraMauka::update/$1'
    );

    $routes->get(
        'DoosraMauka/delete/(:segment)',
        'ManageStudents\DoosraMauka::delete/$1'
    );
});


// ======================================
// SCHOOL SAHYOG STUDENTS
// ======================================

$routes->group('students/school_sahyog', [
    'filter' => 'permission:school_sahyog_students'
], function ($routes) {

    $routes->get('/', 'ManageStudents\SchoolSahyog::index');

    $routes->get('add', 'ManageStudents\SchoolSahyog::add');

    $routes->post('store', 'ManageStudents\SchoolSahyog::store');

    $routes->get(
        'view/(:segment)',
        'ManageStudents\SchoolSahyog::view/$1'
    );

    $routes->get(
        'edit/(:segment)',
        'ManageStudents\SchoolSahyog::edit/$1'
    );

    $routes->post(
        'update/(:segment)',
        'ManageStudents\SchoolSahyog::update/$1'
    );

    $routes->get(
        'delete/(:segment)',
        'ManageStudents\SchoolSahyog::delete/$1'
    );
});


// ======================================
// ATTENDANCE
// Center-based workflow.
// Permission mapping is intentionally left
// to your existing center-based implementation.
// ======================================

$routes->get('attendance/class', 'Attendance::index');

$routes->post('attendance/get-centers', 'Attendance::getCenters');
$routes->post('attendance/get-batches', 'Attendance::getBatches');
$routes->post('attendance/get-students', 'Attendance::getStudents');
$routes->post('attendance/save', 'Attendance::saveAttendance');
$routes->post('attendance/get-attendance-dates', 'Attendance::getAttendanceDates');


// ======================================
// FEES
// Center-based workflow.
// Permission mapping is intentionally left
// to your existing center-based implementation.
// ======================================

$routes->get('fees', 'Fees::index');

$routes->post('finance/fees/get-centers', 'Fees::getCenters');
$routes->post('finance/fees/get-batches', 'Fees::getBatches');
$routes->post('finance/fees/get-students', 'Fees::getStudents');
$routes->post('finance/fees/save', 'Fees::save');


// ======================================
// LEARNING ADDA ASSESSMENT
// ======================================

$routes->group('assessment/learning-adda', [
    'filter' => 'permission:learning_adda_assessment'
], function ($routes) {

    $routes->get('/', 'Assessment\LearningAdda::index');

    $routes->post(
        'get-batches',
        'Assessment\LearningAdda::getBatches'
    );

    $routes->post(
        'get-students',
        'Assessment\LearningAdda::getStudents'
    );

    $routes->get(
        'add',
        'Assessment\LearningAdda::add'
    );

    $routes->post(
        'save',
        'Assessment\LearningAdda::save'
    );

    $routes->get(
        'view/(:segment)',
        'Assessment\LearningAdda::view/$1'
    );

    $routes->get(
        'edit/(:segment)/(:segment)',
        'Assessment\LearningAdda::edit/$1/$2'
    );

    $routes->post(
        'update',
        'Assessment\LearningAdda::update'
    );
});


// ======================================
// SCHOOL SAHYOG ASSESSMENT
// ======================================

$routes->group('assessment/school-sahyog', [
    'filter' => 'permission:school_sahyog_assessment'
], function ($routes) {

    $routes->get('/', 'Assessment\SchoolSahyog::index');

    $routes->post(
        'get-batches',
        'Assessment\SchoolSahyog::getBatches'
    );

    $routes->post(
        'get-students',
        'Assessment\SchoolSahyog::getStudents'
    );

    $routes->get(
        'add',
        'Assessment\SchoolSahyog::add'
    );

    $routes->post(
        'save',
        'Assessment\SchoolSahyog::save'
    );

    $routes->get(
        'view/(:segment)',
        'Assessment\SchoolSahyog::view/$1'
    );

    $routes->get(
        'edit/(:segment)/(:segment)',
        'Assessment\SchoolSahyog::edit/$1/$2'
    );

    $routes->post(
        'update',
        'Assessment\SchoolSahyog::update'
    );
});


// ======================================
// DOOSRA MAUKA ASSESSMENT
// ======================================

$routes->group('assessment/doosra-mauka', [
    'filter' => 'permission:doosra_mauka_assessment'
], function ($routes) {

    $routes->get('/', 'Assessment\DoosraMauka::index');

    $routes->post(
        'get-batches',
        'Assessment\DoosraMauka::getBatches'
    );

    $routes->post(
        'get-students',
        'Assessment\DoosraMauka::getStudents'
    );

    $routes->get(
        'add',
        'Assessment\DoosraMauka::add'
    );

    $routes->post(
        'save',
        'Assessment\DoosraMauka::save'
    );

    $routes->get(
        'view/(:segment)',
        'Assessment\DoosraMauka::view/$1'
    );

    $routes->get(
        'edit/(:segment)/(:segment)',
        'Assessment\DoosraMauka::edit/$1/$2'
    );

    $routes->post(
        'update',
        'Assessment\DoosraMauka::update'
    );
});


// ======================================
// DIGITAL SHAKTI ASSESSMENT
// ======================================

$routes->group('assessment/digital-shakti', [
    'filter' => 'permission:digital_shakti_assessment'
], function ($routes) {

    $routes->get(
        '/',
        'Assessment\DigitalShakti::index'
    );

    $routes->post(
        'get-batches',
        'Assessment\DigitalShakti::getBatches'
    );

    $routes->post(
        'get-students',
        'Assessment\DigitalShakti::getStudents'
    );

    $routes->post(
        'save',
        'Assessment\DigitalShakti::save'
    );
});
