 <!-- Content Header (Page header) -->
 <section class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1>{{ $page_title ??  'Dashboard' }}</h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">
                         @if(Auth::getDefaultDriver()== 'admin')
                         <a href="{{ route('admin.dashboard')}}">Home</a>
                         @elseif(Auth::getDefaultDriver()== 'client')
                         <a href="{{ route('client.dashboard')}}">Home</a>
                         @endif


                     </li>
                     <li class="breadcrumb-item active">{{ $page_title ??  'Dashboard'}}</li>
                 </ol>
             </div>
         </div>
     </div><!-- /.container-fluid -->
 </section>