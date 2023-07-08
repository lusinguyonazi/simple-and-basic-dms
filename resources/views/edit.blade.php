<x-app-layout>
    <x-slot name="header">
        <div class="container d-flex justify-content-center mt-100">

            <body>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mt-5" style="margin: 0 auto;">
                            <!-- Alert message (start) -->
                            @if (Session::has('message'))
                                <div class="alert {{ Session::get('alert-class') }} ">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <!-- Alert message (end) -->
                            @foreach ($files as $file)
                                <form method="post" action="{{ route('update', encrypt($file->id)) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label class="control-label col-sm-2" for="name">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Enter Name"
                                                name="name" value="{{ $file->name }}">
                                        </div>
                                        <!-- Error -->
                                        @if ($errors->has('name'))
                                            <div class='text-danger mt-2'>
                                                * {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    {{-- index --}}
                                    <div class="form-group mb-4">
                                        <label class="control-label col-sm-2" for="name">Index:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Enter Index"
                                                name="index" value="{{ $file->index }}">
                                        </div>
                                        <!-- Error -->
                                        @if ($errors->has('index'))
                                            <div class='text-danger mt-2'>
                                                * {{ $errors->first('index') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="control-label col-sm-2" for="file">File:</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file" class="form-control"
                                                value="{{ $file->file }}">
                                        </div>
                                        <!-- Error -->
                                        @if ($errors->has('file'))
                                            <div class='text-danger mt-2'>
                                                * {{ $errors->first('file') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-info">Upload</button>
                                            <button type="reset" class="btn btn-warning">Clear</button>
                                        </div>
                                    </div>
                            @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </body>
        </div>
    </x-slot>
</x-app-layout>
