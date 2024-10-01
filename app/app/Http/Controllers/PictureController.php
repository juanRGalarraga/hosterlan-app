<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Publication\PublicationController;
use App\Models\Picture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Picture $picture)
    {
        $publicationId = $picture->publication_id;
        $deleted = Storage::disk('publication-pictures')->delete("$publicationId/$picture->name");
        
        if(!$deleted){
            abort(500);
            throw new \Symfony\Component\HttpFoundation\File\Exception\FileException("Error Processing Request");
        }
        
        DB::transaction(function() use ($picture){
            $picture->delete();
        });

        return response()->json(['status' => 'ok']);
    }

    /**
     * Recovery the uploaded pictures from the storage.
     * @param int $publicationId
     * @return mixed|string
     */
    public function getHTMLUploadFiles(Request $request)
    {
        $files = $request->except('publicationId');
        if ($request->input('publicationId')) {
            $pictures = Picture::where('publication_id', $request->input('publicationId'))->get();
            foreach ($pictures as $key => $picture) {
                $files[$picture->id] = $picture->getUrl();
            }
        }

        return view('publications.common.form-preview-files', compact('files'))->render();
    }
}
