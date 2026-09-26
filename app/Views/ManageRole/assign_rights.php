<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">

        <div class="content-wrapper">

            <div class="row">

                <div class="col-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <?= view('includes/breadcrumb'); ?>

                            <h4 class="card-title">Assign Rights</h4>

                            <p class="card-description">
                                Assign Rights to Role
                            </p>


                            <!-- =====================================================
                                 ROLE INFORMATION
                            ====================================================== -->

                            <div class="row">

                                <!-- ROLE NAME -->
                                <div class="col-md-6 form-group">

                                    <label>
                                        Role Name
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc($role['Role_Name']) ?>"
                                        readonly>

                                </div>


                                <!-- STATUS -->
                                <div class="col-md-6 form-group">

                                    <label>
                                        Status
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc($role['Role_Status']) ?>"
                                        readonly>

                                </div>

                            </div>


                            <!-- =====================================================
                                 ASSIGN RIGHTS FORM
                            ====================================================== -->

                            <form
                                class="forms-sample"
                                action="<?= site_url('roles/assign-rights/save/' . $role['Role_Id']) ?>"
                                method="post"
                                id="assignRightsForm">


                                <!-- =================================================
                                     RIGHTS CARD
                                ================================================== -->

                                <div class="card border mt-3">

                                    <div class="card-body">

                                        <div class="mb-3">

                                            <h5 class="mb-1">

                                                <i class="mdi mdi-shield-check-outline me-2"></i>

                                                Available Rights

                                            </h5>

                                            <p class="text-muted mb-0">

                                                Select the rights that should be assigned
                                                to this role.

                                            </p>

                                        </div>


                                        <!-- =================================================
                                             BUILD RIGHTS HIERARCHY
                                        ================================================== -->

                                        <?php

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Recursive function to build the hierarchy
                                        |--------------------------------------------------------------------------
                                        */

                                        $buildTree = function ($parentId) use (
                                            &$buildTree,
                                            $rights
                                        ) {

                                            $children = [];

                                            foreach ($rights as $right) {

                                                if (
                                                    isset($right['Parent_Right_Id']) &&
                                                    $right['Parent_Right_Id'] === $parentId
                                                ) {

                                                    $right['children'] =
                                                        $buildTree(
                                                            $right['Right_Id']
                                                        );

                                                    $children[] = $right;
                                                }
                                            }

                                            return $children;
                                        };


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Get ROOT rights
                                        |--------------------------------------------------------------------------
                                        */

                                        $rootRights = [];

                                        foreach ($rights as $right) {

                                            if (
                                                empty($right['Parent_Right_Id'])
                                            ) {

                                                $right['children'] =
                                                    $buildTree(
                                                        $right['Right_Id']
                                                    );

                                                $rootRights[] = $right;
                                            }
                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Recursive HTML renderer
                                        |--------------------------------------------------------------------------
                                        */

                                        $renderRights = function (
                                            $right,
                                            $level = 0
                                        ) use (
                                            &$renderRights,
                                            $assignedRightIds,
                                            $readOnly
                                        ) {

                                            $rightId =
                                                $right['Right_Id'];


                                            $hasChildren =
                                                !empty($right['children']);


                                            /*
                                            | Generate a safe collapse ID
                                            */

                                            $collapseId =
                                                'right_' .
                                                preg_replace(
                                                    '/[^A-Za-z0-9_-]/',
                                                    '_',
                                                    $rightId
                                                );

                                        ?>


                                            <!-- =================================================
                                                 RIGHT ITEM
                                            ================================================== -->

                                            <div class="right-tree-item">


                                                <!-- =============================================
                                                     RIGHT ROW
                                                ============================================== -->

                                                <div
                                                    class="right-row"
                                                    style="
                                                        padding-left:
                                                        <?= $level * 30 ?>px;
                                                    ">


                                                    <!-- =========================================
                                                         ARROW
                                                    ========================================== -->

                                                    <?php if ($hasChildren): ?>

                                                        <button
                                                            type="button"
                                                            class="right-toggle-btn"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#<?= $collapseId ?>"
                                                            aria-expanded="false"
                                                            aria-controls="<?= $collapseId ?>">

                                                            <i class="mdi mdi-chevron-right"></i>

                                                        </button>

                                                    <?php else: ?>

                                                        <span
                                                            class="right-toggle-placeholder">
                                                        </span>

                                                    <?php endif; ?>


                                                    <!-- =========================================
                                                         CHECKBOX + LABEL
                                                    ========================================== -->

                                                    <div class="form-check right-check-wrapper">

                                                        <input
                                                            type="checkbox"
                                                            class="form-check-input right-checkbox"

                                                            name="right_ids[]"

                                                            value="<?= esc($rightId) ?>"

                                                            data-right-id="<?= esc($rightId) ?>"

                                                            data-parent-id="<?= esc(
                                                                                $right['Parent_Right_Id'] ?? ''
                                                                            ) ?>"

                                                            <?= in_array(
                                                                $rightId,
                                                                $assignedRightIds
                                                            ) ? 'checked' : '' ?>

                                                            <?= $readOnly
                                                                ? 'disabled'
                                                                : '' ?>>


                                                        <label
                                                            class="form-check-label">

                                                            <?= esc(
                                                                $right['Right_Name']
                                                            ) ?>

                                                        </label>

                                                    </div>


                                                </div>


                                                <!-- =============================================
                                                     CHILD RIGHTS
                                                ============================================== -->

                                                <?php if ($hasChildren): ?>

                                                    <div
                                                        class="collapse right-children"
                                                        id="<?= $collapseId ?>">

                                                        <?php foreach (
                                                            $right['children']
                                                            as $child
                                                        ): ?>

                                                            <?php

                                                            $renderRights(
                                                                $child,
                                                                $level + 1
                                                            );

                                                            ?>

                                                        <?php endforeach; ?>

                                                    </div>

                                                <?php endif; ?>


                                            </div>

                                        <?php

                                        };

                                        ?>


                                        <!-- =================================================
                                             RIGHTS TREE
                                        ================================================== -->

                                        <div class="rights-tree">

                                            <?php if (!empty($rootRights)): ?>

                                                <?php foreach (
                                                    $rootRights
                                                    as $rootRight
                                                ): ?>

                                                    <?php

                                                    $renderRights(
                                                        $rootRight
                                                    );

                                                    ?>

                                                <?php endforeach; ?>

                                            <?php else: ?>

                                                <div
                                                    class="alert alert-info mb-0">

                                                    No rights available.

                                                </div>

                                            <?php endif; ?>

                                        </div>


                                    </div>

                                </div>


                                <!-- =====================================================
                                     BUTTONS
                                ====================================================== -->

                                <div
                                    class="mt-4 d-flex justify-content-center flex-wrap gap-3">


                                    <!-- BACK -->

                                    <a
                                        href="<?= site_url('roles/assign-rights') ?>"
                                        class="btn btn-light">

                                        Back

                                    </a>


                                    <?php if (!$readOnly): ?>

                                        <!-- SAVE RIGHTS -->

                                        <button
                                            type="submit"
                                            class="btn btn-primary">

                                            <i
                                                class="mdi mdi-content-save me-1">
                                            </i>

                                            Save Rights

                                        </button>

                                    <?php endif; ?>


                                </div>


                            </form>


                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?= view('includes/footer'); ?>

    </div>

</div>


<!-- =========================================================
     CUSTOM CSS
========================================================= -->

<style>
    /* =========================================================
   RIGHTS TREE
========================================================= */

    .rights-tree {

        border: 1px solid #e5e5e5;

        border-radius: 6px;

        background: #ffffff;

        padding: 8px 12px;

    }


    /* =========================================================
   RIGHT ROW
========================================================= */

    .right-row {

        min-height: 48px;

        padding-top: 7px;

        padding-bottom: 7px;

        border-bottom: 1px solid #f1f1f1;

        display: flex;

        align-items: center;

    }


    /* Remove border from last row */

    .right-tree-item:last-child>.right-row {

        border-bottom: none;

    }


    /* =========================================================
   ARROW BUTTON
========================================================= */

    .right-toggle-btn {

        width: 32px;

        height: 32px;

        min-width: 32px;

        flex: 0 0 32px;

        padding: 0;

        margin-right: 10px;

        border: none;

        background: transparent;

        color: #1B4482;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        cursor: pointer;

        font-size: 22px;

    }


    /* Arrow hover */

    .right-toggle-btn:hover {

        background: #f1f5fa;

        border-radius: 4px;

    }


    /* =========================================================
   ARROW ROTATION
========================================================= */

    .right-toggle-btn i {

        transition: transform 0.2s ease;

    }


    /* Closed */

    .right-toggle-btn[aria-expanded="false"] i {

        transform: rotate(0deg);

    }


    /* Open */

    .right-toggle-btn[aria-expanded="true"] i {

        transform: rotate(90deg);

    }


    /* =========================================================
   EMPTY ARROW SPACE
========================================================= */

    .right-toggle-placeholder {

        width: 32px;

        height: 32px;

        min-width: 32px;

        flex: 0 0 32px;

        margin-right: 10px;

        display: inline-block;

    }


    /* =========================================================
   CHECKBOX + LABEL WRAPPER
========================================================= */

    .right-check-wrapper {

        display: flex !important;

        align-items: center;

        padding: 0 !important;

        margin: 0 !important;

    }


    /* =========================================================
   CHECKBOX
========================================================= */

    .right-checkbox {

        width: 18px !important;

        height: 18px !important;

        min-width: 18px;

        min-height: 18px;

        flex: 0 0 18px;

        margin: 0 9px 0 0 !important;

        padding: 0;

        cursor: pointer;

        border: 2px solid #1B4482 !important;

        border-radius: 3px;

        box-shadow: none !important;

    }


    /* =========================================================
   CHECKED CHECKBOX
========================================================= */

    .right-checkbox:checked {

        background-color: #1B4482 !important;

        border-color: #1B4482 !important;

    }


    /* =========================================================
   INDETERMINATE CHECKBOX
========================================================= */

    .right-checkbox:indeterminate {

        background-color: #1B4482 !important;

        border-color: #1B4482 !important;

    }


    /* =========================================================
   CHECKBOX FOCUS
========================================================= */

    .right-checkbox:focus {

        border-color: #1B4482 !important;

        box-shadow:
            0 0 0 0.15rem rgba(27, 68, 130, 0.15) !important;

    }


    /* =========================================================
   LABEL
========================================================= */

    .right-row .form-check-label {

        cursor: pointer;

        font-size: 14px;

        line-height: 18px;

        margin: 0;

        padding: 0;

    }


    /* =========================================================
   DISABLED CHECKBOX
========================================================= */

    .right-checkbox:disabled {

        opacity: 1;

        cursor: default;

    }


    /* Keep disabled label visible */

    .right-checkbox:disabled+.form-check-label {

        opacity: 1;

    }


    /* =========================================================
   CHILD RIGHTS
========================================================= */

    .right-children {

        margin-left: 0;

    }


    /* =========================================================
   RESPONSIVE
========================================================= */

    @media (max-width: 767px) {

        .right-row {

            min-height: 44px;

        }


        .right-row .form-check-label {

            font-size: 13px;

        }


        .right-toggle-btn,
        .right-toggle-placeholder {

            margin-right: 6px;

        }

    }
</style>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {


            /* =====================================================
               ALL CHECKBOXES
            ====================================================== */

            const checkboxes =
                document.querySelectorAll(
                    '.right-checkbox'
                );


            /* =====================================================
               GET ALL DESCENDANTS
            ====================================================== */

            function getDescendants(parentId) {

                let descendants = [];


                checkboxes.forEach(
                    function(checkbox) {

                        if (
                            checkbox.dataset.parentId ===
                            parentId
                        ) {

                            descendants.push(
                                checkbox
                            );


                            descendants =
                                descendants.concat(
                                    getDescendants(
                                        checkbox.dataset.rightId
                                    )
                                );

                        }

                    }
                );


                return descendants;

            }


            /* =====================================================
               UPDATE PARENT CHECKBOX STATES
            ====================================================== */

            function updateParentStates() {

                let changed = true;


                /*
                | Continue until all parent states
                | are correctly calculated.
                */

                while (changed) {

                    changed = false;


                    checkboxes.forEach(
                        function(checkbox) {

                            const rightId =
                                checkbox.dataset.rightId;


                            const descendants =
                                getDescendants(
                                    rightId
                                );


                            /*
                            | This is a leaf node.
                            */

                            if (
                                descendants.length === 0
                            ) {

                                return;

                            }


                            const checkedCount =
                                descendants.filter(
                                    function(child) {

                                        return child.checked;

                                    }
                                ).length;


                            /*
                            | All descendants selected
                            */

                            const newChecked =
                                checkedCount ===
                                descendants.length;


                            /*
                            | Some descendants selected
                            */

                            const newIndeterminate =
                                checkedCount > 0 &&
                                checkedCount <
                                descendants.length;


                            if (
                                checkbox.checked !==
                                newChecked
                            ) {

                                checkbox.checked =
                                    newChecked;

                                changed = true;

                            }


                            checkbox.indeterminate =
                                newIndeterminate;

                        }
                    );

                }

            }


            /* =====================================================
               CHECKBOX CHANGE EVENT
            ====================================================== */

            checkboxes.forEach(
                function(checkbox) {

                    checkbox.addEventListener(
                        'change',
                        function() {


                            const rightId =
                                this.dataset.rightId;


                            /*
                            | Find all children
                            */

                            const descendants =
                                getDescendants(
                                    rightId
                                );


                            /*
                            | Select/unselect all
                            | descendants.
                            */

                            descendants.forEach(
                                function(child) {

                                    child.checked =
                                        checkbox.checked;

                                    child.indeterminate =
                                        false;

                                }
                            );


                            /*
                            | Recalculate all parents.
                            */

                            updateParentStates();

                        }
                    );

                }
            );


            /* =====================================================
               INITIAL CHECKBOX STATE
            ====================================================== */

            updateParentStates();


        }
    );
</script>