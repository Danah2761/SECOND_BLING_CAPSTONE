<label for="username">Username</label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="username" class="form-control" name="username"
               value="{{ isset($admin) ? $admin->username : old('username') }}"
               placeholder="Enter username" required>
    </div>
    @error('username')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<label for="email">Email</label>
<div class="form-group">
    <div class="form-line">
        <input type="email" id="email" class="form-control" name="email"
               value="{{ isset($admin) ? $admin->email : old('email') }}"
               placeholder="Enter email" required>
    </div>
    @error('email')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<label for="phone">Phone</label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="phone" class="form-control" name="phone"
               value="{{ isset($admin) ? $admin->phone : old('phone') }}"
               placeholder="Enter phone number" required>
    </div>
    @error('phone')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<label for="role">Role</label>
<div class="form-group">
    <div class="form-line">
        <select id="role" class="selectpicker" name="role" required>
            <option value="super_admin" {{ isset($admin) && $admin->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            <option value="admin" {{ isset($admin) && $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>
    @error('role')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<label for="password">Password</label>
<div class="form-group">
    <div class="form-line">
        <input type="password" id="password" class="form-control" name="password"
               placeholder="Enter password {{ isset($admin) ? 'if you want to change' : '' }}">
    </div>
    @error('password')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
