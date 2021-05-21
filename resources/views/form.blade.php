<div class="form-group">
    <input type="text" class="form-control ml-3 @error('company_name') is-invalid @enderror"  placeholder="Company Name" name="company_name" value="{{ old('company_name') ?? Auth::user()->company_name }}" required>

    @error('company_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <input type="text" class="form-control ml-3 @error('name') is-invalid @enderror"  placeholder="Your Name" name="name" value="{{ old('name') ?? Auth::user()->name }}" required>
    
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror   
</div>
<div class="form-group">
    <input type="email" class="form-control ml-3 @error('email') is-invalid @enderror"  placeholder="Email" name="email" value="{{ old('email') ?? Auth::user()->email }}" required>

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <input type="text" class="form-control ml-3 @error('address') is-invalid @enderror"  placeholder="Company Address" name="address" value="{{ old('address') ?? Auth::user()->address }}" required>

    @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <input type="text" class="form-control ml-3 @error('telp_num') is-invalid @enderror"  placeholder="Telp.Number" name="telp_num" value="{{ old('telp_num') ?? Auth::user()->telp_num }}" required>

    @error('telp_num')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <input type="password" class="form-control ml-3 @error('password') is-invalid @enderror" placeholder="Password" name="password" required>

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <input type="password" class="form-control ml-3 @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" required>

    @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<button type="submit" class="btn login-form__btn submit w-100">{{$submit ?? 'Update'}}</button>