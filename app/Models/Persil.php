<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Persil extends Model
{
    protected $table = 'persil';
    protected $primaryKey = 'persil_id';
    protected $fillable = [
        'kode_persil',
        'pemilik_warga_id',
        'luas_m2',
        'penggunaan',
        'alamat_lahan',
        'rt',
        'rw'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'pemilik_warga_id', 'warga_id');
    }
    public function dokumen_persil()
    {
        return $this->hasMany(DokumenPersil::class,'persil_id','persil_id');
    }

    public function sengketa_persil()
    {
        return $this->hasMany(SengketaPersil::class,'persil_id','persil_id');
    }

    public function peta_persil()
    {
        return $this->hasMany(PetaPersil::class,'persil_id','persil_id');
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
        return $query;
    }
    public function scopeSearchPersil($query, $q)
    {
        if (!$q) return $query;

        return $query->where(function ($query) use ($q) {
            $query->where('kode_persil', 'like', "%{$q}%")
                ->orWhereHas('warga', function ($q2) use ($q) {
                    $q2->where('nama', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('telp', 'like', "%{$q}%");
                });
        });
    }

}
