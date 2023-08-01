<style>
    #nav {
        list-style-type: none;
        display: flex;
        justify-content: space-around;
        margin-top: 13px;
        align-items: center;
    }

    .menu {
        cursor: pointer;
        padding: 10px 12px;
    }

    .menu:hover {
        cursor: pointer;
    }

    .menu:hover .product_sub_menu {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        position: absolute;
    }
    .product_sub_menu {
        margin-left: 30px;
        display:none;
        list-style-type: none;
    }
    .product_sub_menu:hover {
        list-style-type: none;
    }
    .product_list {
        border: 2px solid black;
        padding: 0 40px;
        border-radius: 3px;
        margin-left: 54px;
    }
    .product_list:hover {
        cursor: pointer;
        background-color: black;
        color: white;
        border: 2px solid black;
        padding: 0 40px;
        border-radius: 3px;
    }
    .product_list:hover .link{
        cursor: pointer;
        color: white;
    }
    #over {
        display: none;
        list-style-type: none;
        position: absolute;
        padding: 9px 0 0 0;
    }
    .user:hover #over{
        display: block;
    }
    .user li a:hover {
        color: #6868de;
    }
    #logout {
        display: none;
        list-style-type: none;
        position: absolute;
        top: 60px;
        right: 30px;
    }
    .user:hover #logout{
        display: block;
    }
    #logout:hover{
        color: #6868de;
    }

</style>

<header>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <nav class="header">
        <ul id="nav">
            <li id="menu">
                <img width="40px" src="../../image/celement%20cat.png">
            </li>
            <li class="menu">
                <a class="menu link" href="../pages/index.php"> PRODUCT
                    <img width="16px" src="../../image/down.png">
                </a>
                <ul class="product_sub_menu">
                    <li class="product_list">
                        <a class="link" name="shirt" href="../pages/shirt.php"> SHIRT </a>
                    </li>
                    <li class="product_list">
                        <a class="link" name="shirt" href="../pages/coat.php"> COAT </a>
                    </li>
                    <li class="product_list">
                        <a class="link" name="shirt" href="../pages/pant.php"> PANT </a>
                    </li>
                    <li class="product_list">
                        <a class="link" name="shirt" href="../pages/bag.php"> BAGS </a>
                    </li>
                </ul>

            </li>
            <li class="menu">
                <a class="menu link" href="../pages/best_seller.php">
                    BEST SELLER
                </a>
            </li>
            <li class="menu">
                <a class="menu link" href="../pages/new.php">
                    NEW
                </a>
            </li>
            <li class="menu">
                <a class="menu link" href="../contact/form.php">
                    CONTACT
                </a>
            </li>
            <li class="menu">
                <a class=" menu link" href="../carts/index.php">
                    <img width="30px" src="../../image/shopping-cart.png">
                </a>
            </li>
            <li class="menu user">
                <a href="../profile/index.php">
                    <img width="30px" src="../../image/user.png">
                </a>
                <?php
                if(!isset($_SESSION['email_customer'])) {
                ?>
                    <ul id="over">
                        <li>
                            <a class="link" href="../account/register.php">
                                Sign up
                            </a>
                        </li>
                        <li>
                            <a class=" link" href="../account/login_customer.php">
                                Login
                            </a>
                        </li>
                    </ul>
                <?php
                    }else {
                ?>
                    <a id="logout" class=" link" href="../account/logout_customer.php">
                        Logout
                    </a>
                <?php
                    }
                ?>
            </li>
        </ul>
    </nav>
</header>


