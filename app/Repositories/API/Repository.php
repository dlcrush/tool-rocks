<?php

namespace App\Repositories\API;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Repositories\API\Contracts\Repository as RepositoryInterface;
use App\Repositories\API\Contracts\Criteria as CriteriaInterface;
use App\Repositories\API\Criteria\Criteria;

abstract class Repository implements RepositoryInterface, CriteriaInterface {

    private $app;

    protected $model;

    protected $criteria;

    protected $skipCriteria = false;

    public function __construct(App $app, Collection $collection) {
        $this->app = $app;
        $this->criteria = $collection;
        $this->makeModel();
    }

    abstract function model();

    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    public function all($columns = ['*']) {
        $this->applyCriteria();
        return $this->model->get($columns);
    }

    public function paginate($perPage = 15, $columns = ['*']) {
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute="id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id) {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = ['*']) {
        $this->applyCriteria();
        return $this->model->find($id, $columns);
    }

    public function findBy($attribute, $value, $columns = ['*']) {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function findWhere($field, $value, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->where($field, $value)->get($columns);
    }

    public function findIn($field, $values, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->whereIn($field, $values)->get($columns);
    }

    public function findByIdOrSlug($idOrSlug, $field='slug') {
        $idOrSlug = isset($idOrSlug) ? $idOrSlug : 'tool';
        $assumption = 'id';

        if (is_int($idOrSlug)) {
            // $idOrSlug is an integer, we assume it's an id
            $item = $this->find($idOrSlug);
        } else {
            // $idOrSlug is not an integer, we assume slug
            $assumption = 'slug';
            $item = $this->findBy($field, $idOrSlug);
        }

        if (! isset($item) && $assumption == 'id') {
            // In this case, we assumed $idOrSlug as an id but we found nothing.
            // Now, let's check and make sure it wasn't a slug that just happened
            // to be an integer.
            $item = $this->find($idOrSlug);
        }

        return $item;
    }

    public function resetScope() {
        $this->skipCriteria(false);
        return $this;
    }

    public function skipCriteria($status = true){
        $this->skipCriteria = $status;
        return $this;
    }

    public function getCriteria() {
        return $this->criteria;
    }

    public function getByCriteria(Criteria $criteria) {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    public function pushCriteria(Criteria $criteria) {
        $this->criteria->push($criteria);
        return $this;
    }

    public function applyCriteria() {
        if($this->skipCriteria === true) {
            return $this;
        }

        foreach($this->getCriteria() as $criteria) {
            if($criteria instanceof Criteria) {
                $this->model = $criteria->apply($this->model, $this);
            }
        }

        return $this;
    }

}
