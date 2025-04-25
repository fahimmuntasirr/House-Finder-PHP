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

<body class="bg-gray-800 text-white mt-2 flex flex-col min-h-screen">
  <div class="flex-grow">
    <div class="grid grid-cols-1 place-items-center">
      <div>
        <h1 class="text-4xl font-semibold">Morstel</h1>
      </div>
      <div class="text-3xl pt-4">
        <h1>Welcome to our Website</h1>
      </div>
      <div>
        <div class="grid grid-cols-2 items-center gap-20 mt-20">
          <div
            id="login"
            class="border border-white p-10 rounded-md shadow shadow-slate-100 hover:shadow-lg hover:shadow-slate-100">
            <div class="text-3xl font-semibold text-center pb-6">Login</div>
            <div>
              <form onsubmit="submittingLogin(event)" method="post" id="loginForm">
                <label for="email" class="block py-2 text-lg">Email</label>
                <input
                  type="email"
                  name="email"
                  class="text-black rounded-md outline-none pl-2 py-1 w-60"
                  placeholder="example@gmail.com"
                  id="email" />
                <div id="emailError" class="text-red-500"></div>
                <label for="password" class="block py-2 text-lg">Password</label>
                <div
                  onclick="showpass()"
                  id="passShow"
                  class="absolute text-black pt-1 text-lg ml-[13rem] block">
                  <ion-icon name="eye-outline"></ion-icon>
                </div>
                <input
                  type="password"
                  name="password"
                  class="text-black rounded-md outline-none pl-2 py-1 w-60"
                  id="password" />
                <div id="passwordError" class="text-red-500"></div>
                <br />
                <button
                  type="submit"
                  class="border border-white px-3 py-1 mt-2 rounded-lg hover:shadow-md hover:shadow-slate-400 float-right">
                  Login
                </button>
              </form>
            </div>
          </div>
          <div
            id="signup"
            class="border border-white p-10 rounded-md shadow shadow-slate-100 hover:shadow-lg hover:shadow-slate-100">
            <div class="text-3xl font-semibold text-center pb-6">Signup</div>
            <div class="text-1xl font-semibold text-center pb-6" id="create_success"></div>
            <div>
              <form onsubmit="submittingSignup(event)" method="post" id="signupForm">
                <label for="fname" class="block py-2 text-lg">First Name</label>
                <input
                  type="text"
                  name="fname"
                  class="text-black rounded-md outline-none pl-2 py-1 w-60"
                  id="fname" />
                <div id="fnameError" class="text-red-500"></div>
                <label for="Email" class="block py-2 text-lg">Last Name</label>
                <input
                  type="text"
                  name="lname"
                  class="text-black rounded-md outline-none pl-2 py-1 w-60"
                  id="lname" />
                <div id="lnameError" class="text-red-500"></div>
                <label for="Email" class="block py-2 text-lg">Email</label>
                <input
                  type="email"
                  name="semail"
                  class="text-black rounded-md outline-none pl-2 py-1 w-60"
                  id="semail" />
                <div id="semailError" class="text-red-500"></div>
                <label for="Address" class="block py-2 text-lg">Address</label>
                <input
                  type="text"
                  name="address"
                  class="text-black rounded-md outline-none pl-2 py-1 w-60"
                  id="address" />
                <label for="Password" class="block py-2 text-lg">Password</label>
                <div
                  onclick="showpass2()"
                  id="passShow2"
                  class="absolute text-black pt-1 text-lg ml-[13rem] block">
                  <ion-icon name="eye-outline"></ion-icon>
                </div>
                <input
                  type="password"
                  name="spassword"
                  class="text-black rounded-md outline-none pl-2 py-1 w-60"
                  id="spassword" />
                <div id="spasswordError" class="text-red-500"></div>
                <br />
                <button
                  type="submit"
                  class="block border border-white px-3 py-1 mt-2 rounded-lg hover:shadow-md hover:shadow-slate-400 float-right">
                  Signup
                </button>
              </form>
            </div>
          </div>
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
  <script src="login_signup.js"></script>
</body>

</html>