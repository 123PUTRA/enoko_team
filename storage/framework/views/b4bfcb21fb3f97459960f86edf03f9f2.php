<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Alamat Toko:</h2>

        <!-- Formulir untuk alamat -->
        <form action="<?php echo e(route('save.selected.location')); ?>" method="post" id="locationForm">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="provinsi">Provinsi:</label>
                <select id="provinsi" name="provinsi" class="form-control">
                    <option value="">Pilih Provinsi</option>
                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($province->code); ?>"><?php echo e($province->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Pilih Kabupaten/Kota -->
            <div class="form-group">
                <label for="kabupaten">Kabupaten/Kota:</label>
                <select id="kabupaten" name="kabupaten" class="form-control">
                    <option value="">Pilih Kabupaten/Kota</option>
                </select>
            </div>

            <!-- Pilih Kecamatan -->
            <div class="form-group">
                <label for="kecamatan">Kecamatan:</label>
                <select id="kecamatan" name="kecamatan" class="form-control">
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>

            <!-- Tambahkan elemen input hidden untuk menyimpan data alamat -->
            <input type="hidden" id="selectedProvince" name="selectedProvince">
            <input type="hidden" id="selectedCity" name="selectedCity">
            <input type="hidden" id="selectedDistrict" name="selectedDistrict">

            <!-- Tombol untuk menyimpan alamat -->
            <button type="submit" class="btn btn-success" id="simpanAlamatBtn">Simpan Alamat</button>
        </form>

        <!-- Tampilkan peta -->
        <div id="map" style="height: 400px;"></div>
    </div>

    <!-- Sertakan library Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Panggil fungsi initMap setelah library Google Maps dimuat -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQHEz8nAu6iJL-_MGIJh48In5LYcrJH9o&libraries=places&callback=initMap" async defer></script>

    <script>
        let marker;

        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -6.2088, lng: 106.8456 },
                zoom: 12,
            });

            marker = new google.maps.Marker({
                position: { lat: -6.2088, lng: 106.8456 },
                map: map,
                draggable: true,
                title: 'Lokasi Toko',
            });

            // Tambahkan listener dragend ke marker di sini
            marker.addListener('dragend', function (event) {
                const latLng = event.latLng;
                console.log('Lokasi baru:', latLng.lat(), latLng.lng());
            });
        }

        // Pastikan bahwa objek google sudah didefinisikan sebelum memanggil initMap
        if (typeof google !== 'undefined') {
            initMap();
        }

        const provinsiDropdown = document.getElementById('provinsi');
        const kabupatenDropdown = document.getElementById('kabupaten');
        const kecamatanDropdown = document.getElementById('kecamatan');

        provinsiDropdown.addEventListener('change', function (e) {
            const selectedProvinsiId = provinsiDropdown.value;
            fillKabupatenDropdown(selectedProvinsiId);
            saveSelectedLocation();
        });

        kabupatenDropdown.addEventListener('change', function (e) {
            const selectedKabupatenId = kabupatenDropdown.value;
            fillKecamatanDropdown(selectedKabupatenId);
            saveSelectedLocation();
        });

        function fillKabupatenDropdown(selectedProvinsiId) {
            axios.get(`/provinsi/${selectedProvinsiId}/cities`)
                .then(response => {
                    const kabupatenData = response.data;
                    kabupatenDropdown.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                    kecamatanDropdown.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kabupatenData.forEach(kabupaten => {
                        const option = document.createElement('option');
                        option.value = kabupaten.code;
                        option.textContent = kabupaten.name;
                        kabupatenDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error in Axios:', error);
                });
        }

        function fillKecamatanDropdown(selectedKabupatenId) {
            axios.get(`/kabupaten/${selectedKabupatenId}/districts`)
                .then(response => {
                    const kecamatanData = response.data;
                    kecamatanDropdown.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kecamatanData.forEach(kecamatan => {
                        const option = document.createElement('option');
                        option.value = kecamatan.code;
                        option.textContent = kecamatan.name;
                        kecamatanDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error in Axios:', error);
                });
        }

        function saveSelectedLocation() {
            const selectedProvince = provinsiDropdown.value;
            const selectedCity = kabupatenDropdown.value;
            const selectedDistrict = kecamatanDropdown.value;
            document.getElementById('selectedProvince').value = selectedProvince;
            document.getElementById('selectedCity').value = selectedCity;
            document.getElementById('selectedDistrict').value = selectedDistrict;
            updateMapMarker(selectedProvince, selectedCity);
        }

        function updateMapMarker(selectedProvince, selectedCity) {
            // Gantilah ini dengan logika untuk menentukan koordinat toko berdasarkan provinsi dan kota yang dipilih
            const newLatLng = { lat: -6.2088, lng: 106.8456 };
            marker.setPosition(newLatLng);
            map.setCenter(newLatLng);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\enoko1\E-noko\resources\views/locations/locationform.blade.php ENDPATH**/ ?>