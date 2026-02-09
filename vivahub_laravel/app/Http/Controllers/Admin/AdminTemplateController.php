<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invitation;
use App\Models\Coupon;
use App\Models\Plan;
use App\Models\Setting;

class AdminTemplateController extends Controller
{
    /**
     * Shared templates list - same as UserPanelController
     */
    private function getTemplatesList() 
    {
        return [
            ['name' => "Classic Elegant", 'style' => "Indian Traditional", 'color' => "Red/Gold", 'img' => asset('assets/hero-background.png'), 'id' => 'wedding-1'],
            ['name' => "Minimalist Chic", 'style' => "Modern Clean", 'color' => "White/Black", 'img' => asset('assets/thumbnails/thumb_modern_minimal_1769914243192.png'), 'id' => 'theme_2'],
            ['name' => "Midnight Rose", 'style' => "Dark Romantic", 'color' => "Black/Rose", 'img' => asset('assets/thumbnails/thumb_luxury_dark_1769914285194.png'), 'id' => 'theme_3'],
            ['name' => "Sage & Blush", 'style' => "Botanical Minimal", 'color' => "Sage/Pink", 'img' => asset('assets/thumbnails/thumb_floral_pastel_1769914259626.png'), 'id' => 'theme_4'],
            ['name' => "Boho Rust", 'style' => "Bohemian Rustic", 'color' => "Rust/Beige", 'img' => asset('assets/thumbnails/thumb_rustic_boho_1769914300003.png'), 'id' => 'theme_5'],
            ['name' => "Majestic Garden", 'style' => "Vintage Floral", 'color' => "Pastel/Floral", 'img' => asset('assets/thumbnails/thumb_vintage_retro_1769914405735.png'), 'id' => 'theme_6'],
            ['name' => "Royal Heritage", 'style' => "Luxury Traditional", 'color' => "Gold/Cream", 'img' => asset('assets/thumbnails/thumb_royal_gold_1769914222427.png'), 'id' => 'theme_7'],
            ['name' => "Boho Sunshine", 'style' => "Bohemian Rustic", 'color' => "Rust/Orange", 'img' => asset('assets/thumbnails/thumb_beach_tropical_1769914370611.png'), 'id' => 'theme_8'],
            ['name' => "Teal Harmony", 'style' => "Modern Minimal", 'color' => "Teal/Gold", 'img' => asset('assets/thumbnails/thumb_modern_minimal_1769914243192.png'), 'id' => 'theme_9'],
            ['name' => "Royal Ruby", 'style' => "Luxury Dark", 'color' => "Ruby/Gold", 'img' => asset('assets/thumbnails/thumb_traditional_red_1769914314829.png'), 'id' => 'theme_10'],
        ];
    }

    /**
     * Get list of disabled template IDs from settings
     */
    private function getDisabledTemplates()
    {
        $setting = Setting::where('key', 'disabled_templates')->first();
        if ($setting && $setting->value) {
            return json_decode($setting->value, true) ?? [];
        }
        return [];
    }

    /**
     * Show templates page for admin with toggle controls
     */
    public function templates()
    {
        $templates = $this->getTemplatesList();
        $disabledTemplates = $this->getDisabledTemplates();
        $themeColor = Setting::where('key', 'theme_color')->value('value') ?? '#ec1313';
        
        // Add enabled status to each template
        foreach ($templates as &$t) {
            $t['enabled'] = !in_array($t['id'], $disabledTemplates);
        }
        
        return view('admin.templates.index', compact('templates', 'themeColor', 'disabledTemplates'));
    }
    
    /**
     * Toggle template enabled/disabled status
     */
    public function toggleTemplateStatus(Request $request, $templateId)
    {
        $disabledTemplates = $this->getDisabledTemplates();
        
        if (in_array($templateId, $disabledTemplates)) {
            // Enable: Remove from disabled list
            $disabledTemplates = array_values(array_diff($disabledTemplates, [$templateId]));
            $enabled = true;
        } else {
            // Disable: Add to disabled list
            $disabledTemplates[] = $templateId;
            $enabled = false;
        }
        
        // Save to settings
        Setting::updateOrCreate(
            ['key' => 'disabled_templates'],
            ['value' => json_encode(array_values($disabledTemplates))]
        );
        
        return response()->json([
            'success' => true,
            'enabled' => $enabled,
            'message' => $enabled ? 'Template enabled' : 'Template disabled'
        ]);
    }

    /**
     * Show admin's own invitations (same format as user)
     */
    public function invitations()
    {
        $invitations = Invitation::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get()
            ->map(function($inv) {
                $data = $inv->data;
                if (!is_array($data)) $data = [];
                
                return [
                    'id' => $inv->id,
                    'title' => $inv->title,
                    'template_id' => $inv->template_id,
                    'date' => data_get($data, 'eventDates.0.date', 'TBD'),
                    'location' => data_get($data, 'eventDates.0.location', 'TBD'),
                    'type' => 'Wedding',
                    'status' => ucfirst($inv->status),
                    'rsvps' => 0,
                    'img' => data_get($data, 'h_img', "https://csssofttech.com/wedding/assets/hero.png")
                ];
            });
        
        $themeColor = Setting::where('key', 'theme_color')->value('value') ?? '#ec1313';
        
        return view('admin.invitations.index', compact('invitations', 'themeColor'));
    }

    /**
     * Show builder for admin (same as user, will be charged)
     */
    public function builder(Request $request)
    {
        $templateId = $request->query('template', 'wedding-1');
        $invitationId = $request->query('id');
        
        $invitation = null;
        if ($invitationId) {
            $invitation = Invitation::where('id', $invitationId)
                ->where('user_id', Auth::id())
                ->first();
        }
        
        $plans = Plan::where('is_active', true)->get();
        $templates = $this->getTemplatesList();
        $themeColor = Setting::where('key', 'theme_color')->value('value') ?? '#ec1313';
        
        return view('admin.templates.builder', compact('templateId', 'invitation', 'plans', 'templates', 'themeColor'));
    }

    /**
     * Preview a template - mirrors UserPanelController
     */
    public function previewTemplate($template, Request $request)
    {
        try {
            $data = ['isPreview' => true];
            
            // If invitation ID provided, fetch it to show real data in preview
            if ($request->has('invitation_id') && $request->invitation_id) {
                $invitation = Invitation::select('id', 'user_id', 'template_id', 'title', 'data', 'status')
                    ->find($request->invitation_id);
                if ($invitation) {
                    $data['invitation'] = $invitation;
                }
            }
            
            return $this->renderTemplateView($template, $data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Admin Preview Template Error: ' . $e->getMessage());
            return response("Error loading template: " . $e->getMessage(), 500);
        }
    }
    
    /**
     * Render template with proper data - mirrors UserPanelController
     */
    private function renderTemplateView($templateId, $data = [])
    {
        // Inject Mock Invitation for Preview if missing
        if (isset($data['isPreview']) && $data['isPreview'] && !isset($data['invitation'])) {
            $testImgPath = asset('test');
            
            $mockData = [
                'date' => '2026-12-12',
                'rsvp_date' => '2026-10-01',
                'tagline' => 'A celebration of love',
                'accommodation_details' => 'Luxury suites reserved.',
                'travel_details' => 'Nearest Airport: UDR',

                'bride_name' => 'Elena', 
                'groom_name' => 'Julian',
                'venue_city' => 'Udaipur, India',
                'hero_image' => $testImgPath . '/hero.jpg',
                'bride_image' => $testImgPath . '/bride.jpg',
                'groom_image' => $testImgPath . '/groom.jpg',
                
                'bride' => 'Elena',
                'groom' => 'Julian',
                'location' => 'Udaipur, India',
                'h_img' => $testImgPath . '/hero.jpg',
                'hero_bg' => $testImgPath . '/hero.jpg',
                
                'gallery' => [
                    $testImgPath . '/bride.jpg',
                    $testImgPath . '/groom.jpg',
                    $testImgPath . '/wedding.jpg',
                    $testImgPath . '/haldi.png',
                    $testImgPath . '/reception.jpg',
                    $testImgPath . '/family-photo.jpg',
                    $testImgPath . '/hero.jpg',
                ],

                'events' => [
                     ['name' => 'Mehendi Ceremony', 'date' => 'Dec 11', 'time' => '04:00 PM', 'location' => 'Poolside Lawns', 'desc' => 'Henna & Music'],
                     ['name' => 'Wedding Ceremony', 'date' => 'Dec 12', 'time' => '09:00 AM', 'location' => 'The Mandap', 'desc' => 'Traditional Pheras'],
                     ['name' => 'Reception', 'date' => 'Dec 12', 'time' => '07:00 PM', 'location' => 'Grand Ballroom', 'desc' => 'Dinner & Drinks']
                ],
            ];
            
            $invitation = new \stdClass();
            $invitation->data = $mockData;
            $invitation->id = 0;
            $data['invitation'] = $invitation;
        }

        // Handle different template IDs
        if ($templateId === 'wedding-1') {
             return view('templates.wedding_theme_1', $data);
        }

        if (in_array($templateId, ['theme_2', 'theme_3', 'theme_4', 'theme_5', 'theme_6', 'theme_7', 'theme_8', 'theme_9', 'theme_10'])) {
             return view('templates.' . $templateId, $data);
        }

        // Fallback
        return view('templates.wedding_theme_1', $data);
    }

    /**
     * Save draft invitation - mirrors UserPanelController
     */
    public function saveDraft(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            $data = $request->all();
            $templateId = $data['templateId'] ?? 'wedding-1';
            $status = $data['status'] ?? 'draft';

            $invitation = Invitation::updateOrCreate(
                [
                    'user_id' => $user->id, 
                    'template_id' => $templateId
                ],
                [
                    'title' => ($data['groom'] ?? 'Groom') . ' & ' . ($data['bride'] ?? 'Bride'),
                    'content' => 'Wedding Invitation',
                    'status' => $status,
                    'data' => $data
                ]
            );

            return response()->json(['success' => true, 'id' => $invitation->id]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Admin Save Draft Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
