<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DokumenPersil extends Model
{
    protected $table = 'dokumen_persil';

    protected $primaryKey = 'dokumen_id';

    protected $fillable = [
        'persil_id',
        'nomor',
        'jenis_dokumen',
        'keterangan',
    ];
    public function persil()
    {
        return $this->belongsTo(Persil::class, 'persil_id', 'persil_id');
    }

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
                if ($request->filled($column)) {
                    $query->where($column, $request->input($column));
                }
            }
        return $query;
    }
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
