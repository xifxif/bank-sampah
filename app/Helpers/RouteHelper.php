<?php

namespace App\Helpers;

class RouteHelper
{
    /**
     * Check if current route matches pattern
     */
    public static function isActive($route, $output = 'active')
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return $output;
                }
            }
            return '';
        }

        return request()->routeIs($route) ? $output : '';
    }

    /**
     * Check if current route matches pattern (with wildcard)
     */
    public static function isActiveMatch($pattern, $output = 'active')
    {
        return request()->routeIs($pattern) ? $output : '';
    }

    /**
     * Get admin menu items
     */
    public static function getAdminMenu()
    {
        return [
            [
                'name' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'home',
            ],
            [
                'name' => 'Master Data',
                'icon' => 'database',
                'children' => [
                    [
                        'name' => 'Wilayah',
                        'route' => 'admin.wilayah.index',
                    ],
                    [
                        'name' => 'Bank Sampah',
                        'route' => 'admin.bank-sampah.index',
                    ],
                    [
                        'name' => 'Jenis Sampah',
                        'route' => 'admin.jenis-sampah.index',
                    ],
                ],
            ],
            [
                'name' => 'Harga Standar',
                'route' => 'admin.harga-standar.index',
                'icon' => 'dollar-sign',
            ],
            [
                'name' => 'User Management',
                'route' => 'admin.users.index',
                'icon' => 'users',
            ],
            [
                'name' => 'Monitoring',
                'icon' => 'activity',
                'children' => [
                    [
                        'name' => 'Dashboard Monitoring',
                        'route' => 'admin.monitoring.index',
                    ],
                    [
                        'name' => 'Monitoring Harga',
                        'route' => 'admin.monitoring.harga',
                    ],
                    [
                        'name' => 'Monitoring Transaksi',
                        'route' => 'admin.monitoring.transaksi',
                    ],
                    [
                        'name' => 'Monitoring Wilayah',
                        'route' => 'admin.monitoring.wilayah',
                    ],
                    [
                        'name' => 'Log Aktivitas',
                        'route' => 'admin.monitoring.log',
                    ],
                ],
            ],
            [
                'name' => 'Laporan',
                'icon' => 'file-text',
                'children' => [
                    [
                        'name' => 'Laporan Transaksi',
                        'route' => 'admin.laporan.transaksi',
                    ],
                    [
                        'name' => 'Laporan Jenis Sampah',
                        'route' => 'admin.laporan.jenis-sampah',
                    ],
                    [
                        'name' => 'Laporan Per Bank',
                        'route' => 'admin.laporan.per-bank',
                    ],
                    [
                        'name' => 'Laporan Per Wilayah',
                        'route' => 'admin.laporan.per-wilayah',
                    ],
                    [
                        'name' => 'Laporan Nilai Ekonomis',
                        'route' => 'admin.laporan.nilai-ekonomis',
                    ],
                ],
            ],
        ];
    }

    /**
     * Get bank sampah menu items
     */
    public static function getBankSampahMenu()
    {
        return [
            [
                'name' => 'Dashboard',
                'route' => 'bank-sampah.dashboard',
                'icon' => 'home',
            ],
            [
                'name' => 'Transaksi Penyetoran',
                'route' => 'bank-sampah.penyetoran.index',
                'icon' => 'arrow-down-circle',
            ],
            [
                'name' => 'Transaksi Penjualan',
                'route' => 'bank-sampah.penjualan.index',
                'icon' => 'arrow-up-circle',
            ],
            [
                'name' => 'Harga Sampah',
                'route' => 'bank-sampah.harga.index',
                'icon' => 'dollar-sign',
            ],
            [
                'name' => 'Laporan',
                'icon' => 'file-text',
                'children' => [
                    [
                        'name' => 'Laporan Harian',
                        'route' => 'bank-sampah.laporan.harian',
                    ],
                    [
                        'name' => 'Laporan Periode',
                        'route' => 'bank-sampah.laporan.periode',
                    ],
                    [
                        'name' => 'Laporan Bulanan',
                        'route' => 'bank-sampah.laporan.bulanan',
                    ],
                    [
                        'name' => 'Laporan Tahunan',
                        'route' => 'bank-sampah.laporan.tahunan',
                    ],
                    [
                        'name' => 'Laporan Jenis Sampah',
                        'route' => 'bank-sampah.laporan.jenis-sampah',
                    ],
                ],
            ],
        ];
    }
}
