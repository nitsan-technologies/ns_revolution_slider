<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '[NITSAN] Slider Revolution',
    'description' => 'World\'s most popular WordPress slider revolution is now available in TYPO3. We recommend to try our premium version, which includes backend slider revolution mdoule https://t3terminal.com/revolution-slider-typo3-extension',
    'category' => 'plugin',
    'author' => 'Team NITSAN',
    'author_company' => 'NITSAN Technologies Pvt Ltd',
    'author_email' => 'sanjay@nitsan.in',
    'state' => 'stable',
    'uploadfolder' => 1,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.1.1',
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
