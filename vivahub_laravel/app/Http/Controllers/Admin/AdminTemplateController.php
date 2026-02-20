<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invitation;
use App\Models\Coupon;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\Template;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class AdminTemplateController extends Controller
{
    /**
     * Shared templates list - same as UserPanelController
     */
    /**
     * Shared templates list - same as UserPanelController
     */
    private function getTemplatesList() 
    {
        $defaultTemplates = [
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

        // Fetch Custom Templates
        $customTemplates = Template::where('is_custom', true)->where('is_active', true)->get()->map(function($t) {
            return [
                'name' => $t->name,
                'style' => $t->style ?? 'Custom',
                'color' => $t->color ?? 'Mixed',
                'img' => $t->img ? asset($t->img) : asset('assets/hero-background.png'),
                'id' => $t->slug,
                'is_custom' => true,
                'db_id' => $t->id // For deletion
            ];
        })->toArray();

        return array_merge($defaultTemplates, $customTemplates);
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
     * Upload Custom Template ZIP
     */
    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'zip_file' => 'required|file|mimes:zip|max:10240', // 10MB max
            'preview_image' => 'nullable|image|max:2048',
            'style' => 'nullable|string',
            'color' => 'nullable|string'
        ]);

        $zip = new ZipArchive;
        $file = $request->file('zip_file');
        
        if ($zip->open($file->getRealPath()) === TRUE) {
            
            // 1. Validate Structure
            if ($zip->locateName('index.blade.php') === false) {
                return back()->withErrors(['zip_file' => 'Invalid ZIP: index.blade.php not found in root.']);
            }

            // 2. Generate Slug
            $slug = \Illuminate\Support\Str::slug($request->name) . '_' . time();
            
            // 3. Extract Views
            $viewPath = resource_path("views/templates/custom/{$slug}");
            if (!File::exists($viewPath)) {
                File::makeDirectory($viewPath, 0755, true);
            }
            
            // Extract index.blade.php as the main file, rename to {slug}.blade.php in views/templates/custom/
            $content = $zip->getFromName('index.blade.php');
            File::put(resource_path("views/templates/custom/{$slug}.blade.php"), $content);
            
            // 4. Extract Assets
            $publicPath = public_path("templates/custom/{$slug}");
            if (!File::exists($publicPath)) {
                File::makeDirectory($publicPath, 0755, true);
            }

            // Extract 'assets/' folder from ZIP to public path
            for($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                if (strpos($filename, 'assets/') === 0 && $filename !== 'assets/') {
                    // Remove 'assets/' prefix for storage
                    $relativePath = substr($filename, 7); 
                    if (empty($relativePath)) continue;

                    if (substr($filename, -1) == '/') {
                        // Directory
                        File::makeDirectory($publicPath . '/' . $relativePath, 0755, true);
                    } else {
                        // File
                        $extracted = $zip->getFromIndex($i);
                        $dest = $publicPath . '/' . $relativePath;
                        File::ensureDirectoryExists(dirname($dest));
                        File::put($dest, $extracted);
                    }
                }
            }
            
            $zip->close();

            // 5. Save Preview Image
            $imgPath = 'assets/hero-background.png'; // Default
            if ($request->hasFile('preview_image')) {
                $imgName = 'thumb_' . $slug . '.' . $request->file('preview_image')->extension();
                $request->file('preview_image')->move(public_path('assets/thumbnails'), $imgName);
                $imgPath = 'assets/thumbnails/' . $imgName;
            }

            // 6. DB Record
            Template::create([
                'name' => $request->name,
                'slug' => $slug,
                'style' => $request->style,
                'color' => $request->color,
                'img' => $imgPath,
                'is_custom' => true,
                'zip_path' => null, // Not saving ZIP currently
                'assets_path' => "templates/custom/{$slug}",
                'version' => '1.0'
            ]);

            return back()->with('success', 'Template uploaded successfully!');
        }

        return back()->withErrors(['zip_file' => 'Failed to open ZIP file']);
    }

    /**
     * Delete Custom Template
     */
    public function deleteTemplate($id)
    {
        $template = Template::findOrFail($id);
        
        // Delete Blade
        $bladePath = resource_path("views/templates/custom/{$template->slug}.blade.php");
        if (File::exists($bladePath)) {
            File::delete($bladePath);
        }
        
        // Delete View Directory (if any was created)
        $viewDir = resource_path("views/templates/custom/{$template->slug}");
        if (File::exists($viewDir)) {
            File::deleteDirectory($viewDir);
        }
        
        // Delete Assets
        if ($template->assets_path) {
            $assetsDir = public_path($template->assets_path);
            if (File::exists($assetsDir)) {
                File::deleteDirectory($assetsDir);
            }
        }

        $template->delete();

        return back()->with('success', 'Template deleted successfully.');
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
            $testImgPath = asset('assets/wedding-templates');
            
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

        // Custom Templates
        // Check if template exists in DB (custom)
        if (strpos($templateId, 'custom_') !== false || !in_array($templateId, ['wedding-1', 'theme_2', 'theme_3', 'theme_4', 'theme_5', 'theme_6', 'theme_7', 'theme_8', 'theme_9', 'theme_10'])) {
             if (view()->exists('templates.custom.' . $templateId)) {
                 $data['asset_path'] = asset('templates/custom/' . $templateId);
                 return view('templates.custom.' . $templateId, $data);
             }
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

    /**
     * Download Sample ZIP Template
     */
    public function downloadSample()
    {
        // For now, return a text file with instructions or a dummy zip if it exists
        // Ideally we should generate a sample zip
        $samplePath = public_path('sample_template.zip');
        if (File::exists($samplePath)) {
             return response()->download($samplePath);
        }
        
        return back()->with('error', 'Sample template not found. Please contact support.');
    }
}
