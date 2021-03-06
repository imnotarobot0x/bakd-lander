<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsEmail;

class PageController extends Controller
{
    /**
     * Main Landing Page
     *
     * @return string
     */
    public function index()
    {
        // Onepager Doc URLs
        $onepagerTextURL = 'https://bakd.io/docs/onepager-eng.pdf';
        $onepagerGraphicURL = 'https://bakd.io/docs/onepager-eng.pdf';
        
        // Roadmap Doc URLs
        $roadmapTextURL = 'https://bakd.io/docs/roadmap-eng.pdf';
        $roadmapGraphicURL = 'https://bakd.io/docs/roadmap-eng.png';
        
        // Features Doc URLs
        $featuresTextURL = 'https://bakd.io/docs/features-eng.pdf';
        $featuresGraphicURL = 'https://bakd.io/docs/features-eng.pdf';

        return view('home', [
            'launch' => \Carbon\Carbon::now(),
            'features' => [
                'text' => $featuresTextURL,
                'graphic' => $featuresGraphicURL
            ],
            'onepager' => [
                'text' => $onepagerTextURL,
                'graphic' => $onepagerGraphicURL
            ],
            'roadmap' => [
                'text' => $roadmapTextURL,
                'graphic' => $roadmapGraphicURL
            ],
        ]);
    }

    // TODO: Fix the "done at 2am", 2 second contact form
    public function contact(Request $request)
    {
        try {
            $message = $request->input();
            Mail::to(env('HELP_EMAIL', 'tom@bakd.io'))->send(new ContactUsEmail($message));
        } catch (\Exception $e) {
            return response()->json(['sent' => false]);
        }
    
        return response()->json(['sent' => true]);
    }
}