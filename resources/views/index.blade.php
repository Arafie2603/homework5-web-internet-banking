@include('layouts.include.head')
@include('layouts.include.footer')

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <img class="image-fluid col-lg-13" src="{{asset('assets/rakamin.png')}}" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Register</h1>
                        </div>
                        <form method="post" action="{{ url('pendaftaran') }}" enctype="multipart/form-data" class="user">
                            @csrf
                            <div class="form-group">
                                @if (session('success'))
                                <div class="alert alert-success alert-dimissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert"><span>x</span></button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                                    
                                @endif
                                @if (session('error'))
                                <div class="alert alert-danger alert-dimissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert"><span>x</span></button>
                                        {{ session('error') }}
                                    </div>
                                </div>
                                    
                                @endif
                                <label for="name"></label>
                                <input name="name" type="name" class="form-control @error('name')
                                is-invalid
                            @enderror  form-control-user" id="name"
                                    placeholder="name" value="{{ old('name') }}">
                                    @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control form-control-user @error('email')
                                    is-invalid
                                @enderror  " id="exampleInputEmail"
                                    placeholder="email" value="{{ old('email') }}">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control @error('password')
                                is-invalid
                            @enderror form-control-user" id="exampleInputEmail"
                                    placeholder="password" >
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>    
                            <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
