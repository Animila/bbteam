<?php

namespace App\Http\Controllers\Admin\Chapters\Image;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Scans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $file = $request->file('image');
        $chapter = Chapter::find($request->get('id_chapter'));
        $manga = str_replace(' ', '_', $chapter->manga->title_eng);

        $pathZip = 'zip/'.$manga;
        $pathZip = Storage::putFileAs($pathZip, $file, $file->getClientOriginalName());

        $toPath = 'storage/images/scans/'.$manga.'/'.$chapter->tom.'/'.$chapter->number.'/';

        $zip = new ZipArchive;
        if ($zip->open(Storage::path($pathZip)) === TRUE) {
            $zip->extractTo(public_path($toPath));
            $zip->close();
            Storage::delete($pathZip);
            $scanned_directory = array_diff(scandir(public_path($toPath)), array('..', '.'));
            $count = 0;
            foreach ($scanned_directory as $item) {
                $count++;
                Scans::create([
                    'id_chapter'=>$chapter->id,
                    'url'=>$toPath.$item,
                    'number'=>$count
                ]);
            }
            return [
              'status'=> true
            ];
        } else {
            return [
                'status'=> false
            ];
        }

    }
}
