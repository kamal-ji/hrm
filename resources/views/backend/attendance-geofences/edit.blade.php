@extends('layouts.admin')

@section('content')
    <style>
        .autocomplete-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            /* Increase z-index to stay above the map and cards */
            z-index: 10000;
            max-height: 200px;
            overflow-y: auto;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .autocomplete-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            color: #333;
        }
    </style>
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('attendance-geofence.index') }}"><i
                                    class="isax isax-arrow-left me-2"></i>Attendance Geofence</a>
                        </h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Add Attendance Geofence</h5>
                            <form action="{{ route('attendance-geofence.update', $geofence->id) }}" id="createForm"
                                enctype="multipart/form-data">

                                <div class="row gx-3">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Geofence Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $geofence->name }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Approval Required</label>
                                            <select class="form-control" name="approval_required">
                                                <option value="1" {{ $geofence->approval_required == 1 ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ $geofence->approval_required == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                            <span id="approval_required_description"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 my-2" xrole="sites">
                                        @foreach($geofence->sites as $site)
                                            <div class="row site-item">
                                                <input type="hidden" class="latitude-input" name="sites[{{ $loop->index }}][latitude]" value="{{ $site->latitude }}">
                                                <input type="hidden" class="longitude-input" name="sites[{{ $loop->index }}][longitude]" value="{{ $site->longitude }}">
                                                
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">Site Name</label>
                                                    <input type="text" class="form-control" name="sites[{{ $loop->index }}][name]" value="{{ $site->name }}" required>
                                                </div>
                                                <div class="col-md-4 mb-2 position-relative">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control address-input" name="sites[{{ $loop->index }}][address]" value="{{ $site->address }}" required>
                                                    <div class="autocomplete-list"></div>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">Radius (meters)</label>
                                                    <input type="text" class="form-control radius-input" name="sites[{{ $loop->index }}][radius]" value="{{ $site->radius }}" required>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="map" style="height:300px;"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="button" class="btn btn-primary" onclick="addSite()">Add Site</button>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                                    <button type="submit" class="btn btn-primary submitBtn">Submit</button>

                                    <div class="spinner-border spinner-border-sm d-none loadingSpinner" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </form>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- End Content -->
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#createForm').on('submit', async function(e) {
                e.preventDefault();

                $('.submitBtn').prop('disabled', true);
                $('.loadingSpinner').removeClass('d-none');

                const formData = new FormData(this);

                $.ajax({
                    url: this.action,
                    method: 'PUT',
                    data: formData,
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message ||
                                'Attendance Geofence updated successfully');
                            window.location.href = response.redirect_url
                        } else {
                            showError(response.message || 'Something went wrong');
                        }
                    },
                    error: function(xhr) {
                        $('.form-error').remove();

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            for (let field in xhr.responseJSON.errors) {
                                if (xhr.responseJSON.errors.hasOwnProperty(field)) {
                                    let errorMsg = xhr.responseJSON.errors[field][0];

                                    // Find the field's input or label element
                                    let fieldElement = $('[name="' + field + '"]');

                                    // Create an error message element
                                    let errorElement = $('<div class="form-error"></div>')
                                        .text(errorMsg);

                                    // Append the error message below the field
                                    fieldElement.after(errorElement);
                                }
                            }

                        } else if (xhr.responseJSON.message) {
                            showError(xhr.responseJSON.message || 'An error occurred');
                        } else {
                            // If no specific error, show a generic error
                            showError('An error occurred');
                        }
                    },
                    complete: function() {
                        $('.submitBtn').prop('disabled', false);
                        $('.loadingSpinner').addClass('d-none');
                    }
                });
            });
        });
    </script>

    <script>
        function initOpenStreetMaps(site, latitude = false, longitude = false, radius = false) {

            let addressInput = site.querySelector('.address-input');
            let radiusInput = site.querySelector('.radius-input');
            let mapDiv = site.querySelector('.map');

            let map = L.map(mapDiv).setView([26.9124, 75.7873], 13);
            let marker, circle;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            function setLocation(lat, lng) {
                
                if (marker) map.removeLayer(marker);
                if (circle) map.removeLayer(circle);

                marker = L.marker([lat, lng]).addTo(map);

                let radius = radiusInput.value || 100;

                circle = L.circle([lat, lng], {
                    radius: radius
                }).addTo(map);

                site.querySelector('.latitude-input').value = lat;
                site.querySelector('.longitude-input').value = lng;
            }

            // Map click
            map.on('click', function(e) {
                setLocation(e.latlng.lat, e.latlng.lng);
            });

            // Radius change
            radiusInput.addEventListener('input', () => {
                if (marker) {
                    setLocation(marker.getLatLng().lat, marker.getLatLng().lng, radiusInput);
                }
            });

            radiusInput.addEventListener('keyup', (e) => {
                e.preventDefault();
                addressInput.dispatchEvent(new Event('keydown', {
                    key: 'Enter'
                }));
            });

            let autocompleteBox = site.querySelector('.autocomplete-list');
            let debounceTimer;

            // Typing event (auto search)
            addressInput.addEventListener('input', function() {
                let query = this.value.trim();
                clearTimeout(debounceTimer);

                if (query.length < 3) {
                    autocompleteBox.innerHTML = '';
                    return;
                }

                debounceTimer = setTimeout(() => {
                    // Nominatim prefers specific headers or params to identify the requester
                    fetch(
                            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=in&limit=5&addressdetails=1`)
                        .then(res => {
                            if (!res.ok) throw new Error("Rate limit or API error");
                            return res.json();
                        })
                        .then(data => {
                            autocompleteBox.innerHTML = '';

                            if (data.length === 0) {
                                let noResult = document.createElement('div');
                                noResult.className = 'autocomplete-item text-muted';
                                noResult.innerText = 'No results found';
                                autocompleteBox.appendChild(noResult);
                                return;
                            }

                            data.forEach(place => {
                                let item = document.createElement('div');
                                item.classList.add('autocomplete-item');
                                item.innerText = place.display_name;

                                item.addEventListener('click', () => {
                                    const lat = parseFloat(place.lat);
                                    const lon = parseFloat(place.lon);

                                    addressInput.value = place.display_name;
                                    autocompleteBox.innerHTML = ''; // Clear list

                                    map.setView([lat, lon], 17); // Zoom in closer
                                    setLocation(lat, lon);
                                });

                                autocompleteBox.appendChild(item);
                            });
                        })
                        .catch(err => {
                            console.error("Autocomplete error:", err);
                        });
                }, 500); // Increased debounce to 500ms for API safety
            });

            // Address search (Enter key)
            addressInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // stop form submit (IMPORTANT!)

                    let query = this.value.trim();
                    if (!query) return;

                    // Add slight delay (avoids rate limit)
                    setTimeout(() => {

                        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=in&limit=1`, {
                                headers: {
                                    'Accept': 'application/json'
                                }
                            })
                            .then(res => {
                                if (!res.ok) throw new Error("API error");
                                return res.json();
                            })
                            .then(data => {
                                if (data && data.length > 0) {

                                    let lat = parseFloat(data[0].lat);
                                    let lon = parseFloat(data[0].lon);

                                    map.setView([lat, lon], 15);
                                    setLocation(lat, lon);

                                    addressInput.value = data[0].display_name;

                                } else {
                                    alert('Location not found 😅');
                                }
                            })
                            .catch(err => {
                                console.error("Search error:", err);
                                alert("Search failed. Try again.");
                            });

                    }, 300);
                }
            });

            if(latitude && longitude && radius) {
                radiusInput.value = radius;
                map.setView([latitude, longitude], 15); 
                setLocation(latitude, longitude);
            }
        }

        function addSite() {
            jQuery('[xrole="sites"]').append(`
                <div class="row site-item">
                    <input type="hidden" class="latitude-input" name="sites[${jQuery('[xrole="sites"] .site-item').length}][latitude]">
                    <input type="hidden" class="longitude-input" name="sites[${jQuery('[xrole="sites"] .site-item').length}][longitude]">
                    
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Site Name</label>
                        <input type="text" class="form-control" name="sites[${jQuery('[xrole="sites"] .site-item').length}][name]" required>
                    </div>
                    <div class="col-md-4 mb-2 position-relative">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control address-input" name="sites[${jQuery('[xrole="sites"] .site-item').length}][address]" required>
                        <div class="autocomplete-list"></div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Radius (meters)</label>
                        <input type="text" class="form-control radius-input" name="sites[${jQuery('[xrole="sites"] .site-item').length}][radius]" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="map" style="height:300px;"></div>
                    </div>
                </div>
            `);

            initOpenStreetMaps(document.querySelector('[xrole="sites"] .site-item:last-child'));
        }

        window.addEventListener('load', function() {
            document.querySelectorAll('[xrole="sites"] .site-item').forEach(function(item) {
                initOpenStreetMaps(item, item.querySelector('.latitude-input').value, item.querySelector('.longitude-input').value, item.querySelector('.radius-input').value);
            });
        });
    </script>
@endpush
