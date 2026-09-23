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

<script>
    /*
    |--------------------------------------------------------------------------
    | Load Qualifications
    |--------------------------------------------------------------------------
    */

    function loadQualifications(levelId, qualificationSelect, selectedValue = '') {

        if (!levelId) {

            qualificationSelect.innerHTML =
                '<option value="">-- Select Qualification / Class --</option>';

            return;
        }

        fetch(
                "<?= site_url('students/vijetaas/getQualifications') ?>/" + levelId
            )

            .then(response => response.json())

            .then(data => {

                qualificationSelect.innerHTML =
                    '<option value="">-- Select Qualification / Class --</option>';

                data.forEach(function(item) {

                    let option = document.createElement('option');

                    option.value = item.name;
                    option.textContent = item.name;

                    if (item.name === selectedValue) {
                        option.selected = true;
                    }

                    qualificationSelect.appendChild(option);

                });

            })

            .catch(error => {

                console.error(
                    'Error loading qualifications:',
                    error
                );

            });
    }


    /*
    |--------------------------------------------------------------------------
    | Current Education Qualification
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('currentEducationLevel')
        .addEventListener('change', function() {

            let selectedOption =
                this.options[this.selectedIndex];

            let levelId =
                selectedOption.getAttribute('data-id');

            loadQualifications(
                levelId,
                document.getElementById('currentQualification')
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Highest Education Qualification
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('highestEducationLevel')
        .addEventListener('change', function() {

            let selectedOption =
                this.options[this.selectedIndex];

            let levelId =
                selectedOption.getAttribute('data-id');

            loadQualifications(
                levelId,
                document.getElementById('highestQualification')
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Load Old Values After Validation Error
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function() {

        let currentLevel =
            document.getElementById('currentEducationLevel');

        let highestLevel =
            document.getElementById('highestEducationLevel');


        // Current Education
        if (currentLevel.value) {

            let selectedOption =
                currentLevel.options[currentLevel.selectedIndex];

            let levelId =
                selectedOption.getAttribute('data-id');

            loadQualifications(
                levelId,
                document.getElementById('currentQualification'),
                "<?= esc(old('Current_Qualification')) ?>"
            );
        }


        // Highest Education
        if (highestLevel.value) {

            let selectedOption =
                highestLevel.options[highestLevel.selectedIndex];

            let levelId =
                selectedOption.getAttribute('data-id');

            loadQualifications(
                levelId,
                document.getElementById('highestQualification'),
                "<?= esc(old('Highest_Qualification')) ?>"
            );
        }

    });
</script>


<script>
    /*
    |--------------------------------------------------------------------------
    | Load Qualifications
    |--------------------------------------------------------------------------
    */

    function loadQualifications(
        levelId,
        qualificationSelect,
        selectedValue = ''
    ) {

        if (!levelId) {

            qualificationSelect.innerHTML =
                '<option value="">-- Select Qualification / Class --</option>';

            return;
        }


        fetch(
                "<?= site_url('students/vijetaas/getQualifications') ?>/" + levelId
            )

            .then(response => response.json())

            .then(data => {

                qualificationSelect.innerHTML =
                    '<option value="">-- Select Qualification / Class --</option>';


                data.forEach(function(item) {

                    let option = document.createElement('option');

                    option.value = item.name;

                    option.textContent = item.name;


                    if (item.name === selectedValue) {

                        option.selected = true;

                    }


                    qualificationSelect.appendChild(option);

                });

            })

            .catch(error => {

                console.error(
                    'Error loading qualifications:',
                    error
                );

            });

    }


    /*
    |--------------------------------------------------------------------------
    | Current Education Level Change
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('currentEducationLevel')
        .addEventListener('change', function() {

            let selectedOption =
                this.options[this.selectedIndex];

            let levelId =
                selectedOption.getAttribute('data-id');


            loadQualifications(
                levelId,
                document.getElementById('currentQualification')
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Highest Education Level Change
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('highestEducationLevel')
        .addEventListener('change', function() {

            let selectedOption =
                this.options[this.selectedIndex];

            let levelId =
                selectedOption.getAttribute('data-id');


            loadQualifications(
                levelId,
                document.getElementById('highestQualification')
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Load Existing Values When Edit Page Opens
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function() {

        /*
        |--------------------------------------------------------------------------
        | Current Education
        |--------------------------------------------------------------------------
        */

        let currentLevel =
            document.getElementById('currentEducationLevel');

        let currentQualification =
            document.getElementById('currentQualification');


        if (currentLevel && currentLevel.value) {

            let selectedOption =
                currentLevel.options[
                    currentLevel.selectedIndex
                ];

            let levelId =
                selectedOption.getAttribute('data-id');


            loadQualifications(
                levelId,
                currentQualification,
                "<?= esc($student['Current_Qualification'] ?? '') ?>"
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Highest Education
        |--------------------------------------------------------------------------
        */

        let highestLevel =
            document.getElementById('highestEducationLevel');

        let highestQualification =
            document.getElementById('highestQualification');


        if (highestLevel && highestLevel.value) {

            let selectedOption =
                highestLevel.options[
                    highestLevel.selectedIndex
                ];

            let levelId =
                selectedOption.getAttribute('data-id');


            loadQualifications(
                levelId,
                highestQualification,
                "<?= esc($student['Highest_Qualification'] ?? '') ?>"
            );

        }

    });
</script>

</body>

</html>