<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Organization information
        $organizationInfo = [
            'established' => '2080 BS',
            'registration_number' => env('NGO_REGISTRATION_NUMBER', '12345/2080'),
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