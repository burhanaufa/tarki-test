  @extends('layout')
  @section('content')
  <section>
    <div class="py-sm-12" style="height: 350px;overflow: hidden;">
      <img style="width: 100%" src="{{ asset('/images/categories/' .$page['image']) }}" alt=""> 
  </div>
</section>
<section class="single-w3ls-page py-5" style="margin-top:-60px">
    <div class="container py-md-5">
        <div class="content-sing-w3pvt px-lg-5">
            @if($files != null)
            @foreach($files as $file)
            @if($file->file_format == 'img')
            <img src="{{  asset('/images/posts/' .$file->file_name) }}" class="img-fluid" alt="user-image">
            <?php break; ?>
            @endif
            @endforeach
            @endif
            <h4 class="title-wthree my-3">{{$page['title']}}</h4>
            <p>{!!$page['description']!!}</p>

            <hr>
            <div class="row about-w3pvt-top mt-2">
                @if($files != null)
                @foreach($files as $file)
                <div class="col-lg-4 about-img">
                    <div class="row">
                        <div class="col" style="text-align: center">
                            @if($file->file_format == 'img')
                            <img src="{{  asset('/images/posts/' .$file->file_name) }}" class="img-fluid" alt="user-image">
                            @elseif($file->file_format == 'vid')
                            <video width="320" height="240" controls>
                              <source src="{{asset('/images/posts/' .$file->file_name)}}" type="video/mp4">
                                <source src="{{asset('/images/posts/' .$file->file_name)}}" type="video/ogg">
                                    <source src="{{asset('/images/posts/' .$file->file_name)}}" type="video/webm">
                                      Your browser does not support the video tag.
                                  </video> 
                                  @else
                                  <a href="{{asset('/images/posts/' .$file->file_name)}}" >
                                  <img src="{{  asset('assets/images/docx.png') }}" style="width: 240px;height: 240px">
                                  <br>
                                  {{$file->file_name}}
                              </a>
                                  @endif
                              </div>
                          </div>
                      </div>
                      @endforeach
                      @endif
                  </div>
              </div>

          </div>
      </section>
      @endsection