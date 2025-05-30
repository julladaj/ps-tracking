<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu @if(isset($configData['navbarType']) && ($configData['navbarType'] !== "navbar-hidden") ){{$configData['navbarType']}} @else {{'navbar-sticky'}}@endif 2-columns
@if($configData['theme'] === 'dark'){{'dark-layout'}} @elseif($configData['theme'] === 'semi-dark'){{'semi-dark-layout'}} @else {{'light-layout'}} @endif
@if($configData['isContentSidebar']=== true) {{'content-left-sidebar'}} @endif
@if(isset($configData['footerType'])) {{$configData['footerType']}} @endif {{$configData['bodyCustomClass']}}
@if($configData['isCardShadow'] === false){{'no-card-shadow'}}@endif"
data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-framework="laravel">

  <!-- BEGIN: Header-->
  @include('panels.horizontal-navbar')
  <!-- END: Header-->

  <!-- BEGIN: Main Menu-->
  @include('panels.sidebar')
  <!-- END: Main Menu-->

  <!-- BEGIN: Content-->
  <div class="app-content content">
    {{-- Application page structure --}}
	@if($configData['isContentSidebar'] === true)
		<div class="content-area-wrapper">
			<div class="sidebar-left">
				<div class="sidebar">
					@yield('sidebar-content')
				</div>
			</div>
			<div class="content-right">
        <div class="content-overlay"></div>
				<div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
			</div>
		</div>
	@else
    {{-- others page structures --}}
    <div class="content-overlay"></div>
		<div class="content-wrapper">
			<div class="content-header row">
        @if($configData['pageHeader'] === true && isset($breadcrumbs))
          @include('panels.breadcrumbs')
        @endif
			</div>
			<div class="content-body">
				@yield('content')
			</div>
		</div>
	@endif
  </div>
  <!-- END: Content-->
@if($configData['isCustomizer'] === true && isset($configData['isCustomizer']))
  <!-- BEGIN: Customizer-->
  <div class="customizer d-none d-md-block">
    <a class="customizer-toggle" href="#"><i class="bx bx-cog bx bx-spin white"></i></a>
    @include('pages.customizer-content')
  </div>
  <!-- End: Customizer-->

  @endif
  @role('super-admin')
  <!-- demo chat-->
  <div class="widget-chat-demo">
    @include('pages.widget-chat')
  </div>
  @endrole

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  <!-- BEGIN: Footer-->
  @include('panels.footer')
  <!-- END: Footer-->

  @include('panels.scripts')
</body>
<!-- END: Body-->
