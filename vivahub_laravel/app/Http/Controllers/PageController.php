<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function features()
    {
        return view('features');
    }

    public function templates()
    {
        return view('templates');
    }

    public function pricing()
    {
        // Fetch Active Pricing Plans from Database
        $pricing_plans = \App\Models\Plan::where('is_active', true)->get();

        return view('pricing', compact('pricing_plans'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sitemap()
    {
        return view('sitemap');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function submitContact(Request $request)
    {
        // Mock submission for now
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        return back()->with('success', 'Thank you for contacting us! We will get back to you shortly.');
    }

    public function newHome()
    {
        $templates = \App\Models\Template::where('is_active', true)->latest()->get();
        return view('frontend.new_home', compact('templates'));
    }

    public function previewTemplate($template)
    {
        try {
            $data = ['isPreview' => true];
            return $this->renderTemplateView($template, $data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Public Preview Template Error: ' . $e->getMessage());
            return response("Error loading template: " . $e->getMessage(), 500);
        }
    }

    private function renderTemplateView($templateId, $data = [])
    {
        // Inject Mock Invitation for Preview if missing
        if (isset($data['isPreview']) && $data['isPreview'] && !isset($data['invitation'])) {
            // Use template images for defaults
            $testImgPath = asset('assets/wedding-templates');

            $mockData = [
                // Common
                'date' => '2026-12-12',
                'rsvp_date' => '2026-10-01',
                'tagline' => 'A celebration of love',
                'accommodation_details' => 'Luxury suites reserved.',
                'travel_details' => 'Nearest Airport: UDR',

                // New Themes
                'bride_name' => 'Elena', 
                'groom_name' => 'Julian',
                'venue_city' => 'Udaipur, India',
                'hero_image' => $testImgPath . '/hero.jpg', // Couple
                'bride_image' => $testImgPath . '/bride.jpg', // Bride
                'groom_image' => $testImgPath . '/groom.jpg', // Groom
                
                // Legacy/Alternative Themes
                'bride' => 'Elena',
                'groom' => 'Julian',
                'location' => 'Udaipur, India',
                'h_img' => $testImgPath . '/hero.jpg',
                'hero_bg' => $testImgPath . '/hero.jpg',
                
                // Galleries
                'gallery' => [
                    $testImgPath . '/gallery1.png',
                    $testImgPath . '/gallery2.png',
                    $testImgPath . '/gallery3.png',
                    $testImgPath . '/gallery4.png',
                    $testImgPath . '/gallery5.png',
                    $testImgPath . '/gallery6.png',
                ],
                // Individual gallery keys for legacy compatibility
                'gallery_1' => $testImgPath . '/gallery1.png',
                'gallery_2' => $testImgPath . '/gallery2.png', 
                'gallery_3' => $testImgPath . '/gallery3.png',
                'gallery_4' => $testImgPath . '/gallery4.png',

                // Events
                'events' => [
                     ['name' => 'Mehendi Ceremony', 'date' => 'Dec 11', 'time' => '04:00 PM', 'location' => 'Poolside Lawns', 'desc' => 'Henna & Music'],
                     ['name' => 'Wedding Ceremony', 'date' => 'Dec 12', 'time' => '09:00 AM', 'location' => 'The Mandap', 'desc' => 'Traditional Pheras'],
                     ['name' => 'Reception', 'date' => 'Dec 12', 'time' => '07:00 PM', 'location' => 'Grand Ballroom', 'desc' => 'Dinner & Drinks']
                ],
                'rsvp_date' => '2026-10-01'
            ];
            
            // Create a generic object to mimic the model
            $invitation = new \stdClass();
            $invitation->data = $mockData;
            $invitation->id = 0; // Fix for theme_3
            $data['invitation'] = $invitation;
        }

        // 1. Immutable Reference (The Original Check)
        if ($templateId === 'wedding-1') {
             return view('templates.wedding_theme_1', $data);
        }

        // 2. Standalone New Themes
        if (in_array($templateId, ['theme_2', 'theme_3', 'theme_4', 'theme_5', 'theme_6', 'theme_7', 'theme_8', 'theme_9', 'theme_10'])) {
             return view('templates.' . $templateId, $data);
        }

        // 2. Standardized Master (For Royal, Minimal, etc... AND 'royal_wedding')
        // We removed the specific check for royal_wedding because getThemeConfig now handles it
        if (str_starts_with($templateId, 'theme_') || $templateId === 'royal_wedding') {
            $data['theme'] = $this->getThemeConfig($templateId);
            return view('templates.master_prototype', $data);
        }

        // 3. Custom Templates
        if (strpos($templateId, 'custom_') !== false || !in_array($templateId, ['wedding-1', 'theme_2', 'theme_3', 'theme_4', 'theme_5', 'theme_6', 'theme_7', 'theme_8', 'theme_9', 'theme_10'])) {
             if (view()->exists('templates.custom.' . $templateId)) {
                 $data['asset_path'] = asset('templates/custom/' . $templateId);
                 return view('templates.custom.' . $templateId, $data);
             }
        }

        // 4. Fallback
        return view('templates.wedding_theme_1', $data);
    }

    private function getThemeConfig($id)
    {
        // Alias royal_wedding to theme_royal
        if ($id === 'royal_wedding') {
            $id = 'theme_royal';
        }

        $baseAssets = [
            'hero' => 'https://csssofttech.com/wedding/assets/hero.png', // Fallback
        ];

        $themes = [
            'theme_royal' => [
                'name' => 'Royal Gold',
                'fonts' => ['primary' => 'Cinzel', 'secondary' => 'Great Vibes'],
                'colors' => [
                    'bg' => '#1a0b0b',
                    'text' => '#ffffff',
                    // Gold Primary
                    'primary' => ['50' => '#FFFBF0', '500' => '#FFD700', '900' => '#8B7500'],
                    // Red Secondary
                    'secondary' => ['50' => '#FFF0F0', '500' => '#C41E3A', '900' => '#4A0E0E'],
                ],
                'assets' => [
                    'hero_bg' => asset('assets/backgrounds/bg_royal_hero.png'),
                    'content_bg' => asset('assets/backgrounds/bg_royal_content.png'),
                    'footer_bg' => asset('assets/backgrounds/bg_royal_footer.png'),
                    'hero_couple' => 'https://images.unsplash.com/photo-1583934555026-63b5b46e5200?q=80&w=2070&auto=format&fit=crop', // Royal Indian Couple
                    'hero_frame' => 'frame-royal', // Gold Double Border
                    'std_variant' => 'std-royal',
                    'hero_layout' => 'centered',
                    'hero_animation' => 'animate-float-photo',
                ]
            ],
        ];

        return $themes[$id] ?? $themes['theme_royal'];
    }
}
