<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgramModel;
use App\Models\ProgramThemeModel;

class Programs extends BaseController
{
    protected $programModel;
    protected $db;

    private const MAX_IMAGE_SIZE = 2097152; // 2 MB
    private const MAX_GALLERY_IMAGES = 6;

    private const ALLOWED_IMAGE_TYPES = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    public function __construct()
    {
        $this->programModel = new ProgramModel();
        $this->db = \Config\Database::connect();
    }

    // ---------------------------------------------------------
    // IMAGE UPLOAD HELPER
    // Returns:
    // null  = no file selected
    // false = invalid upload
    // string = uploaded image path
    // ---------------------------------------------------------
    private function uploadImage($file, $folder)
    {
        if (!$file || $file->getError() === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if (!$file->isValid() || $file->hasMoved()) {
            return false;
        }

        if (!in_array($file->getMimeType(), self::ALLOWED_IMAGE_TYPES, true)) {
            return false;
        }

        if ($file->getSize() > self::MAX_IMAGE_SIZE) {
            return false;
        }

        $relativePath = 'uploads/programs/' . $folder . '/';
        $absolutePath = FCPATH . $relativePath;

        if (!is_dir($absolutePath)) {
            if (!mkdir($absolutePath, 0775, true) && !is_dir($absolutePath)) {
                return false;
            }
        }

        $newName = $file->getRandomName();

        if (!$file->move($absolutePath, $newName)) {
            return false;
        }

        return $relativePath . $newName;
    }

    // ---------------------------------------------------------
    // DELETE PHYSICAL IMAGE FILE
    // ---------------------------------------------------------
    private function removeImageFile($imagePath)
    {
        if (empty($imagePath)) {
            return;
        }

        // Only delete files inside uploads/programs/
        $allowedPrefix = 'uploads/programs/';

        if (strpos($imagePath, $allowedPrefix) !== 0) {
            return;
        }

        $fullPath = FCPATH . $imagePath;

        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    // ---------------------------------------------------------
    // DELETE MULTIPLE PHYSICAL IMAGE FILES
    // ---------------------------------------------------------
    private function removeImageFiles(array $paths)
    {
        foreach ($paths as $path) {
            $this->removeImageFile($path);
        }
    }

    // ---------------------------------------------------------
    // GALLERY UPLOAD HELPER
    // Uses Gallery_Images[] from Add/Edit views
    // ---------------------------------------------------------
    private function uploadGallery()
    {
        $files = $this->request->getFileMultiple('Gallery_Images') ?? [];

        $selectedFiles = [];

        foreach ($files as $file) {

            if (!$file || $file->getError() === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            $selectedFiles[] = $file;
        }

        if (count($selectedFiles) > self::MAX_GALLERY_IMAGES) {
            return false;
        }

        $uploadedPaths = [];

        foreach ($selectedFiles as $file) {

            $path = $this->uploadImage($file, 'gallery');

            if ($path === false || $path === null) {

                // Remove already uploaded files if any image fails
                $this->removeImageFiles($uploadedPaths);

                return false;
            }

            $uploadedPaths[] = $path;
        }

        return $uploadedPaths;
    }

    // ---------------------------------------------------------
    // GET GALLERY IMAGES
    // ---------------------------------------------------------
    private function getProgramGallery($programId)
    {
        return $this->db->table('program_gallery')
            ->where('Program_Id', $programId)
            ->orderBy('Sort_Order', 'ASC')
            ->get()
            ->getResultArray();
    }

    // ---------------------------------------------------------
    // PROGRAM LIST
    // ---------------------------------------------------------
    public function index()
    {
        $programName = $this->request->getGet('program_filter');

        $query = $this->programModel
            ->select('program_m.*, program_theme_m.Program_Theme_Name')
            ->join(
                'program_theme_m',
                'program_theme_m.Program_Theme_Id = program_m.Program_Theme_Id',
                'left'
            );

        if (!empty($programName)) {
            $query->like('program_m.Program_Name', $programName);
        }

        $programs = $query->findAll();

        return view('ManagePrograms/programs', [
            'programs' => $programs
        ]);
    }

    // ---------------------------------------------------------
    // VIEW PROGRAM
    // ---------------------------------------------------------

    public function view($id)
    {
        $program = $this->db->table('program_m p')
            ->select('p.*, t.Program_Theme_Name')
            ->join(
                'program_theme_m t',
                't.Program_Theme_Id = p.Program_Theme_Id',
                'left'
            )
            ->where('p.Program_Id', $id)
            ->get()
            ->getRowArray();

        if (!$program) {
            return redirect()->to(base_url('programs'))
                ->with('error', 'Program not found.');
        }

        // Fetch gallery images belonging to this program.
        $gallery = $this->db->table('program_gallery')
            ->select('Gallery_Id, Program_Id, Image_Path, Sort_Order')
            ->where('Program_Id', $id)
            ->orderBy('Sort_Order', 'ASC')
            ->orderBy('Gallery_Id', 'ASC')
            ->get()
            ->getResultArray();

        return view('ManagePrograms/view_program', [
            'program' => $program,
            'gallery' => $gallery
        ]);
    }


    // ---------------------------------------------------------
    // ADD PROGRAM PAGE
    // ---------------------------------------------------------
    public function add()
    {
        $themeModel = new ProgramThemeModel();

        return view('ManagePrograms/add_programs', [
            'themes' => $themeModel->findAll()
        ]);
    }

    // ---------------------------------------------------------
    // SAVE NEW PROGRAM
    // ---------------------------------------------------------
    public function store()
    {
        helper(['form']);

        $rules = [
            'Program_Name' => 'required|max_length[200]',
            'Banner_Head' => 'required|max_length[250]',
            'Banner_Subhead' => 'permit_empty|max_length[250]',
            'Program_About' => 'required',
            'Program_Theme_Id' => 'required',
            'Program_Start_Date' => 'required|valid_date[Y-m-d]',
            'Program_End_Date' => 'permit_empty|valid_date[Y-m-d]',
            'Applicable_For' => 'required|max_length[500]',
            'Program_Status' => 'required|in_list[Active,Inactive,Completed]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Check gallery selection count
        $galleryFiles = $this->request->getFileMultiple('Gallery_Images') ?? [];

        $selectedGallery = array_filter($galleryFiles, function ($file) {
            return $file && $file->getError() !== UPLOAD_ERR_NO_FILE;
        });

        if (count($selectedGallery) > self::MAX_GALLERY_IMAGES) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'You can upload a maximum of 6 gallery images.');
        }

        // Upload profile image
        $profile = $this->uploadImage(
            $this->request->getFile('Thumbnail_Image'),
            'profile'
        );

        if (!$profile) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please upload a valid profile image (JPG, PNG or WEBP, maximum 2MB).');
        }

        // Upload banner image
        $banner = $this->uploadImage(
            $this->request->getFile('Banner_Image'),
            'banner'
        );

        if (!$banner) {
            $this->removeImageFile($profile);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Please upload a valid banner image (JPG, PNG or WEBP, maximum 2MB).');
        }

        // Upload gallery
        $galleryPaths = $this->uploadGallery();

        if ($galleryPaths === false) {
            $this->removeImageFiles([$profile, $banner]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gallery upload failed. Use valid JPG, PNG or WEBP images, maximum 2MB each and 6 images total.');
        }

        // Generate Program ID (19 characters)
        $programId = 'PROG_' . strtoupper(bin2hex(random_bytes(7)));

        $data = [
            'Program_Id' => $programId,
            'Program_Name' => $this->request->getPost('Program_Name'),
            'Banner_Head' => $this->request->getPost('Banner_Head'),
            'Banner_Subhead' => $this->request->getPost('Banner_Subhead'),
            'Thumbnail_Image' => $profile,
            'Banner_Image' => $banner,
            'Program_About' => $this->request->getPost('Program_About'),
            'Program_Theme_Id' => $this->request->getPost('Program_Theme_Id'),
            'Program_Start_Date' => $this->request->getPost('Program_Start_Date'),
            'Program_End_Date' => $this->request->getPost('Program_End_Date') ?: null,
            'Applicable_For' => $this->request->getPost('Applicable_For'),
            'Program_Status' => $this->request->getPost('Program_Status'),
            'Rec_Added_By' => 'admin',
            'Rec_Added_On' => date('Y-m-d'),
            'Rec_Updated_By' => 'admin',
            'Rec_Last_Updated_On' => date('Y-m-d')
        ];

        $this->db->transBegin();

        try {

            $saved = $this->programModel->insert($data);

            if ($saved === false) {
                throw new \RuntimeException('Program insert failed.');
            }

            // Save gallery records
            foreach ($galleryPaths as $index => $imagePath) {

                $inserted = $this->db->table('program_gallery')->insert([
                    'Program_Id' => $programId,
                    'Image_Path' => $imagePath,
                    'Sort_Order' => $index + 1
                ]);

                if (!$inserted) {
                    throw new \RuntimeException('Gallery insert failed.');
                }
            }

            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Database transaction failed.');
            }

            $this->db->transCommit();
        } catch (\Throwable $e) {

            $this->db->transRollback();

            // Remove newly uploaded files if database save fails
            $this->removeImageFiles(array_merge(
                [$profile, $banner],
                $galleryPaths
            ));

            log_message('error', 'Program store error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Program could not be saved. Please try again.');
        }

        return redirect()->to('/programs')
            ->with('success', 'Program added successfully!');
    }

    // ---------------------------------------------------------
    // EDIT PROGRAM PAGE
    // ---------------------------------------------------------
    public function edit($id)
    {
        $program = $this->programModel->find($id);

        if (!$program) {
            return redirect()->to('/programs')
                ->with('error', 'Program not found.');
        }

        $gallery = $this->getProgramGallery($id);

        return view('ManagePrograms/edit_programs', [
            'program' => $program,
            'themes' => (new ProgramThemeModel())->findAll(),
            'gallery' => $gallery
        ]);
    }

    // ---------------------------------------------------------
    // UPDATE PROGRAM
    // ---------------------------------------------------------
    public function update($id)
    {
        $program = $this->programModel->find($id);

        if (!$program) {
            return redirect()->to('/programs')
                ->with('error', 'Program not found.');
        }

        helper(['form']);

        $rules = [
            'Program_Name' => 'required|max_length[200]',
            'Banner_Head' => 'required|max_length[250]',
            'Banner_Subhead' => 'permit_empty|max_length[250]',
            'Program_About' => 'required',
            'Program_Theme_Id' => 'required',
            'Program_Start_Date' => 'required|valid_date[Y-m-d]',
            'Program_End_Date' => 'permit_empty|valid_date[Y-m-d]',
            'Applicable_For' => 'required|max_length[500]',
            'Program_Status' => 'required|in_list[Active,Inactive,Completed]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // ---------------------------------------------
        // PROFILE IMAGE
        // ---------------------------------------------
        $newFiles = [];

        $profileFile = $this->request->getFile('Thumbnail_Image');

        $profile = $this->uploadImage($profileFile, 'profile');

        if ($profile === false) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid profile image. Use JPG, PNG or WEBP, maximum 2MB.');
        }

        if ($profile !== null) {
            $newFiles[] = $profile;
        } else {
            $profile = $program['Thumbnail_Image'];
        }

        // ---------------------------------------------
        // BANNER IMAGE
        // ---------------------------------------------
        $bannerFile = $this->request->getFile('Banner_Image');

        $banner = $this->uploadImage($bannerFile, 'banner');

        if ($banner === false) {

            $this->removeImageFiles($newFiles);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid banner image. Use JPG, PNG or WEBP, maximum 2MB.');
        }

        if ($banner !== null) {
            $newFiles[] = $banner;
        } else {
            $banner = $program['Banner_Image'];
        }

        // ---------------------------------------------
        // GALLERY IMAGES
        // ---------------------------------------------
        $galleryFiles = $this->request->getFileMultiple('Gallery_Images') ?? [];

        $selectedGallery = array_filter($galleryFiles, function ($file) {
            return $file && $file->getError() !== UPLOAD_ERR_NO_FILE;
        });

        if (count($selectedGallery) > self::MAX_GALLERY_IMAGES) {

            $this->removeImageFiles($newFiles);

            return redirect()->back()
                ->withInput()
                ->with('error', 'You can upload a maximum of 6 gallery images.');
        }

        $galleryPaths = [];

        // Only upload/replace gallery when new files are selected
        if (count($selectedGallery) > 0) {

            $galleryPaths = $this->uploadGallery();

            if ($galleryPaths === false) {

                $this->removeImageFiles($newFiles);

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gallery upload failed. Use valid JPG, PNG or WEBP images, maximum 2MB each.');
            }

            $newFiles = array_merge($newFiles, $galleryPaths);
        }

        // ---------------------------------------------
        // PROGRAM DATA
        // ---------------------------------------------
        $data = [
            'Program_Name' => $this->request->getPost('Program_Name'),
            'Banner_Head' => $this->request->getPost('Banner_Head'),
            'Banner_Subhead' => $this->request->getPost('Banner_Subhead'),
            'Thumbnail_Image' => $profile,
            'Banner_Image' => $banner,
            'Program_About' => $this->request->getPost('Program_About'),
            'Program_Theme_Id' => $this->request->getPost('Program_Theme_Id'),
            'Program_Start_Date' => $this->request->getPost('Program_Start_Date'),
            'Program_End_Date' => $this->request->getPost('Program_End_Date') ?: null,
            'Applicable_For' => $this->request->getPost('Applicable_For'),
            'Program_Status' => $this->request->getPost('Program_Status'),
            'Rec_Updated_By' => 'admin',
            'Rec_Last_Updated_On' => date('Y-m-d')
        ];

        // Keep old gallery records unless new images were uploaded
        $oldGallery = [];

        if (count($galleryPaths) > 0) {
            $oldGallery = $this->getProgramGallery($id);
        }

        $this->db->transBegin();

        try {

            $updated = $this->programModel->update($id, $data);

            if ($updated === false) {
                throw new \RuntimeException('Program update failed.');
            }

            // Replace gallery only when new images are uploaded
            if (count($galleryPaths) > 0) {

                $deleted = $this->db->table('program_gallery')
                    ->where('Program_Id', $id)
                    ->delete();

                if ($deleted === false) {
                    throw new \RuntimeException('Old gallery records could not be deleted.');
                }

                foreach ($galleryPaths as $index => $imagePath) {

                    $inserted = $this->db->table('program_gallery')->insert([
                        'Program_Id' => $id,
                        'Image_Path' => $imagePath,
                        'Sort_Order' => $index + 1
                    ]);

                    if (!$inserted) {
                        throw new \RuntimeException('New gallery record could not be saved.');
                    }
                }
            }

            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Database transaction failed.');
            }

            $this->db->transCommit();
        } catch (\Throwable $e) {

            $this->db->transRollback();

            // Remove newly uploaded files if database update fails
            $this->removeImageFiles($newFiles);

            log_message('error', 'Program update error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Program update failed. Please try again.');
        }

        // ---------------------------------------------
        // REMOVE OLD FILES AFTER SUCCESSFUL UPDATE
        // ---------------------------------------------
        if ($profile !== $program['Thumbnail_Image']) {
            $this->removeImageFile($program['Thumbnail_Image']);
        }

        if ($banner !== $program['Banner_Image']) {
            $this->removeImageFile($program['Banner_Image']);
        }

        if (count($galleryPaths) > 0) {

            foreach ($oldGallery as $oldImage) {
                $this->removeImageFile($oldImage['Image_Path']);
            }
        }

        return redirect()->to('/programs')
            ->with('success', 'Program updated successfully!');
    }

    // ---------------------------------------------------------
    // DELETE PROGRAM
    // ---------------------------------------------------------
    public function delete($id)
    {
        $program = $this->programModel->find($id);

        if (!$program) {
            return redirect()->to('/programs')
                ->with('error', 'Program not found.');
        }

        $gallery = $this->getProgramGallery($id);

        $this->db->transBegin();

        try {

            $this->db->table('program_gallery')
                ->where('Program_Id', $id)
                ->delete();

            $deleted = $this->programModel->delete($id);

            if ($deleted === false || $this->db->transStatus() === false) {
                throw new \RuntimeException('Program deletion failed.');
            }

            $this->db->transCommit();
        } catch (\Throwable $e) {

            $this->db->transRollback();

            log_message('error', 'Program delete error: ' . $e->getMessage());

            return redirect()->to('/programs')
                ->with('error', 'Program could not be deleted.');
        }

        // Remove physical files after successful database deletion
        $this->removeImageFile($program['Thumbnail_Image'] ?? null);
        $this->removeImageFile($program['Banner_Image'] ?? null);

        foreach ($gallery as $image) {
            $this->removeImageFile($image['Image_Path']);
        }

        return redirect()->to('/programs')
            ->with('success', 'Program deleted successfully.');
    }
}
