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
              <?php 
                if($_SESSION['logged_in']){
                  echo '<li><a href="profile.php">'.strtoupper($_SESSION['fname']) .'</a></li>';
                }
              ?>
            <li>
              <?php
              if ($_SESSION['logged_in']) {
                echo '<a href="components/logout.php">Logout</a>';
              } else {
                echo '<a href="login_signup.php">Login</a>';
              }
              ?>
            </li>
            <a href="/post.php">
              <li class="border px-4 py-1 rounded-2xl bg-white text-black">
                Make a post
              </li>
            </a>
          </ul>
        </div>
      </nav>
    </div>

    <?php
    $post_id = $_GET['id'];
    include 'components/conn.php';
    $stmt = $conn->prepare('select * from post where id = ?');
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt2 = $conn->prepare('select image_loc from post_image where post_id = ?');
    $stmt2->bind_param('i', $row['id']);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $image = $result2->fetch_assoc();
    echo '<div class="text-white px-16 mt-10">
    <div class="float-end flex items-center justify-center">
    <div class="text-3xl pt-2"><ion-icon name="alert-circle-outline"></ion-icon></div>
    <a href="report_confirmation.php?id=' . $post_id . '"><p class="text-2xl">Report</p></a>
    </div>
      <div class="flex">
        <div class="px-4">
          <img
            src="components/' . $image['image_loc'] . '"
            class="h-80 w-96 object-cover object-center rounded-lg"
            alt="Not found" />
        </div>
        <div class="flex-1 ml-10">
          <div class="text-3xl">
            <h1>' . htmlspecialchars($row['title']) . '</h1>
          </div>
          <div>
            <p>
              ' . htmlspecialchars($row['description']) . '
            </p>
          </div>
          <div>
            <p class="text-2xl">
              Location: <span class="font-bold">' . htmlspecialchars($row['address']) . '<span>
            </p>
          </div>
          <div class="inline-block mt-4">
            <div class="text-2xl mb-2 ml-2">
              <p>Call Now</p>
            </div>
            <div
              class="flex gap-2 items-center border px-4 py-2 rounded-full">
              <div class="text-3xl">
                <ion-icon name="call-outline"></ion-icon>
              </div>
              <div class="text-2xl">
                <p>' . htmlspecialchars($row['phone']) . '</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';
    ?>



    <div class="px-16 mt-5 text-white">
      <div class="text-center my-7 text-3xl border-b-2 pb-4">
        <p>More Picture</p>
      </div>
      <div class="px-4 grid grid-cols-3 gap-3">
        <?php
        while ($row = $result2->fetch_assoc()) {
          echo '
            <img
          src="components/' . $row['image_loc'] . '"
          class="h-80 w-96 object-cover object-center rounded-lg"
          alt="Not found" />
          ';
        }
        ?>
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