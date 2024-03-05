<x-app-layout>
    <div class="pagetitle">
        <h1>Create Issue</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user-issues') }}">Issues</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
    {{-- <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="address_address">Address</label>
            <input type="hidden" name="order_id" value="1" required/>
            <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
            <input type="hidden" name="address_longitude" id="address-longitude" value="0" />

            <input type="hidden" name="lat" id="lat" value="" />
            <input type="hidden" name="lon" id="lon" value="" />
            <div class="row">
                <div class="col-lg-9">
                    <input type="text" id="address-input" name="address_address" class="form-control map-input" required>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary">Add Address</button>
                </div>
            </div>
        </div>
    </form>
    <div id="address-map-container" style="width:100%;height:400px; " class="mt-2">
        <div style="width: 100%; height: 100%" id="address-map"></div>
    </div>
    <script>
        let latitu = document.getElementById('address-latitude').value;
        let latinput = document.getElementById('lat');

        let longitu = document.getElementById('address-longitude').value;
        let longinput = document.getElementById('lon');
        if(latitu !== 0)
        {
            latinput.value = latitu;
            longinput.value = longitu;
        }

    </script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" async></script>

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <section class="section">
        <div class="row">
            <div class="col-12 mb-3">
                <x-alert/>
            </div>
            <div class="col-md-6">
                <div id="map"></div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Faulty Reporting Form</h3>
                        <form action="{{ route('user-issues-store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">
                                    Coordinates
                                    <code>(specify by clicking points on map!)</code>
                                </label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="coordinates" id="coordinates" value="" readonly required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="description" required>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Submit Faulty</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let coords = document.getElementById('coordinates');
        console.log(coords.value);
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -19.515914654050317, lng: 29.839833748559467},
                zoom: 10
            });

            map.addListener('click', function(event) {
                var clickedLocation = event.latLng;
                coords.value = clickedLocation.lat()+","+clickedLocation.lng();
                console.log(clickedLocation.lat(), clickedLocation.lng());
                // You can do more here, such as displaying the coordinates on the page
            });
        }
    </script>
</x-app-layout>
