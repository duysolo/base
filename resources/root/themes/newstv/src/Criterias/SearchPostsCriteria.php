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
            ->where(function ($query) {
                return $query
                    ->where(webed_db_prefix() . 'posts.title', 'LIKE', '%' . $this->keyword . '%')
                    ->orWhere(webed_db_prefix() . 'posts.slug', 'LIKE', '%' . $this->keyword . '%')
                    ->orWhere(webed_db_prefix() . 'posts.keywords', 'LIKE', '%' . $this->keyword . '%');
            })
            ->distinct();
    }
}
