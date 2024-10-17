<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <div class="container" style="width:500px">
        <h1>Register</h1>
        <!-- <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Name" >
            <input type="email" name="email" placeholder="Email" >
            <input type="password" name="password" placeholder="Password" >
            <input type="password" name="password_confirmation" placeholder="Confirm Password" >
            <button type="submit">Register</button>
        </form> -->

        <form id="registration-form">
            @csrf
            <input type="text" name="name" placeholder="Name" >
            <div class="error-message" id="error-name"></div>

            <input type="email" name="email" placeholder="Email" >
            <div class="error-message" id="error-email"></div>

            <input type="password" name="password" placeholder="Password" >
            <div class="error-message" id="error-password"></div>

            <input type="password" name="password_confirmation" placeholder="Confirm Password" >

            <button type="submit">Register</button>
        </form>
        <p>If you already have an account, click on the <a href="{{ route('login') }}">Login</a></p>
    </div>

    <script>
        $(document).ready(function() {

            $('#registration-form').on('submit', function(e) {
                e.preventDefault();
                $('.error-message').html('');
                $('input, textarea').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('register') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                            toastr.success(response.message);
                                setTimeout(function() {
                                    window.location.href = response.redirect; 
                                }, 3000); 
                      
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('#error-' + key).html(value[0]);
                                $('#' + key).addClass('is-invalid');
                            });
                        }
                    }
                });
            });


            toastr.options = {
                "progressBar": true,
                "positionClass": 'toast-center', 
                "timeOut": "3000", 
            };
        });
    </script>
</body>
</html>
