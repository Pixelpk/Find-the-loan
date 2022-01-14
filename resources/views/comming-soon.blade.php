<!DOCTYPE html>
<html>
    <head>
        @include('customer.pages.css')
    </head>
<style>
    
body, html {
  height: 100%;
  margin: 0;
}

.bgimg {
  background-image: url('/assets/images/forestbridge.jpg');
  height: 100%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: white;
  font-size: 25px;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottom {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%)
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 40%;
}
.font-sm{
font-size: 1rem !important;
}
</style>
<body>

<div class="bgimg">
  <div class="topleft">
    <p>FindTheLoan</p>
  </div>
  <div class="middle">
    <h1>COMING SOON</h1>
    <hr>
    <div class="card card-body p-0 mb-5">
        <iframe width="600" height="409" src="https://www.youtube.com/embed/fbT68DuwAHc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>   
    </div>
  </div>
  <div class="bottom">
    <p class="lead font-sm">We are adding the finishing touches, conducting security tests and will be available in just a few more weeks. Just waiting for the paint to dry. To get notified when 
        we launch or to hear what our Financing Partners say about us, follow us at <a class="text-info" href="https://www.facebook.com/FindTheLoan">Findtheloan</a> Patent pending.
    </p>
</div>
</div>

</body>
</html>
