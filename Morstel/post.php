<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="output.css">
    <link rel="icon" type="image/png" href="icon.png">
    <title>Morstel</title>
</head>

<body class="bg-gray-800 flex flex-col min-h-screen scroll-smooth">
    <?php
        session_start();
        if(!$_SESSION['logged_in']){
            header("Location: login_signup.php");
            exit();
        }
    ?>
    <div class="flex-grow">
        <div>
            <nav class="flex justify-between items-center p-3 text-white md:px-16 ">
                <div>
                    <h1 class="text-4xl text-white font-semibold">Morstel</h1>
                </div>
                <div>
                    <ul class="flex gap-10 items-center justify-center">
                        <li class="border px-4 py-1 rounded-2xl"><a href="index.php">Home</a></li>
                        <li><a href="profile.php"><?php echo strtoupper($_SESSION['fname']) ?></a></li>
                        <li><a href="components/logout.php">Logout</a></li>
                        <a href="post.php">
                            <li class="border px-4 py-1 rounded-2xl bg-white text-black">Make a post</li>
                        </a>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="grid place-items-start h-screen my-2">
            <div class="text-white pl-16">
                <div class=" text-3xl border-b-2 block p-2">
                    <h1>Fill in the information</h1>
                </div>
                <form action="components/post.php" enctype="multipart/form-data" method="post">
                    <div class="my-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="title">Title</label>
                        <input type="text" name="title" required class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2">
                    </div>
                    <div class="my-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="description">Description</label>
                        <textarea name="description" id="" required class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2"></textarea>
                    </div>
                    <div class="my-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="address">Address</label>
                        <input type="text" name="address" required class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2">
                    </div>
                    <div class="my-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="">Phone Number</label>
                        <input type="text" name="phone" required class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2">
                    </div>
                    <div class="my-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="picture">Upload picture</label>
                        <input type="file" name="image1" required accept="image/*" class="col-span-2 ml-3 bg-transparent  p-1 pl-2">
                    </div>
                    <div class="my-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="picture">Upload picture</label>
                        <input type="file" name="image2" required accept="image/*" class="col-span-2 ml-3 bg-transparent  p-1 pl-2">
                    </div>
                    <div class="my-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="picture">Upload picture</label>
                        <input type="file" name="image3" required accept="image/*" class="col-span-2 ml-3 bg-transparent  p-1 pl-2">
                    </div>
                    <div class="my-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="picture">Upload picture</label>
                        <input type="file" name="image4" required accept="image/*" class="col-span-2 ml-3 bg-transparent  p-1 pl-2">
                    </div>
                    <div class="grid place-items-end">
                        <button class="shadow shadow-white text-2xl border px-4 py-2 rounded-bl-3xl rounded-tr-3xl hover:bg-white hover:text-black">Post</button>
                    </div>
                </form>
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