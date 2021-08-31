<div>
    <div id='map' style='width: 100%; height: 75vh;'></div> 
</div>

    

@push('scripts')
<script>
    document.addEventListener('livewire:load', () => {
        mapboxgl.accessToken = 'pk.eyJ1Ijoid2FoeXVsYW1hbmkiLCJhIjoiY2tzeWxvczJ0MmwwNjJxbjFlczl4Mms4MSJ9.S5X5pfxaMq0574epma-A2g';
        let map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [124.8891153, 1.4221726],
        zoom: 9.6
        });
        map.on('load', () => {
            const coordinats = []

            const loadLocations = (geoJson) => {
                geoJson.features.forEach((location) => {
                    const {geometry, properties} = location
                    const {id,name,image} = properties
                    
                    let markElement = document.createElement('div')
                    markElement.className = 'marker' + id
                    markElement.id = id
                    markElement.style.backgroundImage = 'url(https://cdn.iconscout.com/icon/free/png-256/truck-shipping-logistic-delivery-transport-supply-vehicle-export-5-20575.png)'
                    markElement.style.backgroundSize = 'cover'
                    markElement.style.width = '50px'
                    markElement.style.height = '50px'

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
                                        </div>`
                    const popUp = new mapboxgl.Popup({
                        offset:25
                    }).setHTML(template).setMaxWidth("400px")
                    new mapboxgl.Marker(markElement)
                    .setLngLat(geometry.coordinates)
                    .setPopup(popUp)
                    .addTo(map)

                })
            }
            loadLocations({!! $geoJson !!})
            map.on('click', (e) => {
                let longtitude = e.lngLat.lng
                let lattitude = e.lngLat.lat
                console.log({longtitude, lattitude});
            })
        });
    });
    
</script>
@endpush