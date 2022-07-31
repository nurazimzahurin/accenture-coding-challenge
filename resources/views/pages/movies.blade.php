@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 c0l-xl-8">
            <div class="card p-5">
                @if(isset($message))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-circle-check"></i>&nbsp;</strong> {{ $message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(isset($error))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-xmark"></i>&nbsp;</strong> {{ $error}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @foreach($errors->all() as $error) 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-circle-minus"></i>&nbsp;</strong> {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
                <div class="table-responsive">
                    <table class="table caption-top">
                        <caption>Movies&nbsp;&nbsp;&nbsp;&nbsp;<button class="roundButton btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#newMovie" style="font-size: 12px; font-weight:bold;"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Add New</button></caption>
                        <thead>
                            <tr style="max-height: 10px;">
                            <th scope="col" style="width:30%;">Name</th>
                            <th scope="col" style="width:10%;">Year</th>
                            <th scope="col" style="width:20%;">Producer</th>
                            <th scope="col" style="width:20%;">Actors</th>
                            <th scope="col" style="width:20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($movies->count() > 0)
                                @foreach ($movies as $movie)
                                <tr>
                                    <td>{{$movie->name}}</td> 
                                    <td>{{$movie->year_of_release}}</td>
                                    <td>
                                        <ol class="list-group">
                                            @foreach ($movie->producer as $producer)
                                            <li class="list-group-item" style="border:0; padding:0;">
                                            {{$producer->name}}
                                            </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        <ol class="list-group">
                                            @foreach ($movie->actors as $actor)
                                            <li class="list-group-item" style="border:0; padding:0;">
                                            {{$actor->name}}
                                            </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        <i class="fa-solid fa-eye text-info clickable" style="font-weight:bold; margin-right:20px;" data-bs-toggle="modal" data-bs-target="#viewMovie" onclick="viewMovie('{{$movie->id}}')"></i>
                                        <i class="fa-solid fa-user-plus text-info clickable" style="font-weight:bold; margin-right:20px;" data-bs-toggle="modal" data-bs-target="#viewMember" onclick="viewMember('{{$movie->id}}')"></i>
                                        <i class="fa-solid fa-trash text-danger clickable" style="font-weight:bold;" data-bs-toggle="modal" data-bs-target="#confirmDelete" onclick="document.getElementById('delete_movie_id').value = '{{$movie->id}}';"></i>
                                    </td>
                                </tr> 
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No Data</td> 
                                </tr> 
                            @endif
                            
                        </tbody>
                    </table>
                    @if ($movies->count() > 0)
                    <div class="d-flex justify-content-end">
                        {{$movies->links()}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .search-all:focus {
        border: 1px solid #ced4da;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    .search-all {
        border: 1px solid #ced4da;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    .clickable {
        cursor: pointer;
    }
    .roundButton {
        border-radius: 15px;
    }
    ::-webkit-scrollbar {
        width: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: #a9a9a9; 
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: grey; 
    }
    .form-control:disabled {
        background-color: #ffffff;
        opacity: 1;
    }
</style>
@endsection

@section('script')
<script>
    //Utilities
    function styleDate(event, element) {
        var keynum;

        if(window.event) { // IE                  
            keynum = event.keyCode;
        } else if(event.which){ // Netscape/Firefox/Opera                 
            keynum = event.which;
        }

        if(keynum != 8){ //check for backspace press
            var date = element.value;
            if(date.length == 2 || date.length == 5){
                element.value = date + '/';
            }
        }
    }
    function movetoNext(current, nextFieldID, e) {
        var code = (event.key ? event.key : e.which);

        if (current.value.length >= current.maxLength) {
            if(code == 'ArrowLeft' || code == 'ArrowRight' || code == 'Backspace'){
                //Do nothing
            } else {
                document.getElementById(nextFieldID).focus();
            }
        }
    }
    function updatePreview(element) {
        const file = element.files[0];
        if (file){
            let reader = new FileReader();
            reader.onload = function(event){
                var img = document.getElementById('view-image')
                img.setAttribute('src', event.target.result)
            }
            reader.readAsDataURL(file);
        }
    }
    function clearError(id) {
        document.getElementById(id).innerHTML = '';
    }
    function changeTab(showMe, hideMe) {
        document.getElementById(showMe).style.display = ''
        document.getElementById(hideMe).style.display = 'none'

        if (showMe === 'newMovieMember') {
            var button = document.getElementById('newMovieButton')
            button.setAttribute('onclick', 'assignNewMember();')
        } 
        if (showMe === 'newMember') {
            var button = document.getElementById('newMovieButton')
            button.setAttribute('onclick', 'createNewMember();')
        }
        if (showMe === 'view_member_create_celebrities') {
            var button = document.getElementById('view_member_button')
            button.setAttribute('onclick', 'createMember();')
        } 
        if (showMe === 'view_member_add_celebrities') {
            var button = document.getElementById('view_member_button')
            button.setAttribute('onclick', 'assignMember();')
        }
    }
    function deleteMovie() {
        var movieID = document.getElementById('delete_movie_id').value

        window.location.href = '/movie/' + movieID + '/delete'
    }
    //API calls
    function createMovie() {
        var name = document.getElementById('name')
        var year_of_release = document.getElementById('date')
        var plot = document.getElementById('plot')
        var poster = document.getElementById('poster')

        var formData = new FormData()
        formData.append('name', name.value)
        formData.append('year_of_release', year_of_release.value)
        formData.append('plot', plot.value)
        formData.append('poster', poster.files[0])

        axios.post('/movie/create', formData, {
            headers: {
            'Content-Type': 'multipart/form-data'
            }
        }).then(function (response) {
            var created_name = document.getElementById('created_name')
            created_name.value = response.data.name
            
            var created_img = document.getElementById('created_poster')
            created_img.setAttribute('src', response.data.media[0].original_url)

            var created_date = document.getElementById('created_date')
            created_date.value = response.data.year_of_release

            var created_plot = document.getElementById('created_plot')
            created_plot.value = response.data.plot 

            var created_id = document.getElementById('created_id')
            created_id.value = response.data.id

            document.getElementById('createMovie').style.display = 'none'
            document.getElementById('createdMovie').style.display = ''
            document.getElementById('newMovieMember').style.display = ''
            
            var button = document.getElementById('newMovieButton')
            button.setAttribute('onclick', 'assignNewMember();')
            var buttonFinish = document.getElementById('finishNewMovieButton')
            buttonFinish.style.display = ''

            axios.get('/celebrity/list')
            .then(function (responseGet) {
                var parentSelect = document.getElementById('member_name')
                parentSelect.innerHTML = '';
                //add default
                var options = document.createElement('option')
                options.setAttribute('selected', 'selected')
                options.appendChild(document.createTextNode('Select member'))
                parentSelect.appendChild(options)
                
                var members = responseGet.data;
                members.forEach(function (member) {
                    var options = document.createElement('option')
                    options.setAttribute('value', member.id)
                    options.appendChild(document.createTextNode(member.name))
                    parentSelect.appendChild(options)
                })
            })
            .catch(function (errorGet) {
                console.log(errorGet)
            });

            var messageAlert = document.getElementById('newMovieMessage')
            messageAlert.innerText = ''
            messageAlert.appendChild(document.createTextNode('Movie created successfully'))
            var alert = document.getElementById('newMovieAlert')
            alert.style.display = ''
            var scroll = document.getElementById('scrolltop')
            scroll.scrollTop = 0
        })
        .catch(function (error) {
            for (var field in error.response.data.errors) {
                var createChannelError = error.response.data.errors[field][0]
                if (field == 'name') {
                    var message = document.getElementById('name_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'year_of_release') {
                    var message = document.getElementById('year_of_release_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'plot') {
                    var message = document.getElementById('plot_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'poster') {
                    var message = document.getElementById('poster_error');
                    message.innerHTML = createChannelError
                }
            }
        });
    }
    function assignNewMember() {
        var member_id = document.getElementById('member_name')
        var member_role = document.getElementById('member_role')
        var movie_id = document.getElementById('created_id')

        var formData = new FormData()
        formData.append('movie_id', movie_id.value)
        formData.append('celebrity_id', member_id.value)
        formData.append('role', member_role.value)

        axios.post('/movie/celebrity/create', formData)
        .then(function (response) {
            console.log(response)
            var parent = document.getElementById('created_celebrities')
            parent.innerHTML = '';

            var producer = response.data.producer;
            producer.forEach(function (user) {   
                var list = document.createElement('li')
                list.setAttribute('class', 'list-group-item d-flex justify-content-between align-items-center')
                list.setAttribute('style', 'border:0;')
                var span = document.createElement('span')
                span.setAttribute('class', 'fw-bold')

                span.appendChild(document.createTextNode(user.name))
                list.appendChild(span)

                var icon = document.createElement('span')
                icon.setAttribute('class', 'fw-bold text-info')
                var producer = document.createElement('i')
                producer.setAttribute('class', 'fa-solid fa-user-tie')
                icon.appendChild(producer)
                icon.appendChild(document.createTextNode("                     Producer"))
                list.appendChild(icon)
                parent.appendChild(list)
            })

            var actors = response.data.actors;
            actors.forEach(function (user) {   
                var list = document.createElement('li')
                list.setAttribute('class', 'list-group-item d-flex justify-content-between align-items-center')
                list.setAttribute('style', 'border:0;')
                var span = document.createElement('span')
                span.setAttribute('class', 'fw-bold')

                span.appendChild(document.createTextNode(user.name))
                list.appendChild(span)
                parent.appendChild(list)
            })

            var messageAlert = document.getElementById('newMovieMessage')
            messageAlert.innerText = ''
            messageAlert.appendChild(document.createTextNode('Member added successfully'))
            var alert = document.getElementById('newMovieAlert')
            alert.style.display = ''
            var scroll = document.getElementById('scrolltop')
            scroll.scrollTop = 0
        })
        .catch(function (error) {
            console.log(error)
            for (var field in error.response.data.errors) {
                var createChannelError = error.response.data.errors[field][0]

                if (field == 'celebrity_id') {
                    var message = document.getElementById('member_name_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'role') {
                    var message = document.getElementById('member_role_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'movie_id') {
                    alert(createChannelError)
                }
            }
        });
    }
    function createNewMember() {
        var member_id = document.getElementById('new_member_name')
        var member_role = document.getElementById('new_member_role')
        var movie_id = document.getElementById('created_id')
        var sex = document.getElementById('new_member_sex')
        var dob = document.getElementById('new_member_dob')
        var bio = document.getElementById('new_member_bio')

        var formData = new FormData()
        formData.append('movie_id', movie_id.value)
        formData.append('name', member_id.value)
        formData.append('role', member_role.value)
        formData.append('sex', sex.value)
        formData.append('dob', dob.value)
        formData.append('bio', bio.value)

        axios.post('/celebrity/create', formData)
        .then(function (response) {
            console.log(response)
            var parent = document.getElementById('created_celebrities')
            parent.innerHTML = '';

            var producer = response.data.producer;
            producer.forEach(function (user) {   
                var list = document.createElement('li')
                list.setAttribute('class', 'list-group-item d-flex justify-content-between align-items-center')
                list.setAttribute('style', 'border:0;')
                var span = document.createElement('span')
                span.setAttribute('class', 'fw-bold')

                span.appendChild(document.createTextNode(user.name))
                list.appendChild(span)

                var icon = document.createElement('span')
                icon.setAttribute('class', 'fw-bold text-info')
                var producer = document.createElement('i')
                producer.setAttribute('class', 'fa-solid fa-user-tie')
                icon.appendChild(producer)
                icon.appendChild(document.createTextNode("                     Producer"))
                list.appendChild(icon)
                parent.appendChild(list)
            })

            var actors = response.data.actors;
            actors.forEach(function (user) {   
                var list = document.createElement('li')
                list.setAttribute('class', 'list-group-item d-flex justify-content-between align-items-center')
                list.setAttribute('style', 'border:0;')
                var span = document.createElement('span')
                span.setAttribute('class', 'fw-bold')

                span.appendChild(document.createTextNode(user.name))
                list.appendChild(span)
                parent.appendChild(list)
            })

            var messageAlert = document.getElementById('newMovieMessage')
            messageAlert.innerText = ''
            messageAlert.appendChild(document.createTextNode('Celebrity created and added as member.'))
            var alert = document.getElementById('newMovieAlert')
            alert.style.display = ''
            var scroll = document.getElementById('scrolltop')
            scroll.scrollTop = 0
        })
        .catch(function (error) {
            console.log(error)
            for (var field in error.response.data.errors) {
                var createChannelError = error.response.data.errors[field][0]

                if (field == 'name') {
                    var message = document.getElementById('new_member_name_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'sex') {
                    var message = document.getElementById('new_member_sex_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'dob') {
                    var message = document.getElementById('new_member_dob_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'bio') {
                    var message = document.getElementById('new_member_bio_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'role') {
                    var message = document.getElementById('new_member_role_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'movie_id') {
                    alert(createChannelError)
                }
            }
        });
    }
    function viewMovie(movieID) {
        axios.get('/movie/' + movieID)
        .then(function (response) {
            var name = document.getElementById('view-name')
            name.value = response.data.name
            
            var img = document.getElementById('view-image')
            img.setAttribute('src', response.data.media[0].original_url)

            var name = document.getElementById('view-date')
            name.value = response.data.year_of_release

            var name = document.getElementById('view-plot')
            name.value = response.data.plot

            document.getElementById('view-id').value = response.data.id
            var nameError = document.getElementById('view-name-error')
            nameError.innerHTML = ''
            var dateError = document.getElementById('view-date-error')
            dateError.innerHTML = ''
            var plotError = document.getElementById('view-plot-error')
            plotError.innerHTML = ''
            var fileError = document.getElementById('view-file-error')
            fileError.innerHTML = ''
        })
        .catch(function (error) {
            console.log(error)
        });
    }
    function viewMember(movieID) {
        axios.get('/movie/' + movieID)
        .then(function (response) {
            console.log(response)
            document.getElementById('view_member_movie_id').value = response.data.id
            var parent = document.getElementById('view_member_celebrities')
            parent.innerHTML = '';

            var producer = response.data.producer;
            producer.forEach(function (user) {   
                var list = document.createElement('li')
                list.setAttribute('class', 'list-group-item')
                list.setAttribute('style', 'border:0; padding-bottom:15px;')
                var div = document.createElement('div')
                div.setAttribute('class', 'd-flex w-100 justify-content-between')
                var h5 = document.createElement('h5')
                h5.setAttribute('class', 'mb-1 text-info')
                var small = document.createElement('small')
                small.setAttribute('class', 'text-info')
                var p = document.createElement('p')
                p.setAttribute('class', 'mb-1')
                var small2 = document.createElement('small')

                small.appendChild(document.createTextNode('Producer'))
                h5.appendChild(document.createTextNode(user.name))
                div.appendChild(h5)
                div.appendChild(small)
                p.appendChild(document.createTextNode(user.bio))
                small2.appendChild(document.createTextNode(user.sex + ', born at ' + user.dob))
                list.appendChild(div)
                list.appendChild(p)
                list.appendChild(small2)
                list.appendChild(document.createElement('hr'))
                parent.appendChild(list)
            })

            var actors = response.data.actors;
            actors.forEach(function (user) {   
                var list = document.createElement('li')
                list.setAttribute('class', 'list-group-item')
                list.setAttribute('style', 'border:0; padding-bottom:15px;')
                var div = document.createElement('div')
                div.setAttribute('class', 'd-flex w-100 justify-content-between')
                var h5 = document.createElement('h5')
                h5.setAttribute('class', 'mb-1 text-info')
                var p = document.createElement('p')
                p.setAttribute('class', 'mb-1')
                var small2 = document.createElement('small')

                h5.appendChild(document.createTextNode(user.name))
                div.appendChild(h5)
                p.appendChild(document.createTextNode(user.bio))
                small2.appendChild(document.createTextNode(user.sex + ', born at ' + user.dob))
                list.appendChild(div)
                list.appendChild(p)
                list.appendChild(small2)
                list.appendChild(document.createElement('hr'))
                parent.appendChild(list)
            })

            axios.get('/celebrity/list')
            .then(function (responseGet) {
                var parentSelect = document.getElementById('view_member_add_celebrities_name')
                parentSelect.innerHTML = '';
                //add default
                var options = document.createElement('option')
                options.setAttribute('selected', 'selected')
                options.appendChild(document.createTextNode('Select member'))
                parentSelect.appendChild(options)
                
                var members = responseGet.data;
                members.forEach(function (member) {
                    var options = document.createElement('option')
                    options.setAttribute('value', member.id)
                    options.appendChild(document.createTextNode(member.name))
                    parentSelect.appendChild(options)
                })
            })
            .catch(function (errorGet) {
                console.log(errorGet)
            });
        })
        .catch(function (error) {
            console.log(error)
        });
    }
    function assignMember() {
        var member_id = document.getElementById('view_member_add_celebrities_name')
        var member_role = document.getElementById('view_member_add_celebrities_role')
        var movie_id = document.getElementById('view_member_movie_id')

        var formData = new FormData()
        formData.append('movie_id', movie_id.value)
        formData.append('celebrity_id', member_id.value)
        formData.append('role', member_role.value)

        axios.post('/movie/celebrity/create', formData)
        .then(function (response) {
            console.log(response)
            window.location.href = "{{ route('movie-list', ['message' => 'Member added successfully.'])}}";
        })
        .catch(function (error) {
            console.log(error)
            for (var field in error.response.data.errors) {
                var createChannelError = error.response.data.errors[field][0]

                if (field == 'celebrity_id') {
                    var message = document.getElementById('view_member_add_celebrities_name_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'role') {
                    var message = document.getElementById('view_member_add_celebrities_role_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'movie_id') {
                    alert(createChannelError)
                }
            }
        });
    }
    function createMember() {
        var member_id = document.getElementById('view_member_create_celebrities_name')
        var member_role = document.getElementById('view_member_create_celebrities_role')
        var movie_id = document.getElementById('view_member_movie_id')
        var sex = document.getElementById('view_member_create_celebrities_sex')
        var dob = document.getElementById('view_member_create_celebrities_dob')
        var bio = document.getElementById('view_member_create_celebrities_bio')

        var formData = new FormData()
        formData.append('movie_id', movie_id.value)
        formData.append('name', member_id.value)
        formData.append('role', member_role.value)
        formData.append('sex', sex.value)
        formData.append('dob', dob.value)
        formData.append('bio', bio.value)

        axios.post('/celebrity/create', formData)
        .then(function (response) {
            console.log(response)
            window.location.href = "{{ route('movie-list', ['message' => 'Member created and added successfully.'])}}";
        })
        .catch(function (error) {
            console.log(error)
            for (var field in error.response.data.errors) {
                var createChannelError = error.response.data.errors[field][0]

                if (field == 'name') {
                    var message = document.getElementById('view_member_create_celebrities_name_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'sex') {
                    var message = document.getElementById('view_member_create_celebrities_sex_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'dob') {
                    var message = document.getElementById('view_member_create_celebrities_dob_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'bio') {
                    var message = document.getElementById('view_member_create_celebrities_bio_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'role') {
                    var message = document.getElementById('view_member_create_celebrities_role_error');
                    message.innerHTML = createChannelError
                }

                if (field == 'movie_id') {
                    alert(createChannelError)
                }
            }
        });
    }
    function editMovie() {
        var name = document.getElementById('view-name')
        var year_of_release = document.getElementById('view-date')
        var plot = document.getElementById('view-plot')
        var poster = document.getElementById('view-file')
        var movieID = document.getElementById('view-id').value

        var formData = new FormData()
        formData.append('name', name.value)
        formData.append('year_of_release', year_of_release.value)
        formData.append('plot', plot.value)
        if (poster.files.length > 0) {
            formData.append('poster', poster.files[0])
        }

        axios.post('/movie/' + movieID + '/edit', formData, {
            headers: {
            'Content-Type': 'multipart/form-data'
            }
        }).then(function (response) {
            console.log(response)
            if (response.data === 1) {
                window.location.href = "{{ route('movie-list', ['message' => 'Movie updated successfully.'])}}"
            } else {
                alert("Fail update movie")
            }
        })
        .catch(function (error) {
            for (var field in error.response.data.errors) {
                var createChannelError = error.response.data.errors[field][0]
                if (field == 'name') {
                    var message = document.getElementById('view-name-error');
                    message.innerHTML = createChannelError
                }

                if (field == 'year_of_release') {
                    var message = document.getElementById('view-date-error');
                    message.innerHTML = createChannelError
                }

                if (field == 'plot') {
                    var message = document.getElementById('view-plot-error');
                    message.innerHTML = createChannelError
                }

                if (field == 'poster') {
                    var message = document.getElementById('view-file-error');
                    message.innerHTML = createChannelError
                }
            }
        });
    }
</script>
@endsection
