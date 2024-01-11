<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
            color: #9ABC66;
            font-size: 70px;
            line-height: 200px;
            margin-left: -15px;
            top: -20px !important;
            position: relative;
        }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
        width:35%;
      }
      a.btn.btn-primary {
        display: inline-block;
        margin-top: 30px;
        background-color: #0e6baf;
        color: #fff;
        text-decoration: none;
        padding: 15px 30px;
        border-radius: 3px;
        font-family: system-ui;
    }
    img {
        width: 160px;
        margin-bottom: 50px;
    }
    </style>
    <body>
      <div class="card">
          <img src="{{url('/public/frontend/assets/images/logoipmail.png')}}">
      <div style="border-radius:200px; height:150px; width:150px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Success</h1> 
        <p>Ip Authorized Successfully.</p>
        <a href="{{url('/')}}" class="btn btn-primary">Back To Home</a>
      </div>
    </body>
</html>