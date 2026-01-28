<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends Controller
{
    public function dashboard()
    {
        // Mock Data for Dashboard
        $stats = [
            'total_guests' => 450,
            'confirmed' => 320,
            'pending' => 130
        ];

        $recent_invitations = [
            [
                'id' => 1,
                'title' => "The Wedding",
                'date' => "Dec 12, 2024",
                'location' => "Udaipur",
                'type' => "Main Ceremony",
                'status' => "Live",
                'rsvps' => 142,
                'img' => "https://lh3.googleusercontent.com/aida-public/AB6AXuC9nu-8rVUT7Wz-Vxt9BT824-hq4LswifXbY04Ryv8v1SbyxnTZtdp3KZuMzBf9nWrUkjJ9ndq52UOW0kjFL5o3UtTMXytAyQ_6vwGlMNMdv2r5OY-UFC2dNRgLa28FNuuAeYBmJ5p4cXeHnVzPPOxqicIktNMJihYCr_kDSj-zody2O2TrEHpFfRcNy6LvyyDFGyth4Q_icsFrtKF8ysuMh1VjRHSiXPAl-fgwnjyY6RNVjcR1KWTqxis3xcsQg2vapqsd043UY459"
            ],
            [
                'id' => 2,
                'title' => "Sangeet Night",
                'date' => "Dec 11, 2024",
                'location' => "City Palace",
                'type' => "Pre-Wedding",
                'status' => "Draft",
                'rsvps' => 0,
                'img' => "https://lh3.googleusercontent.com/aida-public/AB6AXuDzYEZUX-l-TUwZSPbPgzGDMjlmSHNn7eZbp5pDaR98aFdzDDjyh_q7r9cm12N5TUiEUzPckOXj0IqvhyPkawfKoG3lDFg-Eaz1JSJdBSHDBuke3zYMLE2OwDSVhPz83NI2fZYis5OXjel99lKxVfaVH-5uswf9VlCrPSKyxsXg3FdhLpE-V5KC7cXKRqpmuexoozDOll6LzcdeQTtsOvK7F_vCJyK1aC3lZrySCA4brPbvS2gQ88HTA7VKNop-8Wud6OI_G8DqpZt1"
            ]
        ];

        return view('user.dashboard', compact('stats', 'recent_invitations'));
    }

    public function invitations()
    {
        // Mock Data same as dashboard for now
        $invitations = [
            [
                'id' => 1,
                'title' => "The Wedding",
                'date' => "Dec 12, 2024",
                'location' => "Udaipur",
                'type' => "Main Ceremony",
                'status' => "Live",
                'rsvps' => 142,
                'img' => "https://lh3.googleusercontent.com/aida-public/AB6AXuC9nu-8rVUT7Wz-Vxt9BT824-hq4LswifXbY04Ryv8v1SbyxnTZtdp3KZuMzBf9nWrUkjJ9ndq52UOW0kjFL5o3UtTMXytAyQ_6vwGlMNMdv2r5OY-UFC2dNRgLa28FNuuAeYBmJ5p4cXeHnVzPPOxqicIktNMJihYCr_kDSj-zody2O2TrEHpFfRcNy6LvyyDFGyth4Q_icsFrtKF8ysuMh1VjRHSiXPAl-fgwnjyY6RNVjcR1KWTqxis3xcsQg2vapqsd043UY459"
            ],
            [
                'id' => 2,
                'title' => "Sangeet Night",
                'date' => "Dec 11, 2024",
                'location' => "City Palace",
                'type' => "Pre-Wedding",
                'status' => "Draft",
                'rsvps' => 0,
                'img' => "https://lh3.googleusercontent.com/aida-public/AB6AXuDzYEZUX-l-TUwZSPbPgzGDMjlmSHNn7eZbp5pDaR98aFdzDDjyh_q7r9cm12N5TUiEUzPckOXj0IqvhyPkawfKoG3lDFg-Eaz1JSJdBSHDBuke3zYMLE2OwDSVhPz83NI2fZYis5OXjel99lKxVfaVH-5uswf9VlCrPSKyxsXg3FdhLpE-V5KC7cXKRqpmuexoozDOll6LzcdeQTtsOvK7F_vCJyK1aC3lZrySCA4brPbvS2gQ88HTA7VKNop-8Wud6OI_G8DqpZt1"
            ]
        ];
        return view('user.invitations', compact('invitations'));
    }

    public function templates()
    {
        $templates = [
            ['name' => "Royal Mandala", 'style' => "Traditional", 'color' => "Red/Gold", 'img' => "https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format&fit=crop&q=80&w=300"],
            ['name' => "Modern Floral", 'style' => "Elegant", 'color' => "White/Pink", 'img' => "https://images.unsplash.com/photo-1519225421980-715cb0202128?auto=format&fit=crop&q=80&w=300"],
            ['name' => "Midnight Luxe", 'style' => "Luxury", 'color' => "Black/Gold", 'img' => "https://images.unsplash.com/photo-1622630998477-20aa696fa4f5?auto=format&fit=crop&q=80&w=300"],
            ['name' => "Pastel Dream", 'style' => "Minimalist", 'color' => "Sage/White", 'img' => "https://images.unsplash.com/photo-1507915977619-6ccfe8003ae6?auto=format&fit=crop&q=80&w=300"]
        ];
        return view('user.templates', compact('templates'));
    }

    public function builder()
    {
        return view('user.builder');
    }

    public function rsvps()
    {
        $guests = [
            ['name' => "Rohan & Family", 'phone' => "+91 9876543210", 'status' => "Accepted", 'count' => 3],
            ['name' => "Mrs. Sharma", 'phone' => "+91 9988776655", 'status' => "Pending", 'count' => 1],
            ['name' => "Amit Gupta", 'phone' => "+91 9123456789", 'status' => "Declined", 'count' => 0],
            ['name' => "Sneha Reddy", 'phone' => "+91 9871234560", 'status' => "Accepted", 'count' => 2]
        ];
        return view('user.rsvps', compact('guests'));
    }

    public function billing()
    {
        $transactions = [
            ['id' => "INV-24-001", 'date' => "Oct 24, 2023", 'plan' => "Viva Plan", 'amount' => "₹699", 'status' => "Paid"],
            ['id' => "INV-23-098", 'date' => "Sep 12, 2023", 'plan' => "Aarambh", 'amount' => "₹399", 'status' => "Paid"]
        ];
        return view('user.billing', compact('transactions'));
    }

    public function settings()
    {
        return view('user.settings');
    }
}
