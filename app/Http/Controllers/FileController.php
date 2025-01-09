<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function storageLocalCreate()
    {
        Storage::put('public/file1.txt', 'Conteúdo do ficheiro 1', 'public');
        Storage::disk('local')->put('file2.txt', 'Conteúdo do ficheiro 2');

        //Quando quiser salvar na pasta public de verdade.
        // Storage::disk('public')->put('arquivo.txt', 'Conteudo do arquivo.txt');

        echo "FIM";
    }

    public function storageLocalAppend()
    {
        Storage::append('file3.txt', Str::random(100));
        Storage::disk('local')->append('file4.txt', Str::random(100));
        return redirect()->route('home');
    }

    public function storageLocalRead()
    {
        // $content = Storage::read('file1.txt');
        $content = Storage::disk('local')->get('file3.txt');
        echo $content;
    }

    public function storageLocalReadMulti()
    {
        $lines = Storage::get('file3.txt');
        $lines = explode(PHP_EOL, $lines);

        foreach($lines as $line){
            echo "<p>$line</p>";
        }
    }

    public function storageLocalCheckFile()
    {
        $exists = Storage::exists('file1.txt');
        //ou
        // $exists = Storage::disk('local')->exists('file1.txt');

        if($exists){
            echo 'O ficheiro existe';
        } else {
            echo "O ficheiro não existe";
        }

        echo '<br>';

        if(Storage::missing('file100.txt')){
            echo "O ficheiro não existe";
        } else {
            echo 'O ficheiro existe';
        }
    }

    public function storeJson()
    {
        $data = [
            [
                'name' => 'João',
                'email' => 'joao@gmail.com'
            ],
            [
                'name' => 'Ana',
                'email' => 'ana@gmail.com'
            ],
            [
                'name' => 'Carlos',
                'email' => 'carlos@gmail.com'
            ],
        ];

        Storage::put('data.json', json_encode($data));
        echo "Ficheiro JSON criado";
    }

    public function readJson()
    {
        $data = Storage::json('data.json');

        echo '<pre>';
        print_r($data);
        // echo '</pre>';
    }

    public function listFiles()
    {
        $files = Storage::files(); // Busca na Raiz de Storage
        // $files = Storage::disk('public')->files(null, true); //Busca do diretório public correto
        // $files = Storage::disk('local')->files(); // Busca na Raiz de Storage, mas informando aonde buscar (no caso, no local)
        // $files = Storage::disk('public')->directories(); //Encontra diretórios dentro de uma pasta (substituindo public por local, pega da pasta private)
        // $files = Storage::disk('local')->files(null, true);

        echo '<pre>';
        print_r($files);
    }

    public function deleteFile()
    {
        Storage::delete('file1.txt');
        echo 'Arquivo removido com sucesso';

        // Delete all files
        // Storage::delete(Storage::files());
    }

    public function createFolder()
    {
        Storage::makeDirectory('documents');
    }

    public function deleteFolder()
    {
        Storage::deleteDirectory('documents');
    }

    public function listFilesWithMetadata()
    {
        $list_files = Storage::allFiles();

        $files = [];
        
        foreach($list_files as $file){
            $files[] = [
                'name' => $file,
                'size' => round(Storage::size($file) / 1024,2) . ' Kb',
                'last_modified' => Carbon::createFromTimestamp(Storage::lastModified($file))->format('d-m-Y H:i:s'),
                'mime_type' => Storage::mimeType($file)
            ];
        }

        return view('list-files-with-metadata', compact('files'));
    }

    public function listFilesForDownload()
    {
        $list_files = Storage::disk('public')->allFiles();

        $files = [];
        
        foreach($list_files as $file){
            $files[] = [
                'name' => $file,
                'size' => round(Storage::disk('public')->size($file) / 1024, 2) . ' Kb', // Especificar o disco
                // 'file_url' => Storage::disk('public')->url($file), // Especificar o disco
                'file' => basename($file)
            ];
        }

        return view('list-files-for-download', compact('files'));
    }

    public function uploadFile(Request $request)
    {
        // Solução para guardar o arquivo na pasta storage/app/private/uploads
        // $request->file('arquivo')->store();
        // $request->file('arquivo')->store('uploads');

        // $request->file('arquivo')->store('public');  
        // $path = $request->file('arquivo')->store( '','public'); // Salva no disco "public"
        // $path = $request->file('arquivo')->storeAs( '',$request->file('arquivo')->getClientOriginalName(), 'public'); //Guarda com o nome do arquivo

        //----------------------------------------
        // upload de arquivos

        $request->validate([
            'arquivo' => 'required|mimes:pdf,jpg,png|max:100'
        ]);


        $path = $request->file('arquivo')->store( '','public'); // Salva no disco "public"

        echo 'Ficheiro enviado com sucesso ' . $path;
    }
}
