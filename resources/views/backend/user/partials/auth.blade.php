
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email"
               name="email" placeholder="Email" value="{{ $edit ? $user->email : '' }}">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" placeholder="optional"
               name="username" value="{{ $edit ? $user->username : '' }}">
    </div>
    <div class="form-group">
        <label for="password">{{ $edit ? 'New Password' : 'Password' }}</label>
        <input type="password" class="form-control" id="password"
               name="password" @if ($edit) placeholder="Leave field blank if you don't want to change it" @endif>
    </div>
    <div class="form-group">
        <label for="password_confirmation">{{ $edit ? 'Confirm New Password' : 'Confirm Password' }}</label>
        <input type="password" class="form-control" id="password_confirmation"
               name="password_confirmation" @if ($edit) placeholder="Leave field blank if you don't want to change it" @endif>
    </div>
    @if ($edit)
        <div class="col-md-12 mt-2">
            <div class="text-center">
                <button type="submit" class="btn btn-primary" id="update-login-details-btn">Update Login Details <i class="icon-paperplane ml-2"></i></button>
                <a href="{{ route('user.list') }}" class="btn btn-light ml-2" id="cancel-btn">Cancel </a>
            </div>
        </div>
    @endif