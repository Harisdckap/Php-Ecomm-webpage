<!-- Header Page -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcommerceSite Webapge</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-style: italic;
        }
    </style>
<body>
    <div class=" p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="index.php"><span class="text-blue text-xl font-bold">HRS-Ecommerce</span></a>
            </div>
            <div class="relative">
                <form method="get" action="#">
                    <input type="text" name="search" placeholder="Search" class="w-100 bg-gray-300 text-white rounded-full py-2 px-4 pl-10 focus:outline-none focus:bg-gray-600 focus:text-gray-200" style="width: 100%;">
                </form>

                <div class="absolute top-0 left-0 ml-3 mt-2">
                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class=" py-2 ">
        <div class="container mx-auto flex gap-6 items-center ml-0">
            <button id="shop-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">
                Shop Products
            </button>
            <button id="blog-btn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Blog
            </button>
        </div>
    </div>
    <hr class="border-black-600">


    <!-- javascript -->
    <script>
        document.getElementById("shop-btn").addEventListener("click", function() {
            window.location.href = "/view/products.php";

        });
        document.getElementById("blog-btn").addEventListener("click", function() {
            window.location.href = "/view/blog.php";
        });
    </script>

</body>

</html>