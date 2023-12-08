<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class cmspagetableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $cmsPageData = [
        ['id' => '1', 'title' =>'About Us', 'description' =>'Content is coming soon', 'url'=>'about-us','meta_title' => 'About Us', 'meta_description' => 'About Us Content', 'meta_keywords' => 'about us, about', 'status' => 1],
        ['id' => '2', 'title' =>'Terms & Conditions', 'description' =>'Content is coming soon', 'url'=>'terms-conditions','meta_title' => 'Terms & Conditions', 'meta_description' => 'Terms & Conditions', 'meta_keywords' => 'terms, terms conditions', 'status' => 1],
        ['id' => '3', 'title' =>'Privacy Policy', 'description' =>'Content is coming soon', 'url'=>'privacy-policy','meta_title' => 'Privacy Policy', 'meta_description' => 'Privacy Policy', 'meta_keywords' => 'Privacy, Privacy Policy', 'status' => 1],
    ];

    CmsPage::insert($cmsPageData);

    }
}
