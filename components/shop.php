<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENRADES</title>

    <!-- FOonti Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
      font-family: 'Roboto', sans-serif;
    }

    header {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .header-text {
      text-align: center;
      height: 30px;
      font-family: sans-serif;
      font-size: 13px;
    }

    .hr {
      margin-top: 12px;
      border: 1px solid pink;
      width: 100%;
    }

    .header-a {
      height: 200px;
      display: flex;
      align-items: center;
    }

    .header-a a {
      text-decoration: none;
      color: black;
      margin-left: 20px;
    }

    .header-a .active {
      border-bottom: 2px solid #000;
    }

    .logo a {
      color: pink;
      margin-right: 200px;
      text-decoration: none;
    }

    .search-bar {
      margin-left: 250px;
      display: flex;
      align-items: center;
    }

    .search-input {
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-left: 5px;
    }

    

    .footer {
      height: 150px;
    }
       
        .hg {
    box-sizing: border-box;
    display: inline-block;
    width: 33%;
    text-align: center;
    padding: 0 20px;
   
}
       
    </style>
</head>

<body>
    <header>
        <div class="header-text">
            <p>Hey Bukuroshe, Mire se erdhe ne ENRADES</p>
        </div>
        <div class="hr"></div>
        <div class="header-a">
            <div class="logo">
                <a href="./kreu.html">
                    <h1>ENRADES</h1>
                </a>
            </div>
            <a href="./kreu.html">Kreu</a>
            <a href="./about.html">Kush jemi</a>
            <a href="./shop.html" class="active">Shop</a>
            <a href="./kontakti.html">Na Kontaktoni</a>

       
            <div class="search-bar">
                <span>Search:</span>
                <input type="text" class="search-input" placeholder="Type here...">
            </div>
        </div>
    </header>


    <div class="hg"> 
        <a href="./blush.html" style="color: #000;">   
            <img src="../img/blush.jpg" style="height:300px;" alt="Kuqalashe Blush Duo">
           <p> Blush  </p>
        </a>
        <hr>
        </div>
        <div class="hg">
            <a href="./bronzer.html" style="color: #000;">   
                <img src="../img/bronzer.jpg" style="height:300px;" alt="Kuqalashe Blush Duo">
                <p>Bronzer</p>  
            </a>
        <hr>
        </div>
        <div class="hg">
        <a href="./highlighter.html" style="color: #000;">
            <img src="../img/highlighter.jpg" style="height:300px;" alt="Highlighter">
          <p>  Highlighter </p>
        </a>
        <hr>
    </div>
    <div class="footer"></div>

</body>

</html>