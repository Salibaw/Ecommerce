<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempImage;
class TempImagesController extends Controller
{
    public function create(Request $request)
    {
        $image = $request->file('image');
        if ($image) {
            $newName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('temp'), $newName);

            $tempImage = TempImage::create(['name' => $newName]);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'message' => 'Image uploaded successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No image uploaded.',
        ], 400);
    }
    public function delete($imageId)
    {
        $tempImage = TempImage::find($imageId);

        if ($tempImage) {
            $imagePath = public_path('temp/' . $tempImage->name);

            // Delete the file if it exists
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Remove the record from the database
            $tempImage->delete();

            return response()->json(['status' => true, 'message' => 'Image deleted successfully']);
        }

        return response()->json(['status' => false, 'message' => 'Image not found'], 404);
    }

}