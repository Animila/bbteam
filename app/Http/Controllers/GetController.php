<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class GetController extends Controller
{
    public function __invoke(Request $request) {
        $dd = $request->validate([
            'data'=>''
        ]);
        $zip = zip_open($dd['data']);

        if ($zip) {
            while ($zip_entry = zip_read($zip)) {
                echo "Name:               " . zip_entry_name($zip_entry) . "\n";
                echo "Actual Filesize:    " . zip_entry_filesize($zip_entry) . "\n";
                echo "Compressed Size:    " . zip_entry_compressedsize($zip_entry) . "\n";
                echo "Compression Method: " . zip_entry_compressionmethod($zip_entry) . "\n";

                if (zip_entry_open($zip, $zip_entry, "r")) {
                    echo "File Contents:\n";
                    $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                    $path = '/images/manga/'.str_replace(' ', '_', 'title_eng');
                    echo Storage::putFileAs($path, $buf, 'titleImage');
                    zip_entry_close($zip_entry);
                }
                echo "\n";
            }
            zip_close($zip);
        }
    }
}
