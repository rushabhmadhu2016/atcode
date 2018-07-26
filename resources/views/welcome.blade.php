@extends('layouts.app')

@section('content')
<section id="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                <div class="col-md-10 col-md-offset-1 padd-tb-20 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-duration="600">
                    <div class="newsletter">
                        <h2 class="color-white">Newsletter</h2>
                        <form id="newsletter-form" class="form-inline" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your mail ID">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-control" value="Subscribe">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1 padd-tb-20 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-duration="600">
                    <div class="tab-banner">
                        <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                            <a href="#" class="tab-btn active">Announcement</a>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                            <a href="#" class="tab-btn">Discuss</a>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                            <a href="#" class="tab-btn">Bounty</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1 padd-tb-40 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-duration="600">
                    <div class="counter">
                        <div class="countdown-container" id="counter">

                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1 padd-tb-20 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-duration="600">
                    <div id="progressbar"></div>
                    <div class="description">
                        <p class="pull-left color-white">25% Bonus <br/>20,000 Token Sold</p>
                        <p class="pull-right color-white"><big>PreSale</big></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="introductoin">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="fade-right">
            <h2 class="section-title color-blue">Why Invest in Avatar Life Tokens?</h2>
            <div class="section-content text-justify">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="icons-intro text-center">
                <ul class="icons">
                    <li data-aos="fade-right" data-aos-delay="200">
                        <img src="{{ asset('/images/revolutionary_gaming.png') }}">
                        <p class="icon-title color-blue">Revolutionary Gaming</p>
                    </li>
                    <li data-aos="fade-left" data-aos-delay="400">
                        <img src="{{ asset('/images/Powerd by_NEO.png') }}">
                        <p class="icon-title color-blue">Powered by NEO</p>
                    </li>
                    <li data-aos="fade-right" data-aos-delay="600">
                        <img src="{{ asset('/images/high_returns.png') }}">
                        <p class="icon-title color-blue">High Returns</p>
                    </li>
                    <li data-aos="fade-left" data-aos-delay="800">
                        <img src="{{ asset('/images/1_million_customers.png') }}">
                        <p class="icon-title color-blue">1 Million Customers</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>
<section id="about" class="bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="fade-right">
                <h2 class="section-title color-blue">About Avatar Life</h2>
                <div class="section-content text-justify">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="fade-left">
                <img src="{{ url('/images/video_img.png') }}" class="img-responsive">
            </div>
        </div>
    </div>
</section>
<section id="tokens">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-aos="fade-down">
                <h2 class="section-title color-blue">Tokens</h2>
                <div class="section-content text-justify">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="zoom-in-up">
                <h3 class="token-title color-blue text-center">Distribution of Tokens</h3>
                <div id="distribution_graph" style="min-height: 320px; width: auto;"></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="zoom-in-up">
                <h3 class="token-title color-blue text-center">Sale Process Allocation</h3>
                <div id="sale_process" style="min-height: 320px; width: auto;">
                    <canvas id="sale_process_chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="global" class="no-padd">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center" data-aos="fade-right">
                <p class="fact-icon"><img src="{{ url('/images/white_paper.png') }}"></p>
                <p class="color-white"><big> White Paper </big></p>
                <p class="fact-link"><a class="color-white" href="#">Download</a></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center" data-aos="fade-up">
                <p class="fact-icon"><img src="{{ url('/images/white_paper.png') }}"></p>
                <p class="color-white"><big> 1 Page Summary </big></p>
                <p class="fact-link"><a class="color-white" href="#">Download</a></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center" data-aos="fade-left">
                <p class="fact-icon"><img src="{{ url('/images/participents.png') }}"></p>
                <p class="color-white"><big> 30,000+ ICO Participants </big></p>
                <p class="fact-link"><a class="color-white" href="#">Register</a></p>
            </div>
        </div>
    </div>
</section>
<section id="roadmap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="section-title color-blue">The Road Map</h2>
                <div class="section-content text-justify">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                 <div class="slider-section">
                                <div id="slider-roadmap" class="owl-carousel owl-theme">
                                    <div class="item" data-aos="fade-up" data-aos-delay="">
                                        <h4 class="color-blue text-center">January 2018</h4>
                                        <p class="bullet"><i class="bullet-circle"></i></p>
                                        <p class="text-left roadmap-slider-text">Partnership for the future EcoSystem.</p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="100">
                                        <h4 class="color-blue text-center">January 2018</h4>
                                        <p class="bullet"><i class="bullet-circle"></i></p>
                                        <p class="text-left roadmap-slider-text">Partnership for the future EcoSystem.</p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="200">
                                        <h4 class="color-blue text-center">January 2018</h4>
                                        <p class="bullet"><i class="bullet-circle"></i></p>
                                        <p class="text-left roadmap-slider-text">Partnership for the future EcoSystem.</p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="300">
                                        <h4 class="color-blue text-center">January 2018</h4>
                                        <p class="bullet"><i class="bullet-circle"></i></p>
                                        <p class="text-left roadmap-slider-text">Partnership for the future EcoSystem.</p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="400">
                                        <h4 class="color-blue text-center">January 2018</h4>
                                        <p class="bullet"><i class="bullet-circle"></i></p>
                                        <p class="text-left roadmap-slider-text">Partnership for the future EcoSystem.</p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="500">
                                        <h4 class="color-blue text-center">January 2018</h4>
                                        <p class="bullet"><i class="bullet-circle"></i></p>
                                        <p class="text-left roadmap-slider-text">Partnership for the future EcoSystem.</p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="600">
                                        <h4 class="color-blue text-center">January 2018</h4>
                                        <p class="bullet"><i class="bullet-circle"></i></p>
                                        <p class="text-left roadmap-slider-text">Partnership for the future EcoSystem.</p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="700">
                                        <h4 class="color-blue text-center">January 2018</h4>
                                        <p class="bullet"><i class="bullet-circle"></i></p>
                                        <p class="text-left roadmap-slider-text">Partnership for the future EcoSystem.</p>
                                    </div>
                                </div>
                            </div>
            </div>
        </div>
    </div>
</section>
<section id="team-advisor" class="bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="section-title color-blue">Our Team</h2>
            <div class="section-content">
                        <div id="slider-team" class="owl-carousel owl-theme">
                            <div class="item" data-aos="fade-up" data-aos-delay="">
                                <p class="image-wrap text-center">
                                    <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                    <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </p>
                                <h4 class="color-blue text-center">John Smith</h4>
                                <p class="text-muted designation text-center">Designation</p>
                                <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                            </div>
                            <div class="item" data-aos="fade-up" data-aos-delay="100">
                                <p class="image-wrap text-center">
                                    <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                    <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </p>
                                <h4 class="color-blue text-center">John Smith</h4>
                                <p class="text-muted designation text-center">Designation</p>
                                <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                            </div>
                            <div class="item" data-aos="fade-up" data-aos-delay="200">
                                <p class="image-wrap text-center">
                                    <img src="http://via.placeholder.com/150x150/"  class="img-circle">
                                    <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </p>
                                <h4 class="color-blue text-center">John Smith</h4>
                                <p class="text-muted designation text-center">Designation</p>
                                <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                            </div>
                            <div class="item" data-aos="fade-up" data-aos-delay="300">
                                <p class="image-wrap text-center">
                                    <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                    <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </p>
                                <h4 class="color-blue text-center">John Smith</h4>
                                <p class="text-muted designation text-center">Designation</p>
                                <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                            </div>
                            <div class="item" data-aos="fade-up" data-aos-delay="400">
                                <p class="image-wrap text-center">
                                    <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                    <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </p>
                                <h4 class="color-blue text-center">John Smith</h4>
                                <p class="text-muted designation text-center">Designation</p>
                                <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                            </div>
                            <div class="item" data-aos="fade-up" data-aos-delay="500">
                                <p class="image-wrap text-center">
                                    <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                    <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </p>
                                <h4 class="color-blue text-center">John Smith</h4>
                                <p class="text-muted designation text-center">Designation</p>
                                <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                            </div>
                            <div class="item" data-aos="fade-up" data-aos-delay="600">
                                <p class="image-wrap text-center">
                                    <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                    <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </p>
                                <h4 class="color-blue text-center">John Smith</h4>
                                <p class="text-muted designation text-center">Designation</p>
                                <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                            </div>
                            <div class="item" data-aos="fade-up" data-aos-delay="700">
                                <p class="image-wrap text-center">
                                    <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                    <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </p>
                                <h4 class="color-blue text-center">John Smith</h4>
                                <p class="text-muted designation text-center">Designation</p>
                                <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="section-title color-blue">Our Advisers</h2>
                <div class="section-content">
                                <div id="slider-advisor" class="owl-carousel owl-theme">
                                    <div class="item" data-aos="fade-up" data-aos-delay="">
                                        <p class="image-wrap text-center">
                                            <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                            <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </p>
                                        <h4 class="color-blue text-center">John Smith</h4>
                                        <p class="text-muted designation text-center">Designation</p>
                                        <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                        <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="100">
                                        <p class="image-wrap text-center">
                                            <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                            <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </p>
                                        <h4 class="color-blue text-center">John Smith</h4>
                                        <p class="text-muted designation text-center">Designation</p>
                                        <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                        <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="200">
                                        <p class="image-wrap text-center">
                                            <img src="http://via.placeholder.com/150x150/"  class="img-circle">
                                            <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </p>
                                        <h4 class="color-blue text-center">John Smith</h4>
                                        <p class="text-muted designation text-center">Designation</p>
                                        <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                        <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="300">
                                        <p class="image-wrap text-center">
                                            <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                            <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </p>
                                        <h4 class="color-blue text-center">John Smith</h4>
                                        <p class="text-muted designation text-center">Designation</p>
                                        <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                        <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="400">
                                        <p class="image-wrap text-center">
                                            <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                            <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </p>
                                        <h4 class="color-blue text-center">John Smith</h4>
                                        <p class="text-muted designation text-center">Designation</p>
                                        <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                        <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="500">
                                        <p class="image-wrap text-center">
                                            <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                            <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </p>
                                        <h4 class="color-blue text-center">John Smith</h4>
                                        <p class="text-muted designation text-center">Designation</p>
                                        <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                        <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="600">
                                        <p class="image-wrap text-center">
                                            <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                            <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </p>
                                        <h4 class="color-blue text-center">John Smith</h4>
                                        <p class="text-muted designation text-center">Designation</p>
                                        <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                        <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                                    </div>
                                    <div class="item" data-aos="fade-up" data-aos-delay="700">
                                        <p class="image-wrap text-center">
                                            <img src="http://via.placeholder.com/150x150/" class="img-circle">
                                            <a class="linkedin-link" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </p>
                                        <h4 class="color-blue text-center">John Smith</h4>
                                        <p class="text-muted designation text-center">Designation</p>
                                        <p class="member-content text-center">Lorem Ipsum is simply dummy text of the printing...</p>
                                        <p class="text-center"><a class="read-more-btn" href="#">Read More</a></p>
                                    </div>
                                </div>
                            </div>
            </div>
        </div>
    </div>
</section>

<section id="faq">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-aos="fade-down">
                            <h2 class="section-title color-blue">Frequently Asked Questions</h2>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <ul class="nav nav-pills faq-pills">
                                            <li class="active"><a data-toggle="tab" href="#general">General</a></li>
                                            <li><a data-toggle="tab" href="#presale">Pre Sale</a></li>
                                            <li><a data-toggle="tab" href="#token">Tokens</a></li>
                                            <li><a data-toggle="tab" href="#legal">Legal</a></li>
                                        </ul>
                                    </div>

                                <div class="col-md-12 col-sm-12 col-xs-12" data-aos="fade-down">
                                    <div class="tab-content">
                                        <div id="general" class="tab-pane fade in active">
                                            <div id="general-slider" class="owl-carousel owl-theme faq-slider">
                                                <div class="item">
                                                   <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="100">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="200">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="300">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="400">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                   <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="100">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="200">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="300">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="400">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="presale" class="tab-pane fade">
                                          <div id="presale-slider" class="owl-carousel owl-theme faq-slider">
                                                <div class="item">
                                                   <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="100">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="200">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="300">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="400">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                   <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="100">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="200">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="300">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="400">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="token" class="tab-pane fade">
                                            <div id="token-slider" class="owl-carousel owl-theme faq-slider">
                                                <div class="item">
                                                   <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="100">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="200">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="300">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="400">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                   <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="100">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="200">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="300">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="400">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="legal" class="tab-pane fade">
                                           <div id="legal-slider" class="owl-carousel owl-theme faq-slider">
                                               <div class="item">
                                                   <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="100">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="200">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="300">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="400">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                   <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="100">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="200">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="300">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12" data-aos="fade-down" data-aos-delay="400">
                                                        <h4 class="color-blue">Lorem ipsum dolor sit amet?</h4>
                                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
<section id="newsletter" class="no-padd">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row subscribe_newsletter_row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                        <h3 class="section-title color-white">Subscribe to Newsletter</h3>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="section-content">
                            <form id="newsletter-form-bottom" class="form-inline" method="post">
                                <div class="form-group email">
                                    <input type="email" name="email" class="form-control" id="subscriber_email">
                                </div>
                                <div class="form-group submit">
                                    <input type="button" id="subscribe_newsletter" name="submit" class="form-control" value="Subscribe">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="contact" class="no-padd">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3 class="section-title contact-title">Any Questions?</h3>
            <p class="contact-tagline"><big>Reach out us and we will get back to you shortly</big></p>
            <div class="footer-contact pull-left">
                <p class="number"><img src="{{ url('/images/phone.png') }}"> <a href="tel:+919876543210"> <big>+91 9876543210</big></a></p>
                <p class="email"><img src="{{ url('/images/mail.png') }}"> <a href="mailto:info@avatarlife.com"> <big>info@avatarlife.com</big></a></p>
            </div>
            <div class="avtar-icon pull-right">
                <img src="{{ url('/images/footer_logo.png') }}">
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="row">
                     <ul class="social-media-bottom">
                        <li data-aos="fade-up" data-aos-duration="100"><a target="_blank" href="https://www.facebook.com/" class="facebook"></a></li>
                        <li data-aos="fade-up" data-aos-duration="200"><a target="_blank" href="https://www.twitter.com/" class="twitter"></a></li>
                        <li data-aos="fade-up" data-aos-duration="300"><a target="_blank" href="https://www.telegram.com/" class="paper-plane"></a></li>
                        <li data-aos="fade-up" data-aos-duration="400"><a target="_blank" href="https://www.github.com/" class="github"></a></li>
                        <li data-aos="fade-up" data-aos-duration="500"><a target="_blank" href="https://www.instagram.com/" class="instagram"></a></li>
                        <li data-aos="fade-up" data-aos-duration="600"><a target="_blank" href="https://www.reddit.com/" class="reddit"></a></li>
                        <li data-aos="fade-up" data-aos-duration="700"><a target="_blank" href="https://www.medium.com/" class="medium"></a></li>
                        <li data-aos="fade-up" data-aos-duration="800"><a target="_blank" href="https://www.linkedin.com/" class="linkedin"></a></li>
                        <li data-aos="fade-up" data-aos-duration="900"><a target="_blank" href="https://www.youtube.com/" class="youtube"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h2 class="section-title contact-title color-blue">Get In Touch</h2>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form id="contact-form" class="form-horizontal" method="post" action="{{ url('save-contact') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name*" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email*" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-control" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    $(".menu-links a").on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 1000, function(){
        window.location.hash = hash;
      });
    }
  });
});
     AOS.init({
        disable: 'mobile',
        easing: 'ease-in-out-sine',
      });
    $(window).scroll(function(){
      var sticky = $('.main-head'),
          scroll = $(window).scrollTop(),
          body = $('body');

      if (scroll >= 115){
        sticky.addClass('navbar-fixed-top');
        body.addClass('navbar-fixed');
        }
      else {
        sticky.removeClass('navbar-fixed-top');
        body.removeClass('navbar-fixed');
        }
    });
  $(window).on('load', function() {

/* --------------- DISTRIBUTION GRAPH --------------- */
    var chart = new CanvasJS.Chart("distribution_graph", {
        animationEnabled: true,
        data: [{
            type: "doughnut",
            startAngle: 50,
            innerRadius: 85,
            indexLabelFontSize: 17,
            indexLabel: " #percent% {label}",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: [
                { y: 5, label: "Bounties", color:'#0e61ad' },
                { y: 25, label: "Partners and Advisors", color:'#ed2c4a'},
                { y: 20, label: "Bonus Fund", color:'#1382ff'},
                { y: 10, label: "Token Presale", color:'#75deee' },
                { y: 40, label: "Core Phases of Token Sale", color:'#242466' },
            ]
        }]
    });
    chart.render();
/* --------------- DISTRIBUTION GRAPH END --------------- */


/* --------------- SALES PROCESS --------------- */
var data = {
    datasets: [{
        data: [ 100, 90, 80, 70, 60, 50 ],
        backgroundColor: ["#7ab5eb","#444347","#91eb7c","#f7a15b","#7e85e9","#ed5d87"],
    }],
    value:[40,20,18,10,8,4],
    labels: [
        "40% Branding and Marketing ",
        "20% Gift Code Inventory",
        "18% Legal & Financial Over head",
        "10% IT Infrastructure",
        "8% Bounty & Overhead",
        "4% Management"
    ],
    // maintainAspectRatio: false
};
var ctx = $("#sale_process_chart");
new Chart(ctx, {
    data: data,
    type: 'polarArea',
    options:{
        legend:{
            position:'right',
            labels: {
                boxWidth:8,
                // fontSize:17,
                // usePointStyle:true
            },
            // display:false,
        },
        scale: {
            display: false
        }
    },
});
/* --------------- SALES PROCESS END --------------- */



/* --------------- PROGRESSBAR --------------- */
    $( "#progressbar" ).progressbar({
      value: 25
    });
/* --------------- PROGRESSBAR END --------------- */

/* --------------- COUNTER BANNER PART --------------- */
    var labels = ['weeks', 'days', 'hours', 'minutes', 'seconds'],
      nextYear = '2018/08/01',
      template = _.template($('#counter-template').html()),
      currDate = '00:00:00:00:00',
      nextDate = '00:00:00:00:00',
      parser = /([0-9]{2})/gi,
      $example = $('#counter');
    // Parse countdown string to an object
    function strfobj(str) {
      var parsed = str.match(parser),
        obj = {};
      labels.forEach(function(label, i) {
        obj[label] = parsed[i]
      });
      return obj;
    }
    // Return the time components that diffs
    function diff(obj1, obj2) {
      var diff = [];
      labels.forEach(function(key) {
        if (obj1[key] !== obj2[key]) {
          diff.push(key);
        }
      });
      return diff;
    }
    // Build the layout
    var initData = strfobj(currDate);
    labels.forEach(function(label, i) {
      $example.append(template({
        curr: initData[label],
        next: initData[label],
        label: label
      }));
    });
    // Starts the countdown
    $example.countdown(nextYear, function(event) {
      var newDate = event.strftime('%w:%d:%H:%M:%S'),
        data;
      if (newDate !== nextDate) {
        currDate = nextDate;
        nextDate = newDate;
        // Setup the data
        data = {
          'curr': strfobj(currDate),
          'next': strfobj(nextDate)
        };
        // Apply the new values to each node that changed
        diff(data.curr, data.next).forEach(function(label) {
          var selector = '.%s'.replace(/%s/, label),
              $node = $example.find(selector);
          // Update the node
          $node.removeClass('flip');
          $node.find('.curr').text(data.curr[label]);
          $node.find('.next').text(data.next[label]);
          // Wait for a repaint to then flip
          _.delay(function($node) {
            $node.addClass('flip');
          }, 50, $node);
        });
      }
    });
/* --------------- COUNTER BANNER PART END --------------- */
  });


$(document).ready(function() {

/* --------------- GENERAL SLIDER --------------- */
    $(".faq-slider").owlCarousel({
        items : 1,
        slideSpeed : 2000,
        nav: true,
        autoplay: false,
        dots: false,
        loop: false,
        navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
    });
/* --------------- GENERAL SLIDER END --------------- */



/* --------------- TEAM SLIDER --------------- */
    $("#slider-team").owlCarousel({
        items : 4,
        slideSpeed : 2000,
        nav: true,
        autoplay: false,
        dots: false,
        loop: true,
        responsiveRefreshRate : 200,
        navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:1,
            },
            // breakpoint from 768 up
            768 : {
                items:3,
            },
            1000:{
                items:3,
            },
            1024:{
                items:4,
            }
        }
    });
/* --------------- TEAM SLIDER END --------------- */


/* --------------- ADVISOR SLIDER --------------- */
    $("#slider-advisor").owlCarousel({
        items : 4,
        slideSpeed : 2000,
        nav: true,
        autoplay: false,
        dots: false,
        loop: true,
        responsiveRefreshRate : 200,
        navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:1,
            },
            // breakpoint from 768 up
            768 : {
                items:3,
            },
            1000:{
                items:3,
            },
            1024:{
                items:4,
            }
        }
    });
/* --------------- ADVISOR SLIDER END --------------- */

/* --------------- ROADMAP SLIDER --------------- */
    $("#slider-roadmap").owlCarousel({
        items : 4,
        slideSpeed : 2000,
        nav: true,
        autoplay: false,
        dots: false,
        loop: true,
        responsiveRefreshRate : 200,
        navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:1,
            },
            // breakpoint from 768 up
            768 : {
                items:3,
            },
            1000:{
                items:3,
            },
            1024:{
                items:4,
            }
        }
    });
/* --------------- ROADMAP SLIDER END --------------- */
});

$(document).ready(function(){
    $("#subscribe_newsletter").click(function(){
        var email = $.trim($("#subscriber_email").val());
        if(email.length==0){
            $(this).parent().parent().append('<span class="error"> Email is required. </span>');
            $("#subscriber_email").css('border','solid 2px red');
        }else if(!isEmail(email)){
            $(this).parent().parent().append('<span class="error"> Email is invalid. </span>');
            $("#subscriber_email").css('border','solid 2px red');
            console.log("true");
        }else{
            var action_url = "{{ url('saveNewsLetter') }}";
            $.ajax({
                data:{"email":email, "_token": "{{ csrf_token() }}"},
                url: action_url,
                method: 'post',
                success: function(response){
                    var resultData=JSON.parse(response);
                    if(resultData.code=="200"){
                        $(".subscribe_newsletter_row").html('<h2 class="subscriber_email_success">'+resultData.message+'</h2>');
                        $(".subscribe_newsletter_row").css('text-align','center');
                        $(".subscribe_newsletter_row").css('color','#FFFFFF');
                    }
                }
            })
        }
    });

    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
    $("#subscriber_email").blur(function(){
        if($(this).length>0){
            $(this).parent().parent().find('span.error').remove();
            $(this).css('border','solid 0px');
        }
    })
});
</script>
@endsection