@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    

    {{-- @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Lapangan') }}</h1>
                    <a href="{{ route('admin.arenas.index') }}" class="btn btn-secondary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.arenas.update', $arena->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="lapangan">{{ __('Olahraga') }}</label>
                        <input type="text" class="form-control" id="lapangan" placeholder="{{ __('lapangan') }}" name="lapangan" value="{{ old('lapangan', $arena->lapangan) }}" />
                    </div>
                    <div class="form-group">
                        <label for="price">{{ __('Harga per Jam') }}</label>
                        <input type="lapangan" class="form-control" id="price" placeholder="{{ __('price') }}" name="price" value="{{ old('price', $arena->price) }}" />
                    </div>
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="image">Image</label>
                        <div class="needsclick dropzone" id="image-dropzone">

                        </div>
                        @if($errors->has('image'))
                            <em class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </em>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="infolokasi">{{ __('Lokasi') }}</label>
                        <input type="text" class="form-control" id="infolokasi" placeholder="{{ __('infolokasi') }}" name="infolokasi" value="{{ old('infolokasi', $arena->infolokasi) }}" />
                    </div>
                    
                    <div class="form-group">
                        <label for="infofasilitas">{{ __('Fasilitas') }}</label>
                        <input type="text" class="form-control" id="infofasilitas" placeholder="{{ __('infofasilitas') }}" name="infofasilitas" value="{{ old('infofasilitas', $arena->infofasilitas) }}" />
                    </div>

                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ $arena->status == 'Active' ? 'selected' : null }}  value="1">Active</option>
                            <option {{ $arena->status == 'In Active' ? 'selected' : null }}  value="0">In Active</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection


@push('style-alt')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
@endpush

@push('script-alt')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    Dropzone.options.imageDropzone = {
        url: "{{ route('admin.arenas.storeMedia') }}",
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2,
        width: 4096,
        height: 4096
        },
        success: function (file, response) {
        $('form').find('input[name="image"]').remove()
        $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="image"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
            @if(isset($arena) && $arena->image)
                var file = {!! json_encode($arena->image) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, "{{ $arena->image->getUrl() }}")
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }
            return _results
        }
    }
</script>
@endpush