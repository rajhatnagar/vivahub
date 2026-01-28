<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $plans = [
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
                'css_class' => 'glass-card-light'
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
            ]
        ];

        return view('pricing', compact('plans'));
    }
}
