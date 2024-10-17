<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>
<body>
    <div class="container">
    <a href="{{ route('products.index') }}" title="Back to Products ">Back</a>
        <a href="{{ route('logout') }}">
            <button type="button" class="btn-logout btn-sm">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Log out
            </button>
        </a>
        <h1>Create Product</h1>
        <form id="create-product-form" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" id="name" placeholder="Product Name" >
            <div class="error-message" id="error-name"></div>

            <input type="text" id="amount" name="amount" placeholder="Amount" >
            <div class="error-message" id="error-amount"></div>

            <textarea name="description" id="description" placeholder="Description"></textarea>
            <div class="error-message" id="error-description"></div>

            <input type="file" name="image" id="image">
            <div class="error-message" id="error-image"></div>

            <div class="col-md-3">
                <button type="submit" style="float: right;">Create Product</button>
            </div>

        </form>
        <div id="success-message"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#amount').on('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '');
            });

            $('#create-product-form').on('submit', function(e) {
                e.preventDefault();
                $('.error-message').html('');
                $('input, textarea').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('products.store') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // $('#success-message').html('<p>' + response.message + '</p>');
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = response.redirect; 
                        }, 3000); 

                        $('#create-product-form')[0].reset();
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
