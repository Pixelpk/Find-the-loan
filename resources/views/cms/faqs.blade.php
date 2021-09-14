@extends('cms.layouts.master')
@section('content')
    <section class="section-white small-padding mt-5">
        <div class="container">
            <div class="row">
                <div id="accordion" class="width-100%">
                    @foreach($faqs as $key=>$faq)
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" href="#collapse{{$key}}">
                            <a class="">
                                {{$faq->question}}
                            </a>
                        </div>
                        <div id="collapse{{$key}}" class="collapse @if($key==0) show @endif" data-parent="#accordion">
                            <div class="card-body">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            {{--        <h2>Accordion Example</h2>--}}
            {{--        <p><strong>Note:</strong> The <strong>data-parent</strong> attribute makes sure that all collapsible elements under the specified parent will be closed when one of the collapsible item is shown.</p>--}}
        </div>
    </section>
@endsection
