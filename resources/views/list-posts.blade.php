  @extends('layout')
  @section('content')
  <section>
      <div class="py-sm-12" style="overflow: hidden;background-image: url({{ '../../images/categories/' .$page['image'] }})">
      <div class="overlay-innerpage" style="height: 25em">
     </div>
   </div>
</section>

  <section class="py-sm-12 container">
    <h3 class="title-wthree my-3">{{$page->category_name}}</h3>
    <hr>
    @foreach($posts as $post)
      <div class="py-sm-12" style="margin-bottom:40px;padding-top: 30px;padding-left: 5px;padding-right: 5px">
       
          <div class="row">
          <div class="col-sm-4">
             @if($files != null)
            @foreach($files as $file)
            @if($file->post_id == $post->posts_id)
            @if($file->file_format == 'img')
             <div style="text-align: center;width: 100%">
            <img src="{{  asset('/images/posts/' .$file->file_name) }}" style="width: 80%" alt="user-image">
            </div>
            <?php break; ?>
            @endif
            @endif
            @endforeach
            @endif
          </div>
          <div class="col-sm-8" style="padding:5px 15px">
          <h4><b>{{$post->title}}</b></h4>
          <h6>{{$post->created_at}}</h6>
          <p>
            {!!$post->headline!!}
          </p>
          <a href="{{route('detail_post', $post->post_slug)}}">
          <button class="btn btn-success">Read More</button>
        </a>
    </div>
        </div>
      </div>
      <hr>
      @endforeach
  </section>
      @endsection