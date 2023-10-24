<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Congrats</p>
    <form action="/logout" method="post">
    @csrf
    <button>Log out</button>
    </form>
    <div style="border: 1px solid black;">
    <h2>Create new Post</h2>
    <form action="/create-post" method="post">
    @csrf
        <input type="text" name="title" placeholder="post title">
        <textarea name="body" placeholder="post content"></textarea>
        <button>Save Post</button>
    </form>
    </div>
    <div style="border: 1px solid black;">
    <h2>All Posts</h2>
    @foreach($posts as $post)
        <div style="background: grey">
           <h3>{{$post['title']}} by: {{$post->user->name}}</h3>
           <p>{{$post['body']}}</p>
           <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
           <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>Delete</button>
            </form>
        </div>

    @endforeach
    </div>


    @else


    <div style="border: 1px solid black;">
        <h2>Register</h2>
     <form action="/register" method="POST">
        @csrf
        <input name='name' type="text" placeholder="name">
        <input name='email' type="text" placeholder="email">
        <input name='password' type="text" placeholder="password">
        <button>Register</button>

     </form>
    </div>
    <div style="border: 1px solid black;">
        <h2>Login</h2>
     <form action="/login" method="POST">
        @csrf
        <input name='loginName' type="text" placeholder="name">
        <input name='loginPassword' type="text" placeholder="password">
        <button>login</button>

     </form>
    </div>
    @endauth

</body>
</html>
