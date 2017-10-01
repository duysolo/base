<?php

return [
    'add_new' => 'Add new',
    'admin_menu' => [
        'dashboard' => [
            'heading' => 'Dashboard',
            'title' => 'Dashboard',
        ],
        'configuration' => [
            'heading' => 'Advanced',
            'title' => 'Configuration',
        ],
    ],
    'form' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'disable' => 'Disable',
        'delete' => 'delete',
        'submit' => 'Submit',
        'save' => 'Save',
        'save_and_continue' => 'Save & continue',
        'save_change' => 'Save change',
        'select' => 'Select',
        'search' => 'Search',

        'basic_info' => 'Basic information',

        'choose_image' => 'Choose image',
        'choose_file' => 'Choose file',
        'choose_images' => 'Choose images',
        'choose_files' => 'Choose files',

        'title' => 'Title',
        'slug' => 'Slug',
        'content' => 'Content',
        'keywords' => 'Keywords',
        'description' => 'Description',
        'templates' => 'Templates',
        'thumbnail' => 'Thumbnail',
        'order' => 'Order',
        'status' => 'Status',
        'sex' => 'Sex',
        'is_featured' => 'Is featured',
        'publish' => 'Publish',

        'model_not_exists' => 'Model not exists with id:',
        'item_not_exists' => 'Item not exists',
        'request_completed' => 'Request completed',
        'error_occurred' => 'Some error occurred during your request',
    ],
    'setting_group' => [
        'basic' => 'Basic',
        'advanced' => 'Advanced',
        'socials' => 'Social networks',
    ],
    'settings' => [
        'site_title' => [
            'label' => 'Site title',
            'helper' => 'Our site title'
        ],
        'app_name' => [
            'label' => 'Application name',
            'helper' => 'Name of this application',
        ],
        'site_logo' => [
            'label' => 'Site logo',
            'helper' => 'Our site logo'
        ],
        'favicon' => [
            'label' => 'Favicon',
            'helper' => '16x16, support png, gif, ico, jpg'
        ],
        'construction_mode' => [
            'label' => 'On construction mode',
            'helper' => 'Mark this site on maintenance mode. Just logged in admin can access front site.',
        ],
        'show_admin_bar' => [
            'label' => 'Show admin bar',
            'helper' => 'When admin logged in, still show admin bar on front site.'
        ],
        'socials' => [
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'google_plus' => 'Google+',
            'youtube' => 'Youtube',
            'instagram' => 'Instagram',
            'linkedin' => 'Linkedin',
            'flickr' => 'Flickr',
        ],

        'smtp' => [
            'smtp_driver' => [
                'label' => 'SMTP driver',
                'helper' => 'Laravel supports both SMTP and PHP\'s "mail" function as drivers for the sending of e-mail. You may specify which one you\'re using throughout your application here. By default, Laravel is setup for SMTP mail.',
            ],
            'smtp_host' => [
                'label' => 'SMTP host',
                'helper' => 'Here you may provide the host address of the SMTP server used by your applications. A default option is provided that is compatible with the Mailgun mail service which will provide reliable deliveries.',
            ],
            'smtp_port' => [
                'label' => 'SMTP port',
                'helper' => 'This is the SMTP port used by your application to deliver e-mails to users of the application. Like the host we have set this value to stay compatible with the Mailgun e-mail application by default.',
            ],
            'smtp_encryption' => [
                'label' => 'E-Mail encryption protocol',
                'helper' => 'Here you may specify the encryption protocol that should be used when the application send e-mail messages. A sensible default using the transport layer security protocol should provide great security.',
            ],
            'smtp_from_address' => [
                'label' => 'Global "From" address',
                'helper' => 'You may wish for all e-mails sent by your application to be sent from the same address. Here, you may specify a name and address that is used globally for all e-mails that are sent by your application.',
            ],
            'smtp_from_name' => [
                'label' => 'Global "From" name',
                'helper' => 'You may wish for all e-mails sent by your application to be sent from the same address. Here, you may specify a name and address that is used globally for all e-mails that are sent by your application.',
            ],
            'smtp_username' => [
                'label' => 'SMTP server username',
                'helper' => 'If your SMTP server requires a username for authentication, you should set it here. This will get used to authenticate with your server on connection. You may also set the "password" value below this one.',
            ],
            'smtp_password' => [
                'label' => 'SMTP server password',
                'helper' => 'If your SMTP server requires a username for authentication, you should set it here. This will get used to authenticate with your server on connection. You may also set the "password" value below this one.',
            ],
        ],
    ],
    'status' => [
        'disabled' => 'Disabled',
        'activated' => 'Activated',
        'deleted' => 'Deleted',
    ],
    'sex' => [
        'male' => 'Male',
        'female' => 'Female',
        'other' => 'Other',
    ],
    'version' => 'Version',
    'visit_page' => 'Visit page',
    'stat_box' => [
        'more_info' => 'More info',
    ],

    'item_not_exists' => 'Item not exists',
    'disabled_in_demo_mode' => 'This feature is disabled in demo site',
];
