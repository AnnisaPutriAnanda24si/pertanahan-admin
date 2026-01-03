<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email'
    ];

    public function persil()
    {
        return $this->hasMany(Persil::class, 'pemilik_warga_id', 'warga_id');
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
    public function scopeSearchWarga($query, $q)
    {
        if (!$q) return $query;

        return $query->where(function ($query) use ($q) {
            $query->where('nama', 'like', "%{$q}%")
                ->orWhere('no_ktp', 'like', "%{$q}%")
                ->orWhere('telp', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%");
        });
    }
}
