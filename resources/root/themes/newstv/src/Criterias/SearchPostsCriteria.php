<?php namespace NewsTV\Criterias;

use Illuminate\Database\Eloquent\Builder;
use WebEd\Base\Criterias\AbstractCriteria;
use WebEd\Base\Repositories\AbstractBaseRepository;
use WebEd\Base\Repositories\Contracts\AbstractRepositoryContract;
use WebEd\Plugins\Blog\Models\Post;

class SearchPostsCriteria extends AbstractCriteria
{
    /**
     * @var string
     */
    protected $keyword;

    public function __construct($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @param Post|Builder $model
     * @param AbstractRepositoryContract $repository
     * @return mixed
     */
    public function apply($model, AbstractRepositoryContract $repository)
    {
        return $model
            ->leftJoin(webed_db_prefix() . 'posts_tags', webed_db_prefix() . 'posts.id', '=', webed_db_prefix() . 'posts_tags.post_id')
            ->leftJoin(webed_db_prefix() . 'tags', webed_db_prefix() . 'tags.id', '=', webed_db_prefix() . 'posts_tags.tag_id')
            ->where(function ($query) {
                return $query
                    ->orWhere(webed_db_prefix() . 'posts.title', 'LIKE', '%' . $this->keyword . '%')
                    ->orWhere(webed_db_prefix() . 'posts.slug', 'LIKE', '%' . $this->keyword . '%')
                    ->orWhere(webed_db_prefix() . 'tags.title', 'LIKE', '%' . $this->keyword . '%')
                    ->orWhere(webed_db_prefix() . 'tags.slug', 'LIKE', '%' . $this->keyword . '%');
            })
            ->distinct();
    }
}
