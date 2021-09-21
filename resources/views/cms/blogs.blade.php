@extends('cms.layouts.master')
@section('content')
    <div class="breadcrumb-wrapper">

        <div class="breadcrumb-wrapper-overlay"></div>

        <!--begin container -->
        <div class="container">

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
                    @foreach($blogs as $blog)
                    <div class="blog-item-big">

                        <!--begin popup image -->
                        <div class="popup-wrapper">
                            <div class="popup-gallery">
                                <a href="{{ route('blog',['id'=>$blog->id,'name'=>$blog->slug]) }}"><img src="{{ asset('uploads/blogImages/'.$blog->image) }}" class="width-100" alt="pic"><span class="eye-wrapper2"><i class="icon icon-link eye-icon"></i></span></a>
                            </div>
                        </div>
                        <!--begin popup image -->

                        <!--begin blog-item_inner -->
                        <div class="blog-item-inner">

                            <h3 class="blog-title"><a href="{{ route('blog',['id'=>$blog->id,'name'=>$blog->slug]) }}">{{ $blog->title }}</a></h3>

{{--                            <a href="#" class="blog-icons"><i class="icon icon-user"></i> Paul Smith</a>--}}

{{--                            <a href="#" class="blog-icons last"><i class="icon icon-tags blue"></i> Finance</a>--}}
                            <?php
                            $string = strip_tags($blog->description);
                            $yourText = $blog->description;
                            if (strlen($string) > 350) {
                                $stringCut = substr($blog->description, 0, 350);
                                $doc = new DOMDocument();
                                $doc->loadHTML($stringCut);
                                $yourText = $doc->saveHTML();
                            }
                            ?>
                            <p>{!! $yourText !!}...<a href='{{ route('blog',['id'=>$blog->id,'name'=>$blog->slug]) }}'>View More</a></p>
                        </div>
                        <!--end blog-item-inner -->

                    </div>
                    @endforeach
                        {{ $blogs->links() }}
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
                        <a href="{{ route('blog',['id'=>$new->id,'name'=>$blog->slug]) }}" title=""><img src="{{ asset('uploads/blogImages/'.$new->image) }}" alt=""></a>
                        <a href="{{ route('blog',['id'=>$new->id,'name'=>$blog->slug]) }}" title="">{!! $yourText !!}</a>
                        <span class="sidebar_post_date">{{ $new->created_at->toFormattedDateString() }}</span>
                    </div>
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

{{--                    <!--begin categories -->--}}
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
{{--                    <!--end categories -->--}}

                </div>
                <!--end col-sm-4-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </section>
    <!--end blog -->
@endsection
