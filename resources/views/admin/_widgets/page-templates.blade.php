<?php
/**
 * @var array $templates
 */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('webed-core::base.form.templates') }}</h3>
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        {!! form()->select($name, array_merge(['' => trans('webed-core::base.form.select') . '...'], $templates), $selected, [
            'class' => 'form-control'
        ]) !!}
    </div>
</div>
