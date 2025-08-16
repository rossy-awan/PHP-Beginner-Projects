<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Auth' }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {font-family: 'Inter', sans-serif; background:#1e1e1e; color: #f5f5f5; display:flex; justify-content:center; align-items:center; min-height:100vh; margin:0;}
    .card {background:#252526; padding:2rem; border-radius:1rem; box-shadow:0 4px 20px rgba(0,0,0,.1); width:100%; max-width:400px; transform: translateY(20px); animation: fadeInUp .5s ease forwards;}
    @keyframes fadeInUp {
      to {
      opacity: 1;
      transform: translateY(0);
      }
    }
    .title {margin-bottom:1rem; font-weight:600;}
    .field {margin-bottom:1rem;}
    .field label {display: flex; align-items: center; gap: .5rem; font-size: .95rem;}
    .field input[type="checkbox"] {width: 16px; height: 16px;}
    input {width:100%; padding:.75rem; border:2px solid #3f3f3f; background: #2d2d2d; color: #f5f5f5; border-radius:.5rem; box-sizing: border-box; transition: border .25s ease;}
    input:focus {border:2px solid #eab308; outline: none;}
    button {width:100%; padding:.75rem; background:#3f3f3f; color:#f5f5f5; border:none; border-radius:.5rem; font-weight:600; cursor:pointer; transition: background .25s ease, transform .25s ease;}
    button:hover {background: #575757; transform: translateY(-1px);}
    .link {color:#eab308; text-decoration:none; transition: color .25s ease;}
    .link:hover {color: #facc15;}
    .error {color:#ef4444; font-size:.9rem; margin-bottom:1rem;}
  </style>
</head>
<body>
  <div class="card">
    @yield('content')
  </div>
</body>
</html>