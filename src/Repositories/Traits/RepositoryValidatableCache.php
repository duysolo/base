<?php namespace WebEd\Base\Repositories\Traits;

trait RepositoryValidatableCache
{
    /**
     * @return array
     */
    public function getModelRules()
    {
        return call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
    }

    /**
     * @param array $rules
     * @return $this
     */
    public function setModelRules(array $rules)
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this;
    }

    /**
     * @param array $rules
     * @return $this
     */
    public function expandModelRules(array $rules)
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this;
    }

    /**
     * @return array
     */
    public function getEditableFields()
    {
        return call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function setEditableFields(array $fields)
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function expandEditableFields(array $fields)
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this;
    }

    /**
     * @param $fields
     * @return $this
     */
    public function unsetEditableFields($fields)
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this;
    }

    /**
     * Validate model
     * @param $data
     * @param bool $justUpdateSomeFields
     * @return bool
     */
    public function validateModel($data, $justUpdateSomeFields = false)
    {
        return call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
    }

    /**
     * Get error messages
     * @return array
     */
    public function getRuleErrors()
    {
        return call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
    }

    /**
     * Get error messages - no key
     * @return array
     */
    public function getRuleErrorMessages()
    {
        return call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
    }

    /**
     * @return \WebEd\Base\Services\Validator
     */
    public function getValidatorInstance()
    {
        return call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
    }
}
