@php
    $hasFilter = isset($filters) && $filters ? true : false;
    $hasTableActions = isset($groupActions) && $groupActions ? true : false;
    $totalColumns = sizeof($headings);
    $actionPosition = array_search('actions', array_keys($headings));
@endphp
<div class="table-container">
    @if($hasTableActions)
        <div class="table-actions-wrapper">
            <span></span>
            {!! form()->select('', $groupActions, null, [
                'class' => 'table-group-action-input form-control input-inline input-small input-sm'
            ]) !!}
            <button class="btn btn-sm green table-group-action-submit" data-toggle="confirmation" data-placement="left">
                <i class="fa fa-check"></i> {{ trans('webed-core::datatables.submit') }}
            </button>
        </div>
    @endif
    <table class="table table-striped table-bordered table-hover vertical-middle datatables">
        <colgroup>
            @if($hasTableActions)
                <col width="1%">
            @endif
            @foreach($headings as $key => $heading)
                <col width="{{ $heading['width'] or '' }}" data-item="{{ $key }}">
            @endforeach
        </colgroup>
        <thead>
        <tr role="row" class="heading">
            @if($hasTableActions)
                <th class="no-sort no-search sorting_disabled">
                    {!! form()->customCheckbox([
                        ['group_checkable', 1]
                    ]) !!}
                </th>
            @endif
            @foreach($headings as $key => $heading)
                <th data-item="{{ $key }}">{!! $heading['title'] or '' !!}</th>
            @endforeach
        </tr>
        @if($hasFilter)
            @php
                $i = 1;
            @endphp
            <tr role="row" class="filter">
                @if($hasTableActions)
                    <td data-item="id-checkbox"></td>
                @endif
                @foreach($headings as $key => $heading)
                    @if(($key == 'actions'))
                        <td data-item="actions">
                            <button class="btn btn-sm green filter-submit">
                                <i class="fa fa-search"></i>
                            </button>
                            <button class="btn btn-sm yellow-lemon filter-cancel">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    @else
                        <td data-item="{{ $key }}">
                            {!! $filters[(($hasTableActions) ? $i : $i - 1)] or '' !!}
                        </td>
                    @endif
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tr>
        @endif
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
