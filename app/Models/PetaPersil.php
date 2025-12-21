<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PetaPersil extends Model
{

    protected $table = 'peta_persil';

    protected $primaryKey = 'peta_id';

    protected $fillable = [
        'persil_id',
        'geojson',
        'panjang_m',
        'lebar_m',
    ];
    public function persil()
    {
        return $this->belongsTo(Persil::class, 'persil_id', 'persil_id');
    }

    // public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    // {
    //     foreach ($filterableColumns as $column) {
    //             if ($request->filled($column)) {
    //                 $query->where($column, $request->input($column));
    //             }
    //         }
    //     return $query;
    // }
    // public function scopeSearch($query, $request, array $searchableColumns)
    // {
    //     // Ambil search term dari request
    //     $searchTerm = $request->input('search');

    //     // Validasi
    //     if (empty($searchTerm) || !is_string($searchTerm)) {
    //         return $query;
    //     }

    //     $searchTerm = trim($searchTerm);

    //     // Cegah input berbahaya
    //     if (str_contains($searchTerm, 'HTTP/') || strlen($searchTerm) > 100) {
    //         return $query;
    //     }

    //     return $query->where(function($q) use ($searchTerm, $searchableColumns) {
    //         foreach ($searchableColumns as $column) {
    //             // Untuk kolom langsung di tabel peta_persil
    //             $q->orWhere($column, 'LIKE', '%' . $searchTerm . '%');
    //         }

    //         // Tambahkan search di relasi jika perlu
    //         $q->orWhereHas('persil', function($q2) use ($searchTerm) {
    //             $q2->where('nama', 'LIKE', '%' . $searchTerm . '%')
    //                ->orWhere('kode_persil', 'LIKE', '%' . $searchTerm . '%')

    //                ->orWhereHas('warga', function($q3) use ($searchTerm) {
    //                    $q3->where('nama', 'LIKE', '%' . $searchTerm . '%')
    //                       ->orWhere('nik', 'LIKE', '%' . $searchTerm . '%');
    //                });
    //         });
    //     });
    // }
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
}
