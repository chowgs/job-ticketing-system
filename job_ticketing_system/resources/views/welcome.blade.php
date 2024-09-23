<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="/images/Layer_1.png" type="image/png">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Request System</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<style>
       <style>
        body {
            background-color: #121212;
            font-family: 'Arial', sans-serif;
            color: #ffffff;
        }

        .login-container {
            margin-top: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30vh;
        }
        .login-container1 {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
        }
        .login-card {
            border-radius: 15px;
            padding: 30px;
            width: 600px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .login-card1 {
           
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            padding: 50px;
            width: 300px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top:80px;
        }


        .card-text {
            margin-top:-40px;
            margin-bottom: 20px;
        }

       .btn, .btn1 {
        text-decoration:none;
        background-color: #F86F03;
        color: #fff;
        padding: 10px 15px;
        border-radius: 4px;
        }
       
         
        .login-card .logo {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 5px;
            margin-right: 10px;
           
        }
        .logo1{
            max-width: 250px;
            max-height: 250px;
            margin-bottom: -25px; 
            margin-right:10px;
        }

        .login-card .btn:hover {
            background-color: #e0e0e0;
        }




    </style>
    
</style>
</head>
<body>
    

<div class="container">
        <div class="row justify-content-center login-container">
            <div class="col-md-4">
                <div class="card login-card">
                    <div class="card-body">
                        <img src="{{ asset('images/Layer_1.png') }}" alt="Logo" class="logo mb-4">
                        <img src="{{ asset('images/welcome-head.png') }}" alt="Logo" class="logo1 mb-4">
                        <img src="{{ asset('images/Plogo.png') }}" alt="Logo" class="logo mb-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container1">
        <div class="row justify-content-center login-container1">
            <div class="col-md-6">
                <div class="card login-card1">
                    <div class="card-body">
                     
                        <br>
                        <div class=" ">
                            <a href="{{ route('login') }}" class="btn">Login</a>
                        </div>
                        <br>
                        <br>
                        <div>
                            <a href="{{ route('register') }}" class="btn1 ">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
