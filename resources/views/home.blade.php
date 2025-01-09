<x-main-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <p class="text-center display-3">Laboratório de Filesystem</p>

                <hr>
                <div class="d-flex gap-5 mb-5">
                    <a href="{{ route('storage.local.create') }}" class="btn btn-primary">Criar arquivo no Storage Local</a>
                    <a href="{{ route('storage.local.append') }}" class="btn btn-primary">Acrescentar conteúdo no Storage Local</a>
                    <a href="{{ route('storage.local.read') }}" class="btn btn-primary">Ler conteúdo do Storage Local</a>
                    <a href="{{ route('storage.local.read.multi') }}" class="btn btn-primary">Ler Arquivo de Múltiplas Linhas</a>
                </div>
                <div class="d-flex gap-5 mb-5">
                    <a href="{{ route('storage.local.check.file') }}" class="btn btn-primary">Verificar a existência de Arquivo</a>
                    <a href="{{ route('storage.local.store.json') }}" class="btn btn-primary">Guardar Json</a>
                    <a href="{{ route('storage.local.read.json') }}" class="btn btn-primary">Ler Json</a>
                    <a href="{{ route('storage.local.list') }}" class="btn btn-primary">Listar Arquivos</a>
                    <a href="{{ route('storage.local.delete') }}" class="btn btn-primary">Delete Arquivos</a>
                </div>
                <div class="d-flex gap-5 mb-5">
                    <a href="{{ route('storage.local.create.folder') }}" class="btn btn-primary">Criar pasta</a>
                    <a href="{{ route('storage.local.delete.folder') }}" class="btn btn-primary">Deletar Pasta</a>
                    <a href="{{ route('storage.local.list.files.metadata') }}" class="btn btn-primary">Listar Arquivos com Metadados</a>
                    <a href="{{ route('storage.local.list.for.download') }}" class="btn btn-primary">Downloads</a>
                </div>

                <hr>

                <div>
                    <p class="display-6">Upload de arquivos</p>

                    <form action="{{ route('storage.local.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="arquivo" class="form-label">Arquivo</label>
                            <input type="file" class="form-control" name="arquivo" id="arquivo">
                            @error('arquivo')
                                <div class="text-danger">{{ $message }}</div>    
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
