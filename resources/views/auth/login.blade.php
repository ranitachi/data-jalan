<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.includes.head-tag')    
    <style>
        .margin60 {
            margin-top: 60px !important;
        }
    </style>
</head>
<body style="background:#2f3b59;">
    <div class="col-md-3"></div>
    <div class="col-md-6 margin60">
        <div class="main-register fl-wrap">
            <h3>Login Form - <span>Gebrak<strong> Pakumis</strong></span></h3>
            <div id="tabs-container" style="margin-top: 0px;">
                <div class="tab">
                    <div id="tab-1" class="tab-content">
                        <div class="custom-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <label>Username or Email Address * </label>
                                <input name="email" type="text" value="{{ old('email') }}" required autofocus> 

                                <label>Password * </label>
                                <input name="password" type="password" required>

                                <div style="text-align:center;">
                                    <button type="submit" class="log-submit-btn"><span>Log In</span></button> 
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <span style="float:left;color:red;">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <li>
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </li>
                                        </span>
                                    @endif
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <li>
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </li>
                                        </span>
                                    @endif
                                </span>
                            </form>
                        </div>
                    </div>  
                </div>                
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</body>
</html>