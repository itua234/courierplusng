@include("layouts.header")
        <div class="container-fluid" style="background-color:#F6F6F7;">
            <!--  Row 1 -->
            <div class="row">
                <div class="col">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title fw-normal bg-white py-2 px-3 rounded-pill">All Users</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mt-2 fw-normal bg-white py-2 px-3 rounded-pill"><a href="{{route('admin.posts')}}">View Blog Posts</a></h5>
                    </div>
                    

                    <div class="row mt-3">
                        <div class="col-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table data-order="false" class="trx-table table table-borderless text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">S/N</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Name</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Email</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Photo</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Date</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Status</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Actions</h6>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $index => $user)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td> <!-- Serial Number -->
                                                        <td>{{ $user->firstname. " ".$user->lastname }}</td> <!-- User Name -->
                                                        <td>{{ $user->email }}</td> <!-- User Email -->
                                                        <td>
                                                            @if($user->avatar)
                                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="50" height="50" class="rounded-circle">
                                                            @else
                                                                <span></span>
                                                            @endif
                                                        </td> <!-- User Avatar -->
                                                        <td>{{ $user->created_at->format('d M, Y') }}</td> <!-- Registration Date -->
                                                        <td>
                                                            @if($user->status === 'approved')
                                                                <span class="">Active</span>
                                                            @else
                                                                <span class="">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($user->status === 'approved')
                                                                
                                                            @else
                                                                <a href="{{ route('admin.approve-user', ['userId' => $user->id]) }}" class="badge bg-danger text-decoration-none">
                                                                    Approve
                                                                </a>
                                                            @endif
                                                        </td> <!-- User Status -->
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  Pagination Starts -->
                        <!-- <div class="d-flex justify-content-center my-2 pr-2">
                            <button class="btn btn-light fs-4 fw-bold mr-2 paginate" data-page="" type="button">
                                <img src="{{asset('assets/images/icons/auth/cil_arrow-left.svg')}}" width="20" class="mr-2" alt="">
                                Previous
                            </button>
                            <button class="custom-btn fs-4 fw-bold paginate" data-page="" type="button">
                                Next
                                <img src="{{asset('assets/images/icons/auth/cil_arrow-right.svg')}}" width="20" class="mr-2" alt="">
                            </button>
                        </div>
                        <div class="my-2 pl-2">
                                Showing
                                <span class="entries fw-semibold">. </span> to
                                <span class="entries fw-semibold">. </span> of
                                <span class="entries fw-semibold">. </span>
                                transactions
                            </div> -->
                    <!--  Pagination Ends -->


                </div>
            </div>
            <!--  End of Row 1 -->
        </div>
    </div>
</div>
@include("layouts.footer")