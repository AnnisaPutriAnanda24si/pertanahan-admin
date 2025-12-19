    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hapus file dengan konfirmasi
            document.querySelectorAll('.delete-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const fileId = this.getAttribute('data-id');
                    const fileName = this.getAttribute('data-name');

                    if (confirm(`Hapus file "${fileName}"?`)) {
                        fetch(`/persil/media/${fileId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Hapus baris dari tabel
                                    this.closest('tr').remove();

                                    // Tampilkan alert
                                    const alert = document.createElement('div');
                                    alert.className =
                                        'alert alert-success alert-dismissible fade show';
                                    alert.innerHTML = `
                                <i class="fas fa-check-circle me-2"></i>
                                File berhasil dihapus
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            `;

                                    // Insert alert di atas tabel
                                    document.querySelector('.table-responsive').insertBefore(
                                        alert, document.querySelector('table'));

                                    // Auto remove alert setelah 3 detik
                                    setTimeout(() => {
                                        alert.remove();
                                    }, 3000);

                                    // Jika tidak ada file lagi
                                    if (document.querySelectorAll('tbody tr').length === 0) {
                                        document.querySelector('tbody').innerHTML = `
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                            Belum ada file untuk persil ini
                                        </td>
                                    </tr>
                                `;
                                    }
                                } else {
                                    alert('Gagal menghapus file');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan');
                            });
                    }
                });
            });
        });
    </script>
