
    <!-- footer__section__start -->
    <div class="footerarea">
        <div class="container">
            <div class="footerarea__newsletter__wraper">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 aos-init" data-aos="fade-up">
                        <div class="footerarea__text">
                            <h3>{{ __('Subscribe to ') }} <span>{{ __('our newsletter') }}</span>.</h3>
                            <p>{{ __('Subscribe to our newsletter and always be informed of all our updates.') }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 aos-init" data-aos="fade-up">
                        <div class="footerarea__newsletter">
                            <div class="footerarea__newsletter__input">
                                @livewire('components.subscriper-footer')
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            {{-- 
            <div class="footerarea__wrapper footerarea__wrapper__2">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 aos-init" data-aos="fade-up">
                        <div class="footerarea__inner footerarea__about__us">
                            <div class="footerarea__heading">
                                <h3>About us</h3>
                            </div>
                            <div class="footerarea__content">
                                <p>orporate clients and leisure travelers has been relying on Groundlink for dependable safe, and professional chauffeured car end service in major cities across World.</p>
                            </div>
                            <div class="foter__bottom__text">
                                <div class="footer__bottom__icon">
                                    <i class="icofont-clock-time"></i>
                                </div>
                                <div class="footer__bottom__content">
                                    <h6>Opening Houres</h6>
                                    <span>Mon - Sat(8.00 - 6.00)</span>
                                    <span>Sunday - Closed</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 aos-init" data-aos="fade-up">
                        <div class="footerarea__inner">
                            <div class="footerarea__heading">
                                <h3>Usefull Links</h3>
                            </div>
                            <div class="footerarea__list">
                                <ul>
                                    <li>
                                        <a href="#">About Us</a>
                                    </li>
                                    <li>
                                        <a href="#">Teachers</a>
                                    </li>
                                    <li>
                                        <a href="#">Partner</a>
                                    </li>
                                    <li>
                                        <a href="#">Room-Details</a>
                                    </li>
                                    <li>
                                        <a href="#">Gallery</a>
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 aos-init" data-aos="fade-up">
                        <div class="footerarea__inner footerarea__padding__left">
                            <div class="footerarea__heading">
                                <h3>Course</h3>
                            </div>
                            <div class="footerarea__list">
                                <ul>
                                    <li>
                                        <a href="#">Ui Ux Design</a>
                                    </li>
                                    <li>
                                        <a href="#">Web Development</a>
                                    </li>
                                    <li>
                                        <a href="#">Business Strategy</a>
                                    </li>
                                    <li>
                                        <a href="#">Softwere Development</a>
                                    </li>
                                    <li>
                                        <a href="#">Business English</a>
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 aos-init" data-aos="fade-up">
                        <div class="footerarea__right__wraper footerarea__inner">
                            <div class="footerarea__heading">
                                <h3>Recent Post</h3>
                            </div>
                            <div class="footerarea__right__list">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <div class="footerarea__right__img">
                                                <img src="img/footer/footer__1.png" alt="footerphoto">
                                            </div>
                                            <div class="footerarea__right__content">
                                                <span>02 Apr 2023 </span>
                                                <h6>Best Your Business</h6>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="footerarea__right__img">
                                                <img src="img/footer/footer__2.png" alt="footerphoto">
                                            </div>
                                            <div class="footerarea__right__content">
                                                <span>02 Apr 2023 </span>
                                                <h6>Keep Your Business</h6>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="footerarea__right__img">
                                                <img src="img/footer/footer__3.png" alt="footerphoto">
                                            </div>
                                            <div class="footerarea__right__content">
                                                <span>02 Apr 2023 </span>
                                                <h6>Nice Your Business</h6>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="footerarea__copyright__wrapper footerarea__copyright__wrapper__2">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="copyright__logo">
                        <a href="/">
                            @if ( settings('appLogo') )
                                <img src="{{ settings('appLogo') }}" alt="{{ settings('appName') ?? config('app.name') }}" style="width: 100%; max-width: 150px;">
                            @else
                                {{ settings('appName') ?? config('app.name') }}
                            @endif
                        </a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="footerarea__copyright__content footerarea__copyright__content__2">
                            <p>
                            {{ __('Copyright') }} © <span>2023</span> {{ __('All Rights Reserved') }} 
                            <a href="{{ config('app.url') }}"> {{ settings('appName') ?? config('app.name') }}</a>.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <div class="footerarea__icon footerarea__icon__2">
                            <ul>
                                <li><a href="{{ settings('appFaceboke') ?? 'javascript:void(0)' }}"><i class="icofont-facebook"></i></a></li>
                                <li><a href="{{ settings('appTwiter') ?? 'javascript:void(0)' }}"><i class="icofont-twitter"></i></a></li>
                                <li><a href="{{ settings('appYoutube') ?? 'javascript:void(0)' }}"><i class="icofont-youtube-play"></i></a></li>
                                <li><a href="{{ settings('appInstagram') ?? 'javascript:void(0)' }}"><i class="icofont-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- footer__section__end -->
    {{-- <section class="footer-main">
    <div class="footer">
        <p> &copy; {{ __('Copyright') }} <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. {{ __('All Rights Reserved') }} <a href="{{ config('app.url') }}"> {{ settings('appName') ?? config('app.name') }} </a>.  
            <br>{{ __('By:') }} <a href="https://naiosh.com" target="_parent" title="free css templates">{{ __('Naiosh') }}</a></p>
    </div>
    </section> --}}