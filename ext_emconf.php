<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '[NITSAN] Revolution Slider',
    'description' => 'World\'s most pupular revolution slider is now available in TYPO3 CMS too. Plug-n-play with Buy license https://revolution.themepunch.com/jquery/ Live-Demo: https://demo.t3terminal.com/t3t-extensions/sliders/revolution-slider/ You can download PRO version for more-features & free-support at https://t3terminal.com/typo3-revolution-slider-extension-pro',
    'category' => 'plugin',
    'author' => 'NITSAN Technologies Pvt Ltd',
    'author_company' => 'NITSAN Technologies Pvt Ltd',
    'author_email' => 'sanjay@nitsan.in',
    'state' => 'stable',
    'uploadfolder' => 1,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.5',
    'constraints' => [
        'depends' => [
            'typo3' => '8.0.0-10.9.99',
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
