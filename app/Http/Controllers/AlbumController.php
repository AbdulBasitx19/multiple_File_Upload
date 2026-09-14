<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class AlbumController extends Controller
{

    public function index()
    {
        $albums = Album::with('files')->latest()->get();
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request) 
    {
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'files' => 'required|array|min:1',
            'files.*' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
        ]);

        $album = Album::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        if($request->hasFile('files')){
            foreach ($request->file('files') as $file) {
                $path = $file->store('album_files', 'public');

                $album->files()->create([
                    'file_name' => $file->getClientOriginalName(), 
                    'file_path' => $path,                        
                    'file_type' => $file->getClientMimeType(), 
                ]);
            }
        }
        return redirect()->route('albums.index')->with('success', 'Album and files successfully uploaded!');
    }

    public function edit(Album $album)
    {
        $album->load('files');
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album){
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
            'delete_files' => 'nullable|array',
            'delete_files.*' => 'exists:files,id',
        ]);

        $album->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        // old files chceckbox delete
        if (!empty($validated['delete_files'])) {
            foreach ($validated['delete_files'] as $fileId) {
                $file = File::find($fileId);
                if ($file) {
                    Storage::disk('public')->delete($file->file_path);
                    $file->delete();
                }
            }
        }

        //new files added
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('album_files', 'public');
                
                $album->files()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('albums.index')->with('success', 'Album successfully updated!');
    }

    public function destroy(Album $album)
    {
        foreach ($album->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }

        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album and its files permanently deleted !');
    }
}