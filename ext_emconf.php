<?php

$EM_CONF['ns_revolution_slider'] = [
    'title' => 'Slider Revolution',
    'description' => 'More than just a TYPO3 Slider! The TYPO3 Slider Revolution is developed in official partnership with Slider Revolution. It allows you to create effective sliders easily using the drag-and-drop feature. It comes with over 250+ modern slider templates and more than 2000+ pre-built slider elements, offering a wide range of transitions and effects.
    *** Live Demo: https://demo.t3planet.com/t3-extensions/revolution-slider/ *** Premium Version, Documentation & Free Support: https://t3planet.com/typo3-slider-revolution-extension',
    'category' => 'plugin',
    'author' => 'T3: Rohan Parmar, Divya Goklani, Nilesh Malankiya, QA: Krishna Dhapa',
    'author_company' => 'T3Planet // NITSAN',
    'author_email' => 'sanjay@nitsan.in',
    'state' => 'stable',
    'uploadfolder' => 1,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.2.1',
    'constraints' => [
        'depends' => [
            'typo3' => '8.0.0-11.5.99',
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
