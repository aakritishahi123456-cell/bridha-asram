<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Event;
use App\Models\ImpactMetric;
use App\Models\Donation;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display the homepage
     */
    public function index()
    {
        // Get latest blog posts
        $latestPosts = BlogPost::where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Get upcoming events
        $upcomingEvents = Event::where('status', 'published')
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();

        // Get impact metrics (cached for performance)
        $impactMetrics = Cache::remember('homepage_impact_metrics', 300, function () {
            return [
                'people_sheltered' => ImpactMetric::where('metric_name', 'people_sheltered')->sum('metric_value') ?: 0,
                'elderly_cared' => ImpactMetric::where('metric_name', 'elderly_cared')->sum('metric_value') ?: 0,
                'meals_served' => ImpactMetric::where('metric_name', 'meals_served')->sum('metric_value') ?: 0,
                'volunteers' => Volunteer::where('status', 'approved')->count(),
                'total_donations' => Donation::where('payment_status', 'completed')->sum('amount') ?: 0,
            ];
        });

        // Sample testimonials (in a real app, these would come from a database)
        $testimonials = [
            [
                'name' => 'राम बहादुर',
                'name_en' => 'Ram Bahadur',
                'message' => 'यो संस्थाले मलाई नयाँ जीवन दिएको छ। म धेरै कृतज्ञ छु।',
                'message_en' => 'This organization has given me a new life. I am very grateful.',
                'role' => 'Beneficiary',
                'location' => 'Surkhet'
            ],
            [
                'name' => 'सीता देवी',
                'name_en' => 'Sita Devi',
                'message' => 'यहाँको सेवा र माया अतुलनीय छ। म सुरक्षित महसुस गर्छु।',
                'message_en' => 'The service and love here is incomparable. I feel safe.',
                'role' => 'Elderly Care Recipient',
                'location' => 'Jajarkot'
            ],
            [
                'name' => 'अनिल शर्मा',
                'name_en' => 'Anil Sharma',
                'message' => 'स्वयंसेवकको रूपमा काम गर्दा मैले जीवनको अर्थ बुझें।',
                'message_en' => 'Working as a volunteer, I understood the meaning of life.',
                'role' => 'Volunteer',
                'location' => 'Surkhet'
            ]
        ];

        return view('home', compact(
            'latestPosts',
            'upcomingEvents',
            'impactMetrics',
            'testimonials'
        ));
    }

    /**
     * Display the about page
     */
    public function about()
    {
        // Organization information
        $organizationInfo = [
            'established' => '2080 BS',
            'registration_number' => 'NGO-REG-2080-001',
            'primary_location' => 'Surkhet',
            'secondary_location' => 'Jajarkot',
            'mission' => [
                'ne' => 'घरबारविहीन र वृद्धवृद्धाहरूलाई सम्मान, आश्रय, हेरचाह र करुणा प्रदान गर्नु, समाजका सबैभन्दा कमजोर सदस्यहरूको लागि मानवीय र सम्मानजनक जीवन सुनिश्चित गर्नु।',
                'en' => 'To provide dignity, shelter, care, and compassion to homeless and elderly individuals, ensuring a humane and respectful life for the most vulnerable members of society.'
            ],
            'vision' => [
                'ne' => 'एक दयालु नेपाल निर्माण गर्नु जहाँ कुनै पनि वृद्ध वा घरबारविहीन व्यक्तिलाई त्यागिएको, उपेक्षित वा हेरचाहविना छोडिने छैन।',
                'en' => 'To build a compassionate Nepal where no elderly or homeless person is left abandoned, neglected, or without care.'
            ]
        ];

        // Core values
        $coreValues = [
            [
                'title' => ['ne' => 'सम्मान', 'en' => 'Dignity'],
                'description' => ['ne' => 'हरेक व्यक्तिको सम्मान र मर्यादा', 'en' => 'Respect and dignity for every individual']
            ],
            [
                'title' => ['ne' => 'करुणा', 'en' => 'Compassion'],
                'description' => ['ne' => 'निःस्वार्थ सेवा र माया', 'en' => 'Selfless service and love']
            ],
            [
                'title' => ['ne' => 'पारदर्शिता', 'en' => 'Transparency'],
                'description' => ['ne' => 'खुला र जवाफदेही संचालन', 'en' => 'Open and accountable operations']
            ],
            [
                'title' => ['ne' => 'समुदायिक सहयोग', 'en' => 'Community Support'],
                'description' => ['ne' => 'स्थानीय समुदायसँग मिलेर काम', 'en' => 'Working together with local communities']
            ]
        ];

        // Leadership team (sample data)
        $leadership = [
            [
                'name' => 'श्री राम प्रसाद शर्मा',
                'name_en' => 'Shri Ram Prasad Sharma',
                'position' => ['ne' => 'अध्यक्ष', 'en' => 'Chairman'],
                'bio' => ['ne' => 'सामाजिक सेवामा २० वर्षको अनुभव', 'en' => '20 years of experience in social service']
            ],
            [
                'name' => 'श्रीमती सीता कुमारी',
                'name_en' => 'Shrimati Sita Kumari',
                'position' => ['ne' => 'कार्यकारी निर्देशक', 'en' => 'Executive Director'],
                'bio' => ['ne' => 'स्वास्थ्य सेवा र सामुदायिक विकासमा विशेषज्ञ', 'en' => 'Expert in healthcare and community development']
            ]
        ];

        return view('about', compact(
            'organizationInfo',
            'coreValues',
            'leadership'
        ));
    }
}