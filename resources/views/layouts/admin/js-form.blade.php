    <script>
        const url = "{{ route('persil.search') }}";
        const input = document.getElementById('search-persil');
        const box = document.getElementById('persil-result');
        const status = document.getElementById('search-status');
        let timer;

        input.onkeyup = () => {
            clearTimeout(timer);
            const q = input.value;
            if (q.length < 2) return;

            timer = setTimeout(() => {
                status.textContent = 'Mencari...';

                fetch(`${url}?q=${q}`)
                    .then(r => r.json())
                    .then(data => {
                        box.innerHTML = '';
                        if (!data.length)
                            return status.textContent = 'Data tidak ditemukan';

                        status.textContent = `${data.length} data ditemukan`;

                        data.forEach(p => {
                            const nama = p.warga?.nama ?? '-';
                            box.innerHTML += `
                            <a href="#" class="list-group-item"
                               onclick="pilihPersil(${p.persil_id}, '${p.kode_persil} - ${nama} -')">
                                <b>${p.kode_persil}</b><br>
                                <small>${nama}</small>
                            </a>`;
                        });
                    });
            }, 300);
        };

        function pilihPersil(id, text) {
            input.value = text;
            document.getElementById('persil_id').value = id;
            box.innerHTML = '';
            status.textContent = 'Persil dipilih';
        }

        /* ================= UPLOAD FILE ================= */
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('file-upload-container');
            const addBtn = document.getElementById('add-file-btn');

            addBtn.onclick = () => {
                container.insertAdjacentHTML('beforeend', `
                <div class="file-upload-item mb-2">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="file" name="media_files[]" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="media_captions[]" class="form-control form-control-sm"
                                   placeholder="Keterangan (opsional)">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-danger remove-file-btn">×</button>
                        </div>
                    </div>
                </div>
            `);
            };

            container.onclick = e => {
                if (e.target.classList.contains('remove-file-btn'))
                    e.target.closest('.file-upload-item').remove();
            };
        });
    </script>
