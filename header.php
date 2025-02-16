<style>
        /* Navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 10px;
    background: linear-gradient(90deg, #5798ff,rgb(190, 187, 255));
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar a {
    color: #555;
    margin: 0 12px;
    font-size: 30x;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.navbar a:hover {
    color:rgb(255, 255, 255);
}

/* Menu */
.menu {
    text-align: center;
    background-color: #e9ecef;
    padding: 20px 0;
    border-bottom: 1px solid #ddd;
    position: sticky;
}

.menu ul {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 25px;
    padding: 0;
    margin: 0;
}

.menu a {
    font-weight: bold;
    font-size: 16px;
    color: #444;
}

.menu a:hover {
    color:rgb(27, 3, 102);
    text-decoration: underline;
}
    </style>

<nav class="navbar">
    <div class="nav-left">
        <a href="index.php">
            <img src="images/logo.png" alt="Rs Couture Logo" style="height: 40px; margin-right: 10px;">Rs Couture</a>
    </div>
    <div class="nav-right">
        <a href="cart.php">Cart 🛒</a>
        <a href="profile.php">Profile 👤</a>
    </div>
</nav>
<div class="menu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="winter.php">WINTER</a></li>
        <li><a href="women.php">WOMEN</a></li>
        <li><a href="men.php">MEN</a></li>
        <li><a href="kids.php">KIDS</a></li>
    </ul>
</div>

