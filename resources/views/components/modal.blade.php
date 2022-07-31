<div class="modal fade" id="newMovie" tabindex="-1" aria-labelledby="newMovieLabel" aria-hidden="true" style="max-height: 100vh;">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-start">
                <i class="fa-solid fa-arrow-left fa-lg clickable text-primary" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 10px;"></i>
                <h5 class="modal-title" id="newMovieLabel">New Movie</h5>
            </div>
            <div class="modal-body" id="scrolltop">
                <div id="createMovie">
                    <h6><strong>Step 1 - Create Movie</strong></h6>
                    <div class="d-flex align-items-center justify-content-center">
                        <input id="name" type="text" name="name" class="form-control search-all text-center" placeholder="Movie name" style="border-left:0;border-right:0;border-top:0; border-radius:0; font-size:24px; font-weight:700;" oninput="clearError('name_error');">
                    </div>
                    <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="name_error"></span>
                    <br/>
                    <br/>
                    <div class="mb-3">
                        <label for="date" class="form-label" style="font-size: 12px;">Year Released :</label>
                        <input id="date" type="text" name="year_of_release" class="form-control search-all" placeholder="eg. 2022" style="border-left:0;border-right:0;border-top:0; border-radius:0;" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="movetoNext(this, 'plot', event);" oninput="clearError('year_of_release_error');">
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="year_of_release_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="plot" class="form-label" style="font-size: 12px;">Plot :</label>
                        <textarea id="plot" name="plot" class="form-control search-all" rows="2" placeholder="Enter plot" style="resize: none;" oninput="clearError('plot_error');"></textarea>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="plot_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="poster" class="form-label" style="font-size: 12px;">Poster :</label>
                        <input class="form-control form-control-sm" id="poster" name="poster" type="file" accept="image/png, image/jpg, image/jpeg" onchange="clearError('poster_error');">
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="poster_error"></span>
                    </div>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="newMovieAlert" style="display: none;">
                    <strong><i class="fa-solid fa-circle-check"></i>&nbsp;</strong><span id="newMovieMessage"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div style="display: none;" id="createdMovie">
                    <h6><strong>Step 1 - Create Movie</strong></h6>
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="#" id="created_poster" class="img-fluid" style="border-radius: 8px;max-height: 150px; width: auto;">
                    </div>
                    <br/>
                    <br/>
                    <input id="view-file" class="form-control form-control-sm" id="poster" name="poster" type="file" style="display: none;" onchange="updatePreview(this);" accept="image/png, image/jpg, image/jpeg">
                    <div class="d-flex align-items-center justify-content-center">
                        <input id="created_name" type="text" class="form-control search-all text-center" placeholder="Movie name" style="border-left:0;border-right:0;border-top:0; border-radius:0; font-size:24px; font-weight:700;" disabled>
                    </div>
                    <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="member_movie_id_error"></span>
                    <br/>
                    <div class="mb-3">
                        <label for="created_date" class="form-label" style="font-size: 12px;">Year Released :</label>
                        <input id="created_date" type="text" class="form-control search-all" placeholder="eg. 2022" style="border-left:0;border-right:0;border-top:0; border-radius:0;" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="created_plot" class="form-label" style="font-size: 12px;">Plot :</label>
                        <textarea id="created_plot" class="form-control search-all" rows="2" placeholder="Enter plot" style="resize: none;" disabled></textarea>
                    </div>
                    <input type="hidden" id="created_id">
                    <div class="mb-3">
                        <label for="created_celebrities" class="form-label" style="font-size: 12px;">Members :</label>
                        <ol class="list-group" style="position: sticky;height:calc(100vh - 40rem);overflow-y:scroll;" id="created_celebrities">
                            
                        </ol>
                    </div>
                </div>
                <div style="display: none;" id="newMovieMember">
                    <br/>
                    <hr>
                    <br/>
                    <h6><strong>Step 2 - Add Member</strong></h6>
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Choose Celebrities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="changeTab('newMember', 'newMovieMember')">Create Celebrities</a>
                        </li>
                    </ul>
                    <div class="mb-3">
                        <label for="member_name" class="form-label">Member :</label>
                        <select id="member_name" class="form-select" aria-label="Default select example" onchange="clearError('member_name_error');">
                        </select>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="member_name_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="member_role" class="form-label" style="font-size: 12px;">Role :</label>
                        <select id="member_role" class="form-select" aria-label="Default select example" onchange="clearError('member_role_error');">
                            <option selected>Select role</option>
                            <option value="producer">Producer</option>
                            <option value="actor">Actor</option>
                        </select>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="member_role_error"></span>
                    </div>
                </div>
                <div style="display: none;" id="newMember">
                    <br/>
                    <hr>
                    <br/>
                    <h6><strong>Step 2 - Add Member</strong></h6>
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#" onclick="changeTab('newMovieMember', 'newMember')">Choose Celebrities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Create Celebrities</a>
                        </li>
                    </ul>
                    <div class="mb-3">
                        <label for="new_member_name" class="form-label" style="font-size: 12px;">Name :</label>
                        <input id="new_member_name" type="text" class="form-control search-all" placeholder="Enter name" style="border-left:0;border-right:0;border-top:0; border-radius:0;" oninput="clearError('new_member_name_error');">
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="new_member_name_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="new_member_sex" class="form-label" style="font-size: 12px;">Gender :</label>
                        <select id="new_member_sex" class="form-select" aria-label="Default select example" onchange="clearError('new_member_sex_error');">
                            <option selected>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="new_member_sex_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="new_member_dob" class="form-label" style="font-size: 12px;">Birthday :</label>
                        <input id="new_member_dob" type="text" class="form-control search-all" placeholder="eg. 28/08/2022" style="border-left:0;border-right:0;border-top:0; border-radius:0;" maxlength="10" onkeypress="styleDate(event, this);return event.charCode >= 48 && event.charCode <= 57;" onkeyup="movetoNext(this, 'new_member_bio', event);" oninput="clearError('new_member_dob_error');">
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="new_member_dob_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="new_member_bio" class="form-label" style="font-size: 12px;">Bio :</label>
                        <textarea id="new_member_bio" class="form-control search-all" rows="2" placeholder="Enter bio" style="resize: none;" oninput="clearError('new_member_bio_error');"></textarea>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="new_member_bio_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="new_member_role" class="form-label" style="font-size: 12px;">Role :</label>
                        <select id="new_member_role" class="form-select" aria-label="Default select example" onchange="clearError('new_member_role_error');">
                            <option selected>Select role</option>
                            <option value="producer">Producer</option>
                            <option value="actor">Actor</option>
                        </select>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="new_member_role_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top:0;">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <button id="newMovieButton" class="btn btn-outline-primary" type="button" style="font-size: 12px; font-weight:bold; width:100px;" onclick="createMovie();"><i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Continue</button>
                    <button id="finishNewMovieButton" class="btn btn-outline-success" type="button" style="font-size: 12px; font-weight:bold; margin-left:25px; display:none; width:100px;" onclick="window.location.href = '{{route('movie-list', ['message' => 'Movie successfully added.'])}}';"><i class="fa-solid fa-check" style="margin-right: 5px;"></i>Finish</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewMovie" tabindex="-1" aria-labelledby="viewMovieLabel" aria-hidden="true" style="max-height: 100vh;">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-start">
                <i class="fa-solid fa-arrow-left fa-lg clickable text-primary" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 10px;"></i>
                <h5 class="modal-title" id="viewMovieLabel">View / Edit Movie</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-center">
                    <input type="hidden" id="view-id">
                    <img src="#" id="view-image" class="img-fluid" style="border-radius: 8px;max-height: 150px; width: auto;">
                    <i class="fa-solid fa-pen-to-square text-primary" style="cursor:pointer; position: absolute; top: 7%; left: 50%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); height:20px;" onclick="document.getElementById('view-file').click();"></i>
                </div>
                <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view-file-error"></span>
                <br/>
                <br/>
                <input id="view-file" class="form-control form-control-sm" id="poster" name="poster" type="file" style="display: none;" onchange="updatePreview(this);clearError('view-file-error');" accept="image/png, image/jpg, image/jpeg">
                <div class="d-flex align-items-center justify-content-center">
                    <input id="view-name" type="text" name="name" class="form-control search-all text-center" oninput="clearError('view-name-error');" placeholder="Movie name" style="border-left:0;border-right:0;border-top:0; border-radius:0; font-size:24px; font-weight:700;">
                </div>
                <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view-name-error"></span>
                <br/>
                <div class="mb-3">
                    <label for="date" class="form-label" style="font-size: 12px;">Year Released :</label>
                    <input id="view-date" type="text" name="year_of_release" class="form-control search-all" oninput="clearError('view-date-error');" placeholder="eg. 2022" style="border-left:0;border-right:0;border-top:0; border-radius:0;" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="movetoNext(this, 'view-plot', event);">
                    <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view-date-error"></span>
                </div>
                <div class="mb-3">
                    <label for="plot" class="form-label" style="font-size: 12px;">Plot :</label>
                    <textarea id="view-plot" name="plot" class="form-control search-all" rows="2" placeholder="Enter plot" style="resize: none;" oninput="clearError('view-plot-error');"></textarea>
                    <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view-plot-error"></span>
                </div>
            </div>
            <div class="modal-footer" style="border-top:0;">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <i class="fa-solid fa-right-to-bracket fa-xl clickable text-primary" onclick="editMovie();"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewMember" tabindex="-1" aria-labelledby="viewMemberLabel" aria-hidden="true" style="max-height: 100vh;">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-start">
                <i class="fa-solid fa-arrow-left fa-lg clickable text-primary" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 10px;"></i>
                <h5 class="modal-title">View / Add Members</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" id="view_member_movie_id">
                    <label for="view_member_celebrities" class="form-label" style="font-size: 12px;">Members :</label>
                    <ol class="list-group" id="view_member_celebrities" style="position: sticky;height:calc(100vh - 27rem);overflow-y:scroll;">
                        
                    </ol>
                </div>
                <div id="view_member_add_celebrities">
                    <br/>
                    <hr>
                    <br/>
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Choose Celebrities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="changeTab('view_member_create_celebrities', 'view_member_add_celebrities')">Create Celebrities</a>
                        </li>
                    </ul>
                    <div class="mb-3">
                        <label for="view_member_add_celebrities_name" class="form-label">Member :</label>
                        <select id="view_member_add_celebrities_name" class="form-select" aria-label="Default select example" onchange="clearError('view_member_add_celebrities_name_error');">
                        </select>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view_member_add_celebrities_name_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="view_member_add_celebrities_role" class="form-label" style="font-size: 12px;">Role :</label>
                        <select id="view_member_add_celebrities_role" class="form-select" aria-label="Default select example" onchange="clearError('view_member_add_celebrities_role_error');">
                            <option selected>Select role</option>
                            <option value="producer">Producer</option>
                            <option value="actor">Actor</option>
                        </select>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view_member_add_celebrities_role_error"></span>
                    </div>
                </div>
                <div style="display: none;" id="view_member_create_celebrities">
                    <br/>
                    <hr>
                    <br/>
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#" onclick="changeTab('view_member_add_celebrities', 'view_member_create_celebrities')">Choose Celebrities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Create Celebrities</a>
                        </li>
                    </ul>
                    <div class="mb-3">
                        <label for="view_member_create_celebrities_name" class="form-label" style="font-size: 12px;">Name :</label>
                        <input id="view_member_create_celebrities_name" type="text" class="form-control search-all" placeholder="Enter name" style="border-left:0;border-right:0;border-top:0; border-radius:0;" oninput="clearError('view_member_create_celebrities_name_error');">
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view_member_create_celebrities_name_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="view_member_create_celebrities_sex" class="form-label" style="font-size: 12px;">Gender :</label>
                        <select id="view_member_create_celebrities_sex" class="form-select" aria-label="Default select example" onchange="clearError('view_member_create_celebrities_sex_error');">
                            <option selected>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view_member_create_celebrities_sex_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="view_member_create_celebrities_dob" class="form-label" style="font-size: 12px;">Birthday :</label>
                        <input id="view_member_create_celebrities_dob" type="text" class="form-control search-all" placeholder="eg. 28/08/2022" style="border-left:0;border-right:0;border-top:0; border-radius:0;" maxlength="10" onkeypress="styleDate(event, this);return event.charCode >= 48 && event.charCode <= 57;" onkeyup="movetoNext(this, 'view_member_create_celebrities_bio', event);" oninput="clearError('view_member_create_celebrities_dob_error');">
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view_member_create_celebrities_dob_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="view_member_create_celebrities_bio" class="form-label" style="font-size: 12px;">Bio :</label>
                        <textarea id="view_member_create_celebrities_bio" class="form-control search-all" rows="2" placeholder="Enter bio" style="resize: none;" oninput="clearError('view_member_create_celebrities_bio_error');"></textarea>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view_member_create_celebrities_bio_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="view_member_create_celebrities_role" class="form-label" style="font-size: 12px;">Role :</label>
                        <select id="view_member_create_celebrities_role" class="form-select" aria-label="Default select example" onchange="clearError('view_member_create_celebrities_role_error');">
                            <option selected>Select role</option>
                            <option value="producer">Producer</option>
                            <option value="actor">Actor</option>
                        </select>
                        <span class="text-danger" style="font-size: 12px;font-weight:bold;" id="view_member_create_celebrities_role_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top:0;">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <i id="view_member_button" class="fa-solid fa-right-to-bracket fa-xl clickable text-primary" onclick="assignMember()"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                    <span>Are you sure to delete this movie?</span>
                    <input type="hidden" id="delete_movie_id">
                </div>
            </div>
            <div class="modal-footer" style="border-top:0;">
                <div class="d-flex align-items-center justify-content-end">
                <button class="btn btn-outline-primary" type="button" style="font-size: 12px; font-weight:bold; margin-right:30px; width:50px;" onclick="deleteMovie()">Yes</button>
                <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px; font-weight:bold; width:50px;">No</button>
                </div>
            </div>
        </div>
    </div>
</div>