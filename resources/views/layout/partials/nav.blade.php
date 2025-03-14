<?php
$sidebarItems = [
    [
        "title" => "Dashboard",
        "icon" => "fa fa-tachometer",
        "url" => "/managements/dashboard",
        "levels" => ["admin", "teacher"]
    ],
    [
        "title" => "Pengguna",
        "icon" => "fa fa-user",
        "url" => "/managements/users",
        "levels" => ["admin"]
    ],
    [
        "title" => "Kelas",
        "icon" => "fa fa-building",
        "url" => "/managements/majors",
        "levels" => ["admin"]
    ],
    [
        "title" => "Tingkat",
        "icon" => "fa fa-bar-chart-o",
        "url" => "/managements/classes",
        "levels" => ["admin"]
    ],
    [
        "title" => "Siswa",
        "icon" => "fa fa-users",
        "url" => "/managements/students",
        "levels" => ["admin"]
    ],
    [
        "title" => "Penjadwalan",
        "icon" => "fa fa-calendar",
        "url" => "/managements/schedules",
        "levels" => ["teacher"]
    ],
    [
        "title" => "Laporan jadwal",
        "icon" => "fa fa-calendar",
        "url" => "/managements/report-schedule",
        "levels" => ["admin"]
    ],
    [
        "title" => "Laporan Konseling",
        "icon" => "fa fa-pencil-square-o",
        "url" => "/managements/counseling",
        "levels" => ["teacher"]
    ],
    [
        "title" => "Laporan Selesai",
        "icon" => "fa fa-check-square-o",
        "url" => "/managements/approved",
        "levels" => ["admin"]
    ],
    [
        "title" => "Pengaturan Akun",
        "icon" => "fa fa-cog",
        "submenu" => [
            [
                "title" => "Ganti Password",
                "url" => "/managements/profile"
            ],
            [
                "title" => "Keluar",
                "url" => "/logout"
            ],
        ],
        "levels" => ["admin", "teacher"]
    ]
];

function renderSidebar($items, $userLevels) {
    $currentPath = $_SERVER['REQUEST_URI'];

    echo '<nav class="sidebar sidebar-offcanvas" id="sidebar">';
    echo '<ul class="nav">';

    foreach ($items as $item) {
        // Cek apakah ada minimal satu level yang cocok
        if (!empty($item['levels']) && empty(array_intersect($userLevels, $item['levels']))) {
            continue;
        }

        $hasSubmenu = isset($item['submenu']) && !empty($item['submenu']);
        $isActive = isset($item['url']) && trim($currentPath, '/') === trim($item['url'], '/');

        echo '<li class="nav-item">';
        
        if ($hasSubmenu) {
            echo '<a class="nav-link" data-bs-toggle="collapse" href="#' . 
                 strtolower(str_replace(' ', '-', $item['title'])) . 
                 '" aria-expanded="false" aria-controls="' . 
                 strtolower(str_replace(' ', '-', $item['title'])) . '">';
            echo '<span class="menu-title">' . $item['title'] . '</span>';
            echo '<i class="menu-arrow"></i>';
            echo '<i class="' . $item['icon'] . ' menu-icon"></i>';
            echo '</a>';
            
            echo '<div class="collapse" id="' . strtolower(str_replace(' ', '-', $item['title'])) . '">';
            echo '<ul class="nav flex-column sub-menu">';
            foreach ($item['submenu'] as $submenu) {
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="' . $submenu['url'] . '">' . $submenu['title'] . '</a>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        } 
        else {
            echo '<a class="nav-link" href="' . $item['url'] . '">';
            echo '<span class="menu-title">' . $item['title'] . '</span>';
            echo '<i class="' . $item['icon'] . ' menu-icon"></i>';
            echo '</a>';
        }
        
        echo '</li>';
    }

    echo '</ul>';
    echo '</nav>';
}

// Ambil level user dari database
$userLevels = auth()->user()->levels;

// Jika `levels` berupa string biasa (misal: "admin,teacher"), ubah menjadi array
if (is_string($userLevels)) {
    $userLevels = explode(',', $userLevels);
} 
// Jika hanya satu level, ubah ke array agar tetap bisa dicek dengan array_intersect()
elseif (!is_array($userLevels)) {
    $userLevels = [$userLevels];
}

renderSidebar($sidebarItems, $userLevels);
?>
