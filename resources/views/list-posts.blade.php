  @extends('layout')
  @section('content')
  <section>
    <div class="py-sm-12" style="height: 350px;overflow: hidden;">
      <img style="width: 100%" src="{{ asset('/images/categories/' .$page['image']) }}" alt=""> 
  </div>
</section>

  <section class="py-sm-12 container">
    <h3 class="title-wthree my-3">{{$page->category_name}}</h3>
    <hr>
    @foreach($posts as $post)
      <div class="py-sm-12" style="margin-bottom:40px;padding-top: 30px">
        <div class="py-12">
          <h4><b>{{$post->title}}</b></h4>
          <h6>{{$post->created_at}}</h6>
          <p>
            {!!$post->headline!!}
          </p>
          <a href="{{route('detail_post', $post->posts_id)}}">
          <button class="btn btn-success">Read More</button>
        </a>
        </div>
      </div>
      @endforeach
  </section>
      @endsection