<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="icon.png">
    <link rel="stylesheet" href="output.css">
    <title>House Finder</title>
</head>

<body class="bg-gray-800 flex flex-col min-h-screen scroll-smooth">
    <?php session_start(); ?>
    <div class="flex-grow">
        <nav class="flex justify-between items-center p-3 text-white md:px-16 ">
            <div>
                <a href='index.php'><h1 class="text-4xl text-white font-semibold">House Finder</h1></a>
            </div>
            <div> 
                <ul class="flex gap-10 items-center justify-center">
                    <li class="border px-4 py-1 rounded-2xl"><a href="index.php">Home</a></li>
                    <?php
                    $temp = 0;
                    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
                        $temp = 1;
                    } else {
                        $name = strtoupper($_SESSION["fname"]);
                        echo "
                        <li>
                        <div class=\"grid place-items-center grid-flow-col\">
                            <div class=\"text-3xl mt-1\">
                                <ion-icon name=\"person-circle-outline\"></ion-icon>
                            </div>
                            <a href=\"profile.php\">$name</a>
                        </div>
                        </li>
                            ";
                    }
                    ?>
                    <li>
                        <!-- <a href="#">Login</a> -->
                        <?php
                        if ($temp) {
                            echo "<a href='login_signup.php'>login</a>";
                        } else {
                            echo "<a href='components/logout.php'>logout</a>";
                        }
                        ?>
                    </li>
                    <a href="post.php">
                        <li class="border px-4 py-1 rounded-2xl bg-white text-black">Make a post</li>
                    </a>
                </ul>
            </div>
        </nav>
        <section>
            <div class="bg-black h-[500px] text-white">
                <div class="flex flex-col justify-center items-center h-full">
                    <div id="timeEvent" class="text-mono text-5xl pb-2 duration-500">00:00:00</div>
                    <h1 class="text-4xl">Welcome to Our website</h1>
                    <h1 class="text-2xl">Here you can find your desired home</h1>
                    <a href="#post" class="border px-3 py-1 rounded-xl pb-2 m-5 shadow shadow-white hover:shadow-md hover:shadow-white"><button>Start Searching</button></a>
                </div>
            </div>
        </section>
        <section class="">
            <div class="mb-4">
                <div class="text-white text-3xl mx-5 my-4 text-center">
                    <h1 id="post">Posts</h1>
                </div>
                <hr>
            </div>

            <div class="grid grid-cols-4 p-2 px-10 gap-5">
                <?php
                include 'components/conn.php';

                $stmt = $conn->prepare('select * from post');
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $stmt2 = $conn->prepare('select image_loc from post_image where post_id = ? limit 1');
                        $stmt2->bind_param('i',$row['id']);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        $image = $result2->fetch_assoc();
                        echo '
                        <div class="border p-2 rounded px-5">
                    <div>
                        <img class="rounded-md object-cover object-center h-52 w-full" src="components/'.$image['image_loc'].'" alt="Not Found">
                    </div>
                    <div>
                        <div class="text-white py-2">
                            <h1 class="text-2xl text-center">'.$row['title'].'</h1>
                            <p class="px-3 text-center overflow-hidden whitespace-nowrap text-ellipsis">'.$row['description'].'</p>
                        </div>
                        <button class="text-white bg-black w-full py-2 rounded-xl text-center hover:scale-90"><a href="view.php?id='.htmlspecialchars($row['id']).'">Show</a></button>
                    </div>
                </div>
                        ';
                    }
                }

                ?>
                <!-- <div class="border p-2 rounded px-5">
                    <div>
                        <img class="rounded-md object-cover object-center h-52 w-full" src="image.png" alt="Not Found">
                    </div>
                    <div>
                        <div class="text-white py-2">
                            <h1 class="text-2xl text-center">Apartment with 5 bedroom</h1>
                            <p class="px-3 text-center">This is a very wonderfull home with 5 bedrroms</p>
                        </div>
                        <button class="text-white bg-black w-full py-2 rounded-xl text-center hover:scale-90"><a href="view.php">Show</a></button>
                    </div>
                </div>
                <div class="border p-2 rounded px-5">
                    <div>
                        <img class="rounded-md object-cover object-center h-52 w-full" src="image.png" alt="Not Found">
                    </div>
                    <div>
                        <div class="text-white py-2">
                            <h1 class="text-2xl text-center">Apartment with 5 bedroom</h1>
                            <p class="px-3 text-center">This is a very wonderfull home with 5 bedrroms</p>
                        </div>
                        <button class="text-white bg-black w-full py-2 rounded-xl text-center hover:scale-90"><a href="view.php">Show</a></button>
                    </div>
                </div>
                <div class="border p-2 rounded px-5">
                    <div>
                        <img class="rounded-md object-cover object-center h-52 w-full" src="image.png" alt="Not Found">
                    </div>
                    <div>
                        <div class="text-white py-2">
                            <h1 class="text-2xl text-center">Apartment with 5 bedroom</h1>
                            <p class="px-3 text-center">This is a very wonderfull home with 5 bedrroms</p>
                        </div>
                        <button class="text-white bg-black w-full py-2 rounded-xl text-center hover:scale-90"><a href="view.php">Show</a></button>
                    </div>
                </div>
                <div class="border p-2 rounded px-5">
                    <div>
                        <img class="rounded-md object-cover object-center h-52 w-full" src="image.png" alt="Not Found">
                    </div>
                    <div>
                        <div class="text-white py-2">
                            <h1 class="text-2xl text-center">Apartment with 5 bedroom</h1>
                            <p class="px-3 text-center">This is a very wonderfull home with 5 bedrroms</p>
                        </div>
                        <button class="text-white bg-black w-full py-2 rounded-xl text-center hover:scale-90"><a href="view.php">Show</a></button>
                    </div>
                </div> -->
            </div>
        </section>
    </div>
    <footer
        class="bg-slate-400 grid grid-cols-1 items-center h-20 mt-16 place-items-center">
        <div>
            <p>All right reserve by @2024 Fahim Muntasir</p>
        </div>
    </footer>
    <script src="main.js"></script>

</body>

</html>