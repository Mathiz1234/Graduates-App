@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show my-1" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ __(session('status')) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="@lang('general.close')">
              <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif