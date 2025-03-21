@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')

				<!-- container -->
				<div class="container-fluid">

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="my-auto">
							<div class="d-flex"><h4 class="content-title mb-0 my-auto">Apps</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Calendar</span></div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="pr-1 mb-3 mb-xl-0">
								<button type="button" class="btn btn-info btn-icon mr-2"><i class="mdi mdi-filter-variant"></i></button>
							</div>
							<div class="pr-1 mb-3 mb-xl-0">
								<button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-star"></i></button>
							</div>
							<div class="pr-1 mb-3 mb-xl-0">
								<button type="button" class="btn btn-warning  btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
							</div>
							<div class="mb-3 mb-xl-0">
								<div class="btn-group dropdown">
									<button type="button" class="btn btn-primary">14 Aug 2019</button>
									<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
										<a class="dropdown-item" href="#">2015</a>
										<a class="dropdown-item" href="#">2016</a>
										<a class="dropdown-item" href="#">2017</a>
										<a class="dropdown-item" href="#">2018</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- breadcrumb -->

					<div class="main-content-app pd-b-0  main-content-calendar pt-0">
						<!-- row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-xl-4">
								<div class=" card card--calendar p-0 mg-b-20">
									<div class="p-4 border-bottom">
										<h2 class="main-content-title mg-b-15 tx-16">My Calendar</h2>
										<div class="text-center mx-auto">
											<img src="../../assets/img/media/calendar.png" alt="calendar" class="ht-80p wd-80p">
										</div>
									</div>
									<div class=" card p-4 mb-0 pb-0 pl-4 pr-4 pt-4 border-0">
										<div class="fc-datepicker main-datepicker border "></div>
									</div>
									<div class="p-4 pt-0">
										<label class="main-content-label tx-14 tx-bold mg-b-10">Event List</label>
										<nav class="nav main-nav-column main-nav-calendar-event">
											<a class="nav-link" href=""><i class="icon ion-ios-calendar tx-primary"></i>
											<div>
												Calendar Events
											</div></a> <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-success"></i>
											<div>
												Birthday Events
											</div></a> <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-danger"></i>
											<div>
												Holiday Calendar
											</div></a> <a class="nav-link" href=""><i class="icon ion-ios-calendar tx-warning"></i>
											<div>
												Other Calendar
											</div></a> <a class="nav-link exclude" href=""><i class="icon ion-ios-calendar tx-info"></i>
											<div>
												Discovered Events
											</div></a>
										</nav>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-8">
								<div class="main-content-body main-content-body-calendar card p-4">
									<div class="main-calendar" id="calendar"></div>
								</div>
							</div>
						</div>
						<!-- /row -->
					</div>
				</div>
				<!-- Container closed -->
			</div>
			<!-- main-content closed -->

					<!-- Modal -->
			<div aria-hidden="true" class="modal main-modal-calendar-schedule" id="modalSetSchedule" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h6 class="modal-title">Create New Event</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="calendar.html" id="mainFormCalendar" method="post" name="mainFormCalendar">
								<div class="form-group">
									<input class="form-control" placeholder="Add title" type="text">
								</div>
								<div class="form-group d-flex align-items-center">
									<label class="rdiobox mg-r-60"><input checked name="etype" type="radio" value="event"> <span>Event</span></label> <label class="rdiobox"><input name="etype" type="radio" value="reminder"> <span>Reminder</span></label>
								</div>
								<div class="form-group mg-t-30">
									<label class="tx-13 mg-b-5 tx-gray-600">Start Date</label>
									<div class="row row-xs">
										<div class="col-7">
											<input class="form-control" id="mainEventStartDate" placeholder="Select date" type="text" value="">
										</div><!-- col-7 -->
										<div class="col-5">
											<select class="select2-modal main-event-time" data-placeholder="Select time" id="mainEventStartTime">
												<option label="Select time">
													Select time
												</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="tx-13 mg-b-5 tx-gray-600">End Date</label>
									<div class="row row-xs">
										<div class="col-7">
											<input class="form-control" id="EventEndDate" placeholder="Select date" type="text" value="">
										</div><!-- col-7 -->
										<div class="col-5">
											<select class="select2-modal main-event-time" data-placeholder="Select time" id="EventEndTime">
												<option label="Select time">
													Select time
												</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<textarea class="form-control" placeholder="Write some description (optional)" rows="2"></textarea>
								</div>
								<div class="d-flex mg-t-15 mg-lg-t-30">
									<button class="btn btn-main-primary pd-x-25 mg-r-5" type="submit">Save</button> <a class="btn btn-light" data-dismiss="modal" href="">Discard</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Modal -->

			<!-- Modal -->
			<div aria-hidden="true" class="modal main-modal-calendar-event" id="modalCalendarEvent" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<nav class="nav nav-modal-event">
								<a class="nav-link" href="#"><i class="icon ion-md-open"></i></a>
								<a class="nav-link" href="#"><i class="icon ion-md-trash"></i></a>
								<a class="nav-link" data-dismiss="modal" href="#">
								<i class="icon ion-md-close"></i></a>
							</nav>
						</div>
						<div class="modal-body">
							<div class="row row-sm">
								<div class="col-sm-6">
									<label class="tx-13 tx-gray-600 mg-b-2">Start Date</label>
									<p class="event-start-date"></p>
								</div>
								<div class="col-sm-6">
									<label class="tx-13 mg-b-2">End Date</label>
									<p class="event-end-date"></p>
								</div>
							</div><label class="tx-13 tx-gray-600 mg-b-2">Description</label>
							<p class="event-desc tx-gray-900 mg-b-30"></p><a class="btn btn-secondary wd-80" data-dismiss="modal" href="">Close</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /Modal -->
            

@endsection