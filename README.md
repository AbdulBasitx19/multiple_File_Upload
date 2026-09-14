# 📁 Multiple File Upload System (Laravel)

A robust Laravel CRUD application focusing on **One-to-Many relationships** and **multiple file uploads** (images, PDFs, documents) in a single form.

## 🚀 Features
- **Multiple File Upload**: Upload multiple files simultaneously for a single Album.
- **One-to-Many Relationship**: `albums` and `files` tables linked via foreign keys.
- **Dynamic Preview**: Shows image thumbnails or document icons automatically.
- **Advanced Update Logic**: Add new files or selectively delete existing ones.
- **Safe Deletion**: Deletes database records and physical files from storage together.
- **Custom Routing**: Manual `GET`, `POST`, `PUT`, `DELETE` routes (No Route::resource).

## 🛠️ Tech Stack
- **Backend**: Laravel 11.x, PHP 8.2+
- **Database**: MySQL
- **Frontend**: Blade Templates, Vanilla HTML/CSS

## 📦 Installation Steps
1. Clone the repo: `git clone https://github.com/AbdulBasitx19/multiple_File_Upload.git`
2. Go to folder: `cd multiple_File_Upload`
3. Install dependencies: `composer install`
4. Setup `.env` file (copy `.env.example` to `.env` and set DB credentials).
5. Generate key: `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. Create storage link: `php artisan storage:link`
8. Start server: `php artisan serve`

---
*Built by Abdul Basit*