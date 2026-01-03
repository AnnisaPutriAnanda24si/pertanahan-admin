 @extends('layouts.admin.app')

 @section('content')
     {{-- Start Main Content --}}
     {{-- form --}}

     <div class="card">
         <div class="card-header">
             <div class="d-flex justify-content-between align-items-center">
                 <h4 class="card-title mb-0">Data Tabel
                 </h4>
                 <a href="{{ url()->previous() }}" class="btn btn-primary btn-border btn-round">
                     <i class="fa fa-arrow-left"></i> Kembali
                 </a>
             </div>
         </div>
         <div class="card-body">
             <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                 @csrf
                 @method('PUT')

                 <div class="row">
                     <!-- Kolom Kiri -->
                     <div class="col-md-6">
                         <!-- Nama Lengkap -->
                         <div class="form-group">
                             <label for="nama">Nama Lengkap</label>
                             <input type="text" id="nama" name="nama" value="{{ old('nama', $warga->nama) }}"
                                 placeholder="Masukkan nama lengkap"
                                 class="form-control @error('nama') is-invalid @enderror">
                             @error('nama')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>

                     <!-- Kolom Kanan -->
                     <div class="col-md-6">
                         <!-- No. KTP -->
                         <div class="form-group">
                             <label for="no_ktp">No. KTP</label>
                             <input type="text" id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $warga->no_ktp) }}"
                                 placeholder="Masukkan nomor KTP"
                                 class="form-control @error('no_ktp') is-invalid @enderror">
                             @error('no_ktp')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                 </div> {{-- Akhir Row 1 --}}

                 <div class="row">
                     <!-- Kolom Kiri -->
                     <div class="col-md-6">
                         <!-- Jenis Kelamin (Select) -->
                         <div class="form-group">
                             <label for="jenis_kelamin">Jenis Kelamin</label>
                             <select id="jenis_kelamin" name="jenis_kelamin"
                                 class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                 <option value="">-- Pilih Jenis Kelamin --</option>
                                 <option value="Male"
                                     {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Male' ? 'selected' : '' }}>
                                     Laki-laki
                                 </option>
                                 <option value="Female"
                                     {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Female' ? 'selected' : '' }}>
                                     Perempuan
                                 </option>
                             </select>
                             @error('jenis_kelamin')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>

                     <!-- Kolom Kanan -->
                     <div class="col-md-6">
                         <!-- Agama -->
                         <div class="form-group">
                             <label for="agama">Agama</label>
                             <input type="text" id="agama" name="agama" value="{{ old('agama', $warga->agama) }}"
                                 placeholder="Masukkan agama" class="form-control @error('agama') is-invalid @enderror">
                             @error('agama')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                 </div> {{-- Akhir Row 2 --}}

                 <div class="row">
                     <!-- Kolom Kiri -->
                     <div class="col-md-6">
                         <!-- Pekerjaan -->
                         <div class="form-group">
                             <label for="pekerjaan">Pekerjaan</label>
                             <input type="text" id="pekerjaan" name="pekerjaan"
                                 value="{{ old('pekerjaan', $warga->pekerjaan) }}" placeholder="Masukkan pekerjaan"
                                 class="form-control @error('pekerjaan') is-invalid @enderror">
                             @error('pekerjaan')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>

                     <!-- Kolom Kanan -->
                     <div class="col-md-6">
                         <!-- Email -->
                         <div class="form-group">
                             <label for="email">Email</label>
                             <input type="email" id="email" name="email" value="{{ old('email', $warga->email) }}"
                                 placeholder="Masukkan email" class="form-control @error('email') is-invalid @enderror">
                             @error('email')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                 </div> {{-- Akhir Row 3 --}}

                 <div class="row">
                     <!-- Telp (Mengambil seluruh lebar baris, karena hanya 1 input tersisa) -->
                     <div class="col-md-6">
                         <div class="form-group">
                             <label for="telp">Telp</label>
                             <input type="text" id="telp" name="telp" value="{{ old('telp', $warga->telp) }}"
                                 placeholder="Masukkan nomor telp" class="form-control @error('telp') is-invalid @enderror">
                             @error('telp')
                                 <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                 </div> {{-- Akhir Row 4 --}}


                 <!-- Tombol (Simpan dan Batal) - Tetap di Kanan -->
                 <div class="card-action d-flex justify-content-end">
                     <button type="submit" class="btn btn-success me-2">
                         <i class="fas fa-save"></i> Simpan Perubahan
                     </button>
                     <a href="{{ route('warga.index') }}" class="btn btn-danger">
                         <i class="fas fa-times"></i> Batal
                     </a>
                 </div>
             </form>
         </div>
     </div>

     {{-- form --}}
     {{-- End Main Content --}}
 @endsection
