<!-- <div class="form-group"> -->
    {{ html()->file('file')->class(["form-control-file form-inline", "is-invalid" => $errors->has('file')])->id('file') }}
    <!-- @error('file') -->
    <!-- <div class="invalid-feedback">{{ $errors->first('file') }}</div> -->
    <!-- @enderror -->
<!-- </div> -->