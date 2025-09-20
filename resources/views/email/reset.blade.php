@extends('section.head')
<div class="main-wrapper">
    <div class="account-page">
        <div class="container">
            <h3 class="account-title text-center text-white">Change Password</h3>
            <div class="account-box">
                <div class="account-wrapper">
                    <div class="account-logo">
                        <a href="index.html"><img src="{{ asset('assets/img/logo.png') }}" alt="SchoolAdmin"></a>
                    </div>
                    <form method="POST" action="{{ route('forgot_password_change_process') }}" onsubmit="return validatePasswords()">
                        @csrf
                        
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label>New Repeat Password</label>
                            <input type="password" class="form-control" id="repeat-password" name="repeat_password" required>
                        </div>
                        <div id="password-error" class="text-danger"></div> <!-- Error message container -->
                        <div class="form-group m-b-0 text-center custom-mt-form-group">
                            <button class="btn btn-primary btn-block account-btn" type="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/app.js"></script>
 
<script>
    function validatePasswords() {
        const newPassword = document.getElementById('new-password').value;
        const repeatPassword = document.getElementById('repeat-password').value;
        const errorContainer = document.getElementById('password-error');
        
        if (newPassword !== repeatPassword) {
            errorContainer.textContent = 'Passwords do not match. Please try again.'; // Display error message
            return false;
        } else {
            errorContainer.textContent = ''; // Clear error message if passwords match
            return true;
        }
    }
</script>