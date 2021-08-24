@extends('layouts.apps')
@section('title', 'User Profile')

@section('contents')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-black-50">Profile</h4>
                        @if (Auth::user()->userable_type === "App\Models\Client\Agent" || Auth::user()->userable_type === "App\Models\Client\Distributor")
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-1" src="{{asset('uploads/'. Auth::user()->userable->thumbnail)}}" width="80" height="80" alt="">
                                <div class="media-body">
                                    <h4 class="mb-0 text-black-50">{{ Auth::user()->userable->name}}</h4>
                                    <p class="text-muted mb-0">{{ Auth::user()->userable->email }}</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-1" src="{{asset('uploads/'. Auth::user()->userable->thumbnail)}}" width="80" height="80" alt="">
                                <div class="media-body">
                                    <h4 class="mb-0 text-black-50">{{ Auth::user()->userable->ceo_name}}</h4>
                                    <p class="text-muted mb-0">{{ Auth::user()->userable->company_email }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row mb-5">
                            <div class="col-12 text-center">
                                <a href="{{ route('profile.edit') }}" class="btn btn-danger px-5">Update Profile</a>
                            </div>
                        </div>
                        @if (Auth::user()->userable_type === "App\Models\Server\Company")
                        <h4>About Me</h4>
                        <p class="text-muted">{{ Auth::user()->userable->about}}</p>
                        @endif
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{ Auth::user()->userable->company_telp_num }}</span></li>
                            <li><strong class="text-dark mr-4">Login Email</strong> <span>{{ Auth::user()->email }}</span></li>
                        </ul>
                    </div>
                </div>  
            </div>
            <div class="col-lg-8 col-xl-8">
                <div style="display: none" class="upload-status my-3">
                    <h5 class="mt-3">Upload Images <span class="float-right">0%</span></h5>
                    <div class="progress" style="height: 9px">
                        <div class="progress-bar bg-danger wow  progress-" role="progressbar"></div>
                    </div>
                </div>
                <div class="click2edit m-b-40"></div>
                <button onclick="edit(0)" class="edit btn mb-1 btn-secondary mb-4">Buat Laporan <span class="btn-icon-right"><i class="fa fa-envelope"></i></span>
                </button>
                <button style="display: none" id="update" class="hidden update btn btn-sm btn-success mt-2" onclick="update(0,0)" type="button">Save</button>
                <button style="display: none" onclick="cancel(0)" class="hidden cancel  btn btn-sm btn-danger mt-2">Cancel</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-black-50">Daftar Laporan</h3>
                        @foreach (Auth::user()->userable->post as $post)
                            <div class="media media-reply">
                                {{-- <img class="mr-3 circle-rounded" src="{{asset('uploads/'.$post->owner->thumbnail)}}" width="50" height="50"> --}}
                                <div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        {{-- <h5 class="mb-sm-0">{{ $post->owner->ceo_name }}  --}}
                                            <p class="text-muted text-">{{($post->created_at == $post->updated_at) ? $post->created_at->diffForHumans() : 'Disunting '.$post->updated_at->diffForHumans()}}</p>
                                        <div class="media-reply__link">
                                            <button data-toggle="modal" data-target="#{{$post->owner->slug.$post->id}}" class="btn btn-transparent p-2"><i class="fa fa-trash-o fa-lg"></i></button>
                                            <button id="edit" onclick="edit({{$loop->iteration}})" class="edit btn btn-transparent p-0 mt-1 ml-3"><i class="fa fa-pencil-square-o fa-lg"></i></button>
                                            <button style="display: none" onclick="cancel({{$loop->iteration}})" class="hidden cancel btn btn-transparent p-0 mt-1 ml-3"><i class="fa fa-window-close-o fa-lg"></i></button>
                                        </div>
                                    </div>
                                    <div style="display: none" class="upload-status my-3">
                                        <h5 class="mt-3">Upload Images <span class="float-right">0%</span></h5>
                                        <div class="progress" style="height: 9px">
                                            <div class="progress-bar bg-danger wow  progress-" role="progressbar"></div>
                                        </div>
                                    </div>
                                    <div class="click2edit m-b-40 text-dark">{!!$post->post!!}</div>
                                    <button id="update" style="display: none" class="hidden update btn btn-sm btn-success mt-2" onclick="update({{$post->id.','.$loop->iteration}})" type="button">Save</button>
                                </div>
                            </div>
                            @section('type', 'company-post')
                            @include('layouts.modal')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

<script>
    window.edit = function (i) { 
        $('.click2edit').eq(i).summernote({
            callbacks: {
                onImageUpload: function(files) {
                    if(files[0].size <= 5100000){
                        imageSave(files[0],i)
                    }else{
                        alert(`Ukuran image terlalu besar`)
                    }
                },
                onMediaDelete: function(files) {
                    imageDelete(files[0],i)
                }
            }
        })
        $('.update').eq(i).show('slow');
        $('.cancel').eq(i).show();
        $('.edit').eq(i).hide();
    },
    window.cancel = function (i) {
        $('.cancel').eq(i).hide()
        $('.edit').eq(i).show();
        $('.update').eq(i).hide('slow');
        $('.click2edit').eq(i).summernote('reset')
        $(".click2edit").eq(i).summernote("destroy")
    },
    window.update = function (identifier, i) {
        let postBody = $('.click2edit').eq(i).summernote('code');
        let url = (identifier === 0) ? '{{route("profile.posting")}}' : '{{route("post.update")}}'
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'post',
            url: url,
            dataType: 'json',
            data: {
                'id' : identifier,
                postBody : postBody
            },
            success: function(res) {
                if(identifier === 0){
                    location.reload();
                }
            }
        })
        $(".click2edit").eq(i).summernote("destroy")
        $('.update').eq(i).hide('slow')
        $('.edit').eq(i).show()
        $('.cancel').eq(i).hide()
        
    }; 
    function imageSave(files,i) {
        let imgFile = new FormData()
            imgFile.append('image', files)
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'post',
            url: "{{ route('post.image') }}",
            dataType: 'json',
            data: imgFile,
            processData : false,
            contentType : false,
            xhr: function(){
                //upload Progress
                let xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    $('.upload-status').eq(i).show('slow')
                    xhr.upload.addEventListener('progress', function(event) {
                        let percent = 0;
                        let position = event.loaded || event.position;
                        let total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //update progressbar
                        $(".progress-bar").eq(i).css("width", + percent +"%");
                        $("span.float-right").eq(i).text(percent +"%");
                    }, true);
                }
                return xhr;
            },
        }).done(function(res){ 
            $('.upload-status').eq(i).hide('slow')
            if(res.error){
                alert(res.error)
            }else{
                let imgTag = `<img src=${res.imgUrl}  style="width: 561.047px; height: 315.582px;">`
                // $('.click2edit').eq(i).summernote('insertImage',res.imgUrl)
                $('.click2edit').eq(i).summernote('pasteHTML', imgTag);
            }
        })
    }
    function imageDelete(files,i) {
        let imgUrt = files.getAttribute('src');
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'delete',
            url: "{{ route('delete.image') }}",
            dataType: 'json',
            data:{ 'data' : imgUrt},
            success: function(res) {
                // 
            }
        })
    }
</script>
<!--**********************************
    Content body end
***********************************-->



@endsection
