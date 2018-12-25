<div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="form-control" {{ $profile ? 'disabled' : '' }}>
                    @foreach($roles as $rolesId => $roleName)
                        <option value="{{ $rolesId }}" {{ ($edit && ($rolesId === $user->role_id)) ? 'selected' : '' }}>{{ $roleName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" {{ $profile ? 'disabled' : '' }}>
                    @foreach($statuses as $key => $val)
                        <option value="{{ $key }}" {{ ($edit && ($key === $user->status)) ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name"
                       name="first_name" placeholder="Your first name" value="{{ $edit ? $user->first_name : '' }}">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name"
                       name="last_name" placeholder="Your last name" value="{{ $edit ? $user->last_name : '' }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">

                <label for="birthday">Date of Birth</label>
                <div class="input-group">
                    <input type="text" name="birthday" id="birthday" value="{{ $edit ? $user->present()->birthday : '' }}" class="form-control pickadate-selectors" placeholder="Select a date" />
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone"
                       name="phone" placeholder="Phone number" value="{{ $edit ? $user->phone : '' }}">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ $edit ? $user->profile->address : '' }}">
            </div>
            <div class="form-group">
                <label for="country_id">Country</label>
                <select name="country_id" id="country_id" class="form-control">
                    @foreach($countries as $key => $val)
                        <option value="{{ $key }}" {{ ($edit && ($key === $user->profile->country_id)) ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if ($edit)
            <div class="col-md-12 mt-2">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">Update User Details <i class="icon-paperplane ml-2"></i></button>
                    <a href="{{ route('user.list') }}" class="btn btn-light ml-2" id="cancel-btn">Cancel </a>
                </div>
            </div>
        @endif
    </div>


