<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class EmploymentApplicationController extends Controller
{
    public function show()
    {
        $title = 'التقدم لوظيفة';
        $pageType = 'employment_application';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('frontend.employment_application', compact('title', 'pageType', 'SEOData'));

    }
}
