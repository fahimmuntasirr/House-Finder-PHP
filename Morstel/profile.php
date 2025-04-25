<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="output.css">
    <link rel="icon" type="image/png" href="icon.png">
    <title>Morstel</title>
</head>

<body class="bg-gray-800 flex flex-col min-h-screen scroll-smooth">
    <?php

    session_start();

    if ($_SESSION['user_id'] <= 0) {
        header("Location: login_signup.php");
        exit();
    }
    include 'components/conn.php';
    $id = $_SESSION['user_id'];
    $name = $_SESSION['fname'];

    $stmt = $conn->prepare("SELECT fname,lname,email,address,phone,pimage_loc FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($fname, $lname, $email, $address, $phone, $pimage_loc);
    $stmt->fetch();
    $stmt->close();
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
                        <li>
                            <div class="grid place-items-center grid-flow-col">
                                <div class="text-3xl mt-1">
                                    <ion-icon name="person-circle-outline"></ion-icon>
                                </div>
                                <a href="profile.php"><?php echo strtoupper($name) ?></a>
                            </div>
                        </li>
                        <li>
                            <?php
                            if ($_SESSION['logged_in']) echo "<a href='components/logout.php'>Logout</a>";
                            else "<a href='login_signup.php'>Login</a>";
                            ?>
                        </li>
                        <a href="post.php">
                            <li class="border px-4 py-1 rounded-2xl bg-white text-black">Make a post</li>
                        </a>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="text-white grid grid-cols-1 place-items-center">
            <div class="mb-5">
                <img src="<?php echo $pimage_loc ?>" alt="Not found" class="object-cover object-center h-64 w-64 rounded-full">
            </div>
            <div>
                <form action="components/profile_edit.php" enctype="multipart/form-data" method="post">
                    <div class="m-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="name">First Name</label>
                        <input type="text" name="fname" required value='<?php echo $fname ?>' class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2">
                    </div>
                    <div class="m-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="name">Last Name</label>
                        <input type="text" name="lname" required value='<?php echo $lname ?>' class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2">
                    </div>
                    <div class="m-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="number">Phone number</label>
                        <input type="text" name="phone" value="<?php echo $phone ?>" class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2">
                    </div>
                    <div class="m-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="address">address</label>
                        <input type="text" name="address" required value="<?php echo $address ?>" class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2">
                    </div>
                    <div class="m-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="email">Email</label>
                        <input type="email" name="email" required value="<?php echo $email ?>" class="col-span-2 ml-3 bg-transparent border rounded-lg p-1 pl-2">
                    </div>
                    <div class="m-4 text-xl font-sans grid grid-cols-3 items-center">
                        <label for="email">Profile Picture</label>
                        <input type="file" name="image" id="image" accept="image/*" class="col-span-2 ml-3 bg-transparent">
                    </div>
                    <div class="grid place-items-center mt-7">
                        <button type="submit" class="text-2xl border px-4 py-2 rounded-bl-3xl rounded-tr-3xl hover:bg-white hover:text-black">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        $stmt2 = $conn->prepare('select * from post where user_id=?');
        $stmt2->bind_param('i', $id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $stmt3 = $conn->prepare('select image_loc from post_image where post_id = ? limit 1');
                $stmt3->bind_param('i', $row['id']);
                $stmt3->execute();
                $result2 = $stmt3->get_result();
                $image = $result2->fetch_assoc();
                echo '
                    <div class="flex h-36 justify-between items-center border rounded-lg p-3 mx-28 text-white mt-6">
            <div class="flex justify-start h-36 p-3 items-center">
                <a href="view.php?id='.$row['id'].'" class="cursor-pointer"><img src="components/' . $image['image_loc'] . '" alt="" class="h-32 object-cover float-left ml-5 rounded-lg w-44 object-center"></a>
                <div class="ml-3">
                    <a href="view.php?id='.$row['id'].'" class="cursor-pointer"><p>' . htmlspecialchars($row['title']) . '</p></a>
                    <p class="overflow-hidden whitespace-nowrap text-ellipsis">' . htmlspecialchars($row['description']) . '</p>
                </div>
            </div>
            <div class="mr-16 border rounded-lg px-3 py-2">
                <a href="components/post_delete.php?id='.$row['id'].'"><button>Delete</button></a>
            </div>
        </div>';
            }
        }
        $conn->close();
        ?>

    </div>

    <footer
        class="bg-slate-400 grid grid-cols-1 items-center h-20 mt-16 place-items-center">
        <div>
            <p>All right reserve by @2024 Fahim Muntasir</p>
        </div>
    </footer>
</body>

</html>