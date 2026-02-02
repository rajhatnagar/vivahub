<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = [
            [
                'name' => "Royal Wedding", 
                'style' => "Indian Traditional", 
                'color' => "Red/Gold", 
                'img' => "https://csssofttech.com/wedding/assets/hero.png", 
                'is_active' => true
            ]
        ];

        foreach ($templates as $template) {
            Template::updateOrCreate(
                ['name' => $template['name']], // Check by name to avoid duplicates
                $template
            );
        }
    }
}
