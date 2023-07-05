<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '[NITSAN] Slider Revolution',
    'description' => 'World\'s most popular WordPress slider revolution is now available in TYPO3. We recommend to try our premium version, which includes backend slider revolution mdoule https://t3planet.com/revolution-slider-typo3-extension',
    'category' => 'plugin',
    'author' => 'T3D: Rohan Parmar, Divya Goklani, Nilesh Malankiya, QA: Krishna Dhapa',
    'author_company' => 'NITSAN Technologies Pvt Ltd',
    'author_email' => 'sanjay@nitsan.in',
    'state' => 'stable',
    'uploadfolder' => 1,
    'createDirs' => '',
    'version' => '12.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-12.4.99',
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
