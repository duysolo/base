<div class="box box-primary">
    <div class="box-body">
        <div class="text-right">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-check"></i> {{ trans('webed-core::base.form.save') }}
            </button>
            <button class="btn btn-success"
                    type="submit"
                    name="_continue_edit"
                    value="1">
                <i class="fa fa-check"></i> {{ trans('webed-core::base.form.save_and_continue') }}
            </button>
        </div>
    </div>
</div>
<div id="waypoint"></div>
<div class="form-actions form-actions-fixed-top hidden">
    <div class="btn-set">
        @php do_action(BASE_ACTION_FORM_ACTIONS, 'fixed-top') @endphp
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-check"></i> {{ trans('webed-core::base.form.save') }}
        </button>
        <button class="btn btn-success"
                type="submit"
                name="_continue_edit"
                value="1">
            <i class="fa fa-check"></i> {{ trans('webed-core::base.form.save_and_continue') }}
        </button>
    </div>
</div>