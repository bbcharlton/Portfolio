<h1>Posts</h1>
<a href="/posts/create">New Post</a>

@foreach($posts as $post)
	<h1>{{$post->title}}</h1>
	<a href="/posts/{{$post->id}}">Read More</a>
@endforeach