<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Totired Trail</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:
            linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
            url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee');
            background-size:cover;
            background-position:center;
        }

        .login-container{
            width:420px;
            background:rgba(255,255,255,.1);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,.2);
            border-radius:20px;
            padding:40px;
            color:white;
            box-shadow:0 20px 40px rgba(0,0,0,.3);
        }

        .logo{
            text-align:center;
            margin-bottom:10px;
        }

        .logo i{
            font-size:55px;
            color:#f2870c;
        }

        .title{
            text-align:center;
            font-size:28px;
            font-weight:700;
            margin-bottom:5px;
        }

        .subtitle{
            text-align:center;
            color:#ddd;
            margin-bottom:30px;
            font-size:14px;
        }

        .form-group{
            margin-bottom:18px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            font-size:14px;
        }

        .input-group{
            position:relative;
        }

        .input-group i{
            position:absolute;
            left:15px;
            top:50%;
            transform:translateY(-50%);
            color:#aaa;
        }

        .form-control{
            width:100%;
            padding:14px 14px 14px 45px;
            border:none;
            border-radius:12px;
            background:rgba(255,255,255,.15);
            color:white;
            outline:none;
        }

        .form-control::placeholder{
            color:#ddd;
        }

        .login-btn{
            width:100%;
            padding:14px;
            border:none;
            border-radius:12px;
            background:#f2870c;
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .login-btn:hover{
            background:#d97200;
        }

        .error{
            background:#ff4d4d;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
            font-size:14px;
        }

        .footer{
            text-align:center;
            margin-top:20px;
            color:#ccc;
            font-size:13px;
        }

        .back-home{
            text-align:center;
            margin-top:15px;
        }

        .back-home a{
            color:#f2870c;
            text-decoration:none;
        }

        .back-home a:hover{
            text-decoration:underline;
        }

        @media(max-width:500px){
            .login-container{
                width:90%;
                padding:30px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">

    <div class="logo">
        <i class="fas fa-mountain"></i>
    </div>

    <h1 class="title">Totired Trail</h1>
    <p class="subtitle">Admin Dashboard Login</p>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Email</label>

            <div class="input-group">
                <i class="fas fa-envelope"></i>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <label>Password</label>

            <div class="input-group">
                <i class="fas fa-lock"></i>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter your password"
                    required
                >
            </div>
        </div>

        <button type="submit" class="login-btn">
            Login
        </button>
    </form>

    <div class="back-home">
        <a href="{{ route('home') }}">
            ← Back to Website
        </a>
    </div>

    <div class="footer">
        © {{ date('Y') }} Totired Trail
    </div>

</div>

</body>
</html>
