@extends('section.head')
<div class="main-wrapper">
    <div class="account-page">
        <div class="container">
            <h3 class="account-title text-white">Forgot Password</h3>
            <div class="account-box">
                <div class="account-wrapper">
                    <div class="account-logo">
                        <a href="">
                        <a href=""><img src="{{ asset('assets/img/logo.png') }}" alt="SchoolAdmin"></a>
                        </a>
                    </div>
                    <div id="loader" style="display: none;">Loading...</div>
                 <div id="forgot_msg"></div>
                    <form id="forgot-password-form">
                   
                        <div class="form-group">
                            <label>Enter  Email</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group text-center custom-mt-form-group" >
                            <button class="btn btn-primary btn-block account-btn"  type="submit">Reset Password</button>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('login') }}">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>      
</div>
 
   
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--<script src="assets/js/jquery.slimscroll.js"></script>-->
<!--<script src="assets/js/app.js"></script>-->
 
<script>
    $(document).ready(function() {
       
        $('#forgot-password-form').on('submit', function(e){
           
            e.preventDefault();
        
            var email = $('input[name="email"]').val();
            $('#loader').show();  // Show the loader
 
            $.ajax({
                url: '{{ route('password-email') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email
                },
                success: function(response) {
					
                    if(response.status === 'success') {
                        $('#forgot_msg').html('<div class="alert alert-success">' + response.msg + '</div>');
                    } else {
                        $('#forgot_msg').html('<div class="alert alert-danger">' + response.msg + '</div>');
                    }
                },
                complete: function() {
                    $('#loader').hide();  // Hide the loader when the request completes
                },
               
            });
        });
    });
</script>
