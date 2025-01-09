<x-main-layout>
    <div class="container">
        <p class="display-6 mt-5">Listar Arquivos com Metadados</p>
        <hr>
        <div class="row">
            @foreach($files as $file)
                <div class="col-12 card-p-2">
                    <ul>
                        <li>Name: <strong>{{ $file['name'] }}</strong></li>
                        <li>Size: <strong>{{ $file['size'] }}</strong></li>
                        <li>Last Modified: <strong>{{ $file['last_modified'] }}</strong></li>
                        <li>Mime Type: <strong>{{ $file['mime_type'] }}</strong></li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-main-layout>
