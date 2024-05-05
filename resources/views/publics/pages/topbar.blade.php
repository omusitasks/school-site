 <!-- Topbar Start -->
<div class="container-fluid bg-dark px-5 d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 45px;">

            <!-- For address information -->
            @if($address_info)
                @foreach ($address_info as $address_info)
                    <small class="me-3 text-light"><i class="{{ $address_info-> address_icon }} me-2"></i>{{ $address_info-> street_address_name }}, {{ $address_info-> city }}, {{ $address_info-> country }}</small>
                @endforeach
            @else
                <p>No email information available</p>
            @endif


            <!-- For contact information -->
            @if($contact_info)
                @foreach ($contact_info as $contact_info)
                <small class="me-3 text-light"><i class="{{ $contact_info->phone_icon }} me-2"></i>{{ $contact_info->company_phone_number }}</small>
                @endforeach
            @else
                <p>No contact information available</p>
            @endif

            <!-- For email information -->
            @if($email_info)
                @foreach ($email_info as $email_info)
                <small class="text-light"><i class="{{ $email_info->email_icon }} me-2"></i>{{ $email_info->company_email }}</small>
                @endforeach
            @else
                <p>No email information available</p>
            @endif

            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
            @foreach ($topnavbar as $topnavbar)
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="{{ $topnavbar->link }}"><i class="{{ $topnavbar->topbar_media_icon }} fw-normal"></i></a>
            @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
