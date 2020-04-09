<?php
return [
    'menus' => [
        'dashboard' => [
            'name' => 'Bảng điều khiển',
            'url' => '/admin',
            'icon' => '<i class="fas fa-cog"></i>',
            'submenu' => [],
        ],
        'invoice' => [
            'name' => 'Đơn hàng',
            'url' => '/admin/order',
            'icon' => '<i class="fas fa-file-invoice-dollar"></i>',
            'submenu' => [],
        ],
        'product' => [
            'name' => 'Sản phẩm',
            'url' => '',
            'icon' => '<i class="fab fa-product-hunt"></i>',
            'submenu' => [
                'categoryProduct' => [
                    'name' => 'Danh mục sản phẩm',
                    'url' => '/admin/product_category',
                ],
                'provider' => [
                    'name' => 'Nhà cung cấp',
                    'url' => '/admin/provider',
                ],
                'product' => [
                    'name' => 'Sản phẩm',
                    'url' => '/admin/product',
                ],
            ],
        ],
        'article' => [
            'name' => 'Bài viết',
            'url' => '',
            'icon' => '<i class="fas fa-newspaper"></i>',
            'submenu' => [
                'categoryArticle' => [
                    'name' => 'Danh mục bài viết',
                    'url' => '/admin/article_category',
                ],
                'article' => [
                    'name' => 'Bài viết',
                    'url' => '/admin/article',
                ],
            ],
        ],
        'slide' => [
            'name' => 'Slide Show',
            'url' => '/admin/slideshow',
            'icon' => '<i class="fas fa-images"></i>',
            'submenu' => [],
        ],
        'gallery' => [
            'name' => 'Thư viện ảnh',
            'url' => '/admin/gallery',
            'icon' => '<i class="fas fa-camera-retro"></i>',
            'submenu' => [],
        ],
        'info' => [
            'name' => 'Thông tin Website',
            'url' => '/admin/config',
            'icon' => '<i class="fas fa-info-circle"></i>',
            'submenu' => [],
        ],

    ],

    'sessionKey' => 'fy+TPoiljmLj2ZgJouUR1lSWNQu58Fnhekzu9IJ2K9g=',
];