<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<style>
    .program-view-card {
        border: 0;
        border-radius: 10px;
        overflow: hidden;
    }

    .program-banner {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
        background: #f1f3f5;
    }

    .program-profile-wrapper {
        margin-top: -65px;
        margin-left: 25px;
        position: relative;
        z-index: 2;
        width: 125px;
        height: 125px;
        border: 5px solid #fff;
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .12);
    }

    .program-profile {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .program-heading {
        color: #1B4482;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .program-subheading {
        color: #6c757d;
        margin-bottom: 0;
    }

    .program-detail-label {
        color: #6c757d;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .program-detail-value {
        color: #343a40;
        font-size: 14px;
        margin-bottom: 0;
        overflow-wrap: anywhere;
    }

    .program-status {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        width: max-content !important;
        min-width: 75px;
        max-width: 120px;
        padding: 6px 13px;
        border-radius: 20px;
        white-space: nowrap !important;
        writing-mode: horizontal-tb !important;
        word-break: normal !important;
        overflow-wrap: normal !important;
        line-height: 1.2;
        font-size: 12px;
        font-weight: 600;
    }

    .program-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 15px;
    }

    .program-gallery-item {
        width: 100%;
        height: 180px;
        border-radius: 8px;
        overflow: hidden;
        background: #f1f3f5;
        border: 1px solid #e5e7eb;
    }

    .program-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .3s ease;
    }

    .program-gallery-item img:hover {
        transform: scale(1.04);
    }

    .program-about {
        overflow-wrap: anywhere;
        line-height: 1.7;
    }

    .program-about img {
        max-width: 100%;
        height: auto;
    }

    .program-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }

    @media (max-width: 576px) {
        .program-banner {
            height: 190px;
        }

        .program-profile-wrapper {
            width: 100px;
            height: 100px;
            margin-top: -50px;
            margin-left: 15px;
        }

        .program-gallery {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .program-gallery-item {
            height: 135px;
        }
    }
</style>

<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-12 grid-margin stretch-card">

                    <div class="card program-view-card">
                        <div class="card-body">

                            <?= view('includes/breadcrumb'); ?>
                            <?= view('includes/messages'); ?>

                            <?php
                            /*
                                 * Normalize saved image paths.
                                 * The database normally stores paths such as:
                                 * uploads/programs/gallery/image.jpg
                                 */
                            $getImageUrl = function ($path) {
                                $path = trim((string) $path);

                                if ($path === '') {
                                    return '';
                                }

                                $path = str_replace('\\', '/', $path);
                                $path = ltrim($path, '/');

                                // Avoid adding the public folder twice.
                                if (strpos($path, 'public/') === 0) {
                                    $path = substr($path, 7);
                                }

                                return base_url($path);
                            };

                            $bannerPath = $getImageUrl($program['Banner_Image'] ?? '');
                            $profilePath = $getImageUrl($program['Thumbnail_Image'] ?? '');

                            $status = $program['Program_Status'] ?? '';
                            $statusClass = strtolower($status) === 'active'
                                ? 'badge-success'
                                : 'badge-secondary';
                            ?>

                            <!-- Banner -->
                            <div class="row">
                                <div class="col-12 p-0">

                                    <?php if (!empty($bannerPath)): ?>
                                        <img
                                            src="<?= esc($bannerPath); ?>"
                                            alt="Program Banner"
                                            class="program-banner">
                                    <?php else: ?>
                                        <div class="program-banner d-flex align-items-center justify-content-center">
                                            <span class="text-muted">No Banner Image Available</span>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <!-- Profile Image -->
                            <div class="program-profile-wrapper">
                                <?php if (!empty($profilePath)): ?>
                                    <img
                                        src="<?= esc($profilePath); ?>"
                                        alt="Program Profile"
                                        class="program-profile">
                                <?php else: ?>
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-image text-muted" style="font-size:35px;"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Program Heading -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h3 class="program-heading">
                                        <?= esc($program['Banner_Head'] ?? $program['Program_Name'] ?? ''); ?>
                                    </h3>

                                    <?php if (!empty($program['Banner_Subhead'])): ?>
                                        <p class="program-subheading">
                                            <?= esc($program['Banner_Subhead']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <hr>

                            <!-- Program Details -->
                            <div class="row mt-4">

                                <div class="col-md-6 col-lg-4 mb-4">
                                    <p class="program-detail-label">Program Name</p>
                                    <p class="program-detail-value">
                                        <?= esc($program['Program_Name'] ?? '—'); ?>
                                    </p>
                                </div>

                                <div class="col-md-6 col-lg-4 mb-4">
                                    <p class="program-detail-label">Program Theme</p>
                                    <p class="program-detail-value">
                                        <?= esc($program['Program_Theme_Name'] ?? '—'); ?>
                                    </p>
                                </div>

                                <div class="col-md-6 col-lg-4 mb-4">
                                    <p class="program-detail-label">Program Status</p>
                                    <p class="program-detail-value">
                                        <span class="badge <?= esc($statusClass); ?> program-status">
                                            <?= esc($status ?: '—'); ?>
                                        </span>
                                    </p>
                                </div>

                                <div class="col-md-6 col-lg-4 mb-4">
                                    <p class="program-detail-label">Start Date</p>
                                    <p class="program-detail-value">
                                        <?= !empty($program['Program_Start_Date'])
                                            ? date('d M Y', strtotime($program['Program_Start_Date']))
                                            : '—'; ?>
                                    </p>
                                </div>

                                <div class="col-md-6 col-lg-4 mb-4">
                                    <p class="program-detail-label">End Date</p>
                                    <p class="program-detail-value">
                                        <?= !empty($program['Program_End_Date'])
                                            ? date('d M Y', strtotime($program['Program_End_Date']))
                                            : '—'; ?>
                                    </p>
                                </div>

                                <div class="col-md-6 col-lg-4 mb-4">
                                    <p class="program-detail-label">Applicable For</p>
                                    <p class="program-detail-value">
                                        <?= esc($program['Applicable_For'] ?? '—'); ?>
                                    </p>
                                </div>

                            </div>

                            <!-- About Program -->
                            <?php if (!empty($program['Program_About'])): ?>
                                <hr>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5 class="font-weight-bold mb-3">
                                            About the Program
                                        </h5>

                                        <div class="program-about">
                                            <?= $program['Program_About']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Program Gallery -->
                            <hr>

                            <div class="row mt-3">
                                <div class="col-12">

                                    <h5 class="font-weight-bold mb-3">
                                        Program Gallery
                                    </h5>

                                    <?php
                                    $validGallery = [];

                                    if (!empty($gallery) && is_array($gallery)) {
                                        foreach ($gallery as $image) {
                                            if (!empty($image['Image_Path'])) {
                                                $validGallery[] = $image;
                                            }
                                        }
                                    }
                                    ?>

                                    <?php if (!empty($validGallery)): ?>

                                        <div class="program-gallery">

                                            <?php foreach ($validGallery as $image): ?>

                                                <?php $galleryImageUrl = $getImageUrl($image['Image_Path']); ?>

                                                <div class="program-gallery-item">
                                                    <a
                                                        href="<?= esc($galleryImageUrl); ?>"
                                                        target="_blank"
                                                        rel="noopener noreferrer">
                                                        <img
                                                            src="<?= esc($galleryImageUrl); ?>"
                                                            alt="Program Gallery Image"
                                                            loading="lazy"
                                                            onerror="this.parentElement.parentElement.style.display='none';">
                                                    </a>
                                                </div>

                                            <?php endforeach; ?>

                                        </div>

                                    <?php else: ?>

                                        <p class="text-muted mb-0">
                                            No gallery images have been added for this program.
                                        </p>

                                    <?php endif; ?>

                                </div>
                            </div>

                            <!-- Actions: keep these only at the bottom -->
                            <div class="text-center mt-4">

                                <a href="<?= base_url('programs/edit/' . $program['Program_Id']) ?>"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="<?= base_url('programs/delete/' . $program['Program_Id']) ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this Program?')">
                                    Delete
                                </a>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<?= view('includes/footer'); ?>