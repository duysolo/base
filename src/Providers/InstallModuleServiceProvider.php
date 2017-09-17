<?php namespace WebEd\Base\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class InstallModuleServiceProvider extends ServiceProvider
{
    protected $module = 'webed-core';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->dropCurrentDb();
        $this->createDatabase();
        $this->registerPermissions();
    }

    protected function dropCurrentDb()
    {
        Schema::dropIfExists(webed_db_prefix() . 'theme_options');
        Schema::dropIfExists(webed_db_prefix() . 'themes');
        Schema::dropIfExists(webed_db_prefix() . 'static_blocks');
        Schema::dropIfExists(webed_db_prefix() . 'custom_fields');
        Schema::dropIfExists(webed_db_prefix() . 'field_items');
        Schema::dropIfExists(webed_db_prefix() . 'field_groups');
        Schema::dropIfExists(webed_db_prefix() . 'view_trackers');
        Schema::dropIfExists(webed_db_prefix() . 'pages');
        Schema::dropIfExists(webed_db_prefix() . 'core_modules');
        Schema::dropIfExists(webed_db_prefix() . 'plugins');
        Schema::dropIfExists(webed_db_prefix() . 'menu_nodes');
        Schema::dropIfExists(webed_db_prefix() . 'menus');
        Schema::dropIfExists(webed_db_prefix() . 'settings');
        Schema::dropIfExists(webed_db_prefix() . 'users_roles');
        Schema::dropIfExists(webed_db_prefix() . 'roles_permissions');
        Schema::dropIfExists(webed_db_prefix() . 'permissions');
        Schema::dropIfExists(webed_db_prefix() . 'roles');
        Schema::dropIfExists(webed_db_prefix() . 'password_resets');
        Schema::dropIfExists(webed_db_prefix() . 'users');
    }

    protected function createDatabase()
    {
        Schema::create(webed_db_prefix() . 'users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('username', 100)->unique();
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->string('display_name', 150)->nullable();
            $table->string('first_name', 150);
            $table->string('last_name', 150)->nullable();
            $table->string('activation_code', 150)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('mobile_phone', 20)->nullable();
            $table->string('sex', 20)->default('male');
            $table->tinyInteger('status')->default(1);
            $table->dateTime('birthday')->nullable();
            $table->text('description')->nullable();
            $table->rememberToken();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->datetime('disabled_until')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
        });

        Schema::create(webed_db_prefix() . 'password_resets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('email', 170)->index();
            $table->string('token', 170)->index();
            $table->datetime('expired_at');
            $table->timestamps();
        });

        Schema::create(webed_db_prefix() . 'roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
        });

        Schema::create(webed_db_prefix() . 'permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->string('module', 255);
        });

        Schema::create(webed_db_prefix() . 'roles_permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->unique(['role_id', 'permission_id']);

            $table->foreign('role_id')->references('id')->on(webed_db_prefix() . 'roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on(webed_db_prefix() . 'permissions')->onDelete('cascade');
        });

        Schema::create(webed_db_prefix() . 'users_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->unique(['user_id', 'role_id']);

            $table->foreign('user_id')->references('id')->on(webed_db_prefix() . 'users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on(webed_db_prefix() . 'roles')->onDelete('cascade');
        });

        Schema::create(webed_db_prefix() . 'settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('option_key', 150)->unique();
            $table->text('option_value')->nullable();
            $table->timestamps();
        });

        Schema::create(webed_db_prefix() . 'menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
        });

        Schema::create(webed_db_prefix() . 'menu_nodes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('entity_id')->unsigned()->nullable();
            $table->string('type', 255);
            $table->string('url', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('icon_font', 255)->nullable();
            $table->string('css_class', 255)->nullable();
            $table->string('target', 255)->nullable();
            $table->integer('order')->unsigned()->default(0);

            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on(webed_db_prefix() . 'menus')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on(webed_db_prefix() . 'menu_nodes')->onDelete('set null');
        });

        Schema::create(webed_db_prefix() . 'plugins', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('alias', 150)->unique();
            $table->string('installed_version', 100)->nullable();
            $table->tinyInteger('enabled', false, true)->default(0);
            $table->tinyInteger('installed', false, true)->default(0);
            $table->timestamps();
            $table->integer('updated_by')->unsigned()->nullable();

            $table->foreign('updated_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
        });

        Schema::create(webed_db_prefix() . 'core_modules', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('alias', 150)->unique();
            $table->string('installed_version', 150)->nullable();
            $table->timestamps();
        });

        Schema::create(webed_db_prefix() . 'pages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('page_template', 150)->nullable();
            $table->string('slug', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->text('keywords')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('order')->default(0);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
        });

        Schema::create(webed_db_prefix() . 'view_trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->string('entity', 170)->index();
            $table->integer('entity_id')->unsigned()->index();
            $table->bigInteger('count')->unsigned()->default(0)->index();

            $table->unique(['entity', 'entity_id']);
        });

        Schema::create(webed_db_prefix() . 'field_groups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->text('rules')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('order')->default(0);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('cascade');
        });

        Schema::create(webed_db_prefix() . 'field_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('field_group_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('order')->default(0)->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('type', 100);
            $table->text('instructions')->nullable();
            $table->text('options')->nullable();

            $table->foreign('field_group_id')->references('id')->on(webed_db_prefix() . 'field_groups')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on(webed_db_prefix() . 'field_items')->onDelete('cascade');
        });

        Schema::create(webed_db_prefix() . 'custom_fields', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('use_for', 255);
            $table->integer('use_for_id')->unsigned();
            $table->integer('field_item_id')->unsigned();
            $table->string('type', 255);
            $table->string('slug', 255);
            $table->text('value')->nullable();

            $table->foreign('field_item_id')->references('id')->on(webed_db_prefix() . 'field_items')->onDelete('cascade');
        });

        Schema::create(webed_db_prefix() . 'static_blocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug', 255);
            $table->text('content')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
        });

        Schema::create(webed_db_prefix() . 'themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 100)->unique();
            $table->tinyInteger('enabled', false, true)->default(0);
            $table->tinyInteger('installed', false, true)->default(0);
            $table->string('installed_version', 255)->nullable();
            $table->timestamps();
            $table->integer('updated_by')->unsigned()->nullable();

            $table->foreign('updated_by')->references('id')->on(webed_db_prefix() . 'users')->onDelete('set null');
        });

        Schema::create(webed_db_prefix() . 'theme_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theme_id', false)->unsigned();
            $table->string('key', 150);
            $table->text('value')->nullable();

            $table->unique(['theme_id', 'key']);

            $table->foreign('theme_id')->references('id')->on(webed_db_prefix() . 'themes')->onDelete('cascade');
        });
    }

    protected function registerPermissions()
    {
        acl_permission()
            ->registerPermission('Access to dashboard', 'access-dashboard', $this->module)
            ->registerPermission('System commands', 'use-system-commands', $this->module);
    }
}
