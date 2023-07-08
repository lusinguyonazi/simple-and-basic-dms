<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Simple Document management System') }}
            </h2>
        </center>
        <a href="uploadFile">
            <div class="btn-group">
                <button type="button" class="btn btn-info">Upload File</button>
            </div>
        </a>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>File</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->index }}</td>
                                <td>{{ $file->name }}</td>
                                <td>
                                    <a href="{{ $file->filepath }}" target="_blank">View file</a>

                                </td>
                                <td>
                                    <a href="{{ route('edit', encrypt($file->id)) }}"> <button type="button"
                                            class="btn btn-info">Edit</button></a>
                                    <a href="{{ route('delete', encrypt($file->id)) }}"> <button type="button"
                                            class="btn btn-warning">Delete</button></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-slot>
</x-app-layout>
