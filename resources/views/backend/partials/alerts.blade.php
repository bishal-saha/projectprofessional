@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-danger border-0 alert-dismissible animated zoomIn">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success border-0 alert-dismissible animated zoomIn">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success border-0 alert-dismissible animated zoomInDown" data-animation="zoomIn">
            <button type="button" class="close" data-dismiss="alert">
                <i class="icon-cross"></i>
            </button>
            <i class="icon-checkmark-circle2 mr-2"></i>
            {{ $data }}
        </div>
    @endif
@endif
