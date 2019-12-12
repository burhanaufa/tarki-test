  @extends('layout')
  @section('content')
  <section>
       <div class="py-sm-12" style="overflow: hidden;background-image: url({{ '../../images/categories/' .$page['image'] }})">
      <div class="overlay-innerpage" style="height: 25em">
     </div>
   </div>
  </section>
  <section class="single-w3ls-page py-5" style="margin-top:-60px">
    <div class="container py-md-5">
      <div class="content-sing-w3pvt px-lg-5">
        @if($files != null)
        @foreach($files as $file)
        @if($file->file_format == 'img')
        <div style="width: 100%;text-align: center">
          <a href="#gal0"> 
            <img src="{{  asset('/images/posts/' .$file->file_name) }}" class="img-fluid" alt="user-image" style="margin-left: auto;margin-right: auto;">
          </a>
        </div>
        <div id="gal0" class="pop-overlay animate">
                    <div class="popup">
                        <img src="{{ asset('/images/posts/' .$file->file_name)}}" alt="Popup Image" class="img-fluid" />
                        <a class="close" href="#gallery">&times;</a>
                    </div>
                </div>
        <?php break; ?>
        @endif
        @endforeach
        @endif
        <h4 class="title-wthree my-3">{{$page['title']}}</h4>
        <p style="text-align: justify;">{!!$page['description']!!}</p>

        <hr>
        <div class="gallery py-5 text-center">
          <div class="row">
          @if($files != null)
          <?php $i = 1;$j = 0; ?>
          @foreach($files as $file)
                @if($file->file_format == 'img')
                  @if($j == 1)
          <div class="col-lg-4 gal-img">
              <div style="text-align: center">
                 <a href="#gal<?= $i ?>"> 
                  <img src="{{  asset('/images/posts/' .$file->file_name) }}" class="img-fluid" alt="user-image"> </a>
                  <div id="gal<?= $i ?>" class="pop-overlay animate">
                      <div class="popup">
                          <img src="{{ asset('/images/posts/' .$file->file_name)}}" alt="Popup Image" class="img-fluid" />
                          <a class="close" href="#gallery">&times;</a>
                      </div>
                  </div>
                </div>
            </div>
                  @endif
                  <?php $j =1; $i++; ?>
                @elseif($file->file_format == 'vid')
          <div class="col-lg-4 about-img">
              <div style="text-align: center">
                <video width="320" height="240" controls>
                  <source src="{{asset('/images/posts/' .$file->file_name)}}" type="video/mp4" />
                    <source src="{{asset('/images/posts/' .$file->file_name)}}" type="video/ogg" />
                      <source src="{{asset('/images/posts/' .$file->file_name)}}" type="video/webm" />
                        Your browser does not support the video tag.
                      </video> 
                    </div>
                  </div>
                      @else
                       <div class="col-lg-4 about-img">
              <div style="text-align: center">
                      <a href="{{asset('/images/posts/' .$file->file_name)}}" >
                        <img src="{{  asset('assets/images/docx.png') }}" style="width: 240px;height: 240px">
                        <br>
                        {{$file->file_name}}
                      </a>
                    </div>
                </div>
                      @endif
                @endforeach
                @endif
              </div>
              </div>
            </div>

          </div>
        </section>

        @endsection