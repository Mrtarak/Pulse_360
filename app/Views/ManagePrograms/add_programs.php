<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.css" rel="stylesheet">

<style>
  .section-heading {
    font-size: 16px;
    font-weight: 600;
    color: #1B4482;
    border-bottom: 1px solid #e5e9f2;
    padding-bottom: 12px;
    margin: 25px 0 20px;
  }

  .required {
    color: red;
  }

  .image-preview {
    width: 100%;
    height: 170px;
    border: 2px dashed #ced4da;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: #f8f9fa;
    margin-top: 10px;
  }

  .image-preview img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }

  .gallery-preview {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-top: 15px;
  }

  .gallery-preview img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 7px;
    border: 1px solid #ddd;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-control,
  .form-select {
    min-height: 43px;
  }

  .note-editor .note-editable {
    min-height: 220px;
  }

  @media(max-width: 576px) {
    .gallery-preview {
      grid-template-columns: repeat(2, 1fr);
    }
  }
</style>

<div class="container-fluid page-body-wrapper">

  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="row">
        <div class="col-12 grid-margin stretch-card">

          <div class="card">
            <div class="card-body">

              <?= view('includes/breadcrumb'); ?>

              <h4 class="card-title">Programs</h4>
              <p class="card-description">Add New Program</p>

              <?= view('includes/messages'); ?>

              <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                  <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <div><?= esc($error) ?></div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <form
                id="programForm"
                action="<?= base_url('programs/store') ?>"
                method="post"
                enctype="multipart/form-data">

                <?= csrf_field() ?>

                <!-- BASIC INFORMATION -->

                <h5 class="section-heading">
                  <i class="mdi mdi-information-outline me-2"></i>
                  Basic Program Information
                </h5>

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label>
                      Program Name <span class="required">*</span>
                    </label>

                    <input
                      type="text"
                      name="Program_Name"
                      class="form-control"
                      value="<?= esc(old('Program_Name')) ?>"
                      placeholder="Enter Program Name"
                      maxlength="200"
                      required>
                  </div>

                  <div class="col-md-6 form-group">
                    <label>
                      Program Theme <span class="required">*</span>
                    </label>

                    <select
                      name="Program_Theme_Id"
                      class="form-select"
                      required>
                      <option value="">Select Theme</option>

                      <?php foreach ($themes as $theme): ?>
                        <option
                          value="<?= esc($theme['Program_Theme_Id']) ?>"
                          <?= old('Program_Theme_Id') == $theme['Program_Theme_Id'] ? 'selected' : '' ?>>
                          <?= esc($theme['Program_Theme_Name']) ?>
                        </option>
                      <?php endforeach; ?>

                    </select>
                  </div>

                </div>

                <!-- BANNER CONTENT -->

                <h5 class="section-heading">
                  <i class="mdi mdi-text-box-outline me-2"></i>
                  Program Banner Content
                </h5>

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label>
                      Heading <span class="required">*</span>
                    </label>

                    <input
                      type="text"
                      name="Banner_Head"
                      class="form-control"
                      value="<?= esc(old('Banner_Head')) ?>"
                      placeholder="Enter Main Heading"
                      maxlength="250"
                      required>
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Sub Heading</label>

                    <input
                      type="text"
                      name="Banner_Subhead"
                      class="form-control"
                      value="<?= esc(old('Banner_Subhead')) ?>"
                      placeholder="Enter Sub Heading"
                      maxlength="250">
                  </div>

                </div>

                <!-- PROGRAM IMAGES -->

                <h5 class="section-heading">
                  <i class="mdi mdi-image-multiple-outline me-2"></i>
                  Program Images
                </h5>

                <div class="row">

                  <!-- PROFILE PHOTO -->

                  <div class="col-md-6 form-group">

                    <label>
                      Program Profile Photo
                      <span class="required">*</span>
                    </label>

                    <input
                      type="file"
                      name="Thumbnail_Image"
                      id="profileImage"
                      class="form-control"
                      accept="image/jpeg,image/png,image/webp"
                      required>

                    <small class="text-muted">
                      JPG, PNG or WEBP. Maximum size 2 MB.
                    </small>

                    <div class="image-preview" id="profilePreview">
                      <span class="text-muted">
                        Profile Photo Preview
                      </span>
                    </div>

                  </div>

                  <!-- BANNER PHOTO -->

                  <div class="col-md-6 form-group">

                    <label>
                      Program Banner
                      <span class="required">*</span>
                    </label>

                    <input
                      type="file"
                      name="Banner_Image"
                      id="bannerImage"
                      class="form-control"
                      accept="image/jpeg,image/png,image/webp"
                      required>

                    <small class="text-muted">
                      JPG, PNG or WEBP. Maximum size 2 MB.
                    </small>

                    <div class="image-preview" id="bannerPreview">
                      <span class="text-muted">
                        Banner Preview
                      </span>
                    </div>

                  </div>

                  <!-- GALLERY -->

                  <div class="col-md-12 form-group">

                    <label>
                      Program Gallery
                    </label>

                    <input
                      type="file"
                      name="Gallery_Images[]"
                      id="galleryImages"
                      class="form-control"
                      accept="image/jpeg,image/png,image/webp"
                      multiple>

                    <small class="text-muted">
                      You can select up to 6 photos.
                      Each photo must be maximum 2 MB.
                    </small>

                    <div
                      id="galleryPreview"
                      class="gallery-preview"></div>

                  </div>

                </div>

                <!-- ABOUT -->

                <h5 class="section-heading">
                  <i class="mdi mdi-text-box-multiple-outline me-2"></i>
                  About Program
                </h5>

                <div class="row">

                  <div class="col-md-12 form-group">

                    <label>
                      Program Description
                      <span class="required">*</span>
                    </label>

                    <textarea
                      name="Program_About"
                      id="programAbout"
                      class="form-control"
                      required><?= old('Program_About') ?></textarea>

                  </div>

                </div>

                <!-- PROGRAM DETAILS -->

                <h5 class="section-heading">
                  <i class="mdi mdi-calendar-outline me-2"></i>
                  Program Details
                </h5>

                <div class="row">

                  <div class="col-md-6 form-group">

                    <label>
                      Start Date <span class="required">*</span>
                    </label>

                    <input
                      type="date"
                      name="Program_Start_Date"
                      class="form-control"
                      value="<?= esc(old('Program_Start_Date')) ?>"
                      required>

                  </div>

                  <div class="col-md-6 form-group">

                    <label>End Date</label>

                    <input
                      type="date"
                      name="Program_End_Date"
                      class="form-control"
                      value="<?= esc(old('Program_End_Date')) ?>">

                  </div>

                  <div class="col-md-12 form-group">

                    <label>
                      Applicable For
                      <span class="required">*</span>
                    </label>

                    <textarea
                      name="Applicable_For"
                      class="form-control"
                      rows="3"
                      maxlength="500"
                      placeholder="Enter to whom this program is applicable"
                      required><?= esc(old('Applicable_For')) ?></textarea>

                  </div>

                  <div class="col-md-6 form-group">

                    <label>
                      Program Status
                      <span class="required">*</span>
                    </label>

                    <select
                      name="Program_Status"
                      class="form-select"
                      required>
                      <option value="">Select Status</option>

                      <option value="Active"
                        <?= old('Program_Status') == 'Active' ? 'selected' : '' ?>>
                        Active
                      </option>

                      <option value="Inactive"
                        <?= old('Program_Status') == 'Inactive' ? 'selected' : '' ?>>
                        Inactive
                      </option>

                      <option value="Completed"
                        <?= old('Program_Status') == 'Completed' ? 'selected' : '' ?>>
                        Completed
                      </option>

                    </select>

                  </div>

                </div>

                <!-- BUTTONS -->

                <div class="mt-4 d-flex justify-content-center gap-3">

                  <a
                    href="<?= site_url('programs') ?>"
                    class="btn btn-light">
                    Cancel
                  </a>

                  <button
                    type="submit"
                    class="btn btn-primary">
                    <i class="mdi mdi-content-save me-1"></i>
                    Save Program
                  </button>

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

<!-- jQuery (if not already loaded in your header) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.js"></script>

<script>
  $(document).ready(function() {

    // Rich Text Editor
    $('#programAbout').summernote({
      height: 220,
      placeholder: 'Write about the program...',
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
        ['view', ['fullscreen', 'codeview']]
      ]
    });

    // Image preview function
    function previewImage(input, previewId) {

      const preview = document.getElementById(previewId);

      if (input.files && input.files[0]) {

        const file = input.files[0];

        if (file.size > 2 * 1024 * 1024) {
          alert('Image size must not exceed 2 MB.');
          input.value = '';
          preview.innerHTML = '<span class="text-muted">Image Preview</span>';
          return;
        }

        if (!file.type.startsWith('image/')) {
          alert('Please select a valid image.');
          input.value = '';
          return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
          preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
        };

        reader.readAsDataURL(file);
      }
    }

    $('#profileImage').on('change', function() {
      previewImage(this, 'profilePreview');
    });

    $('#bannerImage').on('change', function() {
      previewImage(this, 'bannerPreview');
    });

    // Gallery preview
    $('#galleryImages').on('change', function() {

      const files = this.files;
      const preview = $('#galleryPreview');

      preview.empty();

      if (files.length > 6) {
        alert('You can upload maximum 6 gallery photos.');
        this.value = '';
        return;
      }

      for (let i = 0; i < files.length; i++) {

        if (!files[i].type.startsWith('image/') ||
          files[i].size > 2 * 1024 * 1024) {

          alert('Every gallery image must be a valid image under 2 MB.');
          this.value = '';
          preview.empty();
          return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
          $('<img>').attr('src', e.target.result).appendTo(preview);
        };

        reader.readAsDataURL(files[i]);
      }
    });

  });
</script>