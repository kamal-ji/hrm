<!DOCTYPE html>
<html lang="en">
<head>

  
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register |{{get('name')}} -</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="{{get('name')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . get('company_favicon')) }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/' . get('company_favicon')) }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/iconsax.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/backend/plugins/toastr/toatr.css')}}">

</head>

<body class="bg-white">

<div class="main-wrapper auth-bg">

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center vh-100 overflow-auto">

            <div class="col-lg-5 mx-auto">

                <form id="registerForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/' . get('company_logo')) }}" width="90">
                                <h5 class="mt-3">Create Account</h5>
                                <p class="text-muted">Join our network</p>
                            </div>

                            <!-- referralCode -->
                            <div class="mb-3">
                                <label class="form-label">referralCode (Optional)</label>
                                <input type="text" class="form-control" name="sponsor_code"
                                       placeholder="Enter referralCode" value="{{ $referralCode }}">
                            </div>

                            <!-- Name -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mobile *</label>
                                <input type="text" class="form-control" name="mobile" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Password *</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address1">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Country</label>
                                    <select class="form-control" name="countryid" id="countryid">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $c)
                                            <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">State</label>
                                    <select class="form-control" name="regionid" id="regionid">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Offline Payment Notice -->
                            <div class="alert alert-info">
                                <strong>Payment Mode:</strong> Offline <br>
                                Our team will contact you for activation.
                            </div>

                            <button type="submit" class="btn bg-primary-gradient text-white w-100"
                                    id="registerBtn">
                                Create Account
                            </button>

                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}">Already have an account? Sign In</a>
                            </div>

                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

</div>
 <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="topright-Toast" class="toast align-items-center text-white bg-danger border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <!-- Error message will be injected here -->
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
<!-- JS -->
<script src="{{ asset('assets/backend/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/toastr/toastr.min.js') }}"></script>

<script>
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#registerForm').submit(function (e) {
        e.preventDefault();

        $('#registerBtn').prop('disabled', true);

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('register.submit') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    
                    showSuccess(response.message);
                    window.location.href = response.redirect_url;
                } else {
                   
                    showError(response.message);
                }
            },
            error: function (xhr) {
                toastr.error('Registration failed');
                showError(xhr.responseJSON.message);
            },
            complete: function () {
                $('#registerBtn').prop('disabled', false);
            }
        });
    });

   $('#countryid').change(function() {
             var countryId = $(this).val();

             $.ajax({
                 url: '{{ route('getstates', ['countryId' => '%country%']) }}'.replace('%country%',
                     countryId),
                 type: 'GET',
                 success: function(response) {
                     $('#regionid').html('<option value="">Select</option>');

                     for (var i = 0; i < response.states.length; i++) {
                         $('#regionid').append('<option value="' + response.states[i].id + '">' +
                             response.states[i].name + '</option>');
                     }

                     $('#regionid').trigger('change');
                 }
             });
         });
});

  function showError(message) {
        // Display the message somewhere on the page — customize as needed
        const toastElement = document.getElementById('topright-Toast');
        const toastBody = toastElement.querySelector('.toast-body');

        if (toastBody) {
            toastBody.innerText = message;
        }

        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    }

    function showSuccess(message) {
        const toastElement = document.getElementById('topright-Toast');
        const toastBody = toastElement.querySelector('.toast-body');

        if (toastBody) {
            toastBody.innerText = message;
        }

        // Optionally, change background or class to indicate "success"
        toastElement.classList.remove('bg-danger'); // remove error style if present
        toastElement.classList.add('bg-success'); // add success style

        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    }
</script>

</body>
</html>
