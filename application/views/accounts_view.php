<div class="loginform">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Comments site</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="/accounts/login">
                            <fieldset>
                                <div class="form-group">
                                    <input id="email" class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input id="password" class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <a href="javascript:login()" class="btn btn-success btn-block">Login</a>
                                <p>New user? <a href="signUp.html" class="">Sign up</a></p>
                            </fieldset>
                            <p class="text-center">or login</p>
                            <fb:login-button scope="public_profile,email" autologoutlink="true" onlogin="checkLoginState();">
                            </fb:login-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function login() {
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "/accounts/login",
            data: {
                'email' : email,
                'password' : password
            },
            success: function(data){
                alert(data);
                window.location.replace("http://localhost:8080/messages");
            }
        });
    }

function checkLoginState(){
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

function statusChangeCallback(response){
    FB.login(function(response) {
        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', {fields: "id,name,email"}, function(response) {
                var email = response.email;
                $.ajax({
                    type: "POST",
                    url: "/accounts/facebook_auth",
                    data: {
                        'Email' : email
                    },
                    success: function(data){
                        alert(data);
                       // window.location.replace("http://localhost:8080/messages");
                    }
                });
            });
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    },{scope: 'email'});
}
    
</script>