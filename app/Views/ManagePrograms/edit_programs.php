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
              <?= view('includes/messages'); ?>

              <h4 class="card-title">Programs</h4>
              <p class="card-description">Edit Program</p>

              <form
                id="programForm"
                class="forms-sample"
                action="<?= base_url('programs/update/' . $program['Program_Id']) ?>"
                method="post"
                enctype="multipart/form-data"
                onsubmit="return validateProgramForm()">

                <?= csrf_field() ?>

                <!-- PROGRAM BASIC DETAILS -->
                <h5 class="mb-3 text-primary">Program Details</h5>

                <div class="row">

                  <div class="col-md-6 form-group mb-3">
                    <label>Program Name <span class="text-danger">*</span></label>
                    <input
                      type="text"
                      id="program_name"
                      name="Program_Name"
                      class="form-control"
                      value="<?= esc(old('Program_Name', $program['Program_Name'] ?? '')) ?>"
                      required>
                  </div>

                  <div class="col-md-6 form-group mb-3">
                    <label>Program Theme <span class="text-danger">*</span></label>

                    <select
                      id="program_theme"
                      class="form-select dropdown-bold"
                      name="Program_Theme_Id"
                      required>
                      <option value="">Select Theme</option>

                      <?php foreach ($themes as $theme): ?>
                        <option
                          value="<?= esc($theme['Program_Theme_Id']) ?>"
                          <?= old('Program_Theme_Id', $program['Program_Theme_Id'] ?? '') == $theme['Program_Theme_Id'] ? 'selected' : '' ?>>
                          <?= esc($theme['Program_Theme_Name']) ?>
                        </option>
                      <?php endforeach; ?>

                    </select>
                  </div>

                  <!-- HEADING -->
                  <div class="col-md-6 form-group mb-3">
                    <label>Heading</label>
                    <input
                      type="text"
                      name="Banner_Head"
                      class="form-control"
                      placeholder="Enter program heading"
                      value="<?= esc(old('Banner_Head', $program['Banner_Head'] ?? '')) ?>">
                  </div>

                  <!-- SUB HEADING -->
                  <div class="col-md-6 form-group mb-3">
                    <label>Sub Heading</label>
                    <input
                      type="text"
                      name="Banner_Subhead"
                      class="form-control"
                      placeholder="Enter program sub heading"
                      value="<?= esc(old('Banner_Subhead', $program['Banner_Subhead'] ?? '')) ?>">
                  </div>

                </div>

                <hr class="my-4">

                <!-- PROGRAM IMAGES -->
                <h5 class="mb-3 text-primary">Program Images</h5>

                <div class="row">

                  <!-- PROFILE PHOTO -->
                  <div class="col-md-6 form-group mb-4">

                    <label class="mb-2">Program Profile Photo</label>

                    <?php if (!empty($program['Thumbnail_Image'])): ?>
                      <div class="mb-3">
                        <img
                          src="<?= base_url($program['Thumbnail_Image']) ?>"
                          id="profilePreview"
                          alt="Current Program Profile"
                          style="width:150px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                        <p class="text-muted mt-2 mb-0">
                          Current Profile Photo
                        </p>
                      </div>
                    <?php else: ?>
                      <div class="mb-3">
                        <img
                          src=""
                          id="profilePreview"
                          alt="Profile Preview"
                          style="display:none;width:150px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                      </div>
                    <?php endif; ?>

                    <input
                      type="file"
                      name="Thumbnail_Image"
                      id="profile_image"
                      class="form-control"
                      accept="image/jpeg,image/png,image/webp"
                      onchange="previewImage(this, 'profilePreview')">

                    <small class="text-muted">
                      Select a new image only if you want to replace the existing photo.
                      JPG, PNG or WEBP. Maximum 2MB.
                    </small>

                  </div>

                  <!-- BANNER IMAGE -->
                  <div class="col-md-6 form-group mb-4">

                    <label class="mb-2">Program Banner</label>

                    <?php if (!empty($program['Banner_Image'])): ?>
                      <div class="mb-3">
                        <img
                          src="<?= base_url($program['Banner_Image']) ?>"
                          id="bannerPreview"
                          alt="Current Program Banner"
                          style="width:100%;max-width:350px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                        <p class="text-muted mt-2 mb-0">
                          Current Banner
                        </p>
                      </div>
                    <?php else: ?>
                      <div class="mb-3">
                        <img
                          src=""
                          id="bannerPreview"
                          alt="Banner Preview"
                          style="display:none;width:100%;max-width:350px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                      </div>
                    <?php endif; ?>

                    <input
                      type="file"
                      name="Banner_Image"
                      id="banner_image"
                      class="form-control"
                      accept="image/jpeg,image/png,image/webp"
                      onchange="previewImage(this, 'bannerPreview')">

                    <small class="text-muted">
                      Select a new image only if you want to replace the existing banner.
                      JPG, PNG or WEBP. Maximum 2MB.
                    </small>

                  </div>

                </div>

                <hr class="my-4">

                <!-- PROGRAM GALLERY -->
                <h5 class="mb-3 text-primary">Program Gallery</h5>

                <div class="form-group mb-3">

                  <label>Existing Gallery Images</label>

                  <div class="row mt-2">

                    <?php if (!empty($gallery)): ?>

                      <?php foreach ($gallery as $image): ?>

                        <div class="col-md-2 col-6 mb-3">
                          <div class="card h-100">
                            <img
                              src="<?= base_url($image['Image_Path']) ?>"
                              alt="Program Gallery Image"
                              style="width:100%;height:120px;object-fit:cover;border-radius:5px;">
                          </div>
                        </div>

                      <?php endforeach; ?>

                    <?php else: ?>

                      <div class="col-12">
                        <p class="text-muted">
                          No gallery images have been uploaded for this program.
                        </p>
                      </div>

                    <?php endif; ?>

                  </div>

                  <label class="mt-3">Upload New Gallery Images</label>

                  <input
                    type="file"
                    name="Gallery_Images[]"
                    id="gallery_images"
                    class="form-control"
                    accept="image/jpeg,image/png,image/webp"
                    multiple
                    onchange="previewGallery(this)">

                  <small class="text-muted">
                    You can select up to 6 images. JPG, PNG or WEBP. Maximum 2MB per image.
                    If you do not select new images, your existing gallery will remain unchanged.
                  </small>

                  <div id="galleryPreview" class="row mt-3"></div>

                </div>

                <hr class="my-4">

                <!-- ABOUT PROGRAM -->
                <h5 class="mb-3 text-primary">About Program</h5>

                <div class="form-group mb-4">
                  <label>About</label>

                  <textarea
                    id="program_about"
                    name="Program_About"
                    class="form-control"
                    rows="8"><?= esc(old('Program_About', $program['Program_About'] ?? '')) ?></textarea>
                </div>

                <hr class="my-4">

                <!-- OTHER DETAILS -->
                <h5 class="mb-3 text-primary">Other Details</h5>

                <div class="row">

                  <div class="col-md-6 form-group mb-3">
                    <label>Start Date <span class="text-danger">*</span></label>

                    <input
                      type="date"
                      id="program_start_date"
                      name="Program_Start_Date"
                      class="form-control"
                      value="<?= esc(old('Program_Start_Date', $program['Program_Start_Date'] ?? '')) ?>"
                      required>
                  </div>

                  <div class="col-md-6 form-group mb-3">
                    <label>End Date</label>

                    <input
                      type="date"
                      id="program_end_date"
                      name="Program_End_Date"
                      class="form-control"
                      value="<?= esc(old('Program_End_Date', $program['Program_End_Date'] ?? '')) ?>">
                  </div>

                  <div class="col-md-6 form-group mb-3">
                    <label>Applicable For</label>

                    <textarea
                      id="applicable_for"
                      name="Applicable_For"
                      class="form-control"
                      rows="3"
                      placeholder="Enter Age Group"><?= esc(old('Applicable_For', $program['Applicable_For'] ?? '')) ?></textarea>
                  </div>

                  <div class="col-md-6 form-group mb-3">
                    <label>Status <span class="text-danger">*</span></label>

                    <select
                      id="program_status"
                      class="form-select dropdown-bold"
                      name="Program_Status"
                      required>
                      <option value="">Select Status</option>

                      <option
                        value="Active"
                        <?= old('Program_Status', $program['Program_Status'] ?? '') == 'Active' ? 'selected' : '' ?>>
                        Active
                      </option>

                      <option
                        value="Inactive"
                        <?= old('Program_Status', $program['Program_Status'] ?? '') == 'Inactive' ? 'selected' : '' ?>>
                        Inactive
                      </option>

                      <option
                        value="Completed"
                        <?= old('Program_Status', $program['Program_Status'] ?? '') == 'Completed' ? 'selected' : '' ?>>
                        Completed
                      </option>

                    </select>
                  </div>

                </div>

                <!-- BUTTONS -->
                <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">

                  <a href="<?= site_url('programs') ?>" class="btn btn-light">
                    Cancel
                  </a>

                  <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-content-save"></i>
                    Update Program
                  </button>

                </div>

              </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- IMAGE PREVIEW AND VALIDATION SCRIPTS -->
<script>
  function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
      const file = input.files[0];

      if (file.size > 2 * 1024 * 1024) {
        alert('Image size must not exceed 2MB.');
        input.value = '';
        return;
      }

      const reader = new FileReader();

      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      };

      reader.readAsDataURL(file);
    }
  }

  function previewGallery(input) {
    const previewContainer = document.getElementById('galleryPreview');
    previewContainer.innerHTML = '';

    const files = Array.from(input.files);

    if (files.length > 6) {
      alert('You can upload a maximum of 6 gallery images.');
      input.value = '';
      return;
    }

    files.forEach(function(file) {

      if (file.size > 2 * 1024 * 1024) {
        alert(file.name + ' exceeds the 2MB size limit.');
        input.value = '';
        previewContainer.innerHTML = '';
        return;
      }

      const reader = new FileReader();

      reader.onload = function(e) {
        const column = document.createElement('div');
        column.className = 'col-md-2 col-6 mb-3';

        const image = document.createElement('img');
        image.src = e.target.result;
        image.alt = 'Gallery Preview';
        image.style.width = '100%';
        image.style.height = '120px';
        image.style.objectFit = 'cover';
        image.style.borderRadius = '5px';
        image.style.border = '1px solid #ddd';

        column.appendChild(image);
        previewContainer.appendChild(column);
      };

      reader.readAsDataURL(file);
    });
  }
</script>

<!-- SUMMERNOTE RICH TEXT EDITOR -->
<link
  href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css"
  rel="stylesheet">

<script>
  // This assumes jQuery is already loaded by your header.
  // Do not include a second jQuery copy if your header already loads it.
</script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#program_about').summernote({
      height: 250,
      placeholder: 'Write about the program...',
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link']],
        ['view', ['fullscreen', 'codeview']]
      ]
    });
  });
</script>

<script src="<?= base_url('assets/js/program-validation.js') ?>"></script>

<?= view('includes/footer'); ?>