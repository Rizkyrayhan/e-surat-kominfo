    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\OpdController;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\SuratKeluarController;
    use App\Http\Controllers\SuratMasukController;
    use App\Http\Controllers\OpdAccountController;
    use App\Http\Controllers\CategoryController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/', function () {
        return view('landing');
    });

    // Authentication Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    // OPD Routes
    Route::middleware(['auth', 'role:opd'])->prefix('opd')->name('opd.')->group(function () {
        Route::get('/dashboard', [OpdController::class, 'dashboard'])->name('dashboard');
        Route::get('/riwayat', [OpdController::class, 'history'])->name('history');
        Route::post('/surat/bulk-delete', [OpdController::class, 'bulkDelete'])->name('surat.bulk-delete');
        Route::get('/surat/create', [OpdController::class, 'create'])->name('surat.create');
        Route::post('/surat', [OpdController::class, 'store'])->name('surat.store');
        
        // Surat Masuk from Kominfo
        Route::get('/surat-masuk', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
        Route::get('/surat-masuk/{id}', [SuratMasukController::class, 'show'])->name('surat-masuk.show');
        Route::post('/surat-masuk/bulk-delete', [SuratMasukController::class, 'bulkDelete'])->name('surat-masuk.bulk-delete');
    });

    // Admin Routes
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/riwayat', [AdminController::class, 'history'])->name('history');
        Route::post('/surat/bulk-delete', [AdminController::class, 'bulkDelete'])->name('surat.bulk-delete');
        Route::get('/surat/{surat}', [AdminController::class, 'show'])->name('surat.show');
        Route::get('/surat/{surat}/print', [AdminController::class, 'print'])->name('surat.print');
        Route::patch('/surat/{surat}/status', [AdminController::class, 'updateStatus'])->name('surat.update-status');

        // Surat Keluar to OPD
        Route::get('/surat-keluar', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
        Route::get('/surat-keluar/create', [SuratKeluarController::class, 'create'])->name('surat-keluar.create');
        Route::post('/surat-keluar', [SuratKeluarController::class, 'store'])->name('surat-keluar.store');
        Route::delete('/surat-keluar/{id}', [SuratKeluarController::class, 'destroy'])->name('surat-keluar.destroy');

        // Kelola Akun OPD
        Route::resource('opd-accounts', OpdAccountController::class)->except(['show'])->parameters(['opd-accounts' => 'account']);
        Route::patch('/opd-accounts/{account}/reset-password', [OpdAccountController::class, 'resetPassword'])->name('opd-accounts.reset-password');
        Route::patch('/opd-accounts/{account}/toggle-status', [OpdAccountController::class, 'toggleStatus'])->name('opd-accounts.toggle-status');

        // Kelola Kategori
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Shared Profile Routes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::get('/download-file', function (\Illuminate\Http\Request $request) {
            $path = $request->query('path');
            if (!$path) return abort(404);
            return \Illuminate\Support\Facades\Storage::disk('s3')->download($path);
        })->name('download.file');
    });

    // Temporary Route to Run Migrations on Shared Hosting (InfinityFree)
    Route::get('/run-migration', function () {
        try {
            // Force InnoDB engine configuration
            config(['database.connections.mysql.engine' => 'InnoDB']);

            // Convert all existing tables to InnoDB to support foreign key constraints
            $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
            $converted = [];
            foreach ($tables as $table) {
                $tableArray = (array)$table;
                $tableName = reset($tableArray);
                if ($tableName) {
                    \Illuminate\Support\Facades\DB::statement("ALTER TABLE `{$tableName}` ENGINE=InnoDB");
                    $converted[] = $tableName;
                }
            }

            // Run migrations
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            
            $output = "<h2>Tables Converted to InnoDB:</h2><ul>";
            foreach ($converted as $t) {
                $output .= "<li>$t</li>";
            }
            $output .= "</ul>";
            $output .= '<h2>Migration Successful!</h2><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>';
            
            return $output;
        } catch (\Throwable $e) {
            return '<h2>Migration Failed!</h2><p>' . $e->getMessage() . '</p><pre>' . $e->getTraceAsString() . '</pre>';
        }
    });

    // Temporary Route to Fix BOM and Whitespace in PHP Files
    Route::get('/fix-files', function () {
        try {
            $fixed = [];
            
            // Scan App directory
            $dir = new RecursiveDirectoryIterator(base_path('app'));
            $iterator = new RecursiveIteratorIterator($dir);
            $regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

            $filesToCheck = [];
            foreach ($regex as $info) {
                $filesToCheck[] = $info[0];
            }
            $filesToCheck[] = base_path('bootstrap/app.php');
            $filesToCheck[] = base_path('routes/web.php');
            
            // Scan and fix each file
            foreach ($filesToCheck as $file) {
                if (!file_exists($file)) continue;
                
                $content = file_get_contents($file);
                if (strlen($content) === 0) continue;
                
                $original = $content;
                
                // 1. Remove UTF-8 BOM if present
                $bom = pack("CCC", 0xef, 0xbb, 0xbf);
                if (substr($content, 0, 3) === $bom) {
                    $content = substr($content, 3);
                }
                
                // 2. Remove leading whitespaces, newlines, or invisible characters before <?php
                $newContent = preg_replace('/^\s*<\?php/i', '<?php', $content);
                
                if ($newContent !== $original) {
                    file_put_contents($file, $newContent);
                    $fixed[] = str_replace(base_path(), '', $file);
                }
            }
            
            if (count($fixed) > 0) {
                return '<h2>Successfully fixed files:</h2><ul><li>' . implode('</li><li>', $fixed) . '</li></ul>';
            } else {
                return '<h2>No files needed fixing (all clean).</h2>';
            }
        } catch (\Throwable $e) {
            return '<h2>Error fixing files:</h2><p>' . $e->getMessage() . '</p>';
        }
    });
