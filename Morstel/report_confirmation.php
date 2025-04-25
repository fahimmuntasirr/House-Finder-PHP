<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script
    type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script
    nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="output.css">
  <link rel="icon" type="image/png" href="icon.png">
  <title>Morstel</title>
</head>

<body class="bg-gray-800 flex flex-col min-h-screen scroll-smooth">
  <?php session_start() ?>
  <div class="flex-grow">
    <div>
      <nav class="flex justify-between items-center p-3 text-white md:px-16">
        <div>
          <h1 class="text-4xl text-white font-semibold">Morstel</h1>
        </div>
        <div>
          <ul class="flex gap-10 items-center justify-center">
            <li class="border px-4 py-1 rounded-2xl">
              <a href="/index.php">Home</a>
            </li>
            <li><a href="/profile.php"><?php echo strtoupper($_SESSION['fname']) ?></a></li>
            <li><a href="/login_signup.php">Login</a></li>
            <a href="/post.php">
              <li class="border px-4 py-1 rounded-2xl bg-white text-black">
                Make a post
              </li>
            </a>
          </ul>
        </div>
      </nav>
    </div>

    <div class="grid place-items-center mt-36 text-white">
        <div class="border h-[150px] w-[450px] rounded-lg grid place-items-center">
            <div class="text-2xl">
                <p>Do you want to report this post?</p>
            </div>
            <div class="flex gap-10 text-xl">
                <a href="components/report.php?id=<?php echo $_GET['id'] ?>" class="border px-4 py-1 rounded-lg"><button>Yes</button></a>
                <a href="view.php?id=<?php echo $_GET['id']?>" class="border px-4 py-1 rounded-lg"><button>No</button></a>
            </div>
        </div>
    </div>

    </div>

    

  <footer
    class="bg-slate-400 grid grid-cols-1 items-center h-20 mt-16 place-items-center">
    <div>
      <p>All right reserve by @2024 Fahim Muntasir</p>
    </div>
  </footer>
</body>

</html>