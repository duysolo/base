<?php namespace WebEd\Base\Core\Repositories\Contracts;

interface RepositoryValidatorContract
{
    /**
     * @return array
     */
    public function getModelRules();

    /**
     * @param array $rules
     * @return $this
     */
    public function setModelRules(array $rules);

    /**
     * @param array $rules
     * @return $this
     */
    public function expandModelRules(array $rules);

    /**
     * @return array
     */
    public function getEditableFields();

    /**
     * @param array $fields
     * @return $this
     */
    public function setEditableFields(array $fields);

    /**
     * @param array $fields
     * @return $this
     */
    public function expandEditableFields(array $fields);

    /**
     * @param $fields
     * @return $this
     */
    public function unsetEditableFields($fields);

    /**
     * Validate model
     * @param $data
     * @param bool $justUpdateSomeFields
     * @return bool
     */
    public function validateModel($data, $justUpdateSomeFields = false);

    /**
     * Get error messages
     * @return array
     */
    public function getRuleErrors();

    /**
     * Get error messages - no key
     * @return array
     */
    public function getRuleErrorMessages();

    /**
     * @return \WebEd\Base\Core\Services\Validator
     */
    public function getValidatorInstance();

}
