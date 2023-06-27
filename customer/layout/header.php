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

    .menu:hover .sub-menu {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        position: absolute;
        margin-top: 3px;
        right: 40px;
    }

    .sub-menu {
        margin-left: 0;
        display:none;
        list-style-type: none;
    }

    .sub-menu:hover {
        list-style-type: none;
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
                <a class="menu link" href="../pages/contact.php">
                    CONTACT
                </a>
            </li>
            <li class="menu">
                <a class=" menu link" href="../carts/index.php">
                    <img width="30px" src="../../image/shopping-cart.png">
                </a>
            </li>
            <li class="menu">
                <a href="../profile/index.php">
                    <img width="30px" src="../../image/user.png">
                </a>
                <?php
                    if(!isset($_SESSION['email_customer'])) {
                    }else {
                ?>
                    <a class=" link" href="../account/login_customer.php">
                    </a>
                <?php
                    }
                ?>
            </li>
        </ul>
    </nav>
</header>


