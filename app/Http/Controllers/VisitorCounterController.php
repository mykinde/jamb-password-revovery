<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class VisitorCounterController extends Controller
{
    public function index()
    {
        $path = 'visitor_count.txt';

        // Initialize file if not present
        if (!Storage::exists($path)) {
            Storage::put($path, 0);
        }

        // Use file locking to avoid race conditions
        $fullPath = storage_path("app/{$path}");
        $count = 0;

        $fp = fopen($fullPath, 'c+');

        if (flock($fp, LOCK_EX)) {
            $size = filesize($fullPath);
            $count = 0;
        
            if ($size > 0) {
                $count = (int)fread($fp, $size);
            }
        
            $count++;
            ftruncate($fp, 0);
            rewind($fp);
            fwrite($fp, $count);
            fflush($fp);
            flock($fp, LOCK_UN);
        }

        fclose($fp);

        return view('visitor', ['count' => $count]);
    }
}
