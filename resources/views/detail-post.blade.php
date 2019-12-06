  @extends('layout')
  @section('content')
  <section>
    <div class="py-sm-12" style="height: 350px;overflow: hidden;">
      <img style="width: 100%" src="{{ asset('/images/categories/' .$post['image']) }}" alt=""> 
  </div>
</section>
<section class="single-w3ls-page py-5" style="margin-top:-60px">
    <div class="container py-md-5">
        <div class="content-sing-w3pvt px-lg-5">
            @foreach($files as $file)
            @if($file->file_format == 'img')
            <img src="{{  asset('/images/posts/' .$file->file_name) }}" class="img-fluid" alt="user-image">
            <?php break; ?>
            @endif
            @endforeach
            <h4 class="title-wthree my-3">{{$post['title']}}</h4>
            <p>{{$post['description']}}</p>

            <hr>
            <div class="row about-w3pvt-top mt-2">
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

                  </div>
              <hr>
               <div class="comments my-5" style="margin-top: 50px">
                <h4 class="title-wthree mb-5">Recent Comments</h4>
                <div class="comments-grids mt-4">
                    <div class="media mt-4">
                        <div class="media-body comments-grid-right">
                            <h4>Johnson</h4>
                            <ul class="my-2">
                                <li class="font-weight-bold">2 Apr 2019
                                </li>
                            </ul>
                            <p>mattis ut hendrerit non, facilisis eget mauris. Sed ultricies nec purus quis
                                tempor.
                                Phasellus bibendum eu.</p>
                        </div>
                    </div>
                    <div class="media mt-sm-5 mt-3 ml-5">
                        <div class="media-body comments-grid-right">
                            <h4>Watson</h4>
                            <ul class="my-2">
                                <li class="font-weight-bold">2 Apr 2019
                                </li>
                            </ul>
                            <p>mattis ut hendrerit non, facilisis eget mauris. Sed ultricies nec
                                purus
                                quis
                                tempor. Phasellus bibendum eu.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-right-wthree-info login">

                <h4 class="title-wthree mb-5">Leave a Comment</h4>
                <form  method="POST" action="{{ route('add_comment',$post['posts_id']) }}" class="single-page-form">
                    <div class="form-group mt-4">
                        <label>Name</label>

                        <input type="text" class="form-control" name="full_name" placeholder="" required="">
                    </div>
                    <div class="form-group mt-4">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="" required="">
                    </div>
                    <div class="form-group mt-4">
                        <label>Blog ( Optional )</label>
                        <input type="text" class="form-control" name="blog" placeholder="" >
                    </div>

                    <div class="form-group mt-4">
                        <label class="mb-2">Message</label>
                        <textarea class="form-control" name="comment" placeholder="" required=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary submit mb-4">Post Comment </button>

                </form>

            </div>
              </div>
          </div>
      </section>

      @endsection