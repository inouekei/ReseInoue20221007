<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" rel="stylesheet">
  <style>
  /* common*/
    body{
      margin: 0;
    }

    .content{
      min-height: 100vh;
      margin: 0;
      padding: 20px 50px;
      background: lightgray;
    }
    .page-ttl{
      text-align: center;
      font-size: 25pt;
      font-weight: bold;
    }
    .btn-main{
      border: none;
      border-radius: 3px;
      padding: 5px 20px;
      background: darkblue;
      font-size: 10pt;
      text-decoration: none;
      color: white;
    }
    .input-main{
      height: 30px;
      margin-bottom: 10px;
      padding-left: 10px;
      border: none;
      border-radius: 5px;
    }
    .input-full{
      width: 100%;
    }
    /* common*/
    /* header*/
    .header-main{
      display: flex;
      justify-content: space-between;
      width: 100%;
      margin: 0;
    }
    .title-wrapper{
      display:flex;
    }
    #menu-btn-check {
      display: none;
    }
    .menu-btn {
      display: flex;
      height: 30px;
      width: 30px;
      border-radius: 5px;
      justify-content: center;
      align-items: center;
      z-index: 90;
      background-color: darkblue;
    }
    .bars,
    .bars:before,
    .bars:after {
      content: '';
      display: block;
      height: 1px;
      width: 16px;
      border-radius: 3px;
      background-color: white;
      position: absolute;
    }
    .bars:before {
      width: 8px;
      bottom: 5px;
    }
    .bars:after {
      width: 4px;
      top: 5px;
    }
    #menu-btn-check:checked ~ .menu-btn .bars {
      background-color: rgba(255, 255, 255, 0);
    }
    #menu-btn-check:checked ~ .menu-btn .bars::before {
      width: 16px;
      bottom: 0;
      transform: rotate(45deg);
    }    
    #menu-btn-check:checked ~ .menu-btn .bars::after {
      width: 16px;
      top: 0;
      transform: rotate(-45deg);
    }
    .menu-content {
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      right: 100%;
      z-index: 80;
      background-color: white;
      transition: all 0.5s;
    }
    .menu-list {
      padding: 70px 10px 0;
    }
    .menu-item {
      list-style: none;
      text-align: center;
      color: darkblue;
    }
    .menu-link {
      display: block;
      width: 100%;
      font-size: 15px;
      box-sizing: border-box;
      color: darkblue;
      text-decoration: none;
      padding: 9px 15px 10px 0;
    }
    #menu-btn-check:checked ~ .menu-content {
      right: 0;
    }
    .system-ttl{
      margin-left: 10px;
      line-height: 30px;
      font-size: 20px;
      font-weight: bold;
      color: darkblue;
    }
    /* header*/


    /* mini-disp */
    .disp-wrapper{
      height: 100%;
      display: flex;
      align-content: center;
    }

    .mini-disp{
      width: 400px;
    	margin: auto;
      border-radius: 10px;
    }

    .disp-main{
      padding: 50px;
      border-radius: 10px;
      background: white;
      text-align: center;
    }

    .p-message{
      font-weight: bold;
    }    
    /* mini-disp */
    /* right-form */
    .btn-right-form{
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 0 0 5px 5px;
      background: darkblue;
      color: white;
    }
    /* right-form */
    /* restaurant-card */
    .div-restaurant-card{
        width: 23%;
        margin: 0 15px 15px 0;
        border-radius: 5px;
        box-shadow: 3px 3px 3px 0 gray;
    }
    .div-restaurant-card-mypage{
        width: 40%;
        margin-bottom: 60px;
    }
    .div-restaurant-card-img{
        height: 150px;
        border-radius: 5px 5px 0 0;
        background-image: url('https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg');
        background-size: cover;
        background-position: center;
    }
    .div-restaurant-card-content{
        position: relative;
        border-radius: 5px;
        background: white;
        padding: 5px 15px;
    }
    .p-restaurant-name{
        margin-bottom: 0;
        font-weight: bold;
    }
    .btn-restaurant-card{
        display: block;
        width: 75px;
        margin: 10px 0;
        text-align: center;
    }
    .div-heart{
        position: absolute;
        right: 10px;
        bottom: 10px;
        font-size: 20pt;
        color: gray;
    }
    /* restaurant-card */
    </style>
</head>
<body>
  <div class="content">
    <header class='header-main'>
      <div class='title-wrapper'>
        <input type="checkbox" id="menu-btn-check">
        <label for="menu-btn-check" class="menu-btn">
          <span class='bars'></span>
        </label>
        <div class="menu-content">
          <ul class='menu-list'>
            @yield('menu-item')
          </ul>
        </div>
        <div class='system-ttl'>Rese</div>
      </div>
      @yield('header-item')
    </header>
    @yield('content')
  </div>
</body>
</html>