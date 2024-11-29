<label for="username">Username</label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username"
               value="{{ isset($authenticator) ? $authenticator->username : old('username') }}"
               placeholder="Enter username" required>
    </div>
    @error('username')
    <div class="invalid-feedback text-danger">{{ $message }}</div>
    @enderror
</div>

<label for="email">Email</label>
<div class="form-group">
    <div class="form-line">
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
               value="{{ isset($authenticator) ? $authenticator->email : old('email') }}"
               placeholder="Enter email" required>
    </div>
    @error('email')
    <div class="invalid-feedback text-danger">{{ $message }}</div>
    @enderror
</div>

<label for="password">Password</label>
<div class="form-group">
    <div class="form-line">
        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
               placeholder="Enter password" {{ isset($authenticator) ? '' : 'required' }}>
    </div>
    @error('password')
    <div class="invalid-feedback text-danger">{{ $message }}</div>
    @enderror
</div>

<label for="phone">Phone</label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone"
               value="{{ isset($authenticator) ? $authenticator->phone : old('phone') }}"
               placeholder="Enter phone number" required>
    </div>
    @error('phone')
    <div class="invalid-feedback text-danger">{{ $message }}</div>
    @enderror
</div>

<label for="id_number">ID Number</label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="id_number" class="form-control @error('id_number') is-invalid @enderror" name="id_number"
               value="{{ isset($authenticator) ? $authenticator->id_number : old('id_number') }}"
               placeholder="Enter ID number" required>
    </div>
    @error('id_number')
    <div class="invalid-feedback text-danger">{{ $message }}</div>
    @enderror
</div>

<label for="address">Address</label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address"
               value="{{ isset($authenticator) ? $authenticator->address : old('address') }}"
               placeholder="Enter address (optional)">
    </div>
    @error('address')
    <div class="invalid-feedback text-danger">{{ $message }}</div>
    @enderror
</div>
