<!--cookie-->
<div class="cookie_bot" id="test">
        <div class="cookie_main">
            <div class="cookie_cont">
                <p><b>Cookies & Privacy</b> <br>By using this website, you automatically accept that we use cookies. <a href="<?php echo base_url.$lang ?>/privacy-policy" target="_blank"> What for?</a></p>
                <button class="understand_btn" id="test" onClick="savCookie()">I Understand</button>
            </div>
            <div class="clearBoth"></div>
            <style>
            .cookie_cont{
                text-align:center;
            }
                .cookie_bot {
                    padding: 20px;
                    font-size: 16px;
                    position: fixed;
                    left: 0;
                    bottom: 0;
                     width: 100%; 
                    color: #ffffff;
                    background: #00538b;
                    z-index: 1000;
                     opacity: 0.95; 
                }
                .understand_btn {
                    background: #ba0c15;
                    border: none;
                    color: white;
                    padding: 1% 4%;
                    margin-top: 10px;
                    cursor: pointer;
                    font-weight: bold;
                }
                .cookie_bot p{
                    line-height: 1.5;
                }
                .cookie_bot p a{
                    color: #ffffff;
                    text-decoration: underline;
                }
                @media screen and (min-width: 680px){
                    .cookie_bot {
                        width: 400px;
                    }
                }

            </style>
                  <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>

            <script>
                $(document).ready(function () {
                setTimeout(function () {
                    if ("undefined" != typeof Storage) {
                        var e = localStorage.getItem("cookieenabled");
                            console.log(e), "Yes" == e ? $(".cookie_bot").hide() : $(".cookie_bot").fadeIn();
                        }
                    }, 2e3);
                });
                var cookieStatus = localStorage.getItem("cookieenabled");
                function savCookie() {
                    localStorage.setItem("cookieenabled", "Yes"), $(".cookie_bot").fadeOut();
                }
                console.log(cookieStatus), "Yes" == cookieStatus ? $(".cookie_bot").hide() : $(".cookie_bot").fadeIn();

            </script>
        </div>
    </div>