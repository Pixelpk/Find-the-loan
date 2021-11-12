<div class="breadcrumb-wrapper">
    <div class="breadcrumb-wrapper-overlay"></div>
    <div class="container sec-container">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-xs-12">
                <h2 class="page-title white text-center">Blogs</h2>
            </div>
        </div>
    </div>
</div>

<section class="section-white small-padding">
    <div class="container padding-bottom-40">
        <div class="row">
            <div class="col-sm-8">
                @foreach($blogs as $blog)
                <div class="blog-item-big">
                    <div class="popup-wrapper">
                        <div class="popup-gallery">
                            <a href="{{ route('blog',['blog_id'=>$blog->id,'name'=>$blog->slug]) }}"><img
                                    src="{{ asset('uploads/blogImages/'.$blog->image) }}" class="width-100"
                                    alt="pic"><span class="eye-wrapper2"><i
                                        class="icon icon-link eye-icon"></i></span></a>
                        </div>
                    </div>
                    <div class="blog-item-inner">

                        <h3 class="blog-title"><a
                                href="{{ route('blog',['blog_id'=>$blog->id,'name'=>$blog->slug]) }}">{{ $blog->title }}</a>
                        </h3>
                        
                        <?php
                            $string = strip_tags($blog->description);
                            $yourText = $blog->description;
                            if (strlen($string) > 350) {
                                $stringCut = substr($string, 0, 350);
                                $doc = new DOMDocument();
                                @$doc->loadHTML($stringCut);
                                $yourText = $doc->saveHTML();
                            }
                            ?>
                        <p>{!! $yourText !!}...<a href='{{ route('blog',['blog_id'=>$blog->id,'name'=>$blog->slug]) }}'>View
                                More</a></p>
                    </div>
                </div>
                @endforeach
                {{ $blogs->links() }}
            </div>
 
            <div class="col-sm-4 margin-top-20">

                <h5>Recent Posts</h5>
                @foreach($latest as $new)
                <?php
                        $string = strip_tags($new->description);
                        $yourText = $new->description;
                        if (strlen($string) > 100) {
                            $stringCut = substr($string, 0, 100);
                            $doc = new DOMDocument();
                            @$doc->loadHTML($stringCut);
                            $yourText = $doc->saveHTML();
                        }
                        ?>
                <div class="sidebar_posts">
                    <a href="{{ route('blog',['blog_id'=>$new->id,'name'=>$new->slug]) }}" title=""><img
                            src="{{ asset('uploads/blogImages/'.$new->image) }}" alt=""></a>
                    <a href="{{ route('blog',['blog_id'=>$new->id,'name'=>$new->slug]) }}" title="">{{$new->title}}</a>
                    <span class="sidebar_post_date">{{ $new->created_at->toFormattedDateString() }}</span>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
