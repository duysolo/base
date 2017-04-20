# WebEd default theme - Triangle

### How to use
- Install WebEd
- Download these plugins: `contact-form` and `captcha` from [github.com/webed-plugins](https://github.com/webed-plugins)
- Overwrite the `composer.json` of WebEd by the file `composer.sjon` in `sample-data` folder.
- Overwrite the database by the file in `sample-data/webed_triangle_theme.sql`.
- Run
```$xslt
php artisan vendor:publish --tag=webed-public-assets --force
```
- Enjoy~