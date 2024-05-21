<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evSXbVzTVFTLwD6lQmVUhJBfkhYHlwysEJ4BYWAN08t5q1z5eDQTKjmvzßpALqX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* Custom styles for the form */
        .form-container {
            max-width: 450px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #495057;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #495057;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .form-checkbox {
            margin-bottom: 15px;
            color: #495057;
        }

        .form-checkbox input[type="checkbox"] {
            display: inline-block;
            margin-right: 5px;
        }

        .form-checkbox label {
            cursor: pointer;
        }

        .form-button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .form-button:hover {
            background-color: #0056b3;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .form-footer a:hover {
            color: #0056b3;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            color: #ccc;
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="form-container">
                        <div class="form-title">Sign In</div>
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                        </div>
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                        </div>
                        <form action="" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example3">Email address</label>
                                <input type="email" name="email" id="form3Example3" class="form-input"
                                    placeholder="Enter a valid email address" />
                                @error('email')
                                    <small  class="text-danger ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form3Example4">Password</label>
                                <input type="password" name="password" id="form3Example4" class="form-input"
                                    placeholder="Enter password" />
                                @error('password')
                                    <small class="text-danger ">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" value=""
                                        id="form2Example3" />
                                    <label class="form-check-label" for="form2Example3">Remember me</label>
                                </div>
                                <a href="#!" class="text-body">Forgot password?</a>
                            </div>
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="form-button">Login</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
                                        class="link-danger">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
