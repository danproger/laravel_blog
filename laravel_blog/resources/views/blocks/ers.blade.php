@if(count($errors) > 0)
    @foreach($errors->all() as $er)
        <div class="alert alert-danger">
            {{ $er }}
        </div>
    @endforeach
@endif
