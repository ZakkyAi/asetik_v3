# User Photo Upload Feature

## Overview
Added image upload functionality to the user management system, allowing admins to upload and manage user profile photos.

## Features Implemented

### 1. **Photo Upload on Create**
- Added photo upload field to the "Add New User" form
- Real-time image preview before submission
- File validation (max 2MB, JPG/PNG/GIF formats)
- Photos stored in `public/uploads/users/` directory

### 2. **Photo Upload on Edit**
- Added photo upload field to the "Edit User" form
- Displays current photo if exists
- Allows changing/updating the photo
- Automatically deletes old photo when new one is uploaded
- Real-time preview of new photo selection

### 3. **Backend Handling**
- Updated `UserController@store` to handle photo uploads
- Updated `UserController@update` to handle photo updates and old photo deletion
- Added validation rules for image files
- Secure file naming with timestamps to prevent conflicts

## Technical Details

### File Storage
- **Directory**: `public/uploads/users/`
- **Naming Convention**: `{timestamp}_{original_filename}`
- **Database Field**: `photo` (stores relative path: `uploads/users/filename.jpg`)

### Validation Rules
```php
'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
```
- **Optional**: Photo is not required
- **Type**: Must be an image file
- **Formats**: JPEG, PNG, JPG, GIF
- **Max Size**: 2MB (2048 KB)

### File Upload Process

#### Create User:
1. User selects photo via file input
2. JavaScript shows preview
3. On form submit, photo is validated
4. Photo is moved to `public/uploads/users/`
5. Path is saved to database

#### Update User:
1. Current photo is displayed (if exists)
2. User can select new photo
3. JavaScript shows preview of new photo
4. On form submit:
   - Old photo is deleted from server
   - New photo is uploaded
   - Database is updated with new path

### Code Changes

#### UserController.php
```php
// In store() method
if ($request->hasFile('photo')) {
    $photo = $request->file('photo');
    $photoName = time() . '_' . $photo->getClientOriginalName();
    $photo->move(public_path('uploads/users'), $photoName);
    $validated['photo'] = 'uploads/users/' . $photoName;
}

// In update() method
if ($request->hasFile('photo')) {
    // Delete old photo
    if ($user->photo && file_exists(public_path($user->photo))) {
        unlink(public_path($user->photo));
    }
    
    // Upload new photo
    $photo = $request->file('photo');
    $photoName = time() . '_' . $photo->getClientOriginalName();
    $photo->move(public_path('uploads/users'), $photoName);
    $validated['photo'] = 'uploads/users/' . $photoName;
}
```

#### Form Changes
```html
<!-- Added to both create.blade.php and edit.blade.php -->
<form enctype="multipart/form-data">
    <div class="form-group">
        <label for="photo">Profile Photo</label>
        <label for="photo" class="photo-upload-label">📷 Choose Photo</label>
        <input type="file" id="photo" name="photo" accept="image/*" onchange="previewPhoto(event)">
        <img id="photoPreview" class="photo-preview" alt="Photo preview">
    </div>
</form>

<script>
function previewPhoto(event) {
    const preview = document.getElementById('photoPreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>
```

## Usage

### Adding a User with Photo:
1. Go to `/users/create`
2. Click "📷 Choose Photo" button
3. Select an image file
4. Preview will appear below
5. Fill in other user details
6. Click "💾 Create User"

### Editing User Photo:
1. Go to `/users/{id}/edit`
2. Current photo is displayed (if exists)
3. Click "📷 Change Photo" to select new photo
4. Preview will appear
5. Click "💾 Update User"
6. Old photo is automatically deleted, new photo is saved

## Display User Photos

To display user photos in your views, use:

```blade
@if($user->photo)
    <img src="{{ asset($user->photo) }}" alt="{{ $user->name }}">
@else
    <!-- Default avatar or placeholder -->
    <img src="{{ asset('images/default-avatar.png') }}" alt="Default avatar">
@endif
```

## Security Considerations

✅ **File Validation**: Only image files allowed (JPEG, PNG, GIF)
✅ **Size Limit**: Maximum 2MB to prevent large uploads
✅ **Secure Naming**: Timestamp prefix prevents filename conflicts
✅ **Old File Cleanup**: Deleted photos are removed from server
✅ **Path Storage**: Only relative paths stored in database

## Directory Structure

```
public/
└── uploads/
    └── users/
        ├── .gitignore (ignores all files except itself)
        ├── 1734534567_john_doe.jpg
        ├── 1734534890_jane_smith.png
        └── ...
```

## Future Enhancements

Consider adding:
1. **Image Resizing**: Automatically resize large images
2. **Thumbnails**: Generate thumbnail versions
3. **CDN Integration**: Store images on CDN for better performance
4. **Image Cropping**: Allow users to crop images before upload
5. **Multiple Photos**: Support for multiple profile photos
6. **Default Avatars**: Generate default avatars based on initials

---

**Implementation Date**: December 18, 2025
**Laravel Version**: 12.x
**Status**: ✅ Complete and Ready to Use
