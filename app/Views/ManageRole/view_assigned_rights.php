<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">

        <div class="content-wrapper">

            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <?= $this->include('includes/breadcrumb'); ?>

                        <h4 class="card-title mb-4">
                            <i class="mdi mdi-shield-check-outline me-2"></i>
                            Assigned Rights
                        </h4>


                        <!-- =========================
                             ROLE DETAILS
                        ========================== -->

                        <div class="row view-details">


                            <!-- Role Name -->

                            <div class="col-md-12 mb-3 d-flex">

                                <div style="min-width: 200px;">
                                    <strong>Role Name</strong> :
                                </div>

                                <div class="ms-3">
                                    <?= esc($role['Role_Name']) ?>
                                </div>

                            </div>


                            <!-- Status -->

                            <div class="col-md-12 mb-3 d-flex">

                                <div style="min-width: 200px;">
                                    <strong>Status</strong> :
                                </div>

                                <div class="ms-3">

                                    <?php

                                    $status = $role['Role_Status'];

                                    $statusColor = match ($status) {

                                        'Active' => '#28a745',

                                        'Inactive' => '#dc3545',

                                        default => '#6c757d',
                                    };

                                    ?>

                                    <span
                                        class="status-badge"
                                        style="
                                            background-color:
                                            <?= $statusColor ?>;
                                            color: white;
                                            padding: 5px 10px;
                                            border-radius: 5px;
                                            display: inline-block;
                                        ">

                                        <?= esc($status) ?>

                                    </span>

                                </div>

                            </div>


                            <!-- Role Description -->

                            <div class="col-md-12 mb-3 d-flex">

                                <div
                                    style="
                                        min-width: 200px;
                                        white-space: nowrap;
                                    ">

                                    <strong>Role Description</strong> :

                                </div>

                                <div class="ms-3">

                                    <?= !empty($role['Role_Description'])
                                        ? esc($role['Role_Description'])
                                        : '-' ?>

                                </div>

                            </div>


                        </div>


                        <!-- =========================
                             ASSIGNED RIGHTS
                        ========================== -->

                        <div class="card border mt-4">

                            <div class="card-body">

                                <div class="mb-3">

                                    <h5 class="mb-1">

                                        <i class="mdi mdi-shield-check-outline me-2"></i>

                                        Assigned Rights

                                    </h5>

                                    <p class="text-muted mb-0">

                                        Rights assigned to this role.

                                    </p>

                                </div>


                                <?php if (!empty($rights)): ?>


                                    <?php

                                    /*
                                     * Assigned rights lookup
                                     */

                                    $assignedLookup = [];

                                    foreach ($assignedRightIds as $id) {

                                        $assignedLookup[$id] = true;
                                    }


                                    /*
                                     * Build hierarchy
                                     */

                                    $children = [];

                                    foreach ($rights as $right) {

                                        $parentId =
                                            $right['Parent_Right_Id']
                                            ?? '';

                                        if (!isset($children[$parentId])) {

                                            $children[$parentId] = [];
                                        }

                                        $children[$parentId][] = $right;
                                    }


                                    /*
                                     * Check whether a right is
                                     * actually assigned.
                                     */

                                    $isAssigned = function ($rightId)
                                    use ($assignedLookup) {

                                        return isset(
                                            $assignedLookup[$rightId]
                                        );
                                    };


                                    /*
                                     * Render hierarchy
                                     */

                                    $renderRights = function (
                                        $parentId = '',
                                        $level = 0
                                    ) use (
                                        &$renderRights,
                                        $children,
                                        $isAssigned
                                    ) {

                                        if (
                                            !isset($children[$parentId])
                                        ) {

                                            return;
                                        }


                                        foreach (
                                            $children[$parentId]
                                            as $right
                                        ) {

                                            $rightId =
                                                $right['Right_Id'];

                                            $assigned =
                                                $isAssigned($rightId);


                                            /*
                                             * Check if this right has
                                             * an assigned child.
                                             */

                                            $hasAssignedChild = false;

                                            if (
                                                isset(
                                                    $children[$rightId]
                                                )
                                            ) {

                                                foreach (
                                                    $children[$rightId]
                                                    as $child
                                                ) {

                                                    if (
                                                        $isAssigned(
                                                            $child['Right_Id']
                                                        )
                                                    ) {

                                                        $hasAssignedChild =
                                                            true;

                                                        break;
                                                    }
                                                }
                                            }


                                            /*
                                             * Show only assigned rights
                                             * and parents required for
                                             * hierarchy.
                                             */

                                            if (
                                                !$assigned &&
                                                !$hasAssignedChild
                                            ) {

                                                continue;
                                            }

                                    ?>


                                            <div
                                                class="right-tree-row"
                                                style="
                                                    padding-left:
                                                    <?= 15 + ($level * 35) ?>px;
                                                ">

                                                <div class="right-tree-line">


                                                    <?php if ($level > 0): ?>

                                                        <span class="tree-branch">
                                                            └─
                                                        </span>

                                                    <?php endif; ?>


                                                    <?php if ($assigned): ?>

                                                        <span class="assigned-icon">

                                                            <i class="mdi mdi-check-circle"></i>

                                                        </span>

                                                    <?php else: ?>

                                                        <span class="parent-icon">

                                                            <i class="mdi mdi-folder-outline"></i>

                                                        </span>

                                                    <?php endif; ?>


                                                    <span
                                                        class="
                                                        right-name
                                                        <?= $assigned
                                                            ? 'assigned-name'
                                                            : 'parent-name'
                                                        ?>">

                                                        <?= esc(
                                                            $right['Right_Name']
                                                        ) ?>

                                                    </span>


                                                </div>

                                            </div>


                                    <?php

                                            /*
                                             * Render children
                                             */

                                            $renderRights(
                                                $rightId,
                                                $level + 1
                                            );
                                        }
                                    };

                                    ?>


                                    <div class="rights-tree">

                                        <?php
                                        $renderRights('', 0);
                                        ?>

                                    </div>


                                <?php else: ?>


                                    <div class="alert alert-info mb-0">

                                        <i
                                            class="mdi mdi-information-outline me-1">
                                        </i>

                                        No rights have been assigned
                                        to this role.

                                    </div>


                                <?php endif; ?>


                            </div>

                        </div>


                        <!-- =========================
                             ACTION BUTTONS
                        ========================== -->

                        <div
                            class="mt-4 d-flex justify-content-center flex-wrap gap-3">

                            <a
                                href="<?= base_url('roles/assign-rights') ?>"
                                class="btn btn-light btn-sm">

                                Back

                            </a>


                            <a
                                href="<?= base_url(
                                            'roles/edit/' .
                                                $role['Role_Id']
                                        ) ?>"
                                class="btn btn-warning btn-sm">

                                Edit

                            </a>

                        </div>


                    </div>

                </div>

            </div>

        </div>


        <?= view('includes/footer'); ?>

    </div>

</div>


<style>
    /* =========================================
   RIGHTS TREE
========================================= */

    .rights-tree {

        border: 1px solid #e5e5e5;

        border-radius: 6px;

        background: #ffffff;

        overflow: hidden;

    }


    /* =========================================
   RIGHT ROW
========================================= */

    .right-tree-row {

        min-height: 48px;

        display: flex;

        align-items: center;

        border-bottom: 1px solid #f1f1f1;

        padding-top: 7px;

        padding-bottom: 7px;

    }


    /* =========================================
   TREE LINE
========================================= */

    .right-tree-line {

        display: flex;

        align-items: center;

        width: 100%;

    }


    /* =========================================
   TREE BRANCH
========================================= */

    .tree-branch {

        width: 28px;

        min-width: 28px;

        color: #1B4482;

        font-size: 18px;

        font-weight: 600;

    }


    /* =========================================
   ASSIGNED ICON
========================================= */

    .assigned-icon {

        width: 25px;

        min-width: 25px;

        margin-right: 8px;

        color: #1B4482;

        font-size: 18px;

    }


    /* =========================================
   PARENT ICON
========================================= */

    .parent-icon {

        width: 25px;

        min-width: 25px;

        margin-right: 8px;

        color: #777;

        font-size: 18px;

    }


    /* =========================================
   RIGHT NAME
========================================= */

    .right-name {

        font-size: 14px;

        line-height: 20px;

    }


    /* Assigned right */

    .assigned-name {

        color: #333;

        font-weight: 500;

    }


    /* Parent used for hierarchy */

    .parent-name {

        color: #1B4482;

        font-weight: 600;

    }


    /* =========================================
   LAST ROW
========================================= */

    .right-tree-row:last-child {

        border-bottom: none;

    }


    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 767px) {

        .right-tree-row {

            min-height: 44px;

        }

        .right-name {

            font-size: 13px;

        }

    }
</style>