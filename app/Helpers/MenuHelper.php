<?php

namespace App\Helpers;

class MenuHelper
{
    /**
     * Get menu items for a specific role
     */
    public static function getMenuItems($role)
    {
        $menus = [
            0 => [ // Admin
                [
                    'title' => __('Users'),
                    'route' => 'user.index',
                    'icon' => 'fas fa-users'
                ],
                [
                    'title' => __('Tim Pelayanan'),
                    'route' => 'tim_pelayanan.index',
                    'icon' => 'fas fa-users-cog'
                ],
                [
                    'title' => __('Cabang'),
                    'route' => 'cabang.index',
                    'icon' => 'fas fa-map-marker-alt'
                ],
                [
                    'title' => __('Bagian'),
                    'route' => 'bagian.index',
                    'icon' => 'fas fa-sitemap'
                ],
                [
                    'title' => __('Jadwal Ibadah'),
                    'route' => 'jadwal_ibadah.index',
                    'icon' => 'fas fa-church'
                ],
                [
                    'title' => __('Jadwal Pelayanan'),
                    'route' => 'jadwal.index',
                    'icon' => 'fas fa-calendar-alt'
                ],
                [
                    'title' => __('Grading'),
                    'route' => 'grading.index',
                    'icon' => 'fas fa-star'
                ]
            ],
            1 => [ // PIC
                [
                    'title' => __('Tim Pelayanan'),
                    'route' => 'tim_pelayanan.index',
                    'icon' => 'fas fa-users-cog'
                ],
                [
                    'title' => __('Jadwal Ibadah'),
                    'route' => 'jadwal_ibadah.index',
                    'icon' => 'fas fa-church'
                ],
                [
                    'title' => __('Jadwal Pelayanan'),
                    'route' => 'jadwal.index',
                    'icon' => 'fas fa-calendar-alt'
                ]
            ],
            2 => [ // Volunteer
                [
                    'title' => __('Tim Pelayanan'),
                    'route' => 'tim_pelayanan.index',
                    'icon' => 'fas fa-users-cog'
                ],
                [
                    'title' => __('Jadwal Ibadah'),
                    'route' => 'jadwal_ibadah.index',
                    'icon' => 'fas fa-church'
                ],
                [
                    'title' => __('Jadwal Pelayanan'),
                    'route' => 'jadwal.index',
                    'icon' => 'fas fa-calendar-alt'
                ]
            ],
            3 => [ // Servo
                [
                    'title' => __('Jadwal Pelayanan'),
                    'route' => 'jadwal.index',
                    'icon' => 'fas fa-calendar-alt'
                ]
            ]
        ];

        return $menus[$role] ?? [];
    }

    /**
     * Get allowed roles for each route prefix (for middleware)
     */
    public static function getAllowedRolesForPrefix($prefix)
    {
        // Role == 0 : Admin
        // Role == 1 : PIC
        // Role == 2 : Volunteer
        // Role == 3 : Servo
        $map = [
            'user' => ['role:0'],
            'cabang' => ['role:0'],
            'bagian' => ['role:0'],
            'tag' => ['role:0'],
            'mapping' => ['role:0'],
            'jadwal' => ['role:0,2'],
            'jadwal_ibadah' => ['role:0,2'],
            'tim_pelayanan' => ['role:0,2'],
            'grading' => ['role:0'],
        ];
        return $map[$prefix] ?? ['role:0'];
    }

    /**
     * Get menu items with full routes for dashboard
     */
    public static function getDashboardMenuItems($role)
    {
        $menuItems = self::getMenuItems($role);
        
        return array_map(function($item) {
            return [
                'title' => $item['title'],
                'route' => route($item['route']),
                'icon' => $item['icon']
            ];
        }, $menuItems);
    }

    /**
     * Get menu items for navbar (with route names)
     */
    public static function getNavbarMenuItems($role)
    {
        return self::getMenuItems($role);
    }
} 