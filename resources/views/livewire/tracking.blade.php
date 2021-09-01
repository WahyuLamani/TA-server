<div wire:poll.1s="updateData">
    <div id='map' style='width: 100%; height: 75vh;' wire:ignore></div>
</div>

@push('scripts')
<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoid2FoeXVsYW1hbmkiLCJhIjoiY2tzeWxvczJ0MmwwNjJxbjFlczl4Mms4MSJ9.S5X5pfxaMq0574epma-A2g';

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [124.8891153, 1.4221726],
        zoom: 9.6
        // center: [106.827, -6.1747],
        // zoom: 8
    });

    const updateMarker = (markers) => {
        // const markers = {!! $geoJson !!};
        markers.features.forEach((loc) => {
            const { geometry, properties } = loc;
            const { id, name, image } = properties;
            // hapus dulu markernya
            try {
                document.getElementById('marker-' + id).remove();
            } catch(err) {

            }

            // buat marker ulang
            const markElement = document.createElement('div');

            markElement.className = 'marker' + id;
            markElement.id = 'marker-' + id;
            markElement.style.backgroundImage = 'url(https://dtspolimdo.tech/assets/images/truck2.png)';
            markElement.style.backgroundSize = 'cover';
            markElement.style.width = '50px';
            markElement.style.height = '50px';

            const template = `<div style="overflow-y,auto; max-height:400px, width:100%">
                                    <table class="table table-sm mt-2">
                                        <tbody>
                                            <tr>
                                                <td>Title</td>
                                                <td>${name}</td>
                                            </tr>
                                            <tr>
                                                <td>picture</td>
                                                <td><img src="uploads/${image}" loading="lazy" width="50px" class="img-fluid"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>`;

            const popUp = new mapboxgl.Popup({
                offset: 25,
            }).setHTML(template).setMaxWidth("400px");

            new mapboxgl.Marker(markElement)
                .setLngLat(geometry.coordinates)
                .setPopup(popUp)
                .addTo(map)
        });
    };
</script>
<script>
    window.addEventListener('marker-updated', (event) => {
        const { newLocation } = event.detail;
        updateMarker(JSON.parse(newLocation));
    });
</script>
@endpush