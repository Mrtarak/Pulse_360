<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

              <?= view('includes/breadcrumb'); ?>

              <!-- Header -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0"><i class="mdi mdi-book-open-page-variant me-2"></i>User List</h4>
                <?= view('includes/messages'); ?>
                <div class="d-flex align-items-center">
                  <label for="statusFilter" class="me-2">Status:</label>
                  <select id="statusFilter" class="form-select me-3" style="width: 150px;">
                    <option value="">All</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Completed">Completed</option>
                  </select>
                  <label for="roleFilter" class="me-2">Role:</label>
                  <select id="roleFilter" class="form-select me-3" style="width: 150px;">
                    <option value="">All</option>
                    <?php foreach ($roles as $role): ?>
                      <option value="<?= esc($role['Role_Name']) ?>"><?= esc($role['Role_Name']) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <a href="<?= site_url('users/add') ?>" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus-circle-outline me-1"></i> Add New User
                  </a>
                </div>
              </div>
              <!-- Table -->
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="userTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Program</th>
                          <th>Location</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($users)): ?>
                          <?php $i = 1;
                          foreach ($users as $user): ?>
                            <tr>
                              <td><?= $i++ ?></td>
                              <td><?= esc($user['User_FirstName'] . ' ' . $user['User_LastName']) ?></td>
                              <td><?= esc($user['User_Login_MailID']) ?></td>
                              <td><?= esc($user['Role_Name']) ?></td>
                              <td><?= esc($user['Program_Name']) ?></td>
                              <td><?= esc($user['User_Village_City'] . ',' . $user['User_State']) ?></td>
                              <td>
                                <?php
                                $status = $user['User_Status'];
                                $color = match ($status) {
                                  'Active' => '#28a745',
                                  'Inactive' => '#dc3545',
                                  'Completed' => '#ffc107',
                                  default => '#6c757d',
                                };
                                ?>
                                <span style="background-color: <?= $color ?>; color: white; padding: 5px 10px; border-radius: 5px;">
                                  <?= esc($status) ?>
                                </span>
                              </td>
                              <td>
                                <a href="<?= site_url('users/view/' . $user['User_Id']) ?>" class="btn btn-info btn-sm" title="View">
                                  <i class="mdi mdi-eye"></i>
                                </a>
                                <a href="<?= site_url('users/edit/' . $user['User_Id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                  <i class="mdi mdi-pencil"></i>
                                </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <?= view('includes/footer'); ?>

              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
              <script>
                $(document).ready(function() {
                  var table = $('#userTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    columnDefs: [{
                      targets: 6, // Status column
                      render: function(data, type, row) {
                        if (type === 'filter' || type === 'sort') {
                          return $('<div>').html(data).text().trim(); // strip HTML for sorting/filter
                        }
                        return data; // otherwise, return HTML for display
                      }
                    }]
                  });

                  // Status Filter
                  $('#statusFilter').on('change', function() {
                    var selected = $(this).val();
                    table.column(6)
                      .search(selected ? '^' + selected + '$' : '', true, false) // exact match with regex
                      .draw();
                  });
                  // role filter
                  $('#roleFilter').on('change', function() {
                    let selected = $(this).val();
                    table.column(3) // Role column index
                      .search(selected ? '^' + selected + '$' : '', true, false)
                      .draw();
                  });
                });
              </script>