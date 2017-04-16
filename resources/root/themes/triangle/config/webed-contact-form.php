<?php

return [
    /**
     *
     * All normal fields to database. Currently, we just support title, name, email. phone, address, content.
     *
     */
    'normal_fields' => [
        'title', 'name', 'email', 'phone', 'address', 'content'
    ],

    'forms' => [
        'default_form' => [
            /**
             * All fields here will be stored as options field in database. (save as json)
             */
            'option_fields' => [

            ],
            /**
             * Validation
             */
            'validation' => [
                'title' => 'string|min:10|max:255|required',
                'name' => 'string|min:3|max:255|required',
                'email' => 'email|required',
                //'phone' => 'string|min:10|max:15|required',
                //'address' => 'string|min:10|max:255|required',
                'content' => 'string|min:10|max:1500|required',
                /**
                 * Here, you can put some other fields to validate, maybe captcha, optional fields...
                 */
                'g-recaptcha-response' => 'required|google_recaptcha',
            ],
        ],
    ],
];
