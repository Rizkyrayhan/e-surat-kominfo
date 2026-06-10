        <?php

        namespace App\Http\Controllers;

        use App\Models\Category;
        use Illuminate\Http\Request;

        class CategoryController extends Controller
        {
            public function index()
            {
                $categories = Category::withCount('accounts')->orderBy('nama_kategori')->get();
                return view('admin.categories.index', compact('categories'));
            }

            public function store(Request $request)
            {
                $request->validate([
                    'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori',
                ], [
                    'nama_kategori.required' => 'Nama kategori wajib diisi.',
                    'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
                    'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
                ]);

                Category::create([
                    'nama_kategori' => $request->nama_kategori,
                ]);

                return redirect()->route('admin.categories.index')->with('success', 'Kategori baru berhasil ditambahkan.');
            }

            public function update(Request $request, Category $category)
            {
                $request->validate([
                    'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori,' . $category->id,
                ], [
                    'nama_kategori.required' => 'Nama kategori wajib diisi.',
                    'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
                    'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
                ]);

                $category->update([
                    'nama_kategori' => $request->nama_kategori,
                ]);

                return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
            }

            public function destroy(Category $category)
            {
                $category->delete();
                return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
            }
        }
