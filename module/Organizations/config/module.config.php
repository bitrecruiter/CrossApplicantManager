<?php

return array(
    'doctrine' => array(
        'driver' => array(
            'odm_default' => array(
                'drivers' => array(
                    'Organizations\Entity' => 'annotation',
                ),
            ),
        ),
        'eventmanager' => array(
            'odm_default' => array(
                'subscribers' => array(
                ),
            ),
        ),
    ),
    'Organizations' => array(
        'form' => array(
        ),
        'dashboard' => array(
            'enabled' => false,
            'widgets' => array(
            ),
        ),
    ),
    // Translations
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'acl' => array(
        'rules' => array(
            'recruiter' => array(
                'allow' => array(
                ),
            ),
        ),
        'assertions' => array(
            'invokables' => array(
            ),
        ),
    ),
    
    'controllers' => array(
        'invokables' => array(
            'Organizations/Index' => 'Organizations\Controller\IndexController', 
        ),
    ),
    'view_manager' => array(
        // Map template to files. Speeds up the lookup through the template stack.
        'template_map' => array(
        ),
        // Where to look for view templates not mapped above
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'form_elements' => array(
        'invokables' => array(
        ),
        'factories' => array(
        )
    ),
    'input_filters' => array(
        'invokables' => array(
        ),
    ),
    'filters' => array(
        'factories' => array(
        ),
    ),
    'validators' => array(
        'factories' => array(
        ),
    ),
    'hydrators' => array(
        'factories' => array(
            'Hydrator\Organization' => 'Organizations\Entity\Hydrator\OrganizationHydratorFactory',
        ),
    ),
);