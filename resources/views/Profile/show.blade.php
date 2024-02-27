<div class="card">
    <div class="card-header">
        Profile Information
    </div>
    <div class="card-body">
        <p>Name: {{ $user->name }}</p>
        <p>Username: {{ $user->username }}</p>
        <p>Email: {{ $user->email }}</p>
        <!-- Add more user information as needed -->
    </div>
</div>
<form action="{{ route('profile.picture') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="profile_picture">
    <button type="submit">Upload Profile Picture</button>
</form>
