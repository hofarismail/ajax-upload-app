<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $document = new Document();
            $document->name = $file->getClientOriginalName();
            $document->file_path = $filePath;
            $document->save();

            return response()->json(['success' => true, 'message' => 'Document uploaded successfully']);
        }

        return response()->json(['message' => 'Document uploaded successfully.']);
    }
}
