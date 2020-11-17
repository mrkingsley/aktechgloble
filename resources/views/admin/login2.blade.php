<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>hi Class</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
        <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="wrapper" style="background-image: url('../images/registration-form-2.jpg');color: white;font-size:17px">
			<div class="inner">
            <h3>login</h3>

            @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were problems with input:
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

            <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">

					
						<div class="form-wrapper{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name">Email</label>
                            <input type="email" 
                            class="form-control"style="color:white"  name="email" value="{{ old('email') }}">
						</div>
                  
                   
					<div class="form-wrapper{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="">Password</label>
                        <input type="password"
                        class="form-control"style="color:white" name="password">
					</div>
					
					<div class="form-wrapper">
                    <a href="{{ route('auth.password.reset') }}">Forgot your password?</a>
                    </div>
                    
					<div class="checkbox">
						<label>
							<input type="checkbox"name="remember"> I Remember me
							<span class="checkmark"></span>
						</label>
					</div>
					<button type="submit" class="btn btn-primary">
                    Login
                                </button>

                               
                                
				</form>
			</div>
		</div>
		
	</body>
</html>