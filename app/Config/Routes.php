<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
// Manage Program Routes
$routes->get('programs', 'Programs::index');
$routes->get('forms/add_programs', 'Programs::add');
$routes->post('programs/store', 'Programs::store');
$routes->get('programs/view/(:segment)', 'Programs::view/$1');
$routes->get('programs/edit/(:segment)', 'Programs::edit/$1');
$routes->post('programs/update/(:segment)', 'Programs::update/$1');
$routes->get('programs/delete/(:segment)', 'Programs::delete/$1');
// Manage Program Themes
$routes->get('program_theme', 'ProgramThemeController::index');
$routes->get('program_theme/add', 'ProgramThemeController::add');
$routes->post('program_theme/store', 'ProgramThemeController::store');
$routes->get('program_theme/view/(:any)', 'ProgramThemeController::view/$1');
$routes->get('program_theme/edit/(:any)', 'ProgramThemeController::edit/$1');
$routes->post('program_theme/update/(:any)', 'ProgramThemeController::update/$1');
$routes->get('program_theme/delete/(:any)', 'ProgramThemeController::delete/$1');
// manage User Routes
$routes->get('users', 'Users::index');
$routes->get('users/add', 'Users::add');
$routes->post('users/store', 'Users::store');
$routes->get('users/view/(:any)', 'Users::view/$1');
$routes->get('users/edit/(:any)', 'Users::edit/$1');
$routes->post('users/update/(:any)', 'Users::update/$1');
$routes->get('users/delete/(:segment)', 'Users::delete/$1');
// Manage Role Routes
$routes->get('roles', 'Role::index');
$routes->get('roles/manage', 'Role::index');
$routes->get('roles/add', 'Role::add');
$routes->post('roles/store', 'Role::store');
$routes->get('roles/edit/(:any)', 'Role::edit/$1');
$routes->post('roles/update/(:any)', 'Role::update/$1');
$routes->get('roles/delete/(:any)', 'Role::delete/$1');
// manage Rights Routes 
$routes->get('rights', 'Rights::index');
$routes->get('rights/manage', 'Rights::index');
$routes->get('rights/add', 'Rights::add');
$routes->post('rights/store', 'Rights::store');
$routes->post('rights/save', 'Rights::save');
$routes->get('rights/edit/(:any)', 'Rights::edit/$1');
$routes->post('rights/update/(:any)', 'Rights::update/$1');
$routes->get('rights/delete/(:any)', 'Rights::delete/$1');
//Manage EventType
$routes->get('eventtype', 'EventType::index');
$routes->get('eventtype/add', 'EventType::add');
$routes->post('eventtype/store', 'EventType::store');
$routes->get('eventtype/view/(:any)', 'EventType::view/$1');
$routes->get('eventtype/edit/(:any)', 'EventType::edit/$1');
$routes->post('eventtype/update/(:any)', 'EventType::update/$1');
$routes->get('eventtype/delete/(:any)', 'EventType::delete/$1');
//Manage Event Details
$routes->get('events/list', 'Event::eventList');
$routes->get('events/add', 'Event::addEvent');
$routes->post('events/save', 'Event::saveEvent');
$routes->get('events/edit/(:any)', 'Event::editEvent/$1');
$routes->post('events/update/(:any)', 'Event::updateEvent/$1');
$routes->get('events/delete/(:any)', 'Event::deleteEvent/$1');
// Manage Goal Types
$routes->get('goals/types', 'GoalType::goalTypes');
$routes->get('goals/types/add', 'GoalType::addGoalType');
$routes->post('goals/types/save', 'GoalType::saveGoalType');
$routes->get('goals/types/edit/(:any)', 'GoalType::editGoalType/$1');
$routes->post('goals/types/update/(:any)', 'GoalType::updateGoalType/$1');
$routes->get('goals/types/delete/(:any)', 'GoalType::deleteGoalType/$1');
$routes->get('goals/types/view/(:any)', 'GoalType::view/$1');

//Manage Goals
// Goal Master Module

$routes->get('goals', 'Goal::index');

$routes->get('goals/add', 'Goal::add');
$routes->post('goals/save', 'Goal::save');

$routes->get('goals/view/(:any)', 'Goal::view/$1');

$routes->get('goals/edit/(:any)', 'Goal::edit/$1');
$routes->post('goals/update/(:any)', 'Goal::update/$1');

$routes->get('goals/delete/(:any)', 'Goal::delete/$1');
// Manage Centers
$routes->get('center', 'Center::index');
$routes->get('center/add', 'Center::add');
$routes->post('center/store', 'Center::store');
$routes->get('center/view/(:any)', 'Center::view/$1');
$routes->get('center/edit/(:any)', 'Center::edit/$1');
$routes->post('center/update/(:any)', 'Center::update/$1');
$routes->get('center/delete/(:any)', 'Center::delete/$1');
//Manage batches
$routes->get('batches', 'Batch::index');
$routes->get('batches/add', 'Batch::add');
$routes->post('batches/store', 'Batch::store');
$routes->get('batches/view/(:any)', 'Batch::view/$1');
$routes->get('batches/edit/(:any)', 'Batch::edit/$1');
$routes->post('batches/update/(:any)', 'Batch::update/$1');
$routes->get('batches/delete/(:any)', 'Batch::delete/$1');

// Manage Students - Vijetaas
$routes->group('students/vijetaas', function ($routes) {
    $routes->get('/', 'ManageStudents\Vijetaas::index');
    $routes->get('add', 'ManageStudents\Vijetaas::add');
    $routes->post('store', 'ManageStudents\Vijetaas::store');
    $routes->get('view/(:any)', 'ManageStudents\Vijetaas::view/$1');
    $routes->get('edit/(:any)', 'ManageStudents\Vijetaas::edit/$1');
    $routes->post('update/(:any)', 'ManageStudents\Vijetaas::update/$1');
    $routes->get('delete/(:any)', 'ManageStudents\Vijetaas::delete/$1');

    // Goals CRUD (inside same folder but different controller)
    $routes->get('goals', 'ManageStudents\VijetaasGoals::index');
    $routes->get('goals/add', 'ManageStudents\VijetaasGoals::addGoal');
    $routes->post('goals/store', 'ManageStudents\VijetaasGoals::storeGoal');
    $routes->get('goals/view/(:any)', 'ManageStudents\VijetaasGoals::viewGoal/$1');
    $routes->get('goals/edit/(:any)', 'ManageStudents\VijetaasGoals::editGoal/$1');
    $routes->post('goals/update/(:any)', 'ManageStudents\VijetaasGoals::updateGoal/$1');
    $routes->get('goals/delete/(:any)', 'ManageStudents\VijetaasGoals::deleteGoal/$1');
});

// Manage Students - Learning Adda
$routes->group('students/learning_adda', function ($routes) {

    $routes->get('/', 'ManageStudents\LearningAdda::index');

    $routes->get('add', 'ManageStudents\LearningAdda::add');
    $routes->post('store', 'ManageStudents\LearningAdda::store');

    $routes->get('view/(:segment)', 'ManageStudents\LearningAdda::view/$1');

    $routes->get('edit/(:segment)', 'ManageStudents\LearningAdda::edit/$1');
    $routes->post('update/(:segment)', 'ManageStudents\LearningAdda::update/$1');

    $routes->get('delete/(:segment)', 'ManageStudents\LearningAdda::delete/$1');
});


// Manage Students -- Digital_Shakti
// Digital Shakti Routes
$routes->get('digitalshakti', 'ManageStudents\DigitalShakti::index');

$routes->get('digitalshakti/add', 'ManageStudents\DigitalShakti::add');

$routes->post('digitalshakti/save', 'ManageStudents\DigitalShakti::save');

$routes->get(
    'digitalshakti/view/(:segment)',
    'ManageStudents\DigitalShakti::view/$1'
);

$routes->get(
    'digitalshakti/edit/(:segment)',
    'ManageStudents\DigitalShakti::edit/$1'
);

$routes->post(
    'digitalshakti/update/(:segment)',
    'ManageStudents\DigitalShakti::update/$1'
);
$routes->get(
    'digitalshakti/delete/(:segment)',
    'ManageStudents\DigitalShakti::delete/$1'
);

// Manage Students -- Doosra_Mauka
$routes->group('ManageStudents', function ($routes) {

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


// Attendance
$routes->get(
    'attendance/class',
    'Attendance::index'
);

$routes->post(
    'attendance/get-centers',
    'Attendance::getCenters'
);

$routes->post(
    'attendance/get-batches',
    'Attendance::getBatches'
);

$routes->post(
    'attendance/get-students',
    'Attendance::getStudents'
);
$routes->post(
    'attendance/save',
    'Attendance::saveAttendance'
);
$routes->post('attendance/get-attendance-dates', 'Attendance::getAttendanceDates');
