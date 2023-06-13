<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BusinessHour;
use App\Models\Info;
use App\Models\Section;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ViewsController extends Controller
{
    public function index()
    {
        $info = Info::first();
        $infoT = $info->getTranslations();
        $services = Service::get();
        $businessSection = Section::where('slug',Str::slug('Business Hours'))->first();
        $businessHours = BusinessHour::get();

        $banners = Banner::get();
        $aboutUs = Section::where('slug', Str::slug('About Us'))->first();
        $servicesSection = Section::where('slug', Str::slug('Our Services'))->first();
        $goal = Section::where('slug', Str::slug("Our Goal"))->first();
        $vision = Section::where('slug', Str::slug("Our vision"))->first();
        $mission = Section::where('slug', Str::slug("Our Mission"))->first();

        return view('front.index', compact('info', 'infoT','services','businessSection','businessHours','banners','aboutUs',
        'servicesSection','goal', 'vision', 'mission'));
    }

    public function service($id){
        if(!$id)
            abort(404);

        $service = Service::find($id);

        if(!$service)
            abort(404);

        $info = Info::first();
        $infoT = $info->getTranslations();
        $services = Service::get();
        $businessSection = Section::where('slug',Str::slug('Business Hours'))->first();
        $businessHours = BusinessHour::get();
        $servicesSection = Section::where('slug', Str::slug('Our Services'))->first();


        return view('front.service', compact('info', 'infoT','services','businessSection','businessHours','service','servicesSection'));
    }
}
