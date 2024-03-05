<x-app-layout>
    <div class="pagetitle">
        <h1>{{ $issue->title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user-issues') }}">Issues</a></li>
                <li class="breadcrumb-item active">#{{ $issue->id }}</li>
            </ol>
        </nav>
    </div>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <div id="map"></div>

    <script>
        function initMap() {
            var coordinates = {lat: {{ $issue->lat }}, lng: {{ $issue->long }}}; // Default coordinates (San Francisco)
            var map = new google.maps.Map(document.getElementById('map'), {
                center: coordinates,
                zoom: 15 // Zoom level
            });

            var marker = new google.maps.Marker({
                position: coordinates,
                map: map,
                title: 'Your Location'
            });
        }
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap">
    </script>

    <section class="section mt-3">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card card-body">
                    <h3 class="card-title">Faulty Details</h3>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">Title</th>
                                <td>{{$issue->title}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description</th>
                                <td>{{$issue->description}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>{{$issue->status}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Coordinates</th>
                                <td>{{$issue->lat}},{{$issue->long}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Artisan</th>
                                <td>{{get_assigned_artisan($issue->id)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h3>Comments</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-5">
                        @foreach ($threads as $thread)
                            <div class="card-body">
                                <div class="d-flex flex-start align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-primary mb-1">{{thread_sender($thread->user_id)}}</h6>
                                        <p class="text-muted small mb-0">
                                            Shared publicly - {{$thread->created_at->diffForHumans()}}
                                        </p>
                                    </div>
                                </div>
                                <p class="mt-3 mb-4 pb-2">{{ $thread->details }}</p>
                            </div>
                        @endforeach
                        <form action="{{ route('admin-thread-store') }}" class="card-footer py-3 border-0" style="background-color: #f8f9fa;" method="POST">
                            @csrf
                            <input type="hidden" name="issue_id" value="{{$issue->id}}" required>
                            <div class="d-flex flex-start w-100">
                                <div class="form-outline w-100">
                                    <textarea name="details" class="form-control" id="textAreaExample" rows="3" required></textarea>
                                    <label class="form-label" for="textAreaExample">Message</label>
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                <button type="reset" class="btn btn-outline-primary btn-sm">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
