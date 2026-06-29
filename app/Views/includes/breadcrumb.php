<!-- app/views/includes/breadcrumb.php -->
<div class="mb-3">
    <!-- Back Button -->
    <button class="btn btn-secondary mb-3" onclick="window.history.back()">
        <i class="mdi mdi-arrow-left"></i> Back
    </button>

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php
                echo '<li class="breadcrumb-item"><a href="' . base_url('index') . '">Home</a></li>';

                $uri = service('uri');
                $segments = $uri->getSegments();

                // If URL is like /programs/view/PROG123 → remove the last segment (the ID)
                $count = count($segments);
                if ($count > 1 && in_array(strtolower($segments[$count - 2]), ['view', 'edit'])) {
                    array_pop($segments); // remove last segment
                }

                $lastIndex = count($segments);
                $i = 1;
                $linkParts = [];

                foreach ($segments as $segment) {
                    $linkParts[] = $segment;  
                    $name = ucwords(str_replace('_', ' ', $segment));
                    $link = base_url(implode('/', $linkParts));

                    if ($i == $lastIndex) {
                        echo '<li class="breadcrumb-item active" aria-current="page">' . $name . '</li>';
                    } else {
                        echo '<li class="breadcrumb-item"><a href="' . $link . '">' . $name . '</a></li>';
                    }
                    $i++;
                }
            ?>
        </ol>
    </nav>
</div>

