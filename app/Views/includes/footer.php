</div> <!-- main-panel end -->
</div> <!-- page-body-wrapper end -->
</div> <!-- container-scroller end -->

<!-- Core JS -->
<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>

<!-- Bootstrap JS -->


<!-- Template JS -->
<script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
<script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
<script src="<?= base_url('assets/js/template.js') ?>"></script>

<!-- Plugins -->
<script src="<?= base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/chart.js/chart.umd.js') ?>"></script>
<script src="<?= base_url('assets/vendors/progressbar.js/progressbar.min.js') ?>"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JS -->
<script src="<?= base_url('assets/js/validations.js') ?>"></script>

<!--validation-->
<script src="<?= base_url('assets/js/validations.js') ?>"></script>

<!-- Multi-Step Form Navigation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const tabs = document.querySelectorAll(
            '#studentTabs .nav-link'
        );

        // If page doesn't have tabs, stop
        if (!tabs.length) return;

        //----------------------------------
        // NEXT BUTTON
        //----------------------------------

        document.querySelectorAll('.next-tab').forEach(btn => {

            btn.addEventListener('click', function() {

                const currentPane =
                    this.closest('.tab-pane');

                if (!currentPane) return;

                //----------------------------------
                // Validate current tab
                //----------------------------------

                const requiredFields =
                    currentPane.querySelectorAll('[required]');

                let valid = true;

                requiredFields.forEach(field => {

                    if (!field.checkValidity()) {

                        field.reportValidity();

                        valid = false;
                    }

                });

                if (!valid) return;

                //----------------------------------
                // Find current tab index
                //----------------------------------

                const currentTabId = currentPane.id;

                let currentIndex = -1;

                tabs.forEach((tab, index) => {

                    if (
                        tab.getAttribute('href') ===
                        '#' + currentTabId
                    ) {
                        currentIndex = index;
                    }

                });

                //----------------------------------
                // Move to next tab
                //----------------------------------

                if (
                    currentIndex >= 0 &&
                    tabs[currentIndex + 1]
                ) {

                    new bootstrap.Tab(
                        tabs[currentIndex + 1]
                    ).show();

                }

            });

        });

        //----------------------------------
        // PREVIOUS BUTTON
        //----------------------------------

        document.querySelectorAll('.prev-tab').forEach(btn => {

            btn.addEventListener('click', function() {

                const currentPane =
                    this.closest('.tab-pane');

                if (!currentPane) return;

                const currentTabId =
                    currentPane.id;

                let currentIndex = -1;

                tabs.forEach((tab, index) => {

                    if (
                        tab.getAttribute('href') ===
                        '#' + currentTabId
                    ) {
                        currentIndex = index;
                    }

                });

                //----------------------------------
                // Move to previous tab
                //----------------------------------

                if (
                    currentIndex > 0 &&
                    tabs[currentIndex - 1]
                ) {

                    new bootstrap.Tab(
                        tabs[currentIndex - 1]
                    ).show();

                }

            });

        });

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</body>

</html>