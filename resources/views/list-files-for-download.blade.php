<x-main-layout>
    <div class="container">
        <p class="display-6 mt-5">Listar Arquivos paa Download</p>
        <hr>
        <div class="row">
            @foreach($files as $file)
                <div class="col-12 card-p-2">
                    <ul>
                        <li>Name: <strong>{{ $file['name'] }}</strong></li>
                        <li>Size: <strong>{{ $file['size'] }}</strong></li>
                        {{-- <li>Download: <a href="{{ $file['file_url'] }}">Download</a></li> --}}
                        <li>Download: <a href="{{ route('download', [ 'file' => $file['file'] ]) }}">Download</a></li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-main-layout>
