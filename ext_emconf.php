<?php

$EM_CONF['ns_revolution_slider'] = [
    'title' => 'TYPO3 Revolution Slider',
    'description' => 'Create powerful and modern sliders for your TYPO3 website using the official Revolution Slider integration. Easily build sliders with drag-and-drop, 250+ templates, and 2000+ pre-built elements with advanced transitions and effects.',
    'category' => 'plugin',
    'author' => 'Team T3Planet',
    'author_company' => 'T3Planet',
    'author_email' => 'info@t3planet.de',
    'state' => 'stable',
    'uploadfolder' => 1,
    'createDirs' => '',
    'version' => '12.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
       'classmap' => [
          'Classes'
       ],
       'psr-4' => [
            'NITSAN\\NsRevolutionSlider\\' => 'Classes'
        ]
    ],
];
