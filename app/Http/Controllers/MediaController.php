<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Handle media upload for the birthday website via AJAX.
     */
    public function store(Request $request)
    {
        $request->validate([
            'media_file'    => 'required|file|max:51200|mimes:jpg,jpeg,png,gif,mp4,mov,webm',
            'uploader_name' => 'required|string|max:100',
            'caption'       => 'nullable|string|max:200',
        ]);

        try {
            $file = $request->file('media_file');
            $path = $file->store('memories', 'public');

            // Return media data for frontend to display instantly
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your memory has been shared successfully.',
                'media' => [
                    'url'          => asset('storage/' . $path),
                    'path'         => $path,
                    'mime_type'    => $file->getMimeType(),
                    'uploader_name'=> $request->uploader_name,
                    'caption'      => $request->caption,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload media. Please try again.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
