<?php

namespace App\Http\Controllers\Admin\Chapters\Image;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Scans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AddController extends Controller
{
    public function __invoke(Request $request)
    {
        $file = $request->file('image');
        $chapter = Chapter::find($request->get('id_chapter'));

        if(in_array($file->getClientOriginalName(), scandir(public_path('storage\images\scans\\'.$chapter->manga->title_eng.'\\'.$chapter->tom.'\\'.$chapter->number)))) {
            return [
                'status'=> false,
                'error'=>'Файл с таким именем уже существует'
            ];
        }
        $manga = str_replace(' ', '_', $chapter->manga->title_eng);
        $toPath = 'images/scans/'.$manga.'/'.$chapter->tom.'/'.$chapter->number;
        $path = Storage::putFileAs($toPath, $file, $file->getClientOriginalName());
        Scans::create([
            'id_chapter'=>$chapter->id,
            'url'=>'storage/'.$path,
            'number'=>$chapter->scans->max('number')+1,
        ]);
        return [
            'status'=> true,
        ];

    }
}
