<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Albums List</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 40px; background-color: #f4f4f9;">

    <h1 style="color: #333;">My Albums</h1>
    @if(session('success'))
        <p style="color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('albums.create') }}" style="
        display: inline-block; 
        background-color: #13ca31;
        color: white; 
        padding: 10px 15px; 
        text-decoration: none; 
        border-radius: 5px; 
        margin-bottom: 20px;
    "> Create New Album</a>

    <table style="width: 100%; border-collapse: collapse; background-color: white; border-radius: 8px; overflow: hidden;">
        <thead>
            <tr style="background-color: #092f59; color: white; text-align: left;">
                <th style="padding: 12px;">ID</th>
                <th style="padding: 12px;">Title</th>
                <th style="padding: 12px;">Total Files</th>
                <th style="padding: 12px;">Files Preview</th>
                <th style="padding: 12px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 12px;">{{ $album->id }}</td>
                <td style="padding: 12px;">{{ $album->title }}</td>
                <td style="padding: 12px;">{{ $album->files->count() }} files</td>
                
                <td style="padding: 12px;">
                    @foreach($album->files as $file)
                        <div style="margin-bottom: 5px; font-size: 14px;">
                            @if(str_contains($file->file_type, 'image'))
                                <img src="{{ asset('storage/' . $file->file_path) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; vertical-align: middle; margin-right: 5px;">
                            @else
                                <span style="margin-right: 5px;">📄</span>
                            @endif
                            {{ basename($file->file_name) }}
                        </div>
                    @endforeach
                </td>

                <td style="padding: 12px;">
                    <a href="{{ route('albums.edit', $album->id) }}" style="color: #092f59; margin-right: 10px; text-decoration: none;">Edit</a>
                    
                    <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure? This will delete the album and ALL its files.')" style="
                            background-color: #dc3545; /* Red color */
                            color: white; 
                            border: none; 
                            padding: 5px 10px; 
                            border-radius: 3px; 
                            cursor: pointer; /* Mouse par aane par hand icon dikhata hai */
                        ">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>