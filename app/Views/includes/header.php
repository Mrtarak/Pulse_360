<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pulse 360 </title>
  <!-- DataTables CSS (for sorting arrows, search box, pagination, etc.) -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <style>
    .dataTables_filter input {
      height: 35px;
      font-size: 14px;
      padding: 5px 10px;
      background-color: #ffffff;
      border: 1px solid #ced4da;
      border-radius: 4px;
      width: 250px;
    }

    .dataTables_length select {
      height: 38px;
      font-size: 14px;
      padding: 6px 12px;
      background-color: #ffffff;
      border: 1px solid #ced4da;
      border-radius: 4px;
      width: auto;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 3px 8px !important;
      font-size: 10px;
      margin: 2px;
      border-radius: 3px;
      background-color: #f0f0f0 !important;
      border: 1px solid #ddd !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background-color: #005eff !important;
      color: white !important;
      border-color: #005eff !important;
    }

    table.dataTable thead th {
      font-size: 14px;
      background-color: #f9f9f9;
      padding: 10px;
    }

    table.dataTable td {
      padding: 8px 12px;
    }
  </style>

  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url('assets/vendors/feather/feather.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/ti-icons/css/themify-icons.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/typicons/typicons.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/simple-line-icons/css/simple-line-icons.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/select.dataTables.min.css') ?>">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />
  <!-- custom css file link -->
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
  <style>
    /* Dropdown selected text */
    .form-select,
    .form-control {
      color: #212529 !important;
      font-weight: 500;
    }

    /* Dropdown options */
    .form-select option {
      color: #212529 !important;
      background-color: #ffffff !important;
    }

    /* Placeholder option */
    .form-select option:first-child {
      color: #6c757d !important;
    }

    /* Make labels darker too */
    .form-label,
    label {
      color: #000 !important;
      font-weight: 600;
    }
  </style>
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body class="with-welcome-text">
  <div class="container-scroller">