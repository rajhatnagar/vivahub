<?php
// Shared Pricing Data for Frontend and Admin
$pricing_plans = [
    [
        'id' => 1,
        'name' => 'AARAMBH',
        'price' => '399',
        'type' => 'User',
        'validity' => '15 Days',
        'features' => [
            'Web Wedding Invitation',
            'Events, Photos, Gallery',
            'Google Map Location',
            'RSVP',
            'Background Music',
            'Shareable Link'
        ],
        'is_popular' => false,
        'css_class' => 'glass-card-light' // For frontend styling mapping
    ],
    [
        'id' => 2,
        'name' => 'VIVA',
        'price' => '699',
        'type' => 'User',
        'validity' => '45 Days',
        'features' => [
            'All features same as AARAMBH',
            'Extended Validity',
            'WhatsApp Integration',
            '3 Design Revisions'
        ],
        'is_popular' => true,
        'css_class' => 'glass-card'
    ],
    [
        'id' => 3,
        'name' => 'EDGE',
        'price' => '999',
        'type' => 'User',
        'validity' => '60 Days',
        'features' => [
            'All features same as above',
            'Max Validity',
            'Dedicated Support',
            'Zero Branding'
        ],
        'is_popular' => false,
        'css_class' => 'glass-card-light'
    ],
    [
        'id' => 4,
        'name' => 'PARTNER PLAN',
        'price' => '4,999',
        'type' => 'Partner',
        'validity' => '1 Year',
        'features' => [
            '10 Invitations Included',
            'Generate 100% Free Code',
            'Client Order Management',
            'Reseller Dashboard'
        ],
        'is_popular' => false
    ],
    [
        'id' => 5,
        'name' => 'WELCOME BOARD',
        'price' => '600',
        'type' => 'Offline',
        'validity' => 'Physical',
        'features' => [
            'Only Nashik City',
            'No Delivery',
            'Pickup 5-7 days',
            'Premium Fixed Design'
        ],
        'is_popular' => false
    ],
    [
        'id' => 6,
        'name' => 'ACRYLIC LOGO',
        'price' => '800',
        'type' => 'Offline',
        'validity' => 'Physical',
        'features' => [
            'Only Nashik City',
            'Print-ready Acrylic',
            'Pickup 5-7 days'
        ],
        'is_popular' => false
    ],
    [
        'id' => 7,
        'name' => 'NFC CARD',
        'price' => '399',
        'type' => 'Offline',
        'validity' => 'Lifetime',
        'features' => [
            'Pan India Delivery',
            'Tap or Scan',
            'Courier charges extra'
        ],
        'is_popular' => false
    ]
];
?>
