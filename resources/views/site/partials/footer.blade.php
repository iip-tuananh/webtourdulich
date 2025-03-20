<footer id="footer">
    <div class="container">
        <div class="row_pc">
            <div class="colMenuft">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-6">
                            <h2 class="footer__title">
                                {{$category->name}}
                            </h2>
                            <ul class="listFooter">
                                @foreach($category->childs as $child)
                                    <li class="menu-item"><a href="{{ route('front.tour-category', ['slug' => $category->slug, 'childSlug' => $child->slug]) }}" class="menu-link">
                                            {{$child->name}}                       </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
{{--    <div class="menuFooter hidden-xs hidden-sm">--}}
{{--        <div class="container">--}}
{{--            <div class="row_pc">--}}
{{--                <p class="buttonClick visible-sm visible-xs">Danh mục <i class="fa fa-bars" aria-hidden="true"></i> </p>--}}
{{--                <ul>--}}
{{--                    <li><a href="https://vietlandtravel.vn/">Trang chủ</a></li>--}}
{{--                    <li><a href="https://vietlandtravel.vn/danh-muc/tour-nuoc-ngoai.html">--}}
{{--                            TOUR QUỐC TẾ            </a></li>--}}
{{--                    <li><a href="https://vietlandtravel.vn/danh-muc-tin/diem-den.html">--}}
{{--                            Điểm đến            </a></li>--}}
{{--                    <li><a href="https://vietlandtravel.vn/danh-muc-tin/tin-tuc.html">--}}
{{--                            Tin tức            </a></li>--}}
{{--                    <li><a href="https://vietlandtravel.vn/danh-muc-tin/cam-nang-du-lich.html">--}}
{{--                            Cẩm nang du lịch            </a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="footer--bottom">
        <div class="container">
            <div class="row_pc">
                <div class="row">
                    <div class="col-md-6">
                        <div class="company--top">

                            <!--<h3>Vietland Travel, du lịch trọn gói trong nước và quốc tế</h3>-->

                            <p style="text-align:center"><strong><span style="font-size:14px">C&Ocirc;NG TY TNHH VIETLAND HOLIDAY&nbsp;</span></strong></p>

                            <p style="text-align:center"><span style="color:#003300"><span style="font-size:14px"><strong>( </strong>VIETLAND TRAVEL<strong> )</strong></span></span></p>

                            <p style="text-align:center"><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>GP Lữ H&agrave;nh quốc tế</strong>&nbsp;:<strong> <a href="https://quanlyluhanh.vn/index.php/search?tendn=c%C3%B4ng+ty+tnhh+vietlandholiday&amp;sogiayphep=01-516%2F2017&amp;diaphuong=&amp;phamvihd=&amp;btnsearch11=&amp;keyword=">01-516 / TCDL-GPLHQT</a></strong> </span></span></p>

                            <p style="text-align:center"><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>M&atilde; số doanh nghiệp</strong> : <a href="https://masothue.com/0104113015-cong-ty-tnhh-vietlandholiday">0104113015</a></span></span></p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6 col-480-12">
                                <div class="footerAddress">
                                    <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>VĂN PH&Ograve;NG TẠI H&Agrave; NỘI</strong></span></span></p>

                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>Địa chỉ: </strong>Số 15 Y&ecirc;n L&atilde;ng,&nbsp;Q. Đống Đa, H&agrave; Nội</span></span></p>

                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><strong><span style="font-size:14px">Office:</span></strong><span style="font-size:14px"> <a href="tel:024 6296 5430">024 6296 5430</a> // <a href="tel:024 6 6565 988">024 6 6565 988</a></span></span></p>

                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>Hotline</strong> :&nbsp; <a href="tel:098 868 1927">098 868 1927</a> // <a href="tel:09 11 2020 88">09 11 2020 88</a></span></span></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6 col-480-12">
                                <div class="footerAddress">
                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>Email</strong> : sales@vietlandtravel.vn // booking@vietlandtravel.vn</span></span></p>

                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>Email: </strong>travel@vietlandholiday.com</span></span></p>

                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:14px"><strong>Website</strong>: <a href="https://vietlandtravel.vn/">www.vietlandtravel.vn</a> &nbsp;// &nbsp;<a href="https://vietlandholiday.com/">www.vietlandholiday.com&nbsp;</a></span></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footerPhotoList">
                            <div id="myModal" class="modal">
                                <div class="overlayModal"></div>
                                <span class="close">&times;</span>
                                <img class="modal-content" id="img0">
                                <img class="modal-content" id="img1">
                                <div id="caption"></div>
                            </div>
                            <div class="giayphep">
                                <a target="_blank" href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=42819"><img style="display: block;max-width: 165px;margin:0 auto 10px;width:100%;height: auto;" src="https://vietlandtravel.vn/assets/css/img/bocongthuong.png" alt="bct" title="Đăng ký bộ công thương" ></a>
                                <img style="cursor: pointer"  id="myImg0" src="https://vietlandtravel.vn/upload/img/banner/ban-copy-2-min.png" alt="" title="" >
                                <img style="cursor: pointer"  id="myImg1" src="https://vietlandtravel.vn/upload/img/banner/vietland-travel-giay-phep.png" alt="" title="" >
                            </div>
                            <div class="fbFanPage">
                                <!-- <a href="https://www.facebook.com/VietlandTravel.vn/"><img width="100%" src="https://vietlandtravel.vn/img/fanpage.png"></a> -->

                                <div class="content_right">
                                    <div style="padding: 10px" class="cover_connect">
                                        <div id="fb-root"></div>
                                        <script>(function(d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s); js.id = id;
                                                js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11';
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));</script>
                                        <div class="fb-page" data-href="https://www.facebook.com/VietlandTravel.vn/" data-tabs="timeline" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/VietlandTravel.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/VietlandTravel.vn/">Facebook</a></blockquote></div>
                                    </div>
                                </div>              </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var modal = document.getElementById('myModal');
                var img = document.getElementById('myImg0');
                var img2 = document.getElementById('myImg1');
                var modalImg = document.getElementById("img0");
                var modalImg2 = document.getElementById("img1");
                var captionText = document.getElementById("caption");
                img.onclick = function(){
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                }

                img2.onclick = function(){
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                }
                var span = document.getElementsByClassName("close")[0];
                span.onclick = function() {
                    modal.style.display = "none";
                }
                var span2 = document.getElementsByClassName("overlayModal")[0];
                span2.onclick = function() {
                    modal.style.display = "none";
                }

            </script>
        </div>
    </div>
    <div class="footerHotline">
        <div class="box"> <a id="callnowbutton" href="tel:0941316060">
                <div class="call-mobile"> <i class="fa fa-phone"></i> </div>
            </a>
            <div class="call-mobile2 hidden"> <a id="callnowbutton" href="skype:live:?chat"> <img src="https://vietlandtravel.vn/assets/css/img/skype.jpg"></a></div>
            <div class="call-mobile1"> <a data-animate="fadeInDown" rel="noopener noreferrer" href="https://zalo.me/0941316060" target="_blank" class="button success" data-animated="true"> <span>Tư vấn qua Zalo</span></a></div>
        </div>
    </div>
    </div>
    </div>
    <a href="#top" id="go_top"><i class="fa fa-angle-up"></i></a>

</footer>

<div class="icon_fixed visible-xs">
    <div class="fix_mb">


        <div class="mess">
            <a href="https://m.me/179153369290737" target="_blank">
                <img src="https://vietlandtravel.vn/img/mess.png" alt="">
            </a>
        </div>


    </div>

</div>




<div class="icon_fixed hidden-sm hidden-xs">

    <div class="mess">
        <a href="https://m.me/179153369290737" target="_blank">
            <img src="https://vietlandtravel.vn/img/mess.png" alt="">
        </a>
    </div>


</div>

<style>
    .icon_fixed{position: fixed;z-index: 999;top: 82%;right: 30px}
    .icon_fixed img{width: 45px;height: 45px;margin-bottom: 20px}
    @media (max-width: 576px){
        .suntory-alo-phone{top: 89%}
        .call_pc{display: none}
        .suntory-alo-phone{position: relative !important;margin-top: -25px;width: 75px;margin-left: -20px}
        .fix_mb{position: fixed;display: flex;justify-content: space-between;top: 90%;width: 85%}
    }
    @media(min-width: 1500px){
        .icon_fixed{top: 68% !important;}
    }
</style>
<!--   -->
<script type="text/javascript">
    (() => {
        'use strict';
        // Page is loaded
        const objects = document.getElementsByClassName('asyncImage');
        Array.from(objects).map((item) => {
            // Start loading image
            const img = new Image();
            img.src = item.dataset.src;
            // Once image is loaded replace the src of the HTML element
            img.onload = () => {
                item.classList.remove('asyncImage');
                return item.nodeName === 'IMG' ?
                    item.src = item.dataset.src :
                    item.style.backgroundImage = `url(${item.dataset.src})`;
            };
        });
    })();
</script>


<!-- footer -->
<!-- Global site tag (gtag.js) - Google Ads: 831471195 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-831471195"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-831471195');
</script>
