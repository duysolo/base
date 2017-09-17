@php
    $customErrors = session('errorMessages');
    $customMessages = session('successMessages');
    $customInfos = session('infoMessages');
    $customWarnings = session('warningMessages');
    $messagesCount = 0;
@endphp
<div class="modal fade" id="flash_messages_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="flash-messages-container">
                    @if(isset($errors)) @foreach($errors->all() as $key => $row)
                        @php
                            $messagesCount++;
                        @endphp
                        <div class="alert alert-danger" role="alert">
                            <p>{!! $row !!}</p>
                        </div>
                    @endforeach @endif
                    @if($customErrors) @foreach($customErrors as $key => $row)
                        @php
                            $messagesCount++;
                        @endphp
                        <div class="alert alert-danger" role="alert">
                            <p>{!! $row !!}</p>
                        </div>
                    @endforeach @endif
                    @if($customMessages) @foreach($customMessages as $key => $row)
                        @php
                            $messagesCount++;
                        @endphp
                        <div class="alert alert-success" role="alert">
                            <p>{!! $row !!}</p>
                        </div>
                    @endforeach @endif
                    @if($customInfos) @foreach($customInfos as $key => $row)
                        @php
                            $messagesCount++;
                        @endphp
                        <div class="alert alert-info" role="alert">
                            <p>{!! $row !!}</p>
                        </div>
                    @endforeach @endif
                    @if($customWarnings) @foreach($customWarnings as $key => $row)
                        @php
                            $messagesCount++;
                        @endphp
                        <div class="alert alert-warning" role="alert">
                            <p>{!! $row !!}</p>
                        </div>
                    @endforeach @endif
                    @php do_action('flash_messages') @endphp
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        var count = $('.flash-messages-container').find('> *').length;
        if (count) {
            $('#flash_messages_modal').modal();
        }
    </script>
@endpush
