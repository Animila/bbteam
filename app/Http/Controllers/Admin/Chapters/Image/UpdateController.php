<?php

namespace App\Http\Controllers\Admin\Chapters\Image;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Scans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Scans $scan)
    {
        $file = $request->file('image');
        if(in_array($file->getClientOriginalName(), scandir(public_path('storage\images\scans\\'.$scan->chapter->manga->title_eng.'\\'.$scan->chapter->tom.'\\'.$scan->chapter->number)))) {
            return [
                'status'=> false,
                'error'=>'Файл с таким именем уже существует'
            ];
        }
        unlink(public_path($scan->url));
        $chapter = $scan->chapter;
        $manga = str_replace(' ', '_', $scan->chapter->manga->title_eng);
        $toPath = 'images/scans/'.$manga.'/'.$chapter->tom.'/'.$chapter->number;
        $path = Storage::putFileAs($toPath, $file, $file->getClientOriginalName());
        $scan->update([
            'url'=>'storage/'.$path,
        ]);
        return [
            'status'=> true,
        ];
    }
}
