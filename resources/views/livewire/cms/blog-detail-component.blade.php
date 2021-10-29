<div class="breadcrumb-wrapper">

    <div class="breadcrumb-wrapper-overlay"></div>

    <!--begin container -->
    <div class="container sec-container">

        <!--begin row -->
        <div class="row">

            <!--begin col-xs-12 -->
            <div class="col-sm-12 col-lg-12 col-xs-12">

                <h2 class="page-title white text-center">Blogs</h2>

            </div>


            <!--end col-xs-12 -->

        </div>
        <!--end row -->

    </div>
    <!--end container -->

</div>
<!--end breadcrumb-wrapper-->

<!--begin blog -->

<section class="section-white small-padding">

    <!--begin container-->
    <div class="container padding-bottom-40">

        <!--begin row-->
        <div class="row">

            <!--begin col-sm-8 -->
            <div class="col-sm-8">

                <!--begin blog-item -->
                <div class="blog-item">

                    <!--begin popup image -->
                    <div class="popup-wrapper">
                        <div class="popup-gallery">
                            <a href="#"><img src="{{ asset('uploads/blogImages/'.$blog->image) }}" class="width-100" alt="pic"><span class="eye-wrapper2"><i class="icon icon-link eye-icon"></i></span></a>
                        </div>
                    </div>
                    <!--begin popup image -->

                    <!--begin blog-item_inner -->
                    <div class="blog-item-inner margin-bottom-50">

                        <h3 class="blog-title"><a href="#">{{ $blog->title }}</a></h3>

                        {{--                            <a href="#" class="blog-icons"><i class="icon icon-user"></i> Paul Smith</a>--}}

                        {{--                            <a href="#" class="blog-icons last"><i class="icon icon-tags"></i> WordPress</a>--}}

                        {!! $blog->description !!}
                    </div>
                    <!--end blog-item-inner -->

                    <!--begin post_author -->
                {{--                        <div class="post_author">--}}

                {{--                            <img src="assets/img/blog1.jpg" alt="Picture" class="post_author_pic">--}}

                {{--                            <h5>About the author</h5>--}}

                {{--                            <p><strong>Jane Smith</strong> is mattis quam non ullamcorper semper, risus vels tortor etim iacus pharetra. Nullam tellus arcu, molestie vels nibh ut, nets molestie ipse. Prod sed pharetra nunc</p>--}}

                {{--                            <!--begin author icons -->--}}
                {{--                            <ul class="author_icons">--}}
                {{--                                <li>--}}
                {{--                                    <a href="#">--}}
                {{--                                        <i class="icon icon-twitter"></i>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li>--}}
                {{--                                    <a href="#">--}}
                {{--                                        <i class="icon icon-facebook"></i>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li>--}}
                {{--                                    <a href="#">--}}
                {{--                                        <i class="icon icon-dribble"></i>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li>--}}
                {{--                                    <a href="#">--}}
                {{--                                        <i class="icon icon-dropbox"></i>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                            <!--end author icons -->--}}

                {{--                        </div>--}}
                <!--end post_author -->

                    <h4>2 Comments</h4>

                    <!--begin comments_box -->
                    <div class="comments_box">

                        <img src="assets/img/team3.jpg" alt="Picture" class="comments_pic">

                        <!--begin post_text -->
                        <div class="post_text">

                            <h5>John Smith</h5>

                            <ul class="post_info">
                                <li>
                                    <a href="#">27 July 2017</a>
                                </li>
                                <li class="last">
                                    <a href="#">Reply</a>
                                </li>

                            </ul>

                            <p>Pellentesque mattis quam non ullamcorper semper, risus vels tortor etim iacus pharetra. Nullam tellus arcu, molestie vels nibh ut, gravida molestie ipse. Prod sed pharetra nunc. Quisque ornare luctis augue vel facilisis etims mattis.</p>

                        </div>
                        <!--end post_text -->

                    </div>
                    <!--end comments_box -->

                    <!--begin comments_box -->
                    <div class="comments_box second_comment">

                        <img src="assets/img/team1.jpg" alt="Picture" class="comments_pic">

                        <!--begin post_text -->
                        <div class="post_text">

                            <h5>Jane Richards</h5>

                            <ul class="post_info">
                                <li>
                                    <a href="#">27 July 2017</a>
                                </li>
                                <li class="last">
                                    <a href="#">Reply</a>
                                </li>

                            </ul>

                            <p>Pellentesque mattis quam non ullamcorper semper, risus vels tortor etim iacus pharetra. Nullam tellus arcu, molestie vels nibh ut, gravida molestie ipse. Prod sed pharetra nunc. Quisque ornare luctis augue vel facilisis etims mattis.</p>

                        </div>
                        <!--end post_text -->

                    </div>
                    <!--end comments_box -->

                    <h4 class="padding-top-30">Would you like to post a comment?</h4>

                    <p>Pellentesque mattis quam non ullamcorper semper, risus vels tortor etim iacus pharetra. Nullam tellus arcu, moldis vels nibh ut, gravida moldis ipse. Prod sed pharetra nunc. Quisque ornare luctis augue vel facilisis etims mattis.</p>

                    <!--begin comments_form -->
                    <form class="comments_form" action="#" method="post">
                        <input class="comments_input white-input" type="text" placeholder="Your Name" />
                        <input class="comments_input white-input" type="text" placeholder="Your Email" />
                        <textarea name="message" placeholder="Your Message..." rows="2" cols="20" class="comments_text white-input"></textarea>
                        <input type="submit" value="Submit" id="submit-button" class="btn btn-primary" />
                    </form>
                    <!--end comments_form -->

                </div>

            </div>
            <!--end col-sm-8-->

            <!--begin col-sm-4 -->
            <div class="col-sm-4 margin-top-20">

                <!--begin recent_posts -->
                <h5>Recent Posts</h5>
                @foreach($latest as $new)
                    <?php
                    $string = strip_tags($new->description);
                    $yourText = $new->description;
                    if (strlen($string) > 100) {
                        $stringCut = substr($new->description, 0, 100);
                        $doc = new DOMDocument();
                        $doc->loadHTML($stringCut);
                        $yourText = $doc->saveHTML();
                    }
                    ?>
                    <div class="sidebar_posts">
                        <a href="{{ route('blog',['blog_id'=>$new->id,'name'=>$blog->slug]) }}" title=""><img src="{{ asset('uploads/blogImages/'.$new->image) }}" alt=""></a>
                        <a href="{{ route('blog',['blog_id'=>$new->id,'name'=>$blog->slug]) }}" title="">{!! $yourText !!}</a>
                        <span class="sidebar_post_date">{{ $new->created_at->toFormattedDateString() }}</span>
                    @endforeach
                    <!--begin recent_posts -->

                        <!--begin tags -->
                    {{--                    <h5>Tags:</h5>--}}
                    {{--                    <ul class="tags">--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Taxes</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Finances</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Business</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Emplyer</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Audit</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Loans</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Advisors</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Services</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Insurance</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Plannig</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Retirement</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Startups</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#">Consulting</a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                    <!--end tags -->
                        <!--begin categories -->
                    {{--                    <h5>Categories:</h5>--}}
                    {{--                    <ul class="sidebar_categories">--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#"><i class="icon icon-angle-right"></i> Financial Consulting</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#"><i class="icon icon-angle-right"></i> Experts Advisors</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#"><i class="icon icon-angle-right"></i> Insurance Consulting</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            <a href="#"><i class="icon icon-angle-right"></i> Retirement Planning</a>--}}
                    {{--                        </li>--}}

                    {{--                    </ul>--}}
                    <!--end categories -->

                    </div>
                    <!--end col-sm-4-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

</section>
<!--end #content-->
