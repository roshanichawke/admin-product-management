<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <div class="container" style="width:500px">
        <h1>Login</h1>
        <!-- <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" >
            <input type="password" name="password" placeholder="Password" >
            <button type="submit">Login</button>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </form> -->

        <form id="login-form">
            @csrf
            <input type="email" name="email" placeholder="Email" >
            <div class="error-message" id="error-email"></div>

            <input type="password" name="password" placeholder="Password" >
            <div class="error-message" id="error-password"></div>

            <button type="submit">Login</button>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </form>
        <p>Don't have an account ? <a href="{{ route('register') }}">Register</a></p>
    </div>

    <script>
        $(document).ready(function() {

            $('#login-form').on('submit', function(e) {
                e.preventDefault();
                $('.error-message').html('');
                $('input, textarea').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('login') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // $('#success-message').html('<p>' + response.message + '</p>');
                        
                        if(response.success == 'true'){
                            toastr.success(response.message);
                                setTimeout(function() {
                                    window.location.href = response.redirect; 
                                }, 3000); 

                        }else{

                            toastr.error(response.message); 
                        }
                        
                      
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
