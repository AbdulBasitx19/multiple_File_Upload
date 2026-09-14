<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Album</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 40px; background-color: #f4f4f9;">

    <h1 style="color: #333;">Create New Album</h1>
    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data" style="
        background-color: white; 
        padding: 30px; 
        border-radius: 8px; 
        max-width: 600px; /* Form ki choraai limit karta hai */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Halka sa shadow (parchhai) deta hai */
    ">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Album Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" required style="
                width: 100%; 
                padding: 10px; 
                border: 1px solid #ccc; 
                border-radius: 4px; 
                box-sizing: border-box; /* Padding ko width ke andar count karta hai taake form bahar na nikle */
            ">
            @error('title') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Description:</label>
            <textarea name="description" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Upload Files (Multiple Allowed):</label>
            <input type="file" name="files[]" multiple accept="image/jpeg, image/png, application/pdf, application/msword" style="padding: 5px 0;">
            
            <p style="font-size: 12px; color: gray; margin-top: 5px;">You can select multiple files by holding Ctrl (or Cmd) key.</p>
            
            @error('files') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
            @error('files.*') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" style="
            background-color: #28a745; /* Green color */
            color: white; 
            padding: 12px 20px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px;
        ">Save Album & Files</button>
        
        <a href="{{ route('albums.index') }}" style="margin-left: 15px; color: #666; text-decoration: none;">Cancel</a>
    </form>
</body>
</html>