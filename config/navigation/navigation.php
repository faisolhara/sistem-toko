<?php

return 
    [
        [
            'label'     => 'master-user',
            'icon'      => 'users',
            'route'     => 'master-user-index',
            'resource'  => 'Master User',
            'privilege' => 'view',
        ],
        [
            'label'     => 'master-role',
            'icon'      => 'black-tie',
            'route'     => 'master-role-index',
            'resource'  => 'Master Role',
            'privilege' => 'view',
        ],
        [
            'label'     => 'master-category',
            'icon'      => 'sitemap',
            'route'     => 'master-category-index',
            'resource'  => 'Master Category',
            'privilege' => 'view',
        ],
        [    
            'label'     => 'master-uom',
            'icon'      => 'archive',
            'route'     => 'master-uom-index',
            'resource'  => 'Master Uom',
            'privilege' => 'view',
        ],
        [
            'label'     => 'master-conversion',
            'icon'      => 'balance-scale',
            'route'     => 'master-conversion-index',
            'resource'  => 'Master Conversion',
            'privilege' => 'view',
        ],
        [
            'label'     => 'master-item',
            'icon'      => 'barcode',
            'route'     => 'master-item-index',
            'resource'  => 'Master Item',
            'privilege' => 'view',
        ],
        [
            'label'     => 'master-supplier',
            'icon'      => 'truck',
            'route'     => 'master-supplier-index',
            'resource'  => 'Master Supplier',
            'privilege' => 'view',
        ],
        [
            'label'     => 'item-stock',
            'icon'      => 'stack-exchange',
            'route'     => 'item-stock-index',
            'resource'  => 'Item Stock',
            'privilege' => 'view',
        ],
        [
            'label'     => 'receipt-item',
            'icon'      => 'download',
            'route'     => 'receipt-item-index',
            'resource'  => 'Receipt Item',
            'privilege' => 'view',
        ],
        [
            'label'     => 'adjustment-stock',
            'icon'      => 'refresh',
            'route'     => 'adjustment-stock-index',
            'resource'  => 'Adjustment Stock',
            'privilege' => 'view',
        ],
        [
            'label'     => 'payment',
            'icon'      => 'shopping-cart',
            'route'     => 'payment-index',
            'resource'  => 'Payment',
            'privilege' => 'view',
        ],
    ];