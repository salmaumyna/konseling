<?php
$sidebarItems = [
    [
        "title" => "Dashboard",
        "icon" => "fa fa-tachometer",
        "url" => "  /managements/dashboard",
        "levels" => ["admin", "teacher"]
    ],
    [
        "title" => "Pengguna",
        "icon" => "fa fa-user",
        "url" => "/managements/users",
        "levels" => ["admin"]
    ],
    [
        "title" => "Pengaturan Akun",
        "icon" => "fa fa-key",
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

function renderSidebar($items, $userLevel) {
    $currentPath = $_SERVER['REQUEST_URI'];

    echo '<nav class="sidebar sidebar-offcanvas" id="sidebar">';
    echo '<ul class="nav">';

    foreach ($items as $item) {
        if (isset($item['levels']) && !in_array($userLevel, $item['levels'])) {
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
            $target = isset($item['target']) ? ' target="' . $item['target'] . '"' : '';
            echo '<a class="nav-link" href="' . $item['url'] . '"' . $target . '>';
            echo '<span class="menu-title">' . $item['title'] . '</span>';
            echo '<i class="' . $item['icon'] . ' menu-icon"></i>';
            echo '</a>';
        }
        
        echo '</li>';
    }

    echo '</ul>';
    echo '</nav>';
}

$userLevel = auth()->user()->levels; 
renderSidebar($sidebarItems, $userLevel);
?>