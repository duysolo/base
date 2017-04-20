<?php

use WebEd\Base\CustomFields\Repositories\Contracts\CustomFieldRepositoryContract;

/**
 * @var \WebEd\Base\CustomFields\Repositories\CustomFieldRepository $customFieldRepo
 */
$customFieldRepo = app(CustomFieldRepositoryContract::class);

$pages = $customFieldRepo->getWhere([
    'use_for' => \WebEd\Base\Pages\Models\Page::class,
], ['id'])->pluck('id')->toArray();

$customFieldRepo->updateMultiple($pages, [
    'use_for' => WEBED_PAGES
]);