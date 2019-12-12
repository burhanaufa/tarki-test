  @extends('layout')
  @section('content')
  <section>
    <div class="py-sm-12" style="overflow: hidden;background-image: url({{ '../../images/categories/' .$post['image'] }})">
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
             <div style="text-align: center;width: 100%">
            <img src="{{  asset('/images/posts/' .$file->file_name) }}" class="img-fluid" alt="user-image">
            </div>
            <?php break; ?>
            @endif
            @endforeach
            @endif
            <h4 class="title-wthree my-3">{{$post['title']}}</h4>
            <p style="text-align: justify;">{!!$post['description']!!}</p>

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
              <hr>
               <div class="comments my-5" style="margin-top: 50px">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{$errors->first()}}
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <h4 class="title-wthree mb-5">Recent Comments</h4>
                <div class="comments-grids mt-4">
                  @foreach($comments as $comment)
                    <div class="media mt-4">
                        <div class="media-body comments-grid-right">
                            <h4>{{$comment->full_name}}</h4>
                            <ul class="my-2">
                                <li class="font-weight-bold">{{$comment->created_at}}
                                </li>
                            </ul>
                            <p>{{$comment->comment}}</p>
                        </div>
                    </div>
                    <div class="media mt-sm-5 mt-3 ml-5" style="margin-top: 0px !important;margin-left: 0px !important">
                          @if($comment->comment_reply !=  null)
                          <div class="media-body comments-grid-right">
                            <div style="height: 80px;width: 30px;background-color: #8fc9f3;float: left;margin-right: 5px">
                            </div>
                              <h4>Admin</h4>
                              <ul class="my-2">
                              </ul>
                              <p>{!!$comment->comment_reply!!}</p>
                          </div>
                          @endif
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
            <div class="contact-right-wthree-info login">

                <h4 class="title-wthree mb-5">Leave a Comment</h4>
                <form  method="POST" action="{{ route('add_comment',$post['posts_id']) }}" class="single-page-form">
                  @csrf
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