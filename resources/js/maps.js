 function initMap() {
    // Inisialisasi peta
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: -6.2088, lng: 106.8456 }, // Ganti dengan koordinat awal yang diinginkan
        zoom: 12, // Sesuaikan zoom sesuai kebutuhan
    });

    // Tambahkan marker pada peta (diubah sesuai dengan lokasi yang dipilih)
    const marker = new google.maps.Marker({
        position: { lat: -6.2088, lng: 106.8456 }, // Ganti dengan koordinat lokasi yang dipilih
        map: map,
        draggable: true, // Aktifkan jika ingin marker dapat di-drag
        title: 'Lokasi Toko',
    });

    // Tambahkan event listener untuk mendapatkan koordinat saat marker digeser
    marker.addListener('dragend', function (event) {
        const latLng = event.latLng;
        console.log('Lokasi baru:', latLng.lat(), latLng.lng());

 });
