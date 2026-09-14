<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Album</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 40px; background-color: #f4f4f9;">

    <h1 style="color: #333;">Edit Album</h1>

    <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data" style="background-color: white; padding: 30px; border-radius: 8px; max-width: 600px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Album Title:</label>
            <input type="text" name="title" value="{{ old('title', $album->title) }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            @error('title') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Description:</label>
            <textarea name="description" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">{{ old('description', $album->description) }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Existing Files (Check to Delete):</label>
            
            @if($album->files->isNotEmpty())
                <!-- Purani files ko loop karna -->
                @foreach($album->files as $file)
                    <div style="display: flex; align-items: center; margin-bottom: 8px; padding: 8px; background: #f9f9f9; border-radius: 4px;">
                        
                        <!-- Checkbox ka naam 'delete_files[]' hai, jo controller mein array ban kar jayega -->
                        <input type="checkbox" name="delete_files[]" value="{{ $file->id }}" style="margin-right: 10px; transform: scale(1.2);">
                        
                        @if(str_contains($file->file_type, 'image'))
                            <img src="{{ asset('storage/' . $file->file_path) }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; margin-right: 10px;">
                        @else
                            <span style="margin-right: 10px; font-size: 20px;">📄</span>
                        @endif
                        
                        <span style="font-size: 14px;">{{ basename($file->file_name) }}</span>
                    </div>
                @endforeach
            @else
                <p style="color: gray; font-size: 14px;">No files uploaded yet.</p>
            @endif
        </div>

        <div style="margin-bottom: 20px; padding-top: 15px; border-top: 1px dashed #ccc;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Add New Files (Optional):</label>
            <input type="file" name="files[]" multiple accept="image/jpeg, image/png, application/pdf, application/msword" style="padding: 5px 0;">
            <p style="font-size: 12px; color: gray; margin-top: 5px;">Leave empty if you don't want to add new files.</p>
            @error('files') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" style="background-color: #007bff; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">Update Album</button>
        <a href="{{ route('albums.index') }}" style="margin-left: 15px; color: #666; text-decoration: none;">Cancel</a>
    </form>
</body>
</html>