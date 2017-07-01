<?php

namespace WebEd\Base\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->validatorUniqueMultiple();
        $this->validatorDateMultiFormat();
        $this->validatorCheckOldPassword();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    protected function validatorUniqueMultiple()
    {
        Validator::extend('unique_multiple', function ($attribute, $value, $parameters, $validator) {
            $table = array_shift($parameters);

            $query = \DB::table($table);

            foreach ($parameters as $i => $field) {
                $query->where($field, $validator->getData()[$field]);
            }

            // Validation result will be false if any rows match the combination
            return ($query->count() == 0);
        });
    }

    protected function validatorDateMultiFormat()
    {
        /**
         * @see http://stackoverflow.com/questions/32006092/laravel-5-1-date-format-validation-allow-two-formats
         */
        Validator::extend('date_multi_format', function ($attribute, $value, $formats) {
            // iterate through all formats
            foreach ($formats as $format) {
                // parse date with current format
                $parsed = date_parse_from_format($format, $value);

                // if value matches given format return true=validation succeeded
                if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {
                    return true;
                }
            }

            // value did not match any of the provided formats, so return false=validation failed
            return false;
        });
    }

    protected function validatorCheckOldPassword()
    {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            $table = array_shift($parameters);

            $field = $parameters[0];

            $currentModel = \DB::table($table)->find($parameters[1]);

            return Hash::check($validator->getData()[$attribute], $currentModel->$field);
        });
    }
}
